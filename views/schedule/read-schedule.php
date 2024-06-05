<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $gameId = intval($_GET['id']);
    $connect = OpenCon();

    $sql = "SELECT `GameID`, `GameDate`, `GameTime`, `home`.`TeamName` as `HomeName`, `away`.`TeamName` as `AwayName`, `court`.`Name` as `CourtName`, `SeasonID` FROM `game`\n"

        . "INNER JOIN `teams` as `home` on `game`.`HomeID` = `home`.`TeamID`\n"

        . "INNER JOIN `teams` as `away` on  `game`.`AwayID` = `away`.`TeamID`\n"

        . "INNER JOIN `court` on `game`.`CourtID` = `court`.`CourtID`\n"

        . "WHERE `GameID` = $gameId";

    $result = $connect->query($sql);

    if($result->num_rows == 1) {
        echo "REKORD";
    }
}
