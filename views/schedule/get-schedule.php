<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['seasonID'])) {

    $seasonID = $_GET['seasonID'];
    $connect = OpenCon();

    $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `home`.`TeamName` as `HomeName`, `away`.`TeamName` as `AwayName`, `court`.`Name` as `CourtName`, `SeasonID` FROM `game`\n"

        . "INNER JOIN `teams` as `home` on `game`.`HomeID` = `home`.`TeamID`\n"

        . "INNER JOIN `teams` as `away` on  `game`.`AwayID` = `away`.`TeamID`\n"

        . "INNER JOIN `court` on `game`.`CourtID` = `court`.`CourtID`\n"

        . "WHERE `SeasonID` = $seasonID";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        echo "
           
            <table> <a href='update-schedule.php?id=0&season=$seasonID' class='crud-add-button'>Dodaj mecz</a>
                <tr>
                    <th>Gospodarze</th>
                    <th>Goscie</th>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Hala</th>
                    <th>Akcje</th>
                </tr>
            ";

        while ($row = $result->fetch_assoc()) {

            $homeName = $row["HomeName"];
            $awayName = $row["AwayName"];
            $gameDate = $row["GameDate"];
            $gameTime = $row["GameTime"];
            $courtName = $row["CourtName"];
            $gameID = $row["GameID"];

            echo "
                <tr>
                    <td>$homeName</td>
                    <td>$awayName</td>
                    <td>$gameDate</td>
                    <td>$gameTime</td>
                    <td>$courtName</td>
                    <td>
                        <a href='update-schedule.php?id=$gameID'><i class='fa-solid fa-pen-to-square fa-xl'></i></a>
                        <a href='delete-schedule.php?id=$gameID'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        <a href='read-schedule.php?id=$gameID'><i class='fa-solid fa-eye fa-xl'></i></a>
                    </td>
                </tr>
            ";
        }

        echo "</table>";
    } else {
        echo "<a href='update-schedule.php?id=0&season=$seasonID' class='crud-add-button'>Dodaj mecz</a>";
        echo "Nie ma meczów dla tego sezonu";
    }

    CloseCon($connect);
}
