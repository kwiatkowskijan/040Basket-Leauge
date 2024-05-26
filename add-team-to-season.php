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

<?php
    $seasons = $connect -> query("SELECT `Name`, `SeasonID` FROM `season`;");
    $teams = $connect -> query("SELECT `TeamName`, `TeamID` FROM `teams`;")
?>

    <form action="add-team-to-season-action.php" method="POST">
        <label>Wybierz sezon</label><br>
        <select name="seasonID" required>
            <?php
                while($row = $seasons -> fetch_assoc()){
                    echo "<option value='" . $row['SeasonID'] . "'>" . $row['Name'] . "</option>";
                }
            ?>
        </select><br><br>
        <label>Wybierz drużyne</label><br>
        <select name="teamID" require>
            <?php
                while($row = $teams -> fetch_assoc()){
                    echo "<option value='" . $row['TeamID'] . "'>" . $row['TeamName'] . "</option>";
                }
            ?>
        </select><br><br>
        <button type="submit">Dodaj druzyne do sezonu</button>
    </form>
</div>

<?php include ("footer.php"); ?>