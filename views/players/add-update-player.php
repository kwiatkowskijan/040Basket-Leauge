<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$teamID = 0;
$seasonID = 0;

if (isset($_GET['id'])) {
    $playerID = $_GET['id'];
    $seasonID = $_GET['season'];

    if ($playerID != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `PlayerID`, `FirstName`, `LastName`, `Age`, `Height`, `Weight`, `Position`, `TeamID`
                FROM `players` 
                WHERE `PlayerID` = $playerID";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $firstName = $row["FirstName"];
            $lastName = $row["LastName"];
            $age = $row["Age"];
            $height = $row["Height"];
            $weight = $row["Weight"];
            $position = $row["Position"];
            $teamID = $row["TeamID"];
        } else {
            echo "Nie znaleziono rekordu";
        }
    } else {
        echo "Dodawanie";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["PlayerID"]) && !empty($_POST["PlayerID"])) {

        $ufirstName = $_POST["FirstName"];
        $ulastName = $_POST["LastName"];
        $uage = $_POST["Age"];
        $uheight = $_POST["Height"];
        $uweight = $_POST["Weight"];
        $uposition = $_POST["Position"];
        $uteamId = $_POST["TeamID"];
        $uplayerId = $_POST["PlayerID"];

        $sql = "UPDATE `players` SET `FirstName`=?, `LastName`=?, `Age`=?, `Height`=?, `Weight` =?, `Position` =?, `TeamID` =?  WHERE `PlayerID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssiddsii", $ufirstName, $ulastName, $uage, $uheight, $uweight, $uposition, $uteamId, $uplayerId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie zaktualizowano";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    } elseif (isset($_POST["seasonID"]) && !empty($_POST["seasonID"])) {

        $afirstName = $_POST["FirstName"];
        $alastName = $_POST["LastName"];
        $aage = $_POST["Age"];
        $aheight = $_POST["Height"];
        $aweight = $_POST["Weight"];
        $aposition = $_POST["Position"];
        $ateamID = $_POST["TeamID"];


        $teamsSql = "INSERT INTO `players` (`FirstName`, `LastName`, `Age`, `Height`, `Weight`, `Position`, `TeamID`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($connect, $teamsSql)) {
            mysqli_stmt_bind_param($stmt, "ssiddsi", $afirstName, $alastName, $aage, $aheight, $aweight, $aposition, $ateamID);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie dodano";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Document</title>
</head>

<body>

    <?php
    $query = "SELECT `TeamName`, `teams`.`TeamID` 
FROM `teams`
INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID`
WHERE `SeasonID` = $seasonID;";

    $teams = $connect->query($query);
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label>Imię</label><br>
        <input type="text" name="FirstName" value="<?php echo $isUpdate ? $firstName : ''; ?>" required /><br><br>

        <label>Nazwisko</label><br>
        <input type="text" name="LastName" value="<?php echo $isUpdate ? $lastName : ''; ?>" required /><br><br>

        <label>Wiek</label><br>
        <input type="text" name="Age" value="<?php echo $isUpdate ? $age : ''; ?>" required /><br><br>

        <label>Pozycja</label><br>
        <select name="Position" required>
            <option value="Point Guard" <?php if ($isUpdate && $position == "Point Guard") {
                                            echo "selected";
                                        } ?>>Rozgrywający</option>
            <option value="Shooting Guard" <?php if ($isUpdate && $position == "Shooting Guard") {
                                                echo "selected";
                                            } ?>>Rzucający obrońca</option>
            <option value="Small Forward" <?php if ($isUpdate && $position == "Small Forward") {
                                                echo "selected";
                                            } ?>>Niski skrzydłowy</option>
            <option value="Power Forward" <?php if ($isUpdate && $position == "Power Forward") {
                                                echo "selected";
                                            } ?>>Silny skrzydłowy</option>
            <option value="Center" <?php if ($isUpdate && $position == "Center") {
                                        echo "selected";
                                    } ?>>Środkowy</option>
        </select><br><br>

        <label>Wzrost (m)</label>
        <input type="number" name="Height" min="1" max="3" step=".01" value="<?php echo $isUpdate ? $height : ''; ?>" required /><br><br>

        <label>Waga (kg)</label>
        <input type="number" name="Weight" min="1" max="200" step=".5" value="<?php echo $isUpdate ? $weight : ''; ?>" required /><br><br>

        <label>Drużyna</label>
        <select name="TeamID">
            <?php
            while ($row = $teams->fetch_assoc()) {
                echo "<option value='" . $row['TeamID'] . "'>" . $row['TeamName'] . "</option>";
            }
            ?>
        </select>

        <?php
        if ($isUpdate) {
            echo "<input type='hidden' name='PlayerID' value='" . $playerID . "' />";
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
