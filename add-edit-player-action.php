<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
    $connect = OpenCon();

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $position = $_POST['position'];

    $sql = "INSERT INTO players (FirstName, LastName, Age, Height, Weight, Position) VALUES ('$firstName', '$lastName', '$age', '$height', '$weight', '$position')";

    if ($connect->query($sql) === TRUE) {
        $id = $connect -> insert_id;

        echo "<p>Dodano zawodnika. <a href='playerDetails.php?PlayerID=$id'>Zobacz</a></p>";
    } else {
        echo "ERROR: Hush! Sorry $sql. " . $connect->error;
    }

    CloseCon($connect);
?>