<?php
include_once("database.php");
class prescription
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
    public function searchMed($input){
        $db = new Database();
        $data = $db->getData("select * from medicine where name='$input' or shortCode='$input");
        return $data;
    }

    //returning the prescriptions belong to today
    public function getPresToday(){
        $db = new Database();
        $data = $db->getData("select * from prescriptions where doi= CURDATE()");
        return $data;
    }
}
?>