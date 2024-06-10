<?php

session_start();
session_unset();
session_destroy();
header("location: /040Basket-Leauge/index.php");
exit;