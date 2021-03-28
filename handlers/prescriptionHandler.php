<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
include_once(dirname( dirname(__FILE__) ).'/classes/inventory.php');

//Checking which function to call
if(isset($_POST["type"]))
{
    if($_POST["type"]=="addMed")
        addMedicineToPrescription();
    if($_POST["type"]=="addPresNote")
        addPrescriptionNote();
    if($_POST["type"]=="removeMed")
        removeMedicineFromPrescription();
    if($_POST["type"]=="presMed")
        getPrescriptionMedicine();
    if($_POST["type"]=="deletePres")
        deletePrescription();
    if($_POST["type"]=="finishPres")
        finishPrescription();
    if($_POST["type"]=="getPres")
        getPatientPresIn();
    if($_POST["type"]=="presInfo")
        getPatientPres();
    if($_POST["type"]=="getPatientPres")
        getPatientPresForModal();
    if($_POST["type"]=="getPresDataTable")
        getPresDataTable();
    if($_POST["type"]=="getTodayPres")
        getTodayPres();
    if($_POST["type"]=="getTodayPresMed")
        getTodayPresMed();
    if($_POST["type"]=="getMedFinInfo")
        getMedFinInfo();
    if($_POST["type"]=="getPresInfo")
        getPresInfo();
    if($_POST["type"]=="changeStatus")
        changeStatus();
}


function addPrescription()
{
    $pres=new prescription();
    $patientID=$_POST["patID"];
    $docID=$_POST["docID"];
    $today=date("Y-m-d");
    $status=-1;
    $pid=$pres->getNextPID();
    $stat=$pres->addNewPrescription($docID,$patientID,$pid,$today,$status);

    $arr=array($stat,$pid);
    return $arr;
}
function addMedicineToPrescription()
{
    $pres=new prescription();
    $presStatus=false;
    $pid=$_POST["prescription"];
    if($pid!="")
    {
        // $pid=$_SESSION["prescription"];
        $presStatus=true;
    }
    else
    {
        $stat=addPrescription();
        if($stat[0])
        {
            $presStatus=true;
            $pid=$stat[1];
        }
    }
    if($presStatus)
    {
        $medID=$_POST["medID"];
        $medType=$_POST["medT"];
        $amountPerTime=$_POST["amountPT"];
        $timesPerDay=$_POST["timesPD"];
        $afterBefore=$_POST["afterBefore"];
        $duration=$_POST["duration"];
        $stat=$pres->addMed($pid,$medID,$medType,$amountPerTime,$timesPerDay,$afterBefore,$duration);
    }
    else
        $stat=0;

    echo json_encode(array($stat,$pid));
}
function removeMedicineFromPrescription()
{
    $pres=new prescription();
    $pid=$_POST["prescription"];
    if($pid!="")
    {
        // $pid=$_SESSION["prescription"];
        $medID=$_POST["medID"];
        $medType=$_POST["medT"];
        $stat=$pres->removeMed($pid,$medID,$medType);
    }
    else 
        $stat=0;

    echo json_encode(array($stat));
}
function addPrescriptionNote()
{
    $pres=new prescription();
    $pid=$_POST["prescription"];
    if($pid!="")
    {
        // $pid=$_SESSION["prescription"];
        $note=$_POST["presNote"];
        $stat=$pres->addPrescriptionNote($pid,$note);

        echo json_encode(array($stat));
    }
}
function getPrescriptionMedicine()
{
    $pres=new prescription();
    $output="";
    $pid=$_POST["prescription"];
    if($pid!="")
    {
        // $pid=$_SESSION["prescription"];
        $data=$pres->getPresMeds($pid);
        while($row=mysqli_fetch_array($data))
        {

            $output.='
            <tr>
                <td style="width:2%">'.$row[1].'</td>
                <td style="width:23%">'.$row[7].' - '.$row[2].'</td>
                <td style="width:12%; text-align:center;">'.$row[3].'</td>
                <td style="width:12%; text-align:center;">'.formatTimes($row[4]).'</td>
                <td style="width:14%; text-align:center;">'.formatBeforeAfter($row[5]).'</td>
                <td style="width:12%; text-align:center;">'.formatDuration($row[6]).'</td>
                <td style="width:25%; text-align:center;"><button value="'.$row[1].'-'.$row[2].'" class="btn delMed" name="deleteMed" id="medid"><i class="fas fa-times"></i></button></td>
            </tr>
            ';
        }
    }
    echo $output;
}

