<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['seasonID'])) {

    $seasonID = $_GET['seasonID'];
    $connect = OpenCon();

    $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `home`.`TeamName` as `HomeName`, `away`.`TeamName` as `AwayName`, `court`.`Name` as `CourtName`, `SeasonID`, `HomeScore`, `AwayScore` FROM `game`\n"

        . "INNER JOIN `teams` as `home` on `game`.`HomeID` = `home`.`TeamID`\n"

        . "INNER JOIN `teams` as `away` on  `game`.`AwayID` = `away`.`TeamID`\n"

        . "INNER JOIN `court` on `game`.`CourtID` = `court`.`CourtID`\n"

        . "WHERE `SeasonID` = $seasonID";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        echo "
           
            <table>
                <tr>
                    <th>Data/czas</th>
                    <th>Hala</th>
                    <th>Gospodarze</th>
                    <th>Goscie</th>
                    <th>Wynik</th>
                </tr>
            ";

        while ($row = $result->fetch_assoc()) {

            $homeName = $row["HomeName"];
            $awayName = $row["AwayName"];
            $gameDate = $row["GameDate"];
            $gameTime = $row["GameTime"];
            $courtName = $row["CourtName"];
            $homeScore = $row["HomeScore"];
            $awayScore = $row["AwayScore"];
            $gameID = $row["GameID"];

            echo "
            <tr>
                <td class='date-time'><p>{$gameDate}</p><p>{$gameTime}</p></td>
                <td>{$courtName}</td>
                <td>{$homeName}</td>
                <td>{$awayName}</td>
                <td>";

                if (!is_null($homeScore) && !is_null($awayScore)) {
                    echo "{$homeScore} - {$awayScore}";
                }
        }

        echo "</table>";
    } else {
        echo "Nie ma meczów dla tego sezonu";
    }

    CloseCon($connect);
}
