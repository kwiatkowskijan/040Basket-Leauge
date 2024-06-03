<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
    $connect = OpenCon();

    $teamName = $_GET['teamName'];

    $sql = "SELECT `TeamName` FROM `teams` WHERE `TeamName` = '$teamName'";

    $result = $connect->query($sql);

    if($result->num_rows == 1) {
        echo "Ta drużyna istnieje";
    }
    else {
        echo "Dodano";
    }

    CloseCon($connect);