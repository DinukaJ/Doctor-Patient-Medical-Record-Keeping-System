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
        $amountPerTime=$_POST["amountPT"];
        $timesPerDay=$_POST["timesPD"];
        $afterBefore=$_POST["afterBefore"];
        $duration=$_POST["duration"];
        $stat=$pres->addMed($pid,$medID,$amountPerTime,$timesPerDay,$afterBefore,$duration);
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
        $stat=$pres->removeMed($pid,$medID);
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
            if($row[4]=="b")
                $time="Before";
            else
                $time="After";

            $duration=str_replace("w","Week(s)",$row[5]);
            $output.='
            <tr>
                <td style="width:2%">'.$row[1].'</td>
                <td style="width:23%">'.$row[6].'</td>
                <td style="width:12%; text-align:center;">'.$row[2].'</td>
                <td style="width:12%; text-align:center;">'.$row[3].'</td>
                <td style="width:14%; text-align:center;">'.$time.'</td>
                <td style="width:12%; text-align:center;">'.$duration.'</td>
                <td style="width:25%; text-align:center;"><button value="'.$row[1].'" class="btn btnPatientView delMed" name="deleteMed" id="medid"><i class="fas fa-times"></i></button></td>
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
?>