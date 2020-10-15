<?php
include_once('users.php');
class doctor extends users
{
    public function __construct($data)
    {
        
    }

    public function getDoc(){
        $db= new Database();
        $data = $db->getData("select * from doctor");
        return $data;
    }
}
?>