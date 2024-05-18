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

<?php include("header.php"); ?>

<div class="subpage-container">
    <?php

    $sql = "SELECT `TeamID`,`TeamName`,`logo-filename` FROM `teams`";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $teamID = $row["TeamID"];
            $teamName = $row["TeamName"];
            $image = $row["logo-filename"];

            echo "<a href='team.php?TeamID=$teamID' class='team-link'>
                    <div class='team-container'>
                        <img src='img/$image' width='200px' height='170px'/>
                        <p>$teamName</p>
                    </div>
                  </a>";
        }
    } else {
        echo "0 results";
    }
    ?>
</div>

<?php include("footer.php"); ?>