<?php
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
if(isset($_POST["type"]))
{
    if($_POST["type"]=="searchP")
        searchPatient();
    if($_POST["type"]=="patientData")
        getpatientDat();
    if($_POST["type"]=="upPatientAllergies")
        updatePatient_Allergy_IN();
    if($_POST["type"]=="getPres")
        getPatientPresIn();
    if($_POST["type"]=="upDet")
        updateDet();
    if($_POST["type"]=="presInfo")
        getPatientPres();
}
function addPatient()
{

}
function searchPatient()
{
    $output="";
    $patient = new patient();
    $patientSearch=$_POST["patientSearch"];
    $searchResult=$patient->getPatientsList($patientSearch);
    $count=1;
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="<div class='row c-12  searchr se$count'>$row[0] - $row[1] $row[2]</div>";
            $count=$count+1;
        }
        $count=$count-1;
        $output.=" <input type='hidden' id='secount' value='$count'>";
    }
    echo $output;
}

function getpatientDat()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $patientData=$patient->getPatientData($patientID);
    $row=mysqli_fetch_array($patientData);
    echo json_encode($row);
}
function updatePatient_Allergy_IN()
{
    $patient = new patient();
    $patID=$_POST["patID"];
    $allergy=$_POST["allergy"];
    $importantNotes=$_POST["importantNotes"];
    $stat=$patient->updatePatient_Allergy_IN($patID,$allergy,$importantNotes);

    echo json_encode(array($stat));
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

function updateDet(){
    $patient = new patient();
    $patID = $_POST["patientID"];
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $stat = $patient->updatePatientNonMedInfo($patID,$fname,$lname,$phone,$age,$address);
    echo $stat;
}

function getPatientPres(){ 
    $output="";
    $prescription = new prescription();
    $presId = $_POST["presID"];
    $presMedData = $prescription->getMedViewData($presId);
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
        }
    }
    echo $output;
}
?>