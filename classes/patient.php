<?php
include_once('users.php');
class patient extends users
{
    public function __construct($data="")
    {
        if($data!="")
        {
            $row=mysqli_fetch_array($data);
            $this->setUserId($row[0]);
            $this->setFName($row[1]);
            $this->setLName($row[2]);
            $this->setDP($row[6]);
        }
    }
    public function getNewId()
    {
        $db=new Database();
        return $db->getData("select id from patient order by id desc limit 1");
    }
    public function addPatient($pid,$fname,$lname,$phone,$age,$email,$pass,$address,$status)
    {   
        $db=new Database();
        $passEncry=sha1($pass);
        return $db->insert_update_delete("insert into patient values('$pid','$fname','$lname','$phone','$email','$passEncry','$age','$address','',$status)");
    }
    public function getPatients()
    {
        $db=new Database();
        return $db->getData("select * from patient where status=1");
    }
    public function getTotalPatients()
    {
        $db=new Database();
        return $db->getData("select count(id) from patient where status=1");
    }
    public function getPatientData($id)
    {
        $db=new Database();
        return $db->getData("select * from patient where id='$id' and status=1");
    }
    public function getAllergy($id)
    {
        $db=new Database();
        return $db->getData("select * from patientallergy where id='$id'");
    }
    public function getImpNotes($id)
    {
        $db=new Database();
        return $db->getData("select * from patientimpnotes where id='$id'");
    }
    public function addAllergy($id,$allergy)
    {
        $db=new Database();
        $res=$db->getData("select * from patientallergy where id='$id' and allergy='$allergy'");
        if(mysqli_num_rows($res))
        {
            return -1; 
        }
        else
        {
            return $db->insert_update_delete("insert into patientallergy values('$id','$allergy')");
        }
        return $res;
    }
    public function delAllergy($id,$allergy)
    {
        $db=new Database();
        return $db->insert_update_delete("delete from patientallergy where id='$id' and allergy='$allergy'");
    }
    public function addImp($id,$imp)
    {
        $db=new Database();
        $res=$db->getData("select * from patientimpnotes where id='$id' and impNote='$imp'");
        if(mysqli_num_rows($res))
        {
            return -1; 
        }
        else
        {
            return $db->insert_update_delete("insert into patientimpnotes values('$id','$imp')");
        }
        return $res;
    }
    public function delImp($id,$imp)
    {
        $db=new Database();
        return $db->insert_update_delete("delete from patientimpnotes where id='$id' and impNote='$imp'");
    }
    public function delPat($id)
    {
        $db=new Database();
        return $db->insert_update_delete("update patient set status='0' where id='$id'");
    }
    public function getPatientsList($search)
    {
        $db=new Database();
        return $db->getData("select id,fname,lname,age from patient where status=1 and (id like '%$search%' or fname like '%$search%' or lname like '%$search%')");
    }   
    public function updatePatient_Allergy_IN($patID,$allergy,$IN)
    {
        $db=new Database();
        return $db->insert_update_delete("update patient set allergies='$allergy', impNotes='$IN' where id='$patID'");
    }
    public function updatePatientNonMedInfo($patID,$fname,$lname,$phone,$age,$address)
    {
        $db = new Database();
        return $db->insert_update_delete("update patient set fname='$fname',lname='$lname',phone='$phone',age='$age',address='$address' where id='$patID'");
    }
    public function updatePatientPass($patID,$newPass)
    {
        $db = new Database();
        return $db->insert_update_delete("update patient set password='$newPass' where id='$patID'");
    }
}
?>