<body>
    <?php
        include 'connect.php';
        $connect = OpenCon();
    ?>

    <div class="navigation">

        <div id="logo">
            <a href="index.php"><img src="img/owl-logo-01.png" alt="logo"></a>
        </div>

        <div class="menu">
            <a href="#" class="navlink">O lidze</a>
            <a href="#" class="navlink">Tabela</a>
            <a href="#" class="navlink">Terminarz</a>
            <a href="#" class="navlink">Wyniki</a>
            <a href="teams.php" class="navlink">Drużyny</a>
            <a href="players.php" class="navlink">Zawodnicy</a>
        </div>

        <div class="social-menu">
            <a href="#"><i class="fa-brands fa-facebook fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-instagram fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a>
        </div>

        <div class="toggler">
            <a><i class="fa-solid fa-bars fa-2xl"></i></a>
        </div>

        <div class="toggleMenuContainer">
            <div class="toggleMenu">
                <a href="#" class="navlink toggleNavLink">O lidze</a>
                <a href="#" class="navlink toggleNavLink">Tabela</a>
                <a href="#" class="navlink toggleNavLink">Terminarz</a>
                <a href="#" class="navlink toggleNavLink">Wyniki</a>
                <a href="#" class="navlink toggleNavLink">Drużyny</a>
                <a href="#" class="navlink toggleNavLink">Zawodnicy</a>
            </div>
            <div class="toggleSocialMenu">
                <a href="#"><i class="fa-brands fa-facebook fa-xl"></i></a>
                <a href="#"><i class="fa-brands fa-instagram fa-xl"></i></a>
                <a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a>
            </div>
        </div>

        <script src="toggleMenu.js"></script>
    </div>