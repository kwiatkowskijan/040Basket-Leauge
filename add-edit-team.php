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

    <form>
        <input type="text" name="teamName" placeholder="Nazwa drużyny" required /><br>
        <input type="text" name="city" placeholder="Miasto" required /><br>
        <input type="number" name="establishedYear" placeholder="Rok utworzenia" required /><br>
        <input type="text" name="coach" placeholder="Trener" required /><br>
        <button type="submit" id="add-team">Dodaj drużyne</button>
    </form>

    <div id="info-container">

    </div>

</div>

<script src=/040Basket-Leauge/assets/scripts/add-team.js></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>