<?php
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once('token.php');
function login($username,$pass)
{
    $userLogin=new users();
    $passEncrypted=sh1salt($pass);
    $stat=$userLogin->login($username,$pass);
    if($stat=="Receptionist")
    {
        header("Location: Receptionist/addPatients.php");
    }
    else if($stat=="Pharmacist")
    {

    }
    else if($stat instanceof doctor)
    {
        
    }
    else if($stat instanceof patient)
    {
        
    }
    else if($stat==false)
    {
        return false;
    }
}
function logout()
{
    session_start();
    session_destroy();
    header("Location: login.php");
}
?>