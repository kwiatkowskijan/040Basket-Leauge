<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$playerID = 0;
$message = '';

if (isset($_GET['id'])) {
    $playerID = $_GET['id'];

    if ($playerID != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `PlayerID`, `FirstName`, `LastName`, `BirthDate`, `Height`, `Weight`, `Position`, `TeamID`
                FROM `players` 
                WHERE `PlayerID` = $playerID";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $firstName = $row["FirstName"];
            $lastName = $row["LastName"];
            $birthDate = $row["BirthDate"];
            $height = $row["Height"];
            $weight = $row["Weight"];
            $position = $row["Position"];
            $teamID = $row["TeamID"];
        } else {
            $message = "Nie znaleziono rekordu";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $playerID = $_POST["id"];
        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $birthDate = $_POST["BirthDate"];
        $height = $_POST["Height"];
        $weight = $_POST["Weight"];
        $position = $_POST["Position"];
        $teamId = $_POST["TeamID"];

        $sql = "UPDATE `players` SET `FirstName`=?, `LastName`=?, `BirthDate`=?, `Height`=?, `Weight` =?, `Position` =?, `TeamID` =?  WHERE `PlayerID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssddsii", $firstName, $lastName, $birthDate, $height, $weight, $position, $teamId, $playerID);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Pomyślnie zaktualizowano";
            } else {
                $message = "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    } else {

        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $birthDate = $_POST["BirthDate"];
        $height = $_POST["Height"];
        $weight = $_POST["Weight"];
        $position = $_POST["Position"];
        $teamID = $_POST["TeamID"];


        $teamsSql = "INSERT INTO `players` (`FirstName`, `LastName`, `BirthDate`, `Height`, `Weight`, `Position`, `TeamID`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($connect, $teamsSql)) {
            mysqli_stmt_bind_param($stmt, "sssddsi", $firstName, $lastName, $birthDate, $height, $weight, $position, $teamID);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Pomyślnie dodano";
                $playerID = mysqli_insert_id($connect);
                $isUpdate = true;
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
    $query = "SELECT `TeamName`, `teams`.`TeamID` FROM `teams`;";
    $teams = $connect->query($query);
    ?>

    <div class="admin-page-container">
        <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <label>Imię</label><br>
                <input type="text" name="FirstName" value="<?php echo $isUpdate ? $firstName : ''; ?>" required /><br><br>

                <label>Nazwisko</label><br>
                <input type="text" name="LastName" value="<?php echo $isUpdate ? $lastName : ''; ?>" required /><br><br>

                <label>Data urodzenia</label><br>
                <input type="date" name="BirthDate" value="<?php echo $isUpdate ? $birthDate : ''; ?>" required /><br><br>

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
                        echo "<option value='" . $row['TeamID'] . "'";
                        if ($isUpdate && $row['TeamID'] == $teamID) {
                            echo "selected";
                        }
                        echo ">" . $row['TeamName'] . "</option>";
                    }
                    ?>
                </select>

                <?php
                if ($isUpdate) {
                    echo "<input type='hidden' name='id' value='" . $playerID . "' />";
                }
                ?>
                <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>
                
            </form>

            <?php if ($message): ?>
                <p><?php echo $message; ?></p>
                <a href="players.php" class="crud-add-button">Wróć</a>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>

<?php
$connect->close();
?>