function deletePrescription()
{
    $pres=new prescription();
    $pid=$_POST["prescription"];
    $stat=$pres->deletePresAndMeds($pid);
    echo json_encode($stat);
}
function finishPrescription()
{
    $pres=new prescription();
    $pid=$_POST["prescription"];
    $stat=$pres->finishPres($pid);
    echo json_encode($stat);
}
function getPatientPresIn(){ 
    $output="";
    $prescription = new prescription();
    $doctor = new doctor();
    $pid = $_POST["patientID"];
    $presData= $prescription->getPatientPres($pid);//getting prescription data of the patient
    if(mysqli_num_rows($presData)){
    //     while($presRow=mysqli_fetch_array($presData)){
    //         $docId = $presRow[0];//assigning doctor id
    //         $docData= $doctor->getDoc($docId);//getting doctor data 
    //         $itemCount=$prescription->getPresMedCount($presRow[2]);
    //         $docRow= mysqli_fetch_array($docData);
    //         $name = $docRow[1].' '.$docRow[2];//concatenating doc name   
    //         $output.= "<div class='row patientDataRow'>
    //         <div class='c-12 c-l-3' class='presId' style='text-align:center'>$presRow[2]</div>
    //         <div class='c-12 c-l-4' class='docName' id='docNameF'>$name</div>
    //         <div class='c-12 c-l-2'>$itemCount</div>
    //         <div class='c-3 c-l-2'>$presRow[3]</div>
    //         <div class='c-12 c-l-1'>
    //             <button type='button' class='btn btnPatientView viewPres' name='viewPres' patName='$row[0] $row[1]' presId='$row[4]' patId='$row[3]' day='$row[5]' docName='$row[9] $row[10]' note='$row[11]' id='viewPres-$presRow[2]'>View</button>
    //         </div>
    //   </div>";
        while($presRow=mysqli_fetch_array($presData)){
            $output.= "<div class='row patientDataRow'>
            <div class='c-3 c-m-3' class='presId' style='text-align:center'>$presRow[4]</div>
            <div class='c-4 c-m-4' class='docName' id='docNameF'>$presRow[9] $presRow[10]</div>
            <div class='c-2'>$presRow[8]</div>
            <div class='c-3 c-m-2'>$presRow[5]</div>
            <div class='c-12 c-m-1'>
                <button type='button' class='btn btnPatientView viewPres' name='viewPres' patName='$presRow[0] $presRow[1]' presId='$presRow[4]' patId='$presRow[3]' day='$presRow[5]' docName='$presRow[9] $presRow[10]' note='$presRow[11]' id='viewPres-$presRow[2]'>View</button>
            </div>
      </div>";
        }
    }
    echo json_encode(array($output,$prescription->getPatientPresNum($pid)));
}
function getPatientPres(){ 
    $output="";
    $prescription = new prescription();
    $presId = $_POST["presID"];
    $presMedData = $prescription->getMedViewData($presId);
    $docName="";
    $presDate="";
    if(mysqli_num_rows($presMedData)){
        while($presMedRow=mysqli_fetch_array($presMedData)){ 
            $output.= "<div class='row patientDataRow'>
            <div class='c-12 c-m-1'></div>
            <div class='c-12 c-m-2' class='medName'>$presMedRow[2]</div>
            <div class='c-12 c-m-2' class='amtPt'>$presMedRow[5]</div>
            <div class='c-12 c-m-2' class='timePd'>".formatTimes($presMedRow[6])."</div>
            <div class='c-12 c-m-2' class='befAf'>".formatBeforeAfter($presMedRow[7])."</div>
            <div class='c-12 c-m-2' class='dura'>".formatDuration($presMedRow[8])."</div>
            <div class='c-12 c-m-1'></div>
            </div>";
            $docName=$presMedRow[0]." ".$presMedRow[1];
            $presDate=$presMedRow[4];
        }
    }
    //echo $output;
    echo json_encode(array($output,$docName,$presDate));
}

