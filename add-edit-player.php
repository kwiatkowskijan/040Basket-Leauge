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

    <form id="player-form">
        <input type="text" name="firstName" placeholder="Imie" required /><br>
        <input type="text" name="lastName" placeholder="Nazwisko" required /><br>
        <input type="number" name="age" placeholder="Wiek" min="16" max="60" required/><br>
        <input type="number" name="height" placeholder="Wzrost (m)" min="1" max="3" step=".01" required/><br>
        <input type="number" name="weight" placeholder="Waga (kg)" min="1" max="200" step=".5" required/><br>
        <label for="position">Pozycja</label><br>
        <select name="position" required>
            <option value="Point Guard">Rozgrywający</option>
            <option value="Shooting Guard">Rzucający obrońca</option>
            <option value="Small Forward">Niski skrzydłowy</option>
            <option value="Power Forward">Silny skrzydłowy</option>
            <option value="Center">Środkowy</option>
        </select><br>
        <button type="submit">Utwórz zawodnika</button>
    </form>

    <div id="player-info-container">

    </div>

</div>

<script src=/040Basket-Leauge/assets/scripts/add-player.js></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>