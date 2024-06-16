<?php

require $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function invalidUid($username)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat)
{
    $result = false;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    return $result;
}
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
    } else {
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connect, $name, $email, $username, $pwd)
{
    $result = false;
    $sql = "INSERT INTO `admins` (usersName, usersEmail, usersUid, usersPwd) Values (?, ?, ?, ?) ;";
    $stmt = mysqli_prepare($connect, $sql);

    if (!$stmt) {
        return $result;
    }
    //SZYFROWANIE hasla 
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $name, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /040Basket-Leauge/admin-signup.php?error=none");
}

function loginUser($connect, $username, $pwd)
{
    $uidExists = uidExists($connect, $username, $username);
    if ($uidExists === false) {
        header("location: /040Basket-Leauge/admin-login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: /040Basket-Leauge/admin-login.php?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {

        session_start();
        $_SESSION["userid"] = $uidExists["usersid"];
        $_SESSION["useruid"] = $uidExists["usersUid"];

        $verificationCode = randomNumber();
        $_SESSION["verificationCode"] = $verificationCode;
        $_SESSION["verificationCodeTime"] = time();

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '040basket@gmail.com';
            $mail->Password = 'tiiz ypjs timu lizc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('040basket@gmail.com', 'Mailer');
            $mail->addAddress($uidExists["usersEmail"]);
            $mail->isHTML(true);
            $mail->Subject = 'Logowanie dwuetapowe';
            $mail->Body = $verificationCode;

            $mail->send();
            echo '<p>Email successfully sent</p>';
        } catch (Exception $e) {
            echo '<p>Failed to send email. Mailer Error: ' . $mail->ErrorInfo . '</p>';
        }

        header("location: /040Basket-Leauge/includes/verify.inc.php");
        exit();
    }
}


function randomNumber()
{
    $min = 1000;
    $max = 9999;
    $number = rand($min, $max);
    return $number;
}

