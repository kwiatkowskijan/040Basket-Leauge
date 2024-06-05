<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $gameId = $_GET['id'];
    $connect = OpenCon();

}
