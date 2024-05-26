<?php
include("connect.php");

$connect = OpenCon();

$seasonID = $_POST['seasonID'];
$teamID = $_POST['teamID'];

$connect->begin_transaction();

$check_sql = "SELECT * FROM teams_in_season WHERE SeasonID = '$seasonID' AND TeamID = '$teamID'";
$check_result = $connect->query($check_sql);


if ($check_result->num_rows == 0) {

    $sql = "INSERT INTO teams_in_season (SeasonID, TeamID) VALUES ('$seasonID', '$teamID')";

    if ($connect->query($sql) === TRUE) {
        echo "<h3>Succesfully added</h3>";
        $connect -> commit();
    } else {
        echo "ERROR: Hush! Sorry $sql. " . $connect->error;
        $connect -> rollback();
    }
} else {
    echo "Ta drużyna znajduje sie juz w tym sezonie.";
    $connect -> rollback();
}

CloseCon($connect);
?>