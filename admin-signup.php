<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>


<div class="subpage-container">
    <div class="wrapper ">
        <section class="signup-form">
            <h2>Dodaj profil adnima</h2>
            <form action="includes/signup.inc.php" method="post">
            <div class="input-box">
                <input type="text" name="name" placeholder="imie i nazwisko" required>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="email" required>
            </div>
            <div class="input-box">
                <input type="text" name="uid" placeholder="Nazwa użytkownika"required>
            </div>
            <div class="input-box">
                <input type="text" name="pwd" placeholder="Hasło"required>
            </div>
            <div class="input-box">
                <input type="password" name="pwdreapeat" placeholder="Powtórz hasło"required>
            </div>
            <div class="input-box">
                <button type="password" class="admin-btn" name="submit">Zarejestruj się</button>
            </div>
            </form>
                <?php
                if (isset($_GET["error"]))
                {
                    if($_GET["error"] == "invaliduid")
                    {
                        echo "<p> Wybierz poprawna nazwe.</p>";
                    }
                    elseif ($_GET["error"] == "invalidemail")
                    {
                        echo "<p> Wybierz poprawny email.</p>";
                    }
                    elseif ($_GET["error"] == "passwordsdontmatch")
                    {
                        echo "<p> Hasla nie sa identyczne.</p>";
                    }
                    elseif ($_GET["error"] == "stmtffailed")
                    {
                        echo "<p> Cos poszlo nie tak.</p>";
                    }
                    elseif ($_GET["error"] == "usernametaken")
                    {
                        echo "<p> Wybierz inna nazwe.</p>";
                    }
                    elseif ($_GET["error"] == "none")
                    {
                        echo "<p> Zarejstrowales sie.</p>";
                    }
                }
            ?>
        </section>  
    </div> 
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>