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
}

function getRepDatAll(){
    $output="";
    $lab = new lab();
    $data = $lab->getAllRep();
    $numRows=mysqli_num_rows($data);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){

            $output.="<div class='row patientDataRow'>
            <div class='c-3' class='patId'>$row[0]</div>
            <div class='c-4' class='repId'>$row[1]</div>
            <div class='c-4' class='repType'>$row[3]</div>
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
            <div class='c-3' class='patId'>$row[0]</div>
            <div class='c-4' class='repId'>$row[1]</div>
            <div class='c-4' class='repType'>$row[3]</div>
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
    $data = $lab->repSearch($_POST["repId"]);
    $row = mysqli_fetch_array($data);
    echo json_encode($row);
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

?>