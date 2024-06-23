<?php
$sql = "select `teams`.`TeamID`, `teams`.`TeamName`, `teams`.`logo-filename`\n"

    . "from `teams`\n"

    . "inner join `teams_in_season` on `teams`.`TeamID` = `teams_in_season`.`TeamID`\n"

    . "where `SeasonID` = 1\n"

    . "order by `TeamName`;";

$result = $connect->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $teamID = $row["TeamID"];
        $logo = $row["logo-filename"];
        $name = $row["TeamName"];
        $teamID = $row["TeamID"];

        echo "
        <div class='single-team'>
            <img src='/040Basket-Leauge/assets/uploads/$logo'/>
            <h3>$name</h3>
        </div>
    ";
    
    }

    echo "</table>";
} else {
    echo "<a href='add-update-teams.php?id=0' class='crud-add-button'>Dodaj drużyne</a>";
    echo "Nie ma drużyn w tym sezonie";
}