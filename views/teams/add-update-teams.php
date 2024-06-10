<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$teamID = 0;
$seasonID = 0;

if (isset($_GET['id'])) {
    $teamID = $_GET['id'];
    $seasonID = $_GET['season'];

    if ($teamID != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `TeamID`, `TeamName`, `City`, `CoachName`, `EstablishedYear`, `logo-filename`
                FROM `teams` 
                WHERE `TeamID` = $teamID";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $teamName = $row["TeamName"];
            $city = $row["City"];
            $coachName = $row["CoachName"];
            $establishedYear = $row["EstablishedYear"];
            $logo = $row["logo-filename"];
        } else {
            echo "Nie znaleziono rekordu";
        }
    } else {
        echo "Dodawanie";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && !empty($_POST["id"])) {

        $uteamID = $_POST["id"];
        $uteamName = $_POST["TeamName"];
        $ucity = $_POST["City"];
        $ucoachName = $_POST["Coach"];
        $uestablishedYear = $_POST["Year"];

        $sql = "UPDATE `teams` SET `TeamName`=?, `City`=?, `CoachName`=?, `EstablishedYear`=?  WHERE `TeamID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssii", $uteamName, $ucity, $ucoachName, $uestablishedYear, $uteamID);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie zaktualizowano";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    } elseif (isset($_POST["seasonID"]) && !empty($_POST["seasonID"])) {

        $aseasonID = $_POST["seasonID"];
        $ateamName = $_POST["TeamName"];
        $acity = $_POST["City"];
        $acoachName = $_POST["Coach"];
        $aestablishedYear = $_POST["Year"];

        mysqli_begin_transaction($connect);

        $teamsSql = "INSERT INTO `teams` (`TeamName`, `City`, `Coachname`, `EstablishedYear`) VALUES (?, ?, ?, ?)";

        if ($teamsStmt = mysqli_prepare($connect, $teamsSql)) {

            mysqli_stmt_bind_param($teamsStmt, "sssi", $ateamName, $acity, $acoachName, $aestablishedYear);

            if (mysqli_stmt_execute($teamsStmt)) {

                $ateamID = mysqli_insert_id($connect);

                $seasonSql = "INSERT INTO `teams_in_season` (`SeasonID`, `TeamID`) VALUES (?, ?)";

                if ($seasonStmt = mysqli_prepare($connect, $seasonSql)) {

                    mysqli_stmt_bind_param($seasonStmt, "ii", $aseasonID, $ateamID);

                    if (mysqli_stmt_execute($seasonStmt)) {

                        mysqli_commit($connect);
                        echo "Dodano oba wpisy";
                    } else {

                        mysqli_rollback($connect);
                        echo "Oops! Something went wrong with the second insert. Please try again later.";
                    }

                    mysqli_stmt_close($seasonStmt);
                } else {
                    mysqli_rollback($connect);
                    echo "Oops! Something went wrong with the second query preparation. Please try again later.";
                }
            } else {
                mysqli_rollback($connect);
                echo "Oops! Something went wrong with the first insert. Please try again later.";
            }

            mysqli_stmt_close($teamsStmt);
        } else {
            echo "Oops! Something went wrong with the first query preparation. Please try again later.";
        }
    }
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label>Nazwa</label><br>
        <input type="text" name="TeamName" value="<?php echo $isUpdate ? $teamName : ''; ?>" required /><br><br>

        <label>Miasto</label><br>
        <input type="text" name="City" value="<?php echo $isUpdate ? $city : ''; ?>" required /><br><br>

        <label>Trener</label><br>
        <input type="text" name="Coach" value="<?php echo $isUpdate ? $coachName : ''; ?>" required /><br><br>

        <label>Rok założenia</label><br>
        <input type="number" name="Year" value="<?php echo $isUpdate ? $establishedYear : ''; ?>" required /><br><br>


        <?php
        if ($isUpdate) {
            echo "<input type='hidden' name='id' value='" . $teamID . "' />";
        } else {
            echo "<input type='hidden' name='seasonID' value='" . $seasonID . "' />";
        }
        ?>
        <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>

    </form>

</body>

</html>

<?php
$connect->close();
?>