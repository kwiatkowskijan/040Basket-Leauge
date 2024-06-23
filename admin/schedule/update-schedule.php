<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$gameId = 0;
$seasonID = 0;
$message = ''; // Zmienna do przechowywania wiadomości

if (isset($_GET['id'])) {
    $gameId = $_GET['id'];

    if(isset($_GET['season'])) {
        $seasonID = $_GET['season'];
    }

    if ($gameId != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `HomeID`, `AwayID`, `CourtID`, `SeasonID`, `HomeScore`, `AwayScore` 
                FROM `game` 
                WHERE `GameID` = $gameId";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $homeID = $row["HomeID"];
            $awayID = $row["AwayID"];
            $courtID = $row["CourtID"];
            $gameTime = $row["GameTime"];
            $gameDate = $row["GameDate"];
            $seasonID = $row["SeasonID"];
            $homeScore = $row["HomeScore"];
            $awayScore = $row["AwayScore"];
        } else {
            $message = "Nie znaleziono rekordu";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && !empty($_POST["id"])) {

        $ugameId = $_POST["id"];
        $uhomeID = $_POST["HomeID"];
        $uawayID = $_POST["AwayID"];
        $ucourtID = $_POST["CourtID"];
        $ugameTime = $_POST["GameTime"];
        $ugameDate = $_POST["GameDate"];
        $uhomeScore = $_POST["HomeScore"];
        $uawayScore = $_POST["AwayScore"];

        $sql = "UPDATE `game` SET `GameDate`=?, `GameTime`=?, `HomeID`=?, `AwayID`=?, `CourtID`=?, `HomeScore`=?, `AwayScore`=? WHERE `GameID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssiii", $ugameDate, $ugameTime, $uhomeID, $uawayID, $ucourtID, $uhomeScore, $uawayScore, $ugameId);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Pomyślnie zaktualizowano";
            } else {
                $message = "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    } elseif (isset($_POST["seasonID"]) && !empty($_POST["seasonID"])) {

        $aseasonId = $_POST["seasonID"];
        $ahomeID = $_POST["HomeID"];
        $aawayID = $_POST["AwayID"];
        $acourtID = $_POST["CourtID"];
        $agameTime = $_POST["GameTime"];
        $agameDate = $_POST["GameDate"];
        $ahomeScore = $_POST["HomeScore"];
        $aawayScore = $_POST["AwayScore"];

        $sql = "INSERT INTO `game` (`GameDate`, `GameTime`, `HomeID`, `AwayID`, `CourtID`, `SeasonID`, `HomeScore`, `AwayScore`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssiiiiii", $agameDate, $agameTime, $ahomeID, $aawayID, $acourtID, $aseasonId, $ahomeScore, $aawayScore);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Pomyślnie dodano";
            } else {
                $message = "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <title>Document</title>
</head>

<body>

    <?php
    $teamsHome = $connect->query("SELECT `TeamName`, `teams`.`TeamID` as `TeamID` FROM `teams` INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID` WHERE `teams_in_season`.`SeasonID` = $seasonID");
    $teamsAway = $connect->query("SELECT `TeamName`, `teams`.`TeamID` as `TeamID` FROM `teams` INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID` WHERE `teams_in_season`.`SeasonID` = $seasonID");
    $courts = $connect->query("SELECT `CourtID`, `Name` FROM `court` WHERE 1=1");
    ?>

    <div class="admin-page-container">
        <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Wybierz gospodarza</label><br>
                <select name="HomeID" required>
                    <?php
                    while ($row = $teamsHome->fetch_assoc()) {
                        echo "<option value='" . $row['TeamID'] . "'";
                        if ($isUpdate && $row['TeamID'] == $homeID) {
                            echo " selected";
                        }
                        echo ">" . $row['TeamName'] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label>Wybierz gościa</label><br>
                <select name="AwayID" required>
                    <?php
                    while ($row = $teamsAway->fetch_assoc()) {
                        echo "<option value='" . $row['TeamID'] . "'";
                        if ($isUpdate && $row['TeamID'] == $awayID) {
                            echo " selected";
                        }
                        echo ">" . $row['TeamName'] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label>Wybierz halę</label><br>
                <select name="CourtID" required>
                    <?php
                    while ($row = $courts->fetch_assoc()) {
                        echo "<option value='" . $row['CourtID'] . "'";
                        if ($isUpdate && $row['CourtID'] == $courtID) {
                            echo " selected";
                        }
                        echo ">" . $row['Name'] . "</option>";
                    }
                    ?>
                </select><br><br>

                <label>Data meczu</label><br>
                <input type="date" name="GameDate" value="<?php echo $isUpdate ? $gameDate : ''; ?>" min="<?php echo date('Y-m-d'); ?>" required /><br><br>
                
                <label>Godzina meczu</label><br>
                <input type="time" name="GameTime" value="<?php echo $isUpdate ? $gameTime : ''; ?>" required /><br><br>

                <label>Wynik gospodarza</label><br>
                <input type="number" name="HomeScore" value="<?php echo $isUpdate ? $homeScore : ''; ?>" /><br><br>

                <label>Wynik gościa</label><br>
                <input type="number" name="AwayScore" value="<?php echo $isUpdate ? $awayScore : ''; ?>" /><br><br>

                <?php
                if ($isUpdate) {
                    echo "<input type='hidden' name='id' value='" . $gameId . "' />";
                } else {
                    echo "<input type='hidden' name='seasonID' value='" . $seasonID . "' />";
                }
                ?>
                <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>
            </form>

            <?php if ($message): ?>
                <p><?php echo $message; ?></p>
                <a href="season-schedule.php" class="crud-add-button">Wróć</a>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>

<?php
$connect->close();
?>
