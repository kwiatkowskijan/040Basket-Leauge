<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['seasonID'])) {

    $seasonID = $_GET['seasonID'];
    $seasonTeamName = array();
    $seasonTeamScore = array();
    $seasonTeamGamesPlayed = array();
    $seasonTeamGamesWon = array();
    $seasonTeamGamesLost = array();
    $connect = OpenCon();

    $sql = "select `TeamID`, `TeamName`\n"

        . "from `teams`\n"

        . "where `TeamID` in (select `TeamID` from `teams_in_season` where `SeasonID` = $seasonID);";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $seasonTeamName[$row["TeamID"]] = $row["TeamName"];
            $seasonTeamScore[$row["TeamID"]] = 0;
            $seasonTeamGamesPlayed[$row["TeamID"]] = 0;
            $seasonTeamGamesWon[$row["TeamID"]] = 0;
            $seasonTeamGamesLost[$row["TeamID"]] = 0;
        }

        $sql = "select `GameID`, `GameDate`, `GameTime`, `HomeID`, `AwayID`, `HomeScore`, `AwayScore` \n"

            . "from `game`\n"

            . "where `SeasonID`= $seasonID and `HomeScore` is not null and `AwayScore` is not null;";

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $seasonTeamGamesPlayed[$row["HomeID"]]++;
                $seasonTeamGamesPlayed[$row["AwayID"]]++;

                if ($row["HomeScore"] > $row["AwayScore"]) {
                    $seasonTeamGamesWon[$row["HomeID"]]++;
                    $seasonTeamGamesLost[$row["AwayID"]]++;
                    $seasonTeamScore[$row["HomeID"]] += 2;
                    $seasonTeamScore[$row["AwayID"]] += 1;
                } else {
                    $seasonTeamGamesWon[$row["AwayID"]]++;
                    $seasonTeamGamesLost[$row["HomeID"]]++;
                    $seasonTeamScore[$row["AwayID"]] += 2;
                    $seasonTeamScore[$row["HomeID"]] += 1;
                }
            }
        }

        echo "
            <table>
                <tr>
                    <th>Miejsce</th>
                    <th>Drużyna</th>
                    <th>Punkty</th>
                    <th>Ilość meczy</th>
                    <th>Wygrane</th>
                    <th>Przegrane</th>
                </tr>
        ";

        $place = 1;

        arsort($seasonTeamScore, 1);

        foreach ($seasonTeamScore as $key => $value) {
            echo "<tr>";
            echo "<td>" . $place . "</td>";
            echo "<td>" . $seasonTeamName[$key] . "</td>";
            echo "<td>" . $seasonTeamScore[$key] . "</td>";
            echo "<td>" . $seasonTeamGamesPlayed[$key] . "</td>";
            echo "<td>" . $seasonTeamGamesWon[$key] . "</td>";
            echo "<td>" . $seasonTeamGamesLost[$key] . "</td>";
            echo "</tr>";

            $place++;
        }

        echo "</table>";

        echo "<h2>Rozegrane mecze</h2>";

        $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `home`.`TeamName` as `HomeName`, `away`.`TeamName` as `AwayName`, `court`.`Name` as `CourtName`, `SeasonID`, `HomeScore`, `AwayScore` FROM `game`\n"

            . "INNER JOIN `teams` as `home` on `game`.`HomeID` = `home`.`TeamID`\n"

            . "INNER JOIN `teams` as `away` on  `game`.`AwayID` = `away`.`TeamID`\n"

            . "INNER JOIN `court` on `game`.`CourtID` = `court`.`CourtID`\n"

            . "WHERE `SeasonID` = $seasonID and `HomeScore` is not null and `AwayScore` is not null;";

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
                <td>{$gameDate} - {$gameTime}</td>
                <td>{$courtName}</td>
                <td>{$homeName}</td>
                <td>{$awayName}</td>
                <td>";

                if (!is_null($homeScore) && !is_null($awayScore)) {
                    echo "{$homeScore} - {$awayScore}";
                }

                echo "</td>
            </tr>
            ";
            }

            echo "</table>";
        }
    } else {
    }

    CloseCon($connect);
}
