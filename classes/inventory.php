<?php
include_once("database.php");
class prescription
{
    public function __construct($id="")
    {
        
    }

    public function addMed($medName,$qty,$price,$shortCode){
        $db = new Database();
        $stat  = $db->insert_update_delete("insert into medicine values (NULL,'$medName','$price','$qty','$shortCode')");
        return $stat;
    }
}
?>