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
    public function getNewId()
    {
        $db=new Database();
        return $db->getData("select id from doctor order by id desc limit 1");
    }
    public function addDoctor($id,$fname,$lname,$phone,$email,$pass,$type)
    {   
        $db=new Database();
        $passEncry=sha1($pass);
        return $db->insert_update_delete("insert into doctor values('$id','$fname','$lname','$phone','$email','$passEncry','','$type')");
    }
    public function addDocUsualDays($id,$day)
    {
        $db=new Database();
        return $db->insert_update_delete("insert into docusualdays values('$id','$day')");
    }
    public function addDocSpecialty($id,$spec)
    {
        $db=new Database();
        return $db->insert_update_delete("insert into docspeciality values('$id','$spec')");
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
    public function updateDocCharge($charge)
    {
        $db= new Database();
        return $db->insert_update_delete("update doccharge set amount=$charge where id='1'");
    }
}
?>