<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="verify-container">
        <h1>Wprowadź kod weryfikacyjny</h1>
        <form action="verify-code.inc.php" method="post">
            <input type="text" id="code" name="code" placeholder="kod weryfikacyjny" required>
            <button type="submit" class="crud-add-button">Zweryfikuj</button>
        </form>
        <a href="../admin-login.php">Wróć</a>
    </div>
</body>