<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>

<?php

?>

<div class="subpage-container">
    <?php
    $seasons = $connect->query("SELECT `Name`, `SeasonID` FROM `season`;");
    ?>


    <form id="season-form">
        <label>Sezon</label><br>
        <select id="season-select" name="seasonID" value="1">
            <?php
            while ($row = $seasons->fetch_assoc()) {
                echo "<option value='" . $row['SeasonID'] . "'>" . $row['Name'] . "</option>";
            }
            ?>
        </select>
    </form><br>

    <div id="teams-container">

    </div>

</div>

<script src="/040Basket-Leauge/assets/scripts/season-select-for-schedule.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>