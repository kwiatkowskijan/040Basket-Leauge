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

<div class="subpage-container">

    <?php
    $player = $connect->query("SELECT `FirstName`, `LastName`, `PlayerID` FROM `players` WHERE `TeamID` IS NULL");
    $teams = $connect->query("SELECT `TeamName`, `TeamID` FROM `teams`;")
    ?>

    <form id="add-player-to-team">
        <label for="playerID">Zawodnik</label><br>
        <select name="playerID" required>
            <?php
            while ($row = $player->fetch_assoc()) {
                echo "<option value='" . $row['PlayerID'] . "'>" . $row['FirstName'] . " " . $row['LastName'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="teamID">Drużyna</label><br>
        <select name="teamID" required>
            <?php
            while ($row = $teams->fetch_assoc()) {
                echo "<option value='" . $row['TeamID'] . "'>" . $row['TeamName'] . "</option>";
            }
            ?>
        </select><br><br>
        <button type="submit">Dodaj zawodnika do drużyny</button>
    </form>

    <div id="team-to-player"></div>
</div>

<script src=/040Basket-Leauge/assets/scripts/add-player-to-team.js></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>