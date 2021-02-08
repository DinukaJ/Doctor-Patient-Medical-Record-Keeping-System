<?php
include_once('users.php');
class doctor extends users
{
    private $type;
    
    public function setDocType($docType)
    {
        $this->type=$docType;
    }
    public function getDocType()
    {
        return $this->type;
    }

    public function __construct($data="")
    {
        if($data!="")
        {
            $row=mysqli_fetch_array($data);
            $this->setUserId($row[0]);
            $this->setFName($row[1]);
            $this->setLName($row[2]);
            $this->setDP($row[6]);
            $this->setDocType($row[7]);
        }
    }
    public function disname()
    {
        return $this->getFName();
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
    public function getDocCharge()
    {
        $db= new Database();
        $res=$db->getData("select amount from doccharge");
        return $res;
    }
}
?>