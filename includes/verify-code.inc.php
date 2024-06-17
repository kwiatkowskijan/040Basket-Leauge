<?php
session_start();

if (isset($_POST["code"])) {
    $enteredCode = $_POST["code"];
    $storedCode = $_SESSION["verificationCode"];
    $storedTime = $_SESSION["verificationCodeTime"];
    $timeLimit = 300; // 5min

    if ((time() - $storedTime) > $timeLimit) {
        unset($_SESSION["verificationCode"]);
        unset($_SESSION["verificationCodeTime"]);
        header("location: /040Basket-Leauge/includes/verify.inc.php?error=codeexpired");
        exit();
    }

    if ($enteredCode == $storedCode) {
        unset($_SESSION["verificationCode"]); // usuń kod z sesji
        unset($_SESSION["verificationCodeTime"]); // usuń czas z sesji
        header("location: /040Basket-Leauge/admin.php");
        exit();
    } else {
        header("location: /040Basket-Leauge/includes/verify.inc.php?error=wrongcode");
        exit();
    }
} else {
    header("location: /040Basket-Leauge/admin-login.php");
    exit();
}

