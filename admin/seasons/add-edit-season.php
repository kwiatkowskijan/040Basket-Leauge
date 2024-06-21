<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$seasonID = 0;

if (isset($_GET['id'])) {
    $seasonID = $_GET['id'];

    if ($seasonID != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `Name`, `StartDate`, `EndDate`
                FROM `season` 
                WHERE `SeasonID` = $seasonID";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $name = $row["Name"];
            $startDate = $row["StartDate"];
            $endDate = $row["EndDate"];
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
        $seasonID = $_POST["id"];
        $name = $_POST["Name"];
        $startDate = $_POST["StartDate"];
        $endDate = $_POST["EndDate"];

        $sql = "UPDATE `season` SET `Name`=?, `StartDate`=?, `EndDate`=? WHERE `SeasonID` = ?";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $startDate, $endDate, $seasonID);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie zaktualizowano";
                echo "<a href='seasons.php' class='crud-add-button'>Wróć</a>";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    } else {

        $name = $_POST["Name"];
        $startDate = $_POST["StartDate"];
        $endDate = $_POST["EndDate"];

        $sql = "INSERT INTO `season` (`Name`, `StartDate`, `EndDate`) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $startDate, $endDate);

            if (mysqli_stmt_execute($stmt)) {
                echo "Pomyślnie dodano";
                echo "<a href='seasons.php' class='crud-add-button'>Wróć</a>";
                $playerID = mysqli_insert_id($connect);
                $isUpdate = true;
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label>Nazwa</label><br>
        <input type="text" name="Name" value="<?php echo $isUpdate ? $name : ''; ?>" required /><br><br>

        <label>Data startu</label><br>
        <input type="date" name="StartDate" value="<?php echo $isUpdate ? $startDate : ''; ?>" required /><br><br>

        <label>Data końca</label><br>
        <input type="date" name="EndDate" value="<?php echo $isUpdate ? $endDate : ''; ?>" required /><br><br>

        <?php
        if ($isUpdate) {
            echo "<input type='hidden' name='id' value='" . $seasonID . "' />";
        }
        ?>
        <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>

    </form>

</body>

</html>

<?php
$connect->close();
?>
