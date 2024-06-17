<?php
if (isset($_POST["submit"]))
{
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    echo $username;
    echo $pwd;

    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
    $connect = OpenCon();

    require_once 'functions.inc.php';

    loginUser($connect, $username, $pwd);

    CloseCon($connect);

}