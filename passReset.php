<?php
session_start();
include_once("handlers/loginHandler.php");
if(isset($_POST["emailReset"]))
{
    $email=$_POST["emailReset"];
    $userType=$_GET["uType"];
    $pID="";
    if($userType=="patient")
    {
        $pID=$_POST["pID"];
    }
    $stat=passwordReset($email,$pID,$userType);
}
if(!isset($_GET["uType"]))
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
    <title>Forgot Password</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row loginMain">
            <div class="c-12 c-l-9 mainIMG">
            </div>
            <div class="c-12 c-l-3 loginPart">
                <div class="centerBox">
                <h1>Forgot Password</h1>
                <?php
                if(isset($_POST["emailReset"]) && $stat==-1 && $_GET["uType"]=="patient")
                {
                    echo "<p class='errorText'>Email address or patient id is incorrect!<p>";
                }
                else if(isset($_POST["emailReset"]) && $stat==-1 && $_GET["uType"]=="doctor")
                {
                    echo "<p class='errorText'>Email address not found!<p>";
                }
                else if(isset($_POST["emailReset"]) && $stat==0)
                {
                    echo "<p class='errorText'>Something went wrong!<p>";
                }
                else if(isset($_POST["emailReset"]) && $stat==1)
                {
                    echo "<p class='successText'>We have sent an email with the instructions!<p>";
                }
                ?>
                <form action="#" method="POST">
                    <div class="group-fields">
                        <label>Email</label>
                        <input type="email" class="input-field fullWidth" name="emailReset" id="emailReset" placeholder="Email" required>
                    </div>
                    <?php
                    if($_GET["uType"]=='patient')
                    {
                    ?>
                        <div class="group-fields">
                            <label>Patient ID</label>
                            <input type="text" class="input-field fullWidth" name="pID" id="pID" placeholder="Patient ID" required>
                        </div>
                    <?php
                    }
                    ?>
                    <button type="submit" class="btn btnLogin" name="loginBtn" id="loginBtn">RESET PASSWORD</button><br><br>
                    <?php
                    if($_GET["uType"]=="patient")
                    {
                        echo'<a href="login.php" class="resetLink">Login?</a>';
                    }
                    ?>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>