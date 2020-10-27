<?php
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');

if(isset($_POST["type"])){

    if($_POST["type"]=="getAllRep")
            getRepDatAll();
}

function getRepDatAll(){
    $output="";
    $lab = new lab();
    $data = $lab->getAllrep();
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){

            $output.="<div class='row patientDataRow'>
            <div class='c-3' class='patId'>$row[0]</div>
            <div class='c-4' class='repId'>$row[1]</div>
            <div class='c-4' class='reptype'>$row[3]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewRep' name='viewRep' id='viewRep-$row[1]'>View</button>
            </div>
      </div>";
        }
    }
    echo $output;
}


?>