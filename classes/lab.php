<?php
include_once("database.php");

class lab{

    public function getAllrep(){
        $db = new Database();
        return $db->getData("select * from labreport");
    }

}

?>