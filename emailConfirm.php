<?php
session_start();
include_once("handlers/loginHandler.php");
if(isset($_GET["type"]))
{
    $type=$_GET["type"];
    $token=$_GET["tk"];
    $email=$_GET["email"];
    $stat=verifyAccount($type,$token,$email);
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
    <title>Login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row loginMain">
            <div class="c-12 c-l-9 mainIMG">
            </div>
            <div class="c-12 c-l-3 loginPart">
                <h1>
                <?php
                if($stat==1)
                {
                    echo "Successfully Verified!";
                }
                else if($stat==0)
                {
                    echo "Verification Failed!";
                }
                else if($stat==2)
                {
                    echo "Already Verified!";
                }
                else if($stat==-1)
                {
                    echo "Not Found! Something Went Wrong!";
                }
                ?>
                </h1>
                <a href="login.php"><button type="button" class="btn btnLogin" name="loginBtn" id="loginBtn">LOGIN</button></a>
            </div>
        </div>
    </div>
</body>
</html>