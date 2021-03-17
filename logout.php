<?php 
include_once("handlers/loginHandler.php");
$uType=$_GET["uType"];
logout($uType);
?>