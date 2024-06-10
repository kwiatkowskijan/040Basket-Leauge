<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $gameId = intval($_GET['id']);
    $connect = OpenCon();

    $sql = "DELETE FROM `game` WHERE `GameID` = ?";

    if ($stmt = mysqli_prepare($connect, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $gameId);

        if (mysqli_stmt_execute($stmt)) {
            echo "Usunięto pomyślnie";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
}
