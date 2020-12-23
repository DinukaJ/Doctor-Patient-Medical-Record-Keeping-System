<?php
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');

if(isset($_POST["type"])){

    if($_POST["type"]=="getAllRep")
            getRepDatAll();
    if($_POST["type"]=="searchRep")
            repSearch();
    if($_POST["type"]=="repData")
            getRep();
    if($_POST["type"]=="repDel")
            delRep();
    if($_POST["type"]=="repUp")
            upRep();
    if($_POST["type"]=="repAdd")
            addRep();    
    if($_POST["type"]=="repAddData")
            addRepData();
    if($_POST["type"]=="testGet")
            testData();    
}

function getRepDatAll(){
    $output="";
    $lab = new lab();
    $data = $lab->getAllRep();
    $numRows=mysqli_num_rows($data);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){

            $output.="<div class='row patientDataRow'>
            <div class='c-2' class='patId'>$row[0]</div>
            <div class='c-2' class='repId'>$row[1]</div>
            <div class='c-3' class='repType'>$row[3]</div>
            <div class='c-4' class='repType'>$row[2]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewRep' name='viewRep' id='viewRep-$row[1]'>View</button>
            </div>
      </div>";
        }
    }
    echo json_encode(array($output, $numRows));
}

function repSearch(){
    $output="";
    $lab = new lab();
    $data = $lab->repSearch($_POST["id"]);
    $numRows=mysqli_num_rows($data);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){
           
            $output.="<div class='row patientDataRow'>
            <div class='c-2' class='patId'>$row[0]</div>
            <div class='c-2' class='repId'>$row[1]</div>
            <div class='c-3' class='repType'>$row[3]</div>
            <div class='c-4' class='repType'>$row[2]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewRep' name='viewRep' id='viewRep-$row[1]'>View</button>
            </div>
      </div>";
        }
    }
    echo json_encode(array($output, $numRows));
}

//gets report data
function getRep(){
    $lab = new lab();
    $patId=""; $name=""; $repId=""; $type=""; $date="";
    $data = $lab->repSearch($_POST["repId"]);
    $output="";
    while($row = mysqli_fetch_array($data))
    {
        $patId=$row[0]; $name=$row[4]." ".$row[5]; $repId=$row[1]; $type=$row[3]; $date=$row[2];
        $output.='
        <div class="row">
        <div class="c-4 c-m-4">
            '.$row[7].'
        </div>
        <div class="c-4 c-m-4">
            '.$row[8].'
        </div>
        <div class="c-4 c-m-4">
            '.$row[9].'
        </div>
    </div>
        ';
    }
    echo json_encode(array($patId,$name,$repId,$type,$date,$output));
}

//delete report data
function delRep(){
    $lab = new lab();
    $stat = $lab->repDelete($_POST["repId"]);
    echo $stat;
}

//update report data
function upRep(){
    $lab = new lab();
    $rid = $_POST["repUpID"];
    $type = $_POST["repUpType"];
    $f1 = $_POST["repUpFi1"];
    $f2 = $_POST["repUpFi2"];
    $f3 = $_POST["repUpFi3"];
    $f4 = $_POST["repUpFi4"];
    $f5 = $_POST["repUpFi5"];
    $stat = $lab->repUpdate($rid,$type,$f1,$f2,$f3,$f4,$f5);
    echo $stat;
}

function addRep(){
    $lab = new lab();
    $pid = $_POST["patId"];
    $repType = $_POST["repType"];
    $today=date("Y-m-d");
    $stat = $lab->repAdd($pid,$repType,$today);
    echo $stat;
}
function addRepData()
{
    $lab = new lab();
    $pid = $_POST["patId"];
    $rid = $_POST["repId"];
    $repTest = $_POST["repTest"];
    $repRes = $_POST["repRes"];
    $today=date("Y-m-d");
    $stat = $lab->repAddData($pid,$rid,$today,$repTest,$repRes);
    echo $stat;
}

//getting tests for each report type
function testData()
{
    $output1="";
    $output2="";
    $lab = new lab();
    $rId = $_POST["rid"];
    $data = $lab->getRepInfo($rId);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){

            $output1.="<option value='$row[0]'>'$row[0]'</option>";
            $output2.="<option value='$row[1]'>'$row[1]'</option>"; 
        }
    }
    echo json_encode(array($output1,$output2));
}

?>