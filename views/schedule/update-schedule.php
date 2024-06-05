<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id'])) {

    $isUpdate = true;
    $gameId = $_GET['id'];

    if ($gameId == 0) {
        $isUpdate = false;
    }

    $connect = OpenCon();

    if ($isUpdate) {
        $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `HomeID`, `AwayID`, `CourtID`, `SeasonID` \n"

            . "FROM `game` \n"

            . "WHERE `GameID` = $gameId";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $homeID = $row["HomeID"];
            $awayID = $row["AwayID"];
            $courtID = $row["CourtID"];
            $gameTime = $row["GameTime"];
            $gameDate = $row["GameDate"];
            $seasonID = $row["SeasonID"];
        } else {
            echo "Nie znaleziono rekordu";
        }
    } else if (!$isUpdate) {
        echo "Dodawanie";
    }
}

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $isUpdate = true;

    $ugameId = $_POST["id"];
    $uhomeID = $_POST["HomeID"];
    $uawayID = $_POST["AwayID"];
    $ucourtID = $_POST["CourtID"];
    $ugameTime = $_POST["GameTime"];
    $ugameDate = $_POST["GameDate"];

    if ($ugameID == 0) {
        $isUpdate = false;
    }

    $sql = "UPDATE `game` SET `GameDate`=?,`GameTime`=?,`HomeID`=?,`AwayID`=?,`CourtID`=? WHERE `GameID` = ?;";

    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssi", $ugameDate, $ugameTime, $uhomeID, $uawayID, $ucourtID, $ugameId);

        if (mysqli_stmt_execute($stmt)) {
            echo "Pomyślnie dodano";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $teamsHome = $connect->query("SELECT `TeamName`, `teams`.`TeamID` as `TeamID` FROM `teams` INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID` where `teams_in_season`.`SeasonID` = $seasonID");
    $teamsAway = $connect->query("SELECT `TeamName`, `teams`.`TeamID` as `TeamID` FROM `teams` INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID` where `teams_in_season`.`SeasonID` = $seasonID");
    $courts = $connect->query("SELECT `CourtID`, `Name` From `court` where 1=1");
    ?>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <label>Wybierz gospodarza</label><br>
        <select name="HomeID" required>
            <?php
            while ($row = $teamsHome->fetch_assoc()) {
                echo "<option value='" . $row['TeamID'] . "'";
                if ($row['TeamID'] == $homeID) {
                    echo " selected";
                };
                echo ">" . $row['TeamName'] . "</option>";
            }
            ?>
        </select><br><br>
        <label>Wybierz gościa</label><br>
        <select name="AwayID" required>
            <?php
            while ($row = $teamsAway->fetch_assoc()) {
                echo "<option value='" . $row['TeamID'] . "'";
                if ($row['TeamID'] == $awayID) {
                    echo " selected";
                };
                echo ">" . $row['TeamName'] . "</option>";
            }
            ?>
        </select><br><br>
        <label>Wybierz halę</label><br>
        <select name="CourtID" required>
            <?php
            while ($row = $courts->fetch_assoc()) {
                echo "<option value='" . $row['CourtID'] . "'";
                if ($row['CourtID'] == $courtID) {
                    echo " selected";
                };
                echo ">" . $row['Name'] . "</option>";
            }
            ?>
        </select><br><br>
        <label>Data meczu</label><br>
        <input type="date" name="GameDate" /><br><br>
        <input type="time" name="GameTime" /><br><br>
        <input type="hidden" name="id" value="<?php echo $gameId; ?>" />
        <button type="submit">Aktualizuj</button>
    </form>
</body>

</html>