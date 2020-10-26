<?php
include_once("database.php");

class lab{

    public function getAllrep($rid){
        $db = new Database();
        return $db->getData("select * from labreport where id='$rid'");
    }

}

?>