<?php
include_once(dirname(dirname(__FILE__)).'/classes/bill.php');

if(isset($_POST["type"]))
{
    if($_POST["type"]=="createBill")
        createBill();
    if($_POST["type"]=="addBillMed")
        addBillMed();
    if($_POST["type"]=="getBill")
        getBill();
    if($_POST["type"]=="getBillData")
        getBillData();
}

function createBill(){

$bill = new bill();
$totAmt = $_POST["totAmt"];
$pid = $_POST["pid"];
$billType=$_POST["billType"];
$today=date("Y-m-d");
$docCharge=$_POST["docCharge"];
$stat = $bill->addBill($pid,$totAmt,$today,$docCharge,$billType);
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

function getBill()
{
    $bill=new bill();
    $docType=$_POST["docType"];
    $docID=$_POST["docID"];
    $month=$_POST["month"];
    if($month=="")
    {
        $month=date("Y-m");
    }
    $data=$bill->getBillData($docType,$docID,$month);
    $output="";
    $totalDocCharge=0;
    $totalBillCount=0;
    if(mysqli_num_rows($data[0])>0)
    {
        while($row=mysqli_fetch_assoc($data[0]))
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
        $row2=mysqli_fetch_array($data[1]);
        $totalDocCharge=$row2[0];
        $totalBillCount=$row2[1];
    }
    echo json_encode(array($output,$totalDocCharge,$totalBillCount));
}
function getBillData()
{
    $bill = new bill();
    $billId=$_POST["bId"];
    $data=$bill->viewBillAllData($billId);
    $data2=$bill->viewBill($billId);
    $output="";
    $patientId="";
    $patientName="";
    $doi="";
    $billType="";
    $billTotal=0;
    if(mysqli_num_rows($data)>0)
    {
        while($row=mysqli_fetch_assoc($data))
        {   
            $output.='
            <div class="row">
                <div class="c-12 c-m-4">
                    <b>'.$row['name'].'</b>
                </div>
                <div class="c-12 c-m-4">
                    <b>'.$row['type'].'</b>
                </div>
                <div class="c-12 c-m-2">
                    <b>'.$row['qty'].'</b>
                </div>
                <div class="c-12 c-m-2">
                    <b>'.$row['totPrice'].'</b>
                </div>
            </div>
            ';
        }
        $data2=mysqli_fetch_assoc($data2);
        $doi=$data2["doi"];
        $billTotal=$data2["amount"];
        if($data2['type']=="pres")
        {
            $billType="Prescription";
            $output.='
            <div class="row" style="margin-top:50px;margin-bottom:0px;">
                <div class="c-12"><hr></div>
                <div class="c-12" style="text-align:right; padding-right:11%;">
                    Doctor Charge:- Rs.<span id="docCharge">'.$data2['docCharge'].'</span>
                </div>
            </div>  
            ';
            $data3=$bill->getBillPatient($billId);
            $data3=mysqli_fetch_assoc($data3);
            $patientId=$data3["id"];
            $patientName=$data3["Name"];
        }
        else
        {
            $billType="Normal";
        }
    }
    echo json_encode(array($output,$patientId,$patientName,$doi,$billType,$billTotal));
}
?>