function getPatientPresForModal(){ 
    $output="";
    $prescription = new prescription();
    $presId = $_POST["patientID"];
    $presData = $prescription->getPatientPres($presId);
    $last="";
    $lastDate="";
    if(mysqli_num_rows($presData)){
        $presMedRow=mysqli_fetch_array($presData);
        $output.= "
            <div class='row patientDataRow2 active' id='pres $presMedRow[4]' note='$presMedRow[6]'>
                <div class='c-12' style='padding-right:0px;'>
                    <b>ID: </b><span class='presListID'>".$presMedRow[4]."</span><br>
                    <b>Date: </b><span class='presListDate'>".$presMedRow[5]."</span><br>
                </div>
            </div> 
            ";
            $last=$presMedRow[4];
            $lastDate=$presMedRow[5];
            $lastComment=$presMedRow[6];
        while($presMedRow=mysqli_fetch_array($presData)){ 
            $output.= "
            <div class='row patientDataRow2' id='pres $presMedRow[4]' note='$presMedRow[6]'>
                <div class='c-12' style='padding-right:0px;'>
                    <b>ID: </b><span class='presListID'>".$presMedRow[4]."</span><br>
                    <b>Date: </b><span class='presListDate'>".$presMedRow[5]."</span><br>
                </div>
            </div> 
            ";
        }
    }
    //echo $output;
    echo json_encode(array($output,$last,$lastDate,$lastComment));
}
function getPresDataTable()
{
    $output="";
    $prescription = new prescription();
    $presId = $_POST["presID"];
    $presData = $prescription->getPresMeds($presId);
    $count=1;
    if(mysqli_num_rows($presData)){
        while($presMedRow=mysqli_fetch_array($presData)){             
            $output.= "
            <tr>
                <td style='width:2%'>$count</td>
                <td style='width:23%'>$presMedRow[7] $presMedRow[2]</td>
                <td style='width:12%; text-align:center;'>$presMedRow[3]</td>
                <td style='width:12%; text-align:center;'>".formatTimes($presMedRow[4])."</td>
                <td style='width:14%; text-align:center;'>".formatBeforeAfter($presMedRow[5])."</td>
                <td style='width:12%; text-align:center;'>".formatDuration($presMedRow[6])."</td>
            </tr>
            ";
            $count++;
        }
    }
    //echo $output;
    echo $output;
}
function formatTimes($t)
{
    $t=explode(" ",$t);
    if($t[0]==1 && $t[1]=="m")
    {
        return "1 (Morning)";
    }
    else if($t[0]==1 && $t[1]=="n")
    {
        return "1 (Night)";
    }
    else if($t[0]==2)
    {
        return "2 (Morning & Night)";
    }
    else
    {
        return "3";
    }
}
function formatBeforeAfter($v)
{
    if($v=="b")
        return "Before";
    else if($v=="a")
        return "After";
    else if($v=="c")
        return "Any";
}
function formatDuration($v)
{
    $v=explode(" ",$v);
    if($v[1]=="d")
        return "$v[0] Day(s)";
    else if($v[1]=="w")
        return "$v[0] Week(s)";
    else if($v[1]=="m")
        return "$v[0] Month(s)";
}

function getTodayPres()
{
    $output="";
    $prescription = new prescription();
    $presData = $prescription->getTodayPres();
    $count=0;
    if(mysqli_num_rows($presData)){
        while($row = mysqli_fetch_array($presData)){
            $output.="<div class='row patientDataRow'>
            <div class='c-3' class='presId'>$row[4]</div>
            <div class='c-4' class='patName'>$row[0] $row[1]</div>
            <div class='c-4' class='items'>$row[8]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewPres' name='viewPres' patName='$row[0] $row[1]' presId='$row[4]' patId='$row[3]' day='$row[5]' docName='$row[9] $row[10]' note='$row[11]' id='viewPres~$row[4]~$row[2]~$row[3]~$row[0]~$row[1]~$row[5]~$row[9]~$row[10]'>View</button>
            </div>
            </div>";
            $count+=1;
        }
    }
    echo json_encode(array($output,$count));
}


