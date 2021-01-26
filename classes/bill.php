<?php
include_once("database.php");

class bill
{

    public function __construct()
    {
        
    }

    //adding bill details
    public function addBill($presId,$amt,$doi){
        $db = new Database();
        $stat = $db->insert_update_delete("insert into bill values ('$presId',null,'$doi','$amt')");
        return $stat;
    }

    //viewing bill details
    public function viewBill($billId){
        $db = new Database();
        $data = $db->getData("select * from bill where id = '$billId'");
        return $data;
    }

}
?>