<?php
session_start();
include_once("classes/users.php");

if(isset($_SESSION["user"]))
{
    $user=unserialize($_SESSION["user"]);
    if($user instanceof doctor)
    {
        $word="Doctor";
    }
    if($user instanceof patient)
    {
        $word="Patient";
    }
}
else
{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Next Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="c-12" style=""><h1><?php echo $word;?></h1></div>
        </div>
        <div class="row">
            <div class="c-12" style="">
                <a href="logout.php"><button type="button" class="btn btnLogin" name="logout" id="loginBtn">LOGOUT</button></a>
            </div>
        </div>
    </div>
</body>
</html>