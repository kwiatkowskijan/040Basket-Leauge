<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include("header.php"); ?>

<div class="subpage-container">
    <?php
    if (isset($_GET['TeamID'])) {

        $teamID = intval($_GET['TeamID']);

        $sql = "SELECT * FROM `teams_stats`\n"

            . "INNER JOIN `teams` on `teams_stats`.`TeamID` = `teams`.`TeamID`\n"

            . "WHERE `teams_stats`.`TeamID` = $teamID;";

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['TeamName'];
                $points = $row['Points'];
                $assists = $row['Assists'];
                $rebounds = $row['Rebounds'];

                echo "<p>Name: $name</p><br>";
                echo "<p>Points: $points</p><br>";
                echo "<p>Assists: $assists</p><br>";
                echo "<p>Points: $rebounds</p><br>";
            }
        } else {
            echo "Brak wyników dla tej drużyny";
        }
    } else {
        echo "Brak ID druzyny";
    }
    ?>
</div>

<?php include("footer.php"); ?>