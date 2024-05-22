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
    $sql = "SELECT `TeamID`,`TeamName` FROM `teams`";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='team-container'><p>" . $row["TeamName"]  . "</p></div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</div>


<?php include("footer.php"); ?>