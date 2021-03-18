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
    if($_POST["type"]=="addSpecDay")
        addSpecDay();
    if($_POST["type"]=="getSpecDays")
        getSpecDays();
    if($_POST["type"]=="removeSpecDay")
        removeSpecDay();
    if($_POST["type"]=="docDataModal")
        docDataModal();
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
    $doctor=new doctor();
    $name=$_POST["name"];
    $spec=$_POST["spec"];
    $output="";
    $data=$doctor->getDoctorListPatient($name,$spec);
    if(mysqli_num_rows($data)>0)
    {
        while($row=mysqli_fetch_assoc($data))
        {
            $dp="";
            $spec="";
            if($row["dp"]==NULL)
                $dp="acc.png";
            else
                $dp=$row["dp"];

            $docSpec=$doctor->getDoctorSpecialty($row["id"]);
            if(mysqli_num_rows($docSpec)>0)
            {
                $count=mysqli_num_rows($docSpec);
                $i=1;
                while($row2=mysqli_fetch_assoc($docSpec))
                {
                    if($i==$count)
                    {
                        $spec.='
                        '.$row2["speciality"].'
                        ';
                    }
                    else
                    {
                        $spec.='
                        '.$row2["speciality"].',
                        ';
                    }
                    $i++;
                }
            }
            $output.='
            <div class="c-6 c-m-3">
                <div class="docBox">
                    <div class="imgSection">
                        <img class="docDp" src="../images/'.$dp.'">
                    </div>
                    <div class="textSection">
                        <p class="docName">'.$row["fname"].' '.$row["lname"].'</p>
                        <p class="docSpec">'.$spec.'</p>
                        <a class="viewDocDates" docId="'.$row["id"].'">View Dates</a>
                    </div>
                </div>
            </div>
            ';
        }
    }
    echo $output;
    
}
function searchDRecep()
{
    $output="";
    $patient = new doctor();
    $patientSearch=$_POST["doctorSearch"];
    $searchResult=$patient->getDoctorList($patientSearch);
    $numRows=mysqli_num_rows($searchResult);
    $btnVal="View";
    if(isset($_POST["btn"]))
    {
        $btnVal=$_POST["btn"];
    }
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="
            <div class='row patientDataRow'>
                <div class='c-3' class='$row[0]' id='docID'>$row[0]</div>
                <div class='c-8' class='$row[1]'>$row[1] $row[2]</div>
                <div class='c-1'>
                    <button type='button' class='btn btnPatientView viewDoc' name='viewDoc' id='$row[0]'>$btnVal</button>
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
    $email = $_POST["email"];
    $stat = $doctor->updateDoctorInfo($fname, $lname, $phone, $docID, $email);
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

function addSpecDay()
{
    $doctor = new doctor();
    $id = $_POST["docId"];
    $specDate = $_POST["specDate"];
    $stat = $_POST["stat"];
    if($stat=="Available")
    {
        $stat=1;
    }
    else
    {
        $stat=0;
    }
    $res = $doctor->addSpecDay($id,$specDate,$stat);
    echo $res;
}
function getSpecDays()
{
    $doctor = new doctor();
    $id = $_POST["docId"];
    $res = $doctor->getSpecDays($id);
    $output="";
    while($row=mysqli_fetch_array($res))
    {
        $stat="";
        if($row[2]==1)
        {
            $stat="Available";
        }
        else
        {
            $stat="Not Available";
        }
        $output.='
        <div class="row allergyRow docSpecDays"><div class="c-11 specialtyValue" style="padding-right:0px;">'.$row[1].' - '.$stat.'</div><div class="c-1" style="padding-left:2px;"><button type="button" specDate='.$row[1].' class="btn btnPatientView2 removeSpecDate" name="removeSpecialty"><i class="fas fa-times"></i></button></div></div>
        ';
    }
    echo $output;
}
function removeSpecDay()
{
    $doctor = new doctor();
    $id = $_POST["docId"];
    $specDate = $_POST["specDate"];
    $res = $doctor->removeSpecDay($id,$specDate);
    echo $res;
}

function docDataModal()
{
    $doctor=new doctor();
    $id=$_POST['id'];
    $normalDays=$doctor->getDoctorUsualDays($id);
    $specDays=$doctor->getSpecDays($id);
    $output1="";
    $output2="";
    if(mysqli_num_rows($normalDays)>0)
    {
        while($row=mysqli_fetch_assoc($normalDays))
        {
            $output1.='
            <p>'.$row["day"].'</p>
            ';
        }
    }
    if(mysqli_num_rows($specDays)>0)
    {
        while($row2=mysqli_fetch_assoc($specDays))
        {
            if($row2["status"]=="1")
            {
                $output2.='
                <p>'.$row2["date"].' <span class="success">Coming</span></p>
                ';
            }
            else
            {
                $output2.='
                <p>'.$row2["date"].' <span class="error">Not Coming</span></p>
                ';
            }
            
        }
    }
    echo json_encode(array($output1,$output2));
}
?>