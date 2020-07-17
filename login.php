<?php
session_start();
include_once("classes/users.php");

if(isset($_POST["emailUsername"]))
{
    $userLogin=new users();
    $username=$_POST["emailUsername"];
    $password=$_POST["password"];
    $stat=$userLogin->login($username,$password);
    if(!$stat)
    {
        $user=$_SESSION["user"];
        
    }
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
                <h1>Login</h1>
                <form action="#" method="POST">
                    <div class="group-fields">
                        <label>Email or Username</label>
                        <input type="text" class="input-field" name="emailUsername" id="emailUsername" placeholder="Email or Username" required>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" class="input-field" name="password" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btnLogin" name="loginBtn" id="loginBtn">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>