<?php
include_once("doctor.php");
class users{

    private $userId;
    private $name;
    
    public function setUserId($id)
    {
        $this->userId=$id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function setName($name)
    {
        $this->name=$name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function login($username, $password)
    {
        if($username=="Doctor" && $password=="123")
        {
            $user=new doctor($this->getUserId());
            $_SESSION["user"]=$user;
            return $user;
        }
        else
        {
            return false;
        }
    }
}

?>