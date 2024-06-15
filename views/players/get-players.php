<?php

$sql = "SELECT `PlayerID`, `FirstName`, `LastName`, `Age`, `Height`, `Weight`, `Position`, `teams`.`TeamName` as `Team`
            FROM `players`
            INNER JOIN `teams` ON `players`.`TeamID` = `teams`.`TeamID`
            ORDER BY `FirstName`;";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo "<a href='add-update-player.php?id=0' class='crud-add-button'>Dodaj zawodnika</a>
              <table> 
                  <tr>
                      <th>Imie</th>
                      <th>Nazwisko</th>
                      <th>Pozycja</th>
                      <th>Aktualna drużyna</th>
                      <th>Wiek</th>
                      <th>Wzrost</th>
                      <th>Waga</th>
                      <th>Akcje</th>
                  </tr>";

    while ($row = $result->fetch_assoc()) {
        $playerID = $row["PlayerID"];
        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
        $age = $row["Age"];
        $height = $row["Height"];
        $weight = $row["Weight"];
        $position = $row["Position"];
        $team = $row["Team"];

        echo "<tr>
                              <td>$firstName</td>
                              <td>$lastName</td>
                              <td>$position</td>
                              <td>$team</td>
                              <td>$age</td>
                              <td>$height</td>
                              <td>$weight</td>
                              <td>
                                  <a href='add-update-player.php?id=$playerID'><i class='fa-solid fa-pen-to-square fa-xl'></i></a>
                                  <a href='#' onclick='confirmDeletion($playerID)'><i class='fa-solid fa-trash-can fa-xl'></i></a>
                              </td>
                          </tr>";
    }

    echo "</table>";
} else {
    echo "<a href='add-update-player.php?id=0' class='crud-add-button'>Dodaj zawodnika</a>";
    echo "Nie ma zawodników dla tego sezonu";
}
