<?php
include_once(dirname(dirname(__FILE__)).'/classes/bill.php');

if(isset($_POST["type"]))
{
    if($_POST["type"]=="createBill")
        createBill();
    if($_POST["type"]=="addBillMed")
    addBillMed();
}

function createBill(){

$bill = new bill();
$totAmt = $_POST["totAmt"];
$pid = $_POST["pid"];
$today=date("Y-m-d");
$docCharge=$_POST["docCharge"];
$stat = $bill->addBill($pid,$totAmt,$today,$docCharge);
echo $stat;
}
function addBillMed(){

$bill = new bill();
$billId = $_POST["billId"];
$medId = $_POST["medId"];
$medType = $_POST["medType"];
$medQty = $_POST["medQty"];
$medTot = $_POST["medTot"];

$stat = $bill->addBillItems($billId,$medId,$medType,$medQty,$medTot);
echo $stat;
}

?>