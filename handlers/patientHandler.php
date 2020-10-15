<?php
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
if(isset($_POST["type"]))
{
    if($_POST["type"]=="searchP")
        searchPatient();
    if($_POST["type"]=="patientData")
        getpatientDat();
    if($_POST["type"]=="upPatientAllergies")
        updatePatient_Allergy_IN();
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


function getPatientPres(){ 
    $output="";
    $prescription = new prescription();
    $pid = $_POST["patientID"];
    $presData= $prescription->getPatientPres($pid);
    // $row= mysql_fetch_array($presData);
    if(mysqli_num_rows($presData)){
        while(mysqli_fetch_array($presData)){
            $output.= "<div class='row patientDataRow'>
            <div class='c-3' class='presId'>$row[0]</div>
            <div class='c-4' class='medicName'>$row[1]</div>
            <div class='c-4' class='medicQty'>$row[2]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewMed' name='viewMed' id='viewMed-$row[0]'>View</button>
            </div>
      </div>";
        }
    }
}
?>