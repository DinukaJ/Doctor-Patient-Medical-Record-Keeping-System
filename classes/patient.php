<?php
class patient extends users
{
    public function __construct($id="")
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
    public function getPatientPresNum($pid)
    {
        $db=new Database();
        return $db->getData("select count(id) from prescriptions where id=$pid");
    }
    public function getTotalPatients()
    {
        $db=new Database();
        return $db->getData("select count(id) from patient");
    }
}
?>