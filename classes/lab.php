<?php
include_once("database.php");

class lab{

    public function getAllRep(){
        $db = new Database();
        return $db->getData("select * from labreport");
    }

    public function repSearch($id){
        $db = new Database();
        $data = $db->getData("select r.* from labreport r join patient p on r.patientId = p.id where r.patientId like '%$id%' or p.fname like '%$id%' or p.lname like '%$id%' or r.id like '%$id%'");
        return $data;
    }

}

?>