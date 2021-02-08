<?php
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
if(isset($_POST["type"]))
{
    if($_POST["type"]=="getID")
        getDocNewId();
    if($_POST["type"]=="searchD")
        searchDoctor();
    if($_POST["type"]=="doctorData")
        getDoctorData();
    if($_POST["type"]=="doctorData2")
        getDoctorData2();
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
    if($_POST["type"]=="searchDRecep")
        searchDRecep();
    if($_POST["type"]=="addDocSpec")
        addDocSpec();
    if($_POST["type"]=="removeDocSpec")
        removeDocSpec();
    if($_POST["type"]=="upDoc")
        updateDoctor();
}
function getDocNewId()
{
    $doctor = new doctor();
    $res=$doctor->getNewId();
    if(mysqli_num_rows($res))
        echo mysqli_fetch_array($res)[0];
    else
        echo "";
}
function addDoctor()
{
    $doctor = new doctor();
    $id=$_POST["docId"];
    $fname=$_POST["firstName"];
    $lname=$_POST["lastName"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $days=$_POST["day"];
    $specialties=$_POST["special"];
    $specialArr=explode(",",$specialties);
    $stat=$doctor->addDoctor($id,$fname,$lname,$phone,$email,$pass,0);
    foreach($days as $day)
    {
        $doctor->addDocUsualDays($id,$day);
    }
    foreach($specialArr as $spec)
    {
        $doctor->addDocSpecialty($id,$spec);
    }
    echo $stat;
}
function updateDoctor()
{
    $doctor = new doctor();
    $id=$_POST["docUpID"];
    $fname=$_POST["firstNameUp"];
    $lname=$_POST["lastNameUp"];
    $phone=$_POST["phoneUp"];
    $email=$_POST["emailUp"];
    $pass=$_POST["passUp"];
    $days=$_POST["day"];
    $stat=$doctor->updateDoctor($id,$fname,$lname,$phone,$email,$pass);
    foreach($days as $day)
    {
        $doctor->addDocUsualDays($id,$day);
    }
    echo $stat;
}
function addDocSpec()
{
    $doctor = new doctor();
    $id=$_POST["id"];
    $spec=$_POST["spec"];
    $stat=$doctor->addDocSpecialty($id,$spec);
    echo $stat;
}
function removeDocSpec()
{
    $doctor = new doctor();
    $id=$_POST["id"];
    $spec=$_POST["spec"];
    $stat=$doctor->removeDocSpecialty($id,$spec);
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
function searchDRecep()
{
    $output="";
    $patient = new doctor();
    $patientSearch=$_POST["doctorSearch"];
    $searchResult=$patient->getDoctorList($patientSearch);
    $numRows=mysqli_num_rows($searchResult);
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="
            <div class='row patientDataRow'>
                <div class='c-3' class='$row[0]' id='docID'>$row[0]</div>
                <div class='c-8' class='$row[1]'>$row[1] $row[2]</div>
                <div class='c-1'>
                    <button type='button' class='btn btnPatientView viewDoc' name='viewDoc' id='$row[0]'>View</button>
                </div>
            </div>
            ";
        }
    }
    //echo $output;
    echo json_encode(array($output, $numRows));
}
function getDoctorData()
{
    $doctor = new doctor();
    $docID=$_POST["docID"];
    $doctorData=$doctor->getDoctorData($docID);
    $row=mysqli_fetch_array($doctorData);
    echo json_encode($row);
}
function getDoctorData2()
{
    $doctor = new doctor();
    $docID=$_POST["docID"];
    $doctorData=$doctor->getDoctorData($docID);
    $data=mysqli_fetch_array($doctorData);
    $usualDays=$doctor->getDoctorUsualDays($docID);
    $usualDaysData="";
    while($row=mysqli_fetch_array($usualDays))
    {
        $usualDaysData.="$row[1] ,";
    }
    $specialty=$doctor->getDoctorSpecialty($docID);
    $specialtyData="";
    while($row=mysqli_fetch_array($specialty))
    {
        $specialtyData.="$row[1] ,";
    }
    echo json_encode(array($data,$usualDaysData,$specialtyData));
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