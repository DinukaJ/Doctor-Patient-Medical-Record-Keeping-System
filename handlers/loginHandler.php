<?php
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
// include_once('token.php');
function login($username,$pass)
{
    $userLogin=new users();
    // $passEncrypted=sh1salt($pass);
    $stat=$userLogin->login($username,$pass);
    if($stat=="Receptionist")
    {
        header("Location: Receptionist/addPatients.php");
    }
    else if($stat=="Pharmacist")
    {
        header("Location: Pharmacist/prescriptionQueue.php");
    }
    else if($stat=="Lab")
    {
        header("Location: Lab/addLab.php");
    }
    else if($stat instanceof doctor)
    {
        header("Location: Doctor/prescribe.php");
    }
    else if($stat instanceof patient)
    {
        header("Location: Patient/prescriptions.php");
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

function verifyAccount($type,$token,$email)
{ 
    $user=new users();
    $stat=$user->verifyUser($type,$token,$email);
    return $stat;
}
?>