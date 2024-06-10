<?php

include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
$connect = OpenCon();

if (isset($_GET['seasonID'])) {

    $seasonID = $_GET['seasonID'];

    $sql = "select `teams`.`TeamID`, `teams`.`TeamName`, `teams`.`logo-filename`\n"

        . "from `teams`\n"

        . "left join `teams_in_season` on `teams`.`TeamID` = `teams_in_season`.`TeamID`\n"

        . "left join `season` on `season`.`SeasonID` = `teams_in_season`.`SeasonID`\n"

        . "where `season`.`SeasonID` = $seasonID \n"

        . "order by `TeamName`";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

        echo "
           
            <a href='add-update-teams.php?id=0&season=$seasonID' class='crud-add-button'>Dodaj drużyne</a>
            <table> 
                <tr>
                    <th>Logo</th>
                    <th>Nazwa</th>
                    <th>Akcje</th>
                </tr>
            ";

        while ($row = $result->fetch_assoc()) {

            $teamID = $row["TeamID"];
            $logo = $row["logo-filename"];
            $name = $row["TeamName"];
            $teamID = $row["TeamID"];

            echo "
                <tr>
                    <td><img src='/040Basket-Leauge/assets/uploads/logos/$logo' width='50px' height='50px'/></td>
                    <td>$name</td>
                    <td>
                        <a href='add-update-teams.php?id=$teamID'><i class='fa-solid fa-pen-to-square fa-xl'></i></a>
                        <a href='delete-team.php?id=$teamID'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                        <a href='#'><i class='fa-solid fa-eye fa-xl'></i></a>
                    </td>
                </tr>
            ";
        }

        echo "</table>";
    } else {
        echo "<a href='add-update-teams.php?id=0&season=$seasonID' class='crud-add-button'>Dodaj drużyne</a>";
        echo "Nie ma drużyn w tym sezonie";
    }
}


CloseCon($connect);

?>