<?php
include_once("database.php");
class inventory
{
    public function __construct($id="")
    {
        
    }

    public function addMed($medName,$qty,$price,$shortCode){
        $db = new Database();
        $stat  = $db->insert_update_delete("insert into medicine values (NULL,'$medName','$price','$qty','$shortCode')");
        return $stat;
    }

    public function searchMed($input){
        $db = new Database();
        $data = $db->getData("select * from medicine where name='$input' or shortCode='$input");
        return $data;
    }
}
?>