<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $seasonID = intval($_GET['id']);
    $connect = OpenCon();

    mysqli_begin_transaction($connect);

    try {
        $teamInSeasonSql = "DELETE FROM `teams_in_season` WHERE `SeasonID` = ?";
        $seasonSql = "DELETE FROM `season` WHERE `SeasonID` = ?";

        if ($stmt1 = mysqli_prepare($connect, $teamInSeasonSql)) {
            mysqli_stmt_bind_param($stmt1, "i", $seasonID);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
        } else {
            throw new Exception("Błąd przygotowania zapytania nr1.");
        }

        if ($stmt2 = mysqli_prepare($connect, $seasonSql)) {
            mysqli_stmt_bind_param($stmt2, "i", $seasonID);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        } else {
            throw new Exception("Błąd przygotowania zapytania nr2.");
        }

        mysqli_commit($connect);
        echo "Usunięto pomyślnie sezon.<br>";

    } catch (Exception $e) {
        mysqli_rollback($connect);
        echo "Oops! Something went wrong. Please try again later.<br>";
    }

    CloseCon($connect);
}
?>
