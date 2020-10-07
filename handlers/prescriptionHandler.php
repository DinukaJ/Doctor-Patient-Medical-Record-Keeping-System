<?php
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');

//Checking which function to call
if(isset($_POST["addPres"]))
    addMedicineToPrescription();

function addPrescription()
{
    $pres=new prescription();
    $patientID=$_POST["patID"];
    $docID=$_POST["docID"];
    $today=date("Y-m-d");
    $status=0;
    $pid=$pres->getNextPID();
    $stat=$pres->addNewPrescription($docID,$patientID,$pid,$today,$status);

    $arr=array($stat,$pid);
    return $arr;
}
function addMedicineToPrescription()
{
    $pres=new prescription();
    $presStatus=false;
    if(isset($_SESSION["prescription"]))
    {
        $pid=$_SESSION["prescription"];
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

    echo json_encode(array($stat));
}
function removeMedicineToPrescription()
{
    $pres=new prescription();
    if(isset($_SESSION["prescription"]))
    {
        $pid=$_SESSION["prescription"];
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
    if(isset($_SESSION["prescription"]))
    {
        $pid=$_SESSION["prescription"];
        $note=$_POST["presNote"];
        $stat=$pres->addPrescriptionNote($pid,$note);

        echo json_encode(array($stat));
    }
}
?>