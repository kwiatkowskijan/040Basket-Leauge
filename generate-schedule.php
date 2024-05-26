<?php
include("connect.php");
$connect = OpenCon();

$seasons = $connect->query("SELECT `Name`, `SeasonID` FROM `season`;");
?>

<form action="generate-schedule.php" method="post">
    <label>Sezon</label><br>
    <select id="season-select" name="seasonID" value="1">
        <?php
        while ($row = $seasons->fetch_assoc()) {
            echo "<option value='" . $row['SeasonID'] . "'>" . $row['Name'] . "</option>";
        }
        ?>
    </select><br>
    <button type="submit">Utwórz terminarz</button>
</form>

<?php
CloseCon($connect);
?>