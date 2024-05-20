<?php
    include("connect.php");

    $connect = OpenCon();

    $teamName = $_POST['teamName'];
    $city = $_POST['city'];
    $establishedYear = $_POST['establishedYear'];
    $coach = $_POST['coach'];

    $sql = "INSERT INTO teams (TeamName, City, EstablishedYear, CoachName) VALUES ('$teamName', '$city', '$establishedYear', '$coach')";

    if ($connect->query($sql) === TRUE) {
        echo "<h3>Data stored in the database successfully."
            . " Please browse your localhost phpMyAdmin"
            . " to view the updated data.</h3>";
    } else {
        echo "ERROR: Hush! Sorry $sql. " . $connect->error;
    }

    CloseCon($connect);
?>
