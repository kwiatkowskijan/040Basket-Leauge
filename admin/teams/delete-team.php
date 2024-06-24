<?php
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $teamID = intval($_GET['id']);
    $connect = OpenCon();

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    mysqli_begin_transaction($connect);

    try {
        $teamSql = "DELETE FROM `teams` WHERE `TeamID` = ?";
        $seasonSql = "DELETE FROM `teams_in_season` WHERE `TeamID` = ?";
        $updatePlayersSql = "UPDATE `players` SET `TeamID` = NULL WHERE `TeamID` = ?";

        // Wykonanie zapytania DELETE dla teams
        if ($stmt1 = mysqli_prepare($connect, $teamSql)) {
            mysqli_stmt_bind_param($stmt1, "i", $teamID);
            mysqli_stmt_execute($stmt1);
            if (mysqli_stmt_errno($stmt1)) {
                throw new Exception("Error executing team delete query: " . mysqli_stmt_error($stmt1));
            }
            mysqli_stmt_close($stmt1);
        } else {
            throw new Exception("Błąd przygotowania zapytania dla usunięcia zespołu: " . mysqli_error($connect));
        }

        // Wykonanie zapytania DELETE dla teams_in_season
        if ($stmt2 = mysqli_prepare($connect, $seasonSql)) {
            mysqli_stmt_bind_param($stmt2, "i", $teamID);
            mysqli_stmt_execute($stmt2);
            if (mysqli_stmt_errno($stmt2)) {
                throw new Exception("Error executing season delete query: " . mysqli_stmt_error($stmt2));
            }
            mysqli_stmt_close($stmt2);
        } else {
            throw new Exception("Błąd przygotowania zapytania dla usunięcia sezonu: " . mysqli_error($connect));
        }

        // Wykonanie zapytania UPDATE dla players
        if ($stmt3 = mysqli_prepare($connect, $updatePlayersSql)) {
            mysqli_stmt_bind_param($stmt3, "i", $teamID);
            mysqli_stmt_execute($stmt3);
            if (mysqli_stmt_errno($stmt3)) {
                throw new Exception("Error executing update players query: " . mysqli_stmt_error($stmt3));
            }
            mysqli_stmt_close($stmt3);
        } else {
            throw new Exception("Błąd przygotowania zapytania dla aktualizacji graczy: " . mysqli_error($connect));
        }

        mysqli_commit($connect);
        echo "Usunięto pomyślnie zespół i sezon.<br>";

    } catch (Exception $e) {
        mysqli_rollback($connect);
        echo "Oops! Something went wrong. Please try again later. Error: " . $e->getMessage() . "<br>";
    }

    mysqli_close($connect);
} else {
    echo "Invalid ID.<br>";
}
?>
