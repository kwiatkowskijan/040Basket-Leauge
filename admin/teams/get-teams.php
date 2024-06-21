<?php
$sql = "select `teams`.`TeamID`, `teams`.`TeamName`, `teams`.`logo-filename`\n"

    . "from `teams`\n"

    . "order by `TeamName`";

$result = $connect->query($sql);

if ($result->num_rows > 0) {

    echo "
           
            <a href='add-update-teams.php?id=0' class='crud-add-button'>Dodaj drużyne</a>
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
                        <a href='#' onclick='confirmDeletion($teamID)'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                    </td>
                </tr>
            ";
    }

    echo "</table>";
} else {
    echo "<a href='add-update-teams.php?id=0' class='crud-add-button'>Dodaj drużyne</a>";
    echo "Nie ma drużyn w tym sezonie";
}



CloseCon($connect);
