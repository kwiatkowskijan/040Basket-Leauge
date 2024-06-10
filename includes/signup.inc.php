<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/040Basket-Leauge/config/connect.php';
    $connect = OpenCon();
    ?>
<?php
if(isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdreapeat"];

    echo "siema";
    require_once 'functions.inc.php';
    //require_once 'dbh.inc.php';  
    
    //OpenCon();

    if (invalidUid($username) !== false)
    {
        header("location: /040Basket-Leauge/admin-signup.php?error=invaliduid");
        exit;
    }
    if (invalidEmail($email) !== false)
    {
        header("location: /040Basket-Leauge/admin-signup.php?error=invalidemail");
        exit;
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false)
    {
        header("location: /040Basket-Leauge/admin-signup.php?error=passwordsdontmatch");
        exit;
    }
    if (uidExists($connect , $username, $email) !== false)
    {
        header("location: /040Basket-Leauge/admin-signup.php?error=usernametaken");
        exit;
    }

    echo "Passed all checks, attempting to create user...<br>";
    echo "Name: $name<br>Email: $email<br>Username: $username<br>Password: $pwd<br>";

    createUser($connect, $name, $email, $username, $pwd);
}
else
{
    header("location: /040Basket-Leauge/admin-signup.php ");
}
?>
