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
        if($stat)
        {
            $res=$db->getData("select id from bill order by id desc limit 1");
            $id=mysqli_fetch_array($res)[0];
            return $id;
        }
        return $stat;
    }
    public function addBillItems($billId,$medId,$medType,$medQty,$medTot){
        $db = new Database();
        $stat = $db->insert_update_delete("insert into billitems values ('$billId','$medId','$medType','$medQty','$medTot')");

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