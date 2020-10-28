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
        $db=new Database();
        $passEncry=sha1($password);
        $isDoc=$db->getData("select * from doctor where id='$username' and password='$passEncry'");
        $isPat=$db->getData("select * from patient where id='$username' and password='$passEncry'");
        if(mysqli_num_rows($isDoc))
        {
            $user=new doctor($isDoc);
            $_SESSION["user"]=serialize($user);
            return $user;
        }
        else if(mysqli_num_rows($isPat))
        {
            $user=new patient($isPat);
            $_SESSION["user"]=serialize($user);
            return $user;
        }
        else if($username=="Receptionist" && $password=="123123")
        {
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