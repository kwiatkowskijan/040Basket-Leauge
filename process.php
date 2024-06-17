<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ścieżka do autoload.php z PHPMailer

if (isset($_POST['btn-send'])) {
    $UserName = $_POST['uid'];
    $Email = $_POST['email'];
    $Subject = $_POST['subject'];
    $Msg = $_POST['msg'];

    // Inicjalizacja PHPMailer
    $mail = new PHPMailer(true);

    try {
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
            header("Location: /040Basket-Leauge/index.php?success");
            exit();
        } else {
            echo "Wiadomość nie została wysłana. Błąd: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Wystąpił błąd podczas wysyłania wiadomości: {$mail->ErrorInfo}";
    }
}
?>
