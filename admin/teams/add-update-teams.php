<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$teamID = 0;
$seasonID = 0;

if (isset($_GET['id'])) {
    
    $teamID = $_GET['id'];

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
    
    if(isset($_POST["id"]) && $_POST["id"] > 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {

        $uteamID = $_POST["id"];

        $teamName = $_POST["TeamName"];
        $city = $_POST["City"];
        $coachName = $_POST["Coach"];
        $establishedYear = $_POST["Year"];

        $sql = "UPDATE `teams` SET `TeamName`=?, `City`=?, `CoachName`=?, `EstablishedYear`=?  WHERE `TeamID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssii", $teamName, $city, $coachName, $establishedYear, $uteamID);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie zaktualizowano";
                echo "<a href='teams.php' class='crud-add-button'>Wróć</a>";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
        
    } else {

        $teamName = $_POST["TeamName"];
        $city = $_POST["City"];
        $coachName = $_POST["Coach"];
        $establishedYear = $_POST["Year"];

        $teamsSql = "INSERT INTO `teams` (`TeamName`, `City`, `Coachname`, `EstablishedYear`) VALUES (?, ?, ?, ?)";

        if ($teamsStmt = mysqli_prepare($connect, $teamsSql)) {
            mysqli_stmt_bind_param($teamsStmt, "sssi", $teamName, $city, $coachName, $establishedYear);
            mysqli_stmt_execute($teamsStmt);

            $uteamID = mysqli_insert_id($connect);
    
            mysqli_stmt_close($teamsStmt);

            $isUpdate = true;

            echo "Pomyślnie dodano";
            echo "<a href='teams.php' class='crud-add-button'>Wróć</a>";

        } else {
            echo "Oops! Something went wrong with the query preparation. Please try again later.";
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

        <label>Logo</label><br>
        <input type="file" name="logo" /><br><br>

        <?php
        if ($isUpdate) {
            echo "<input type='hidden' name='id' value='" . $teamID . "' />";
        }
        ?>
        <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>

    </form>

</body>

</html>

<?php
$connect->close();
?>