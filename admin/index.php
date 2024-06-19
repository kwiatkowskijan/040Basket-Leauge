<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/includes/check-admin.php';
?>

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

<div class="admin-page-container">

    <div class="admin-nav-container">
        <a href="admin.php" class="admin-nav">Kokpit</a>
        <a href="seasons/seasons.php" class="admin-nav">Sezony</a>
        <a href="players/players.php" class="admin-nav">Zawodnicy</a>
        <a href="teams/teams.php" class="admin-nav">Drużyny</a>
        <a href="schedule/season-schedule.php" class="admin-nav">Mecze</a>
        <a href="/040Basket-Leauge/includes/signup.inc.php" class="admin-nav">Dodaj nowego admina</a>
    </div>

    <div class="admin-page-content">
       
    </div>


</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>