<?php
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/includes/check-admin.php';
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
$connect = OpenCon();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="admin-page-container">
        <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">
            <h1 class="page-title">Sezony</h1>
            <div id="season-container" class="crud-container admin-page-container">
                <?php include 'get-seasons.php'; ?>
            </div>
        </div>
    </div>
</body>