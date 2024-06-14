<?php
if (isset($_POST["submit"]))
{
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'connect.php';
    require_once 'functions.inc.php';

    loginUser($connect, $username, $pwd);

}