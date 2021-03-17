<?php
session_start();
include_once("handlers/loginHandler.php");
if(isset($_POST["emailUsername"]))
{
    $username=$_POST["emailUsername"];
    $password=$_POST["password"];
    $stat=login($username,$password,"admin");
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
                <div class="centerBox">
                    <h1>Login</h1>
                    <?php
                    if(isset($_POST["emailUsername"]) && $stat==false)
                    {
                        echo "<p class='errorText'>Username or password incorrect!<p>";
                    }
                    ?>
                    <form action="#" method="POST">
                        <div class="group-fields">
                            <label>Email or Username</label>
                            <input type="text" class="input-field fullWidth" name="emailUsername" id="emailUsername" placeholder="Email or Username" required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" class="input-field fullWidth" name="password" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btnLogin" name="loginBtn" id="loginBtn">LOGIN</button><br><br>
                        <a href="passReset.php?uType=patient" class="resetLink">Forgot Password?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>