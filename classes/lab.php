<?php
include_once("database.php");

class lab{

    public function getAllRep(){
        $db = new Database();
        return $db->getData("select * from labreport");
    }

    public function repSearch($id){
        $db = new Database();
        $data = $db->getData("select r.* from labreport r
                                        join patient p on r.patientId = p.id
                                        where r.patientId='$id' or p.fname='$id' or p.lname='$id' or r.id='$id'");
        return $data;
    }

}

?>