function getTodayPresMed()
{
    $output="";
    $prescription =  new prescription();
    $pid = $_POST["id"];
    $presMedData = $prescription->getPresMeds($pid);
    if(mysqli_num_rows($presMedData)){
        while($row = mysqli_fetch_array($presMedData)){
            $output.='<div class="row">
            <div class="c-4 c-m-2 medName" id='.$row[0].'>'.$row[7].'</div>
            <div class="c-4 c-m-2 medType" id='.$row[1].'>'.$row[2].'</div>
            <div class="c-4 c-m-2 medAmt">'.$row[3].'</div>
            <div class="c-4 c-m-2 medTimes">'.formatTimes($row[4]).'</div>
            <div class="c-4 c-m-2 medBA">'.formatBeforeAfter($row[5]).'</div>
            <div class="c-4 c-m-2 medDura">'.formatDuration($row[6]).'</div>
            </div>';
        }
    }
    echo $output;
}

function getMedFinInfo(){
$output="";
$total = 0;
$qtys = [];
$prescription =  new prescription();
$doc =  new doctor();
$inv =  new inventory();
$pid = $_POST["pid"];
$presMedFinData = $prescription->getMedFin($pid);
$docCharge=$doc->getDocCharge();
$docCharge=mysqli_fetch_array($docCharge)[0];
if(mysqli_num_rows($presMedFinData)){
    while($row = mysqli_fetch_array($presMedFinData)){
            $dayCount=0;
            $arr= (explode(" ",$row[5]));
            if($arr[1]=='w')
            {
                $dayCount=7;
            }
            else if($arr[1]=='d')
            {
                $dayCount=1;
            }

            $stockCount=$inv->getMedCount($row[6],$row[1]);
            $stockCount=mysqli_fetch_array($stockCount)[0];

            $qty = ceil((float)$row[3]*(int)$row[4]*(int)$row[5]*$dayCount);
            $total+= $qty*(float)$row[2];
            $output.='<div class="row billItemRow" medId='.$row[6].'>
            <div class="c-12 c-m-3 medName">'.$row[0].'</div>
            <div class="c-12 c-m-3 medType">'.$row[1].'</div>
            <div class="c-12 c-m-2">';
            if($stockCount<$qty)
            {
                $output.='<span class="errStock">*'.$stockCount.' in Stock need '.$qty.'. <br></span><input type="number" value="'.$stockCount.'" maxAmount="'.$stockCount.'" unitPrice="'.$row[2].'" class="input-field medQty" style="width:100%;" name="qty" placeholder=""></div>';
            }
            else
            {
                $output.='<input type="number" value="'.$qty.'" maxAmount="'.$qty.'" unitPrice="'.$row[2].'" class="input-field medQty" style="width:100%;" name="qty" placeholder=""></div>';
            }
            $output.='
            <div class="c-12 c-m-2 medPrice">'.$row[2].'</div>
            <div class="c-12 c-m-2 medTotPrice">'.number_format((float)$qty*(float)$row[2], 2, '.', '').'</div>
            </div>';
            array_push($qtys,$qty);
    }
    $output.='
    <div class="row" style="margin-top:50px;margin-bottom:0px;">
        <div class="c-12"><hr></div>
        <div class="c-12" style="text-align:right; padding-right:11%;">
            Doctor Charge:- Rs.<span id="docCharge">'.$docCharge.'</span>
        </div>
    </div>  
    ';
    $total+=(float)$docCharge;
}

echo json_encode(array($output,number_format((float)$total, 2, '.', ''),$qtys));
}

function getPresInfo(){
    $output="";
    $prescription = new prescription();
    $presData = $prescription->getAllPres();
    $count=0;
    if(mysqli_num_rows($presData)){
        while($row = mysqli_fetch_array($presData)){
            $output.="<div class='row patientDataRow'>
            <div class='c-3' class='presId'>$row[4]</div>
            <div class='c-4' class='patName'>$row[0] $row[1]</div>
            <div class='c-2' class='items'>$row[8]</div>
            <div class='c-2' class='doi'>$row[5]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewPres' name='viewPres' patName='$row[0] $row[1]' presId='$row[4]' patId='$row[3]' day='$row[5]' docName='$row[9] $row[10]' note='$row[11]' id='viewPres~$row[4]~$row[2]~$row[3]~$row[0]~$row[1]~$row[5]~$row[9]~$row[10]'>View</button>
            </div>
            </div>";
            $count+=1;
        }
    }
    echo json_encode(array($output,$count));  
}

function changeStatus(){
    $prescription = new prescription();
    $pid = $_POST["pid"];
    $stat = $prescription->changeStatus($pid);
    echo json_encode($stat);
}


?>