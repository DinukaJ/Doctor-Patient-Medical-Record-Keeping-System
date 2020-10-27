<?php
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
if(isset($_POST["type"]))
{
    if($_POST["type"]=="getID")
        getPatNewId();
    if($_POST["type"]=="addPat")
        addPatient();
    if($_POST["type"]=="searchP")
        searchPatient();
    if($_POST["type"]=="patientData")
        getpatientDat();
    if($_POST["type"]=="upPatientAllergies")
        updatePatient_Allergy_IN();
    if($_POST["type"]=="upDet")
        updateDet();
    if($_POST["type"]=="upPass")
        updatePass();
    if($_POST["type"]=="searchPRecep")
        searchPatientsRecep();
}
function getPatNewId()
{
    $patient = new patient();
    $res=$patient->getNewId();
    if(mysqli_num_rows($res))
        echo mysqli_fetch_array($res)[0];
    else
        echo "";
}
function addPatient()
{
    $patient = new patient();
    $id=$_POST["patId"];
    $fname=$_POST["firstName"];
    $lname=$_POST["lastName"];
    $phone=$_POST["phone"];
    $age=$_POST["age"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $address=$_POST["address"];
    $stat=$patient->addPatient($id,$fname,$lname,$phone,$age,$email,$pass,$address);
    echo $stat;
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
function searchPatientsRecep()
{
    $output="";
    $patient = new patient();
    $patientSearch=$_POST["patientSearch"];
    $searchResult=$patient->getPatientsList($patientSearch);
    $numRows=mysqli_num_rows($searchResult);
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="
            <div class='row patientDataRow'>
                <div class='c-3' class='$row[0]'>$row[0]</div>
                <div class='c-4' class='$row[1]'>$row[1]</div>
                <div class='c-4' class='$row[2]'>$row[2]</div>
                <div class='c-1'>
                    <button type='button' class='btn btnPatientView viewMed' name='viewMed' id='$row[0]'>View</button>
                </div>
            </div>
            ";
        }
    }
    //echo $output;
    echo json_encode(array($output, $numRows));
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

function updatePass(){
    $patient = new patient();
    $patID=$_POST["pid"];
    $newPass= $_POST["nPass"];
    $stat = $patient->updatePatientPass($patID,$newPass);
    echo $stat;
}
?>