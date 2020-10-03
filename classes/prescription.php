<?php
class prescription extends users
{
    public function __construct($id="")
    {
        
    }

    public function getPatientPresNum($pid)
    {
        $db=new Database();
        return $db->getData("select count(id) from prescriptions where id=$pid");
    }

}
?>