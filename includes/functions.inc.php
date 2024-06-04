<?php
    function invalidUid($username)
    {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
        {
            $result = true;
        }
        return $result;
    }

    function invalidEmail($email)
    {
        $result = false;
        if (! filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $result = true;
        }
        return $result;
    }
    function pwdMatch($pwd, $pwdRepeat)
    {
        $result = false;
        if ($pwd !== $pwdRepeat)
        {
            $result = true;
        }
        return $result;
    }

    //wymagana aktualizacja bazy danych zeby to smigalo
    //zabezpieczenie przed zastrzykiem sql
    function uidExists($connect, $username, $email)
{
    $result = false;
    $sql = "SELECT * FROM admins WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_prepare($connect, $sql);

    if (!$stmt) {
        return $result;
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else
    {
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connect, $name, $email, $username, $pwd)
{
    $result = false;
    $sql = "INSERT INTO admins (usersName, usersEmail, usersUid, usersPwd) VALUSES (? ? ? ?) ;";
    $stmt = mysqli_prepare($connect, $sql);

    if (!$stmt) {
        return $result;
    }
    //SZYFROWANIE hasla 
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin-signup.php?error=none");
}

function loginUser($connect, $username, $pwd)
{
    $uidExists = uidExists($connect, $username, $username);
    if ($uidExists === false)
    {
        header("location: ../admin-login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false)
    {
        header("location: ../admin-login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExists["usersid"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}

