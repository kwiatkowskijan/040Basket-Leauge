<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/owl-logo-01.png">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include ("header.php"); ?>

<div class="subpage-container">
    <?php
        if (isset($_GET['TeamID'])){

            $teamID = intval($_GET['TeamID']);
            
            $sql = "SELECT * FROM `teams_stats` WHERE `TeamID` = $teamID";

            $result = $connect->query($sql);

            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    $points = $row['Points'];
                    $assists = $row['Assists'];
                    $rebounds = $row['Rebounds'];

                    echo "<p>Points: $points</p><br>";
                    echo "<p>Assists: $assists</p><br>";
                    echo "<p>Points: $rebounds</p><br>";
                }
            }
            else {
                echo "Brak wyników dla tej drużyny";
            }


        }
        else {
            echo "Brak ID druzyny";
        }
    ?>
</div>

<?php include ("footer.php"); ?>