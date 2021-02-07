<?php
include_once("doctor.php");
include_once("patient.php");
include_once("database.php");
class users{

    private $userId;
    private $fName;
    private $lName;
    private $dp;
    
    public function setUserId($id)
    {
        $this->userId=$id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function setFName($fName)
    {
        $this->fName=$fName;
    }
    public function getFName()
    {
        return $this->fName;
    }
    public function setLName($lName)
    {
        $this->lName=$lName;
    }
    public function getLName()
    {
        return $this->lName;
    }
    public function setDP($dp)
    {
        $this->dp=$dp;
    }
    public function getDP()
    {
        return $this->dp;
    }

    public function login($username, $password)
    {
        $db=new Database();
        $passEncry=sha1($password);
        $isDoc=$db->getData("select * from doctor where id='$username' and password='$passEncry'"); //Doc#123
        $isPat=$db->getData("select * from patient where (id='$username' OR email='$username') and password='$passEncry'");//Pat#123
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
        else if($username=="Receptionist" && $passEncry=="d75387b1d124f110e9ceaf1ab614e7cf4174b2a4")//Recep#123
        {
            $_SESSION["user"]="Receptionist";
            return "Receptionist";
        }
        else if($username=="Pharmacist" && $passEncry=="5b67e38292e588e4343ee1c6dfcba5d93a8547b2")//Pharm#123
        {
            $_SESSION["user"]="Pharmacist";
            return "Pharmacist";
        }
        else if($username=="Lab" && $passEncry=="e870f68ce0c4a1644baa2ad87ff7d0d7cf070332")//Lab#123
        {
            $_SESSION["user"]="Lab";
            return "Lab";
        }
        else
        {
            return false;
        }        
    }
}
?>