<?php
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
$connect = OpenCon();

$player = $_POST['playerID'];
$team = $_POST['teamID'];

$sql = "UPDATE players SET `TeamID` = '$team' WHERE `PlayerID` = '$player'";

if ($connect->query($sql) === TRUE) {
    $id = $connect->insert_id;

    echo "<p>Dodano zawodnika.</p>";
} else {
    echo "ERROR: Hush! Sorry $sql. " . $connect->error;
}


CloseCon($connect);
