<?php
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');

if(isset($_POST["type"])){

    if($_POST["type"]=="getRepAll")
            getRepDatAll();
}


?>