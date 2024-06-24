<?php
$sql = "SELECT `season`.`SeasonID`, `season`.`Name`, `StartDate`, `EndDate`, GROUP_CONCAT(`teams`.`TeamName` SEPARATOR ', ') as `Teams`
FROM `season`
LEFT JOIN `teams_in_season` ON `season`.`SeasonID` = `teams_in_season`.`SeasonID`
LEFT JOIN `teams` ON `teams_in_season`.`TeamID` = `teams`.`TeamID`
GROUP BY `season`.`SeasonID`;";


$result = $connect->query($sql);

if ($result->num_rows > 0) {

    echo "
           
            <a href='add-edit-season.php?id=0' class='crud-add-button'>Dodaj sezon</a>
            <table> 
                <tr>
                    <th>Nazwa</th>
                    <th>Start</th>
                    <th>Koniec</th>
                    <th>Drużyny</th>
                    <th>Akcje</th>
                </tr>
            ";

    while ($row = $result->fetch_assoc()) {

        $seasonID = $row["SeasonID"];
        $name = $row["Name"];
        $startDate = $row["StartDate"];
        $endDate = $row["EndDate"];
        $teams = $row["Teams"] ? $row["Teams"] : "Brak drużyn";

        echo "
                <tr>
                    <td>$name</td>
                    <td>$startDate</td>
                    <td>$endDate</td>
                    <td>$teams</td>
                    <td>
                        <a href='add-edit-season.php?id=$seasonID'><i class='fa-solid fa-pen-to-square fa-xl'></i></a>
                        <a href='#' onclick='confirmDeletion($seasonID)'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        <a href='add-teams-to-season.php?id=$seasonID' class='crud-add-button'>Dodaj drużyny</a>
                        <a href='delete-teams-from-season.php?id=$seasonID' class='crud-add-button'>Usun drużyny</a>
                    </td>
                </tr>
            ";
    }

    echo "</table>";
} else {
    echo "<a href='add-edit-seasons.php?id=0' class='crud-add-button'>Dodaj sezon</a>";
    echo "Nie ma drużyn w tym sezonie";
}



CloseCon($connect);
