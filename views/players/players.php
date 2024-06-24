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
    <div class="search_players">
        <?php

        // Funkcja do wyświetlania zawodników
        function displayPlayers($connect, $search = '')
        {
            // SQL query for fetching players
            $sql = "SELECT `PlayerID`, `FirstName`, `LastName`, `BirthDate`, `Height`, `Weight`, `Position` FROM `players`";
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
                    echo "<div class='letter-section'>";
                    echo "<h2 class='letter'>" . $letter . "</h2>";
                    echo "<div class='players-container'>";
                    foreach ($players as $player) {
                        $playerID = $player["PlayerID"];
                        $fullName = $player["FirstName"] . " " . $player["LastName"];
                        echo "<div class='player'><a href='playerDetails.php?id=$playerID'>$fullName</a></div>";
                    }
                    echo "</div>"; // .players-container
                    echo "</div>"; // .letter-section
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

        displayPlayers($connect, $search);

        ?>
    </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/views/layouts/footer.php'; ?>