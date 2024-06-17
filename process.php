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
        // Konfiguracja serwera SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';  // Tutaj podaj nazwę hosta SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 't61738768@gmail.com'; // Tu podaj swój adres e-mail
        $mail->Password = 'Dupa1234';  // Tu podaj swoje hasło do konta e-mail
        $mail->SMTPSecure = 'tls'; // Typ szyfrowania - TLS, alternatywnie można użyć 'ssl'
        $mail->Port = 587; // Port SMTP

        // Ustawienia wiadomości
        $mail->setFrom($Email, $UserName);
        $mail->addAddress('040Basket-league@gmail.com'); // Adres odbiorcy
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
