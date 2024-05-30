<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

    $connect = OpenCon();

    $teamName = $_POST['teamName'];
    $city = $_POST['city'];
    $establishedYear = $_POST['establishedYear'];
    $coach = $_POST['coach'];

    $sql = "INSERT INTO teams (TeamName, City, EstablishedYear, CoachName) VALUES ('$teamName', '$city', '$establishedYear', '$coach')";

    if ($connect->query($sql) === TRUE) {
        $id = $connect -> insert_id;

        echo "<p>Dodano drużyne. <a href='team.php?TeamID=$id'>Zobacz</a></p>";
    } else {
        echo "ERROR: Hush! Sorry $sql. " . $connect->error;
    }

    CloseCon($connect);
?>
