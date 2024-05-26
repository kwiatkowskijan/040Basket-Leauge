<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include ("views/layouts/header.php"); ?>

<div class="subpage-container">

    <form>
        <input type="text" name="teamName" placeholder="Nazwa drużyny" required /><br>
        <input type="text" name="city" placeholder="Miasto" required /><br>
        <input type="number" name="establishedYear" placeholder="Rok utworzenia" required /><br>
        <input type="text" name="coach" placeholder="Trener" required /><br>
        <button type="button" id="add-team">Dodaj drużyne</button>
    </form>

    <div id="info-container">

    </div>

</div>

<script>
    document.getElementById("add-team").onclick = function() {
        const teamName = document.querySelector('input[name="teamName"]').value;
        const city = document.querySelector('input[name="city"]').value;
        const establishedYear = document.querySelector('input[name="establishedYear"]').value;
        const coach = document.querySelector('input[name="coach"]').value;
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'add-edit-team-action.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('info-container').innerHTML = "<p>Pomyślnie dodano drużyune</p>";
            } else {
                console.error('Błąd podczas ładowania danych.');
            }
        }
        xhr.send('teamName=' + encodeURIComponent(teamName) + '&city=' + encodeURIComponent(city) + '&establishedYear=' + encodeURIComponent(establishedYear) + '&coach=' + encodeURIComponent(coach));
    };
</script>

<?php include ("views/layouts/footer.php"); ?>