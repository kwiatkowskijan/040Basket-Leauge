<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040Basket</title>
    <link rel="icon" type="image/x-icon" href="img/owl-logo-01.png">

    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <script src="https://kit.fontawesome.com/79ac7dc523.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/header.php'; ?>

<div class="subpage-container">

    <form>
        <div class="search fixed-search">
            <span class="search-icon material-symbols-outlined">search</span>
            <input class="search-input" type="search" placeholder="Wyszukaj">
        </div>
    </form>

    <?php

    // Funkcja do wyświetlania zawodników
    function displayPlayers($connect, $search = '')
    {
        // SQL query for fetching players
        $sql = "SELECT `PlayerID`, `FirstName`, `LastName`, `Age`, `Height`, `Weight`, `Position` FROM `players`";
        if (!empty($search)) {
            $search = $connect->real_escape_string($search);
            $sql .= " WHERE `FirstName` LIKE '%$search%' OR `LastName` LIKE '%$search%' ORDER BY `LastName`";
        } else {
            $sql .= " ORDER BY `LastName`";
        }

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $players_by_letter = [];
            while ($row = $result->fetch_assoc()) {
                $first_letter = strtoupper($row["LastName"][0]);
                if (!isset($players_by_letter[$first_letter])) {
                    $players_by_letter[$first_letter] = [];
                }
                $players_by_letter[$first_letter][] = $row;
            }

            foreach ($players_by_letter as $letter => $players) {
                echo "<h2>" . $letter . "</h2>";
                foreach ($players as $player) {
                    $playerID = $player["PlayerID"];
                    $fullName = $player["FirstName"] . " " . $player["LastName"];
                    echo "<div class='team-container'><p><a href='playerDetails.php?id=$playerID'>$fullName</a></p></div>";
                }
            }
        } else {
            echo "<p>Brak wyników.</p>";
        }
    }

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Pobieranie frazy wyszukiwania
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Formularz wyszukiwania
    /*echo '<form method="GET" action="" style="text-align: right; margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Wyszukaj zawodnika" value="' . htmlspecialchars($search) . '" class="search-input">
    <button type="submit" class="search-button">Szukaj</button>
</form>';*/

    displayPlayers($connect, $search);


    ?>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>