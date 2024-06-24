<?php
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

if (isset($_GET["id"])) {
    $seasonID = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $seasonID = $_POST["id"];

        if (isset($_POST["Teams"]) && is_array($_POST["Teams"])) {

            $sql = "DELETE FROM `teams_in_season` WHERE `SeasonID` = ? AND `TeamID` = ?";
            $stmt = $connect->prepare($sql);

            foreach ($_POST["Teams"] as $teamID) {
                $stmt->bind_param("ii", $seasonID, $teamID);
                $stmt->execute();
            }
            echo "Pomyślnie usunięto wybrane drużyny z sezonu.";
        } else {
            echo "Nie wybrano żadnych drużyn do usunięcia.";
        }
    } else {
        echo "Błąd: Brak identyfikatora sezonu.";
    }
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <title>Formularz usuwania drużyn</title>
</head>

<body>

    <div class="admin-page-container">
        <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">

            <h2>Wybierz drużyny do usunięcia:</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <?php
                $sql = "SELECT `teams`.`TeamID`, `TeamName`\n"
                    . "FROM `teams`\n"
                    . "INNER JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID`\n"
                    . "WHERE `teams_in_season`.`SeasonID` = $seasonID;";


                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<label>";
                        echo "<input type='checkbox' name='Teams[]' value='" . htmlspecialchars($row["TeamID"]) . "'>";
                        echo $row["TeamName"];
                        echo "</label><br>";
                    }
                } else {
                    echo "Brak drużyn do usunięcia z tego sezonu.";
                }
                ?>

                <input type='hidden' name='id' value='<?php echo $seasonID; ?>' />

                <button type="submit">Usuń</button>
                <a href="./seasons.php">Wróć</a>
            </form>
        </div>
    </div>

</body>

</html>