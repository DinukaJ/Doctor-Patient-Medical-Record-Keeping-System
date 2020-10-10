<?php
include_once("database.php");
class inventory
{
    public function __construct($id="")
    {
        
    }

    //adding medicine to the inventory
    public function addMed($medName,$qty,$price,$shortCode){
        $db = new Database();
        $stat  = $db->insert_update_delete("insert into medicine values (NULL,'$medName','$price','$qty','$shortCode')");
        return $stat;
    }

    //searching for specific medicine using medicine name or shortCode of the medicine
    public function getMed($input){
        $db = new Database();
        $data = $db->getData("select * from medicine where name='$input' or shortCode='$input");
        return $data;
    }

    public function getMedList($input){
        $db = new Database();
        $data = $db->getData("select * from medicine where name like '%$input%' or shortCode like '%$input%'");
        return $data;
    }

    //returning the prescriptions belong to today
    public function getPresToday(){
        $db = new Database();
        $today=date("Y-m-d");
        $data = $db->getData("select * from prescriptions where doi='$today'");
        return $data;
    }
}
?>