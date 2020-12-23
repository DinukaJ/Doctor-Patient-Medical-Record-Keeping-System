<?php
include_once("database.php");

class lab{

    public function getAllRep(){
        $db = new Database();
        return $db->getData("select * from labreport");
    }

    public function repSearch($id){
        $db = new Database();
        $data = $db->getData("select r.*, p.fname, p.lname, rd.* from labreport r join labreportdetails rd on r.id=rd.id join patient p on r.patientId = p.id where r.patientId like '%$id%' or p.fname like '%$id%' or p.lname like '%$id%' or r.id like '%$id%'");
        return $data;
    }

    public function repDelete($id){
        $db = new Database();
        $stat = $db->insert_update_delete("delete from labreport where id='$id'");
        return $stat;
    }

    public function repUpdate($id,$type,$f1,$f2,$f3,$f4,$f5){
        $db = new Database();
        $stat = $db->insert_update_delete("update labreport set type='$type',field1='$f1',field2='$f2',field3='$f3',field4='$f4',field5='$f5' where id='$id'");
        return $stat;
    }

    public function repAddData($pid,$rid,$today,$repTest,$repRes)
    {
        $db = new Database();
        $stat = $db->insert_update_delete("insert into labpatientrepdata values ('$pid','$rid','$today','$repTest','$repRes')");
        return $stat;
    }


}

?>