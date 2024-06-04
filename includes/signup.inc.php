<?php
    if(isset($_POST["submit"]))
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdreapeat"];

        echo "siema";
        require_once 'functions.inc.php';
        require_once 'dbh.inc.php';

        if (invalidUid($username) !== false)
        {
            header("location: ../admin-signup.php?error=invalidUid");
            exit;
        }
        if (invalidEmail($email) !== false)
        {
            header("location: ../admin-signup.php?error=invalidemail");
            exit;
        }
        if (pwdMatch($pwd, $pwdRepeat) !== false)
        {
            header("location: ../admin-signup.php?error=passwordsdontmatch");
            exit;
        }
        if (uidExists($connect , $username, $email) !== false)
        {
            header("location: ../admin-signup.php?error=userexist");
            exit;
        }

        createUser($connect, $name, $email, $username, $pwd);
    }
else
    {
        header("location: ../admin-signup.php ");
    }



