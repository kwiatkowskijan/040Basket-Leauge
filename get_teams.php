<?php

include("connect.php");
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
        while ($row = $result->fetch_assoc()) {

            $teamID = $row["TeamID"];
            $teamName = $row["TeamName"];
            $image = $row["logo-filename"];

            echo "<a href='team.php?TeamID=$teamID' class='team-link'>
                    <div class='team-container'>
                        <img src='img/$image' width='200px' height='170px'/>
                        <p>$teamName</p>
                    </div>
                  </a>";
        }
    } else {
        echo "0 results";
    }
}


CloseCon($connect);
