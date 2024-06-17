<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['season']) && !empty($_GET['season'])) {

    $teamID = intval($_GET['id']);
    $seasonID = intval($_GET['season']);
    $connect = OpenCon();

    // Rozpoczęcie transakcji
    mysqli_begin_transaction($connect);

    try {
        // Zapytania SQL
        $teamSql = "DELETE FROM `teams` WHERE `TeamID` = ?";
        $seasonSql = "DELETE FROM `teams_in_season` WHERE `TeamID` = ? AND `SeasonID` = ?";

        // Przygotowanie zapytania dla usunięcia zespołu
        if ($stmt1 = mysqli_prepare($connect, $teamSql)) {
            mysqli_stmt_bind_param($stmt1, "i", $teamID);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);
        } else {
            throw new Exception("Błąd przygotowania zapytania dla usunięcia zespołu.");
        }

        // Przygotowanie zapytania dla usunięcia sezonu
        if ($stmt2 = mysqli_prepare($connect, $seasonSql)) {
            mysqli_stmt_bind_param($stmt2, "ii", $teamID, $seasonID);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        } else {
            throw new Exception("Błąd przygotowania zapytania dla usunięcia sezonu.");
        }

        mysqli_commit($connect);
        echo "Usunięto pomyślnie zespół i sezon.<br>";

    } catch (Exception $e) {
        // Wycofanie transakcji w przypadku błędu
        mysqli_rollback($connect);
        echo "Oops! Something went wrong. Please try again later.<br>";
    }

    // Zamknięcie połączenia
    mysqli_close($connect);
}
?>
