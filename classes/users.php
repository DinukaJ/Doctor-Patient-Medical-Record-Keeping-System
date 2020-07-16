<?php

class users{

    private $userId;
    private $fName;
    private $lName;
    
    public function setUserId($id)
    {
        $this->userId=$id;
    }
    public function getUserId()
    {
        return $this->userId;
    }

    public function login($username, $password)
    {

    }
}

?>