<?php
include_once(dirname(dirname(__FILE__)).'/classes/bill.php');

if(isset($_POST["type"]))
{
    if($_POST["type"]=="createBill")
    createBill();
}

function createBill(){

$bill = new bill();
$totAmt = $_POST["totAmt"];
$pid = $_POST["pid"];
$today=date("Y-m-d");
$stat = $bill->addBill($pid,$totAmt,$today);
return $stat;
}

?>