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

            $sql = "INSERT INTO `teams_in_season`(`SeasonID`, `TeamID`) VALUES (?, ?);";
            $stmt = $connect->prepare($sql);

            foreach ($_POST["Teams"] as $teamID) {
                $stmt->bind_param("ii", $seasonID, $teamID);
                $stmt->execute();
            }
            echo "Pomyślnie dodano wybrane drużyny do sezonu.";
        } else {
            echo "Nie wybrano żadnych drużyn do dodania.";
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
    <title>Formularz dodawania drużyn</title>
</head>

<body>

    <h2>Wybierz drużyny do dodania:</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <?php
        $sql = "SELECT `teams`.`TeamID`, `TeamName`\n"

        . "FROM `teams`\n"

        . "LEFT JOIN `teams_in_season` ON `teams`.`TeamID` = `teams_in_season`.`TeamID` AND `teams_in_season`.`SeasonID` = $seasonID "
        
        . "WHERE `teams_in_season`.`TeamID` IS NULL;";
    

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<label>";
                echo "<input type='checkbox' name='Teams[]' value='" . htmlspecialchars($row["TeamID"]) . "'>";
                echo $row["TeamName"];
                echo "</label><br>";
            }
        } else {
            echo "Brak dostępnych drużyn.";
        }
        ?>

        <input type='hidden' name='id' value='<?php echo $seasonID; ?>' />

        <button type="submit">Dodaj</button> <br>

    </form>

</body>

</html>