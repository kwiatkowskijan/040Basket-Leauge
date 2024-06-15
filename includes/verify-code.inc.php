<?php
session_start();

if (isset($_POST["code"])) {
    $enteredCode = $_POST["code"];
    $storedCode = $_SESSION["verificationCode"];

    if ($enteredCode == $storedCode) {
        unset($_SESSION["verificationCode"]); // remove code from session
        header("location: /040Basket-Leauge/index.php");
        exit();
    } else {
        header("location: /040Basket-Leauge/includes/verify.inc.php?error=wrongcode");
        exit();
    }
} else {
    header("location: /040Basket-Leauge/admin-login.php");
    exit();
}
