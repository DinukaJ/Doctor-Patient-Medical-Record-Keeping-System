<?php
include_once("doctor.php");
include_once("patient.php");
include_once("database.php");
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
        // if($username=="Doctor" && $password=="123")
        // {
        //     $user=new doctor($this->getUserId());
        //     $_SESSION["user"]=serialize($user);
        //     return $user;
        // }
        // else if($username=="Patient" && $password=="123")
        // {
        //     $user=new patient($this->getUserId());
        //     $_SESSION["user"]=serialize($user);
        //     return $user;
        // }
        // else 
        if($username=="Receptionist" && $password=="123123")
        {
            //$user=new patient($this->getUserId());
            $_SESSION["user"]="Receptionist";
            return "Receptionist";
        }
        else
        {
            return false;
        }
    }
}

?>