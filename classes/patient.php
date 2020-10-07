<?php
class patient extends users
{
    public function __construct($data="")
    {
        
    }
    public function addPatient($fname,$lname,$phone,$age,$address)
    {   
        $db=new Database();
        return $db->insert_update_delete("insert into patient values(null,'$fname','$lname','$phone','$age','$address')");
    }
    public function getPatients()
    {
        $db=new Database();
        return $db->getData("select * from patient");
    }
    public function getTotalPatients()
    {
        $db=new Database();
        return $db->getData("select count(id) from patient");
    }
    public function getPatientData($id)
    {
        $db=new Database();
        return $db->getData("select * from patient where id='$id'");
    }   
    public function getPatientsList($search)
    {
        $db=new Database();
        return $db->getData("select id,fname,lname from patient where id='$search' or fname like '%$search%' or lname like '%$search%'");
    }   
    public function updatePatient_Allergy_IN($patID,$allergy,$IN)
    {
        $db=new Database();
        return $db->insert_update_delete("update patient set allergies='$allergy', impNotes='$IN' where id='$patID'");
    }
}
?>