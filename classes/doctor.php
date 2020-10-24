<?php
include_once('users.php');
class doctor extends users
{
    public function __construct($data="")
    {
        
    }

    public function getDoc($docId){
        $db= new Database();
        $data = $db->getData("select * from doctor where id='$docId'");
        return $data;
    }
    public function getDoctorData($id)
    {
        $db=new Database();
        return $db->getData("select * from doctor where id='$id'");
    } 
    public function updateDoctorInfo($fname, $lname, $phone, $docID)
    {
        $db = new Database();
        return $db->insert_update_delete("update doctor set fname='$fname',lname='$lname',phone='$phone' where id='$docID'");
    }
    public function updateDoctorPass($docID,$newPass)
    {
        $db = new Database();
        return $db->insert_update_delete("update doctor set password='$newPass' where id='$docID'");
    }
}
?>