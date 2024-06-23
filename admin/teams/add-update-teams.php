<?php
include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';

$connect = OpenCon();

$isUpdate = false;
$teamID = 0;
$seasonID = 0;
$message = '';

if (isset($_GET['id'])) {
    $teamID = $_GET['id'];

    if ($teamID != 0) {
        $isUpdate = true;
    }

    if ($isUpdate) {
        $sql = "SELECT `TeamID`, `TeamName`, `City`, `CoachName`, `EstablishedYear`, `logo-filename`
                FROM `teams` 
                WHERE `TeamID` = $teamID";

        $result = $connect->query($sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $teamName = $row["TeamName"];
            $city = $row["City"];
            $coachName = $row["CoachName"];
            $establishedYear = $row["EstablishedYear"];
            $logo = $row["logo-filename"];
        } else {
            $message = "Nie znaleziono rekordu";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/040Basket-Leauge/assets/uploads/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . "." . $imageFileType;

    if (isset($_FILES["logo"])) {
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["logo"]["size"] > 5000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $logoFilename = basename($target_file);
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }
    }

    if (isset($_POST["id"]) && $_POST["id"] > 0) {
        $isUpdate = true;
    }

    $teamName = $_POST["TeamName"];
    $city = $_POST["City"];
    $coachName = $_POST["Coach"];
    $establishedYear = $_POST["Year"];

    if ($isUpdate) {
        $uteamID = $_POST["id"];

        if ($uploadOk == 1 && isset($logoFilename)) {
            $sql = "UPDATE `teams` SET `TeamName`=?, `City`=?, `CoachName`=?, `EstablishedYear`=?, `logo-filename`=? WHERE `TeamID`=?";
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssisi", $teamName, $city, $coachName, $establishedYear, $logoFilename, $uteamID);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Pomyślnie zaktualizowano";
                } else {
                    $message = "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $sql = "UPDATE `teams` SET `TeamName`=?, `City`=?, `CoachName`=?, `EstablishedYear`=? WHERE `TeamID`=?";
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssii", $teamName, $city, $coachName, $establishedYear, $uteamID);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Pomyślnie zaktualizowano";
                } else {
                    $message = "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        $teamsSql = "INSERT INTO `teams` (`TeamName`, `City`, `CoachName`, `EstablishedYear`, `logo-filename`) VALUES (?, ?, ?, ?, ?)";
        if ($teamsStmt = mysqli_prepare($connect, $teamsSql)) {
            mysqli_stmt_bind_param($teamsStmt, "sssis", $teamName, $city, $coachName, $establishedYear, $logoFilename);
            mysqli_stmt_execute($teamsStmt);
            $uteamID = mysqli_insert_id($connect);
            mysqli_stmt_close($teamsStmt);
            $isUpdate = true;
            $message = "Pomyślnie dodano";
        } else {
            $message = "Oops! Something went wrong with the query preparation. Please try again later.";
        }
    }
}

$connect->close();
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/040Basket-Leauge/assets/styles/style.css">
    <title>Document</title>
</head>

<body>
    <div class="admin-page-container">
        <?php include '../layouts/admin-nav.php'; ?>
        <div class="admin-page-content">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                <label>Nazwa</label><br>
                <input type="text" name="TeamName" value="<?php echo $isUpdate ? $teamName : ''; ?>" required /><br><br>

                <label>Miasto</label><br>
                <input type="text" name="City" value="<?php echo $isUpdate ? $city : ''; ?>" required /><br><br>

                <label>Trener</label><br>
                <input type="text" name="Coach" value="<?php echo $isUpdate ? $coachName : ''; ?>" required /><br><br>

                <label>Rok założenia</label><br>
                <input type="number" name="Year" value="<?php echo $isUpdate ? $establishedYear : ''; ?>" required /><br><br>

                <label>Logo</label><br>
                <input type="file" name="logo" /><br><br>

                <?php
                if ($isUpdate) {
                    echo "<input type='hidden' name='id' value='" . $teamID . "' />";
                }
                ?>

                <button type="submit"><?php echo $isUpdate ? 'Aktualizuj' : 'Dodaj'; ?></button>

            </form>

            <?php if ($message): ?>
                <p><?php echo $message; ?></p>
                <a href="teams.php" class="crud-add-button">Wróć</a>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>

<?php
$connect->close();
?>
