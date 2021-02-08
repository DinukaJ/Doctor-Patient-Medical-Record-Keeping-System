<?php
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
if(isset($_POST["type"]))
{
    if($_POST["type"]=="searchD")
        searchDoctor();
    if($_POST["type"]=="doctorData")
        getDoctorData();
    if($_POST["type"]=="upDet")
        updateDet();
    if($_POST["type"]=="upPass")
        updatePass();
    if($_POST["type"]=="updateDocCharge")
        updateDocCharge();
    if($_POST["type"]=="getDocCharge")
        getDocCharge();
    if($_POST["type"]=="addDoc")
        addDoctor();
}
function addDoctor()
{
    $patient = new patient();
    $id=$_POST["docId"];
    $fname=$_POST["firstName"];
    $lname=$_POST["lastName"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $stat=$patient->addPatient($id,$fname,$lname,$phone,$age,$email,$pass,$address,1);
    echo $stat;
}
function searchDoctor()
{
    // $output="";
    // $patient = new patient();
    // $patientSearch=$_POST["patientSearch"];
    // $searchResult=$patient->getPatientsList($patientSearch);
    // $count=1;
    // if(mysqli_num_rows($searchResult))
    // {
    //     while($row=mysqli_fetch_array($searchResult))
    //     {
    //         $output.="<div class='row c-12  searchr se$count'>$row[0] - $row[1] $row[2]</div>";
    //         $count=$count+1;
    //     }
    //     $count=$count-1;
    //     $output.=" <input type='hidden' id='secount' value='$count'>";
    // }
    // echo $output;
}

function getDoctorData()
{
    $doctor = new doctor();
    $docID=$_POST["docID"];
    $doctorData=$doctor->getDoctorData($docID);
    $row=mysqli_fetch_array($doctorData);
    echo json_encode($row);
}

function updateDet(){
    $doctor = new doctor();
    $docID = $_POST["docID"];
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $phone = $_POST["phone"];
    $stat = $doctor->updateDoctorInfo($fname, $lname, $phone, $docID);
    echo $stat;
}

function updatePass(){
    $doctor = new doctor();
    $docID=$_POST["docID"];
    $newPass= $_POST["nPass"];
    $stat = $doctor->updateDoctorPass($docID,$newPass);
    echo $stat;
}
function updateDocCharge(){
    $doctor = new doctor();
    $charge=$_POST["charge"];
    $stat = $doctor->updateDocCharge($charge);
    echo $stat;
}
function getDocCharge(){
    $doctor = new doctor();
    $stat = $doctor->getDocCharge();
    $stat=mysqli_fetch_array($stat)[0];
    echo $stat;
}
?>