<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');

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
            if($row[5]=="b")
                $time="Before";
            else
                $time="After";

            $duration=str_replace("w","Week(s)",$row[6]);
            $output.='
            <tr>
                <td style="width:2%">'.$row[1].'</td>
                <td style="width:23%">'.$row[7].' - '.$row[2].'</td>
                <td style="width:12%; text-align:center;">'.$row[3].'</td>
                <td style="width:12%; text-align:center;">'.$row[4].'</td>
                <td style="width:14%; text-align:center;">'.$time.'</td>
                <td style="width:12%; text-align:center;">'.$duration.'</td>
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
        while($presRow=mysqli_fetch_array($presData)){
            $docId = $presRow[0];//assigning doctor id
            $docData= $doctor->getDoc($docId);//getting doctor data 
            $docRow= mysqli_fetch_array($docData);
            $name = $docRow[1].' '.$docRow[2];//concatenating doc name   
            $output.= "<div class='row patientDataRow'>
            <div class='c-12 c-l-4' class='docName' id='docNameF'>$name</div>
            <div class='c-12 c-l-4' class='presId' style='text-align:center'>$presRow[2]</div>
            <div class='c-3 c-l-3'></div>
            <div class='c-12 c-l-1'>
                <button type='button' class='btn btnPatientView viewPres' name='viewPres' id='viewPres-$presRow[2]'>View</button>
            </div>
      </div>";
        }
    }
    echo $output;
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
            <div class='c-12 c-m-2' class='timePd'>$presMedRow[6]</div>
            <div class='c-12 c-m-2' class='befAf'>$presMedRow[7]</div>
            <div class='c-12 c-m-2' class='dura'>$presMedRow[8]</div>
            <div class='c-12 c-m-1'></div>
            </div>";
            $docName=$presMedRow[0]." ".$presMedRow[1];
            $presDate=$presMedRow[4];
        }
    }
    //echo $output;
    echo json_encode(array($output,$docName,$presDate));
}
?>