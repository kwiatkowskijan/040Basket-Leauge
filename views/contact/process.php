<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ścieżka do autoload.php z PHPMailer

if (isset($_POST['btn-send'])) {
    $UserName = $_POST['uid'];
    $Email = $_POST['email'];
    $Subject = $_POST['subject'];
    $Msg = $_POST['msg'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Weryfikacja reCAPTCHA
    $secretKey = '6LdwJfspAAAAAChiexutN-Yd_BFeDR6Z28oxS4Es'; // Zamień na Twój sekretny klucz reCAPTCHA
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        $error = "Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie.";
        header("Location: /040Basket-Leauge/contact.php?error=" . urlencode($error));
        exit();
    }

    // Inicjalizacja PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Konfiguracja serwera SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '040basket@gmail.com';
        $mail->Password = 'tiiz ypjs timu lizc';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Ustawienia wiadomości
        $mail->setFrom($Email, $UserName);
        $mail->addAddress('040basket@gmail.com'); // Adres odbiorcy
        $mail->isHTML(true); // Format wiadomości jako HTML
        $mail->Subject = $Subject;
        $mail->Body = $Msg;

        // Wysyłanie wiadomości
        if ($mail->send()) {
            header("Location: /040Basket-Leauge/contact.php?success");
            exit();
        } else {
            $error = "Wiadomość nie została wysłana. Błąd: " . $mail->ErrorInfo;
            header("Location: /040Basket-Leauge/contact.php?error=" . urlencode($error));
            exit();
        }
    } catch (Exception $e) {
        $error = "Wystąpił błąd podczas wysyłania wiadomości: {$mail->ErrorInfo}";
        header("Location: /040Basket-Leauge/contact.php?error=" . urlencode($error));
        exit();
    }
}
?>
