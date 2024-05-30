<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/owl-logo-01.png">

    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>

<div class="subpage-container">


    <?php
    $playerID = $_GET['id'];

    $sql = "SELECT * FROM players WHERE PlayerID = $playerID";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<h1>" . $row["FirstName"] . " " . $row["LastName"] . "</h1>";
            if (!empty($row["PhotoLink"])) {
                echo "<img src='" . $row["PhotoLink"] . "' alt='Picture " . $row["FirstName"] . " " . $row["LastName"] . "' style='width:200px;height:auto;'>";
            }
            echo "<p>Szczegółowe informacje: </p>";
            echo "<table>";
            echo "<tr><td>Wiek: " . $row["Age"] . "</td></tr>";
            echo "<tr><td>Wzrost: " . $row["Height"] . "</td></tr>";
            echo "<tr><td>Waga: " . $row["Weight"] . "</td></tr>";
            echo "<tr><td>Pozycja: " . $row["Position"] . "</td></tr>";
            echo "</table>";
            echo "<br>";
        }
    } else {
        echo "Brak szczegółowych informacji.";
    }

    ?>


</div>