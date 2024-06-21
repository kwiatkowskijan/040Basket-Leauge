<body>
    <?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
    $connect = OpenCon();
    ?>

    <div class="navigation">

        <div id="logo">
            <a href="/040Basket-Leauge/index.php"><img src="/040Basket-Leauge/assets/uploads/owl-logo-01.png" alt="logo"></a>
        </div>

        <div class="menu">
            <a href="#" class="navlink">O lidze</a>
            <a href="/040Basket-Leauge/views/season-table/season-table.php" class="navlink">Tabela</a>
            <a href="#" class="navlink">Terminarz</a>
            <a href="/040Basket-Leauge/views/teams/teams.php" class="navlink">Drużyny</a>
            <a href="/040Basket-Leauge/views/players/players.php" class="navlink">Zawodnicy</a>
            <a href="/040Basket-Leauge/contact.php" class="navlink">Kontakt</a>
            <?php
                if (isset($_SESSION["useruid"]))
                {
                    echo "<a href ='/040Basket-Leauge/admin/index.php' class = 'navlink' >Admin panel </a>";
                    echo "<a href ='/040Basket-Leauge/includes/admin-logout.inc.php' class = 'navlink' >Wyloguj </a>";
                }
            ?>
        </div>

        <div class="social-menu">
            <a href="https://www.facebook.com/profile.php?id=100095507017641&paipv=0&eav=AfaNz7qdzqhwXE6gdMObrWChRoiOCYbu7o6d_DL24DUiyEhPLBnSDVIOd1aKhVfS3NM" target="_blank"><i class="fa-brands fa-facebook fa-xl"></i></a>
            <a href="https://www.instagram.com/040basket/" target="_blank"><i class="fa-brands fa-instagram fa-xl"></i></a>
            <a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a>
        </div>

        <div class="toggler">
            <a><i class="fa-solid fa-bars fa-2xl"></i></a>
        </div>

        <div class="toggleMenuContainer">
            <div class="toggleMenu">
                <a href="#" class="navlink toggleNavLink">O lidze</a>
                <a href="#" class="navlink toggleNavLink">Tabela</a>
                <!-- <a href="#" class="navlink toggleNavLink">Terminarz</a> -->
                <a href="#" class="navlink toggleNavLink">Wyniki</a>
                <a href="/040Basket-Leauge/views/teams/teams.php" class="navlink toggleNavLink">Drużyny</a>
                <a href="/040Basket-Leauge/views/players/players.php" class="navlink toggleNavLink">Zawodnicy</a>
            </div>
            <div class="toggleSocialMenu">
                <a href="https://www.facebook.com/profile.php?id=100095507017641&paipv=0&eav=AfaNz7qdzqhwXE6gdMObrWChRoiOCYbu7o6d_DL24DUiyEhPLBnSDVIOd1aKhVfS3NM" target="_blank"><i class="fa-brands fa-facebook fa-xl"></i></a>
                <a href="https://www.instagram.com/040basket/" target="_blank"><i class="fa-brands fa-instagram fa-xl"></i></a>
                <a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a>
            </div>
        </div>

        <script src="/040Basket-Leauge/assets/scripts/toggleMenu.js"></script>

    </div>