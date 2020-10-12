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

    //updating existing data
    public function upMed($id,$medName,$qty,$price,$shortCode){
        $db = new Database();
        $stat = $db->insert_update_delete("update medicine set name='$medName',price='$price',qty='$qty',shortCode='$shortCode' where id='$id'"); 
        return $stat;
    }

    public function delMed($id){
        $db = new Database();
        $stat = $db->insert_update_delete("delete from medicine where id='$id'");
        return $stat;
    }

    //retrieving all the information of the inventory
    public function getMedAll(){
        $db = new Database();
        $data = $db->getData("select * from medicine");
        return $data;
    }

    //searching for specific medicine using medicine name or shortCode of the medicine
    public function getMed($input){
        $db = new Database();
        $data = $db->getData("select * from medicine where id='$input'");
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