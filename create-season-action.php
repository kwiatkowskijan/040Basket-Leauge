<?php
    include("connect.php");

    $connect = OpenCon();

    $seasonName = $_POST['seasonName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sql = "INSERT INTO season (Name, StartDate, EndDate) VALUES ('$seasonName', '$startDate', '$endDate')";

    if ($connect->query($sql) === TRUE) {
        echo "<h3>Succesfully added</h3>";
    } else {
        echo "ERROR: Hush! Sorry $sql. " . $connect->error;
    }

    CloseCon($connect);
?>
