<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>

<div class="subpage-container">

    <div class="wrapper ">
        <section class="signup-form">
            <h1>Panel logowania Admina</h1>
            <form id="log_admin_pannel" action="includes/login.inc.php" method="post">
                <div class="input-box">
                    <input type="text" name="uid" placeholder="Nazwa użytkownika/Email"
                    required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="pwd" placeholder="Hasło"
                    required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="submit" class="admin-btn">Zaloguj</button>
            </form>
    </div>
        <?php
            if (isset($_GET["error"]))
            {
                if($_GET["error"] == "wronglogin")
                {
                    echo "<p> Nieprawidlowy login.</p>";
                }
            }
        ?>
        </section>

    
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>