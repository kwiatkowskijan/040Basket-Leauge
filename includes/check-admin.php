<?php
session_start();

if (!isset($_SESSION['useruid'])) {
    header("Location: /040Basket-Leauge/admin-login.php");
    exit();
}

?>