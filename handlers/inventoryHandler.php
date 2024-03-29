<?php
include_once(dirname(dirname(__FILE__)).'/classes/inventory.php');

//function check to call
if(isset($_POST["type"])){

    if($_POST["type"]=="searchMed")
        searchMedic();
    if($_POST["type"]=="getMed")
        getMedic();
    if($_POST["type"]=="medData")
        getMedDat();
    if($_POST["type"]=="searchDocMed")
        searchDocMedic();
    if($_POST["type"]=="addMed")
        addMedData();
    if($_POST["type"]=="addMedTypes")
        addMedTypes();
    if($_POST["type"]=="upMedTypes")
        upMedTypes();
    if($_POST["type"]=="upMed")
        upMedData();
    if($_POST["type"]=="delMed")
        delMedData();
    if($_POST["type"]=="updateMed")
        updateMed();
}


function searchMedic()
{
    $output="";
    $inventory = new inventory();
    $medicSearch=$_POST["medSearch"];
    $searchResult=$inventory->getMedList($medicSearch);
    $count=0;
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output .="<div class='row patientDataRow'>
                            <div class='c-3' class='medicId'>$row[0]</div>
                            <div class='c-4' class='medicName'>$row[1]</div>
                            <div class='c-4' class='medicQty'>$row[2]</div>
                            <div class='c-1'>
                                <button type='button' class='btn btnPatientView viewMed' name='viewMed' id='viewMed-$row[0]'>View</button>
                            </div>
                      </div>";
            $count++;
        }
    }
    echo json_encode(array($output,$count));
}

function searchDocMedic()
{
    $output="<div class='row c-12 disable searchr'>ID - Name QTY</div>";
    $inventory = new inventory();
    $medicSearch=$_POST["medSearch"];
    $searchResult=$inventory->getMedList2($medicSearch);
    $count=1;
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="<div class='row c-12  searchr se$count'>$row[0] - $row[1] -$row[3]</div>";
            $count=$count+1;
        }
        $count=$count-1;
        $output.=" <input type='hidden' id='secount' value='$count'>";
    }
    echo $output;
}

function getMedic(){
    $output= "";
    $inventory = new inventory();
    $medData = $inventory->getMedAll();
    $count=0;
    if(mysqli_num_rows($medData))
    {
        while($row=mysqli_fetch_array($medData))
        {
            $output .="<div class='row patientDataRow'>
                            <div class='c-3' class='medicId'>$row[0]</div>
                            <div class='c-4' class='medicName'>$row[1]</div>
                            <div class='c-4' class='medicQty'>$row[2]</div>
                            <div class='c-1'>
                                <button type='button' class='btn btnPatientView viewMed' name='viewMed' id='viewMed-$row[0]'>View</button>
                            </div>
                      </div>";
            $count++;
        }
    }
    echo json_encode(array($output,$count));
}

//getting view clicked med full details
function getMedDat(){
    $inventory = new inventory();
    $medicID=$_POST["medId"];
    $medData=$inventory->getMed($medicID);
    $medid="";
    $medName="";
    $shortCode="";
    $output="";
    $upOutput="";
    while($row=mysqli_fetch_array($medData))
    {
        $medid=$row[0];
        $medName=$row[1];
        $shortCode=$row[2];
        $output.='
        <div class="row">
            <div class="c-12 c-m-6">
                '.$row[3].'
            </div>
            <div class="c-12 c-m-3">
                '.$row[5].'
            </div>
            <div class="c-12 c-m-3">
                '.$row[4].'
            </div>
        </div>
        ';
        $upOutput.="
        <div class='row typeUpRow'>
            <div class='c-12 c-m-4'>
                <input type='text' class='input-field medUpType disable' disabled style='width:100%;' name='medUpType' placeholder='' value='$row[3]'>
            </div>
            <div class='c-12 c-m-4'>
                <input type='number' class='input-field medUpQTY' style='width:100%;' name='medUpQTY' placeholder='' value='$row[5]'>
            </div>
            <div class='c-12 c-m-4'>
                <input type='number' class='input-field medUpPrice' style='width:100%;' name='medUpPrice' placeholder='' value='$row[4]'>
            </div>
        </div>
        ";
    }
    echo json_encode(array($medid,$medName,$shortCode,$output,$upOutput));
}

//Adding new med data 
function addMedData(){
    $inventory = new inventory();
    $name = $_POST["medName"];
    $shortCode = $_POST["medSc"];
    $stat = $inventory->addMed($name,$shortCode);
    echo $stat;
}
//Adding new med types data 
function addMedTypes(){
    $inventory = new inventory();
    $medId = $_POST["medId"];
    $type = $_POST["medType"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $stat = $inventory->addMedType($medId,$type,$qty,$price);
    echo $stat;
}

//Updating existing data
function upMedData(){
    $inventory = new inventory();
    $id = $_POST["medID"];
    $name = $_POST["medName"];
    $shortCode = $_POST["medSc"];
    $stat = $inventory->upMed($id,$name,$shortCode);
    echo $stat;
}

//Deleting Data
function delMedData(){
    $inventory = new inventory();
    $id = $_POST["id"];
    $stat = $inventory->delMed($id);
    echo $stat;
}

//Updating med types data 
function upMedTypes(){
    $inventory = new inventory();
    $medId = $_POST["medId"];
    $type = $_POST["medType"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $stat = $inventory->upMedTypes($medId,$type,$qty,$price);
    echo $stat;
}

function updateMed(){
    $inventory = new inventory();
    $medId = $_POST["medId"];
    $medType = $_POST["medType"];
    $medQty = $_POST["medQty"];
    // console.log(sizeof($medIds));
    $stat=$inventory->updateMed($medId,$medType,$medQty);
  
    echo $stat;
}


?>