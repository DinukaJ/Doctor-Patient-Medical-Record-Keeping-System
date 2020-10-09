<?php
include_once("database.php");

class bill
{

    public function __construct()
    {
        
    }

    //adding bill details
    public function addBill($presId,$amt){
        $db = new Database();
        $stat = $db->insert_update_delete("insert into bill values ('$presId',NULL,'CURDATE()',$amt)");
        return $stat;
    }

}
?>