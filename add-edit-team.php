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

<?php include ("header.php"); ?>

<div class="subpage-container">

    <form action="add-edit-team-action.php" method="post">
        <label>Nazwa drużny</label><br>
        <input type="text" name="teamName" placeholder="Nazwa drużyny" required/><br>
        <input type="text" name="city" placeholder="Miasto" required/><br>
        <input type="number" name="establishedYear" placeholder="Rok utworzenia" required/><br>
        <input type="text" name="coach" placeholder="Trener" required/><br>
        <button type="submit">Dodaj drużyne</button>
    </form>

</div>

<?php include ("footer.php"); ?>