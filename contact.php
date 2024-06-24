<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>

    <div class="subpage-container">
        <div class="contact-wrapper">
            <section class="contact-container">
                <h2>Skontaktuj się z nami</h2>
                <hr>
                <?php
                if (isset($_GET['success'])) {
                    $Msg = "Wiadomość wysłana z sukcesem!";
                    echo '<div class="alert alert-success">' . $Msg . '</div>';
                } elseif (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
                }
                ?>
                <form action="process.php" method="post">
                    <div class="input-box">
                        <input type="text" name="uid" placeholder="Nazwa użytkownika" required>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="subject" placeholder="Temat" required>
                    </div>
                    <div class="input-box">
                        <textarea name="msg" class="form-control" placeholder="Tekst" required></textarea>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdwJfspAAAAACU34odFEnMSawU1teBTS8U2Levd"></div>
                    <div class="input-box">
                        <button type="submit" class="admin-btn" name="btn-send">Wyślij</button>
                    </div>
                </form>

            </section>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>

</body>

</html>