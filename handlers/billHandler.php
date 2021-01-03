<?php
include_once(dirname(dirname(__FILE__)).'/classes/bill.php');

if(isset($_POST["type"]))
{
    if($_POST["type"]=="createBill")
    createBill();
}

function createBill(){
$totAmt = $_POST["totAmt"];
$pid = $_POST["pid"];
$bill = new bill();
$stat = $bill->addBill($pid,$totAmt);
return $stat;
}

?>