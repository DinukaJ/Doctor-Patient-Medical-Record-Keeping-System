<?php
include_once(dirname(dirname(__FILE__)).'/classes/bill.php');

if(isset($_POST["type"]))
{
    if($_POST["type"]=="createBill")
        createBill();
    if($_POST["type"]=="addBillMed")
        addBillMed();
    if($_POST["type"]=="getBill")
        getBillData();
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

function getBillData()
{
    $bill=new bill();
    $docType=$_POST["docType"];
    $docID=$_POST["docID"];
    $month=$_POST["month"];
    if($month=="")
    {
        $month=date("Y-m");
    }
    $stat=$bill->getBillData($docType,$docID,$month);
    $output="";
    if(mysqli_num_rows($stat)>0)
    {
        while($row=mysqli_fetch_assoc($stat))
        {
            $output.='
            <div class="row patientDataRow">
                <div class="c-3">
                    '.$row["id"].'
                </div>
                <div class="c-5">
                    '.$row["noMed"].'
                </div>
                <div class="c-3">
                    '.$row["amount"].'
                </div>
                <div class="c-1">
                    <button class="btn btnPatientView viewBill" name="viewBill" id="viewBill" billId="'.$row["id"].'">View</button>
                </div>
            </div>  
            ';
        }
    }
    echo $output;
}
?>