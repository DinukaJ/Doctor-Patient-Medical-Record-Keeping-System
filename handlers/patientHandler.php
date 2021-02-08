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
    if($_POST["type"]=="upDet")
        updateDet();
    if($_POST["type"]=="upPass")
        updatePass();
    if($_POST["type"]=="searchPRecep")
        searchPatientsRecep();
    if($_POST["type"]=="getAllergy")
        getAllergy();
    if($_POST["type"]=="addAllergy")
        addAllergy();
    if($_POST["type"]=="addImp")
        addImp();
    if($_POST["type"]=="delAllergy")
        delAllergy();
    if($_POST["type"]=="delImp")
        delImp();
    if($_POST["type"]=="delPat")
        delPat();
    if($_POST["type"]=="upPat")
        upPat();
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
    $stat=$patient->addPatient($id,$fname,$lname,$phone,$age,$email,$pass,$address,1);
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
                <div class='c-3' class='$row[0]' id='patID'>$row[0]</div>
                <div class='c-5' class='$row[1]'>$row[1] $row[2]</div>
                <div class='c-3' class='$row[2]'>$row[3]</div>
                <div class='c-1'>
                    <button type='button' class='btn btnPatientView viewPat' name='viewMed' id='$row[0]'>View</button>
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
function getAllergy()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $allergy=$patient->getAllergy($patientID);
    $impNotes=$patient->getImpNotes($patientID);
    $output1="";
    $output2="";
    while($row=mysqli_fetch_array($allergy))
    {
        $output1.='
        <div class="row allergyRow">
            <div class="c-11" style="padding-right:0px;">
                '.$row[1].'
            </div>
            <div class="c-1" style="padding-left:2px;">
                <button class="btn btnPatientView2 delAllergy" name="delAllergy" id="'.$row[1].'"><i class="fas fa-times"></i></button>
            </div>
        </div>  
        ';
    }
    while($row=mysqli_fetch_array($impNotes))
    {
        $output2.='
        <div class="row allergyRow">
            <div class="c-11" style="padding-right:0px;">
                '.$row[1].'
            </div>
            <div class="c-1" style="padding-left:2px;">
                <button class="btn btnPatientView2 delImp" name="delImp" id="'.$row[1].'"><i class="fas fa-times"></i></button>
            </div>
        </div>  
        ';
    }
    echo json_encode(array($output1,$output2));
}

function addAllergy()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $allergy=$_POST["allergy"];
    $stat=$patient->addAllergy($patientID,$allergy);
    echo $stat;
}
function delAllergy()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $allergy=$_POST["allergy"];
    $stat=$patient->delAllergy($patientID,$allergy);
    echo $stat;
}
function addImp()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $imp=$_POST["imp"];
    $stat=$patient->addImp($patientID,$imp);
    echo $stat;
}
function delImp()
{
    $patient = new patient();
    $patientID=$_POST["patientID"];
    $imp=$_POST["imp"];
    $stat=$patient->delImp($patientID,$imp);
    echo $stat;
}
//deletes patient
function delPat(){
    $patient = new patient();
    $patientID=$_POST["id"];
    $stat=$patient->delPat($patientID);
    echo $stat; 
}
function upPat(){
    $patient = new patient();
    $id=$_POST["patUpID"];
    $fname=$_POST["patUpFname"];
    $lname=$_POST["patUpLname"];
    $phone=$_POST["patUpPhone"];
    $age=$_POST["patUpAge"];
    $email=$_POST["patUpEmail"];
    $oldEmail=$_POST["oldEmail"];
    $pass=$_POST["patUpPass"];
    $address=$_POST["patUpAddress"];
    $stat=$patient->updatePatient($id,$fname,$lname,$phone,$age,$email,$pass,$address);
    echo $stat; 
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