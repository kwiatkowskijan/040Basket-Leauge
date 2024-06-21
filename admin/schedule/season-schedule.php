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
    <div class="admin-container">
    <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">
            <?php
            $seasons = $connect->query("SELECT `Name`, `SeasonID` FROM `season`;");
            ?>

            <form id="season-form">
                <label>Sezon</label><br>
                <select id="season-select" name="seasonID" value="1">
                    <?php
                    while ($row = $seasons->fetch_assoc()) {
                        echo "<option value='" . $row['SeasonID'] . "'>" . $row['Name'] . "</option>";
                    }
                    ?>
                </select>
            </form><br>

            <div id="schedule-container" class="crud-container">

            </div>
        </div>
    </div>

    <script src="/040Basket-Leauge/assets/scripts/season-select-for-schedule.js"></script>
</body>