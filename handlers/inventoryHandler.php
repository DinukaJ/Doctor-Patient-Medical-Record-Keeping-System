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
}


function searchMedic()
{
    $output="";
    $inventory = new inventory();
    $medicSearch=$_POST["medSearch"];
    $searchResult=$inventory->getMedList($medicSearch);
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
        }
    }
    echo $output;
}
function searchDocMedic()
{
    $output="<div class='row c-12 disable searchr'>ID - Name QTY</div>";
    $inventory = new inventory();
    $medicSearch=$_POST["medSearch"];
    $searchResult=$inventory->getMedList($medicSearch);
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

function getMedic(){
    $output= "";
    $inventory = new inventory();
    $medData = $inventory->getMedAll();
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
        }
    }
    echo $output;
}

//getting view clicked med full details
function getMedDat(){
    $inventory = new inventory();
    $medicID=$_POST["medId"];
    $medData=$inventory->getMed($medicID);
    $row=mysqli_fetch_array($medData);
    echo json_encode($row);
}

function addMedData(){
    $inventory = new inventory();
    echo "check";
    $name = $_POST["medName"];
    $price = $_POST["medPrice"];
    $qty = $_POST["medQTY"];
    $shortCode = $_POST["medSc"];
    $stat = $inventory->addMed(NULL,$name,$price,$qty,$shortCode);
    return $stat;
}


?>