<?php
include_once("database.php");
class inventory
{
    public function __construct($id="")
    {
        
    }

    //adding medicine to the inventory
    public function addMed($medName,$shortCode)
    {
        $db = new Database();
        $stat  = $db->insert_update_delete("insert into medicine values (NULL,'$medName','$shortCode')");
        $lastId=$db->getData("select id from medicine order by id desc limit 1");
        if($stat)
            return mysqli_fetch_array($lastId)[0];
        else
            $stat;
    }
    public function addMedType($id,$type,$qty,$price){
        $db = new Database();
        $stat  = $db->insert_update_delete("insert into medtypes values ('$id','$type','$price','$qty','1')");
        return $stat;
    }
 
    public function upMed($id,$medName,$shortCode){
        $db = new Database();
        $stat = $db->insert_update_delete("update medicine set name='$medName',shortCode='$shortCode' where id='$id'"); 
        return $stat;
    }
    
    public function upMedTypes($id,$type,$qty,$price){
        $db = new Database();
        $stat = $db->insert_update_delete("update medtypes set price='$price',qty='$qty' where id='$id' and type='$type'");
        return $stat;
    }

    public function delMed($id){
        $db = new Database();
        $stat = $db->insert_update_delete("update medtypes set status='0' where id='$id'");
        return $stat;
    }

    //retrieving all the information of the inventory
    public function getMedAll(){
        $db = new Database();
        $data = $db->getData("select m.* from medicine m join medtypes mt on m.id=mt.id and mt.status=1 group by m.id");
        return $data;
    }

    //searching for specific medicine using medicine name or shortCode of the medicine
    public function getMed($input){
        $db = new Database();
        $data = $db->getData("select m.*, mt.type, mt.price, mt.qty from medicine m join medtypes mt on m.id=mt.id where m.id='$input' and mt.status=1");
        return $data;
    }

    public function getMedList($input){
        $db = new Database();
        $data = $db->getData("select m.*, mt.type, mt.price, mt.qty from medicine m join medtypes mt on m.id=mt.id where (m.name like '%$input%' or m.shortCode like '%$input%') and mt.status=1 group by m.id");
        return $data;
    }
    public function getMedList2($input){
        $db = new Database();
        $data = $db->getData("select m.*, mt.type, mt.price, mt.qty from medicine m join medtypes mt on m.id=mt.id where (m.name like '%$input%' or m.shortCode like '%$input%') and mt.status=1");
        return $data;
    }

    //returning the prescriptions belong to today
    // public function getPresToday(){
    //     $db = new Database();
    //     $today=date("Y-m-d");
    //     $data = $db->getData("select * from prescriptions where doi='$today'");
    //     return $data;
    // }

    public function updateMed($medId,$medType,$medQty){
        $db = new Database();
        $data = $db->insert_update_delete("update medtypes set qty=qty-'$medQty' where id='$medId' and type='$medType'");
        return $data;
    }

    public function getMedCount($id,$type)
    {
        $db = new Database();
        $data = $db->getData("select qty from medtypes where id='$id' and type='$type'");
        return $data;
    }

}
?>