<?php
include_once("doctor.php");
include_once("patient.php");
include_once("database.php");
include_once(dirname( dirname(__FILE__) ).'/handlers/token.php');
include_once(dirname( dirname(__FILE__) ).'/emails/email.php');
class users{

    private $userId;
    private $fName;
    private $lName;
    private $dp;
    private $verifyStatus;
    
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
    public function setVS($vs)
    {
        $this->verifyStatus=$vs;
    }
    public function getVS()
    {
        return $this->verifyStatus;
    }

    public function login($username, $password)
    {
        $db=new Database();
        $passEncry=sha1($password);
        $isDoc=$db->getData("select * from doctor where (id='$username' OR email='$username') and password='$passEncry'"); //Doc#123
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
    public function verifyUser($type,$token,$email)
    {
        $db=new Database();
        if($type=="pat")
        {
            $stat=$db->getData("select verifyStatus from patient where email='$email' and token='$token'");
            if(mysqli_num_rows($stat)>0)
            {
                $stat=mysqli_fetch_array($stat);
                if($stat[0]==1)
                {
                    return 2; //Already Verified
                }
                else if($stat[0]==-1)
                {
                    $res=$db->insert_update_delete("update patient set verifyStatus=1 where email='$email' and token='$token'");
                    return $res; //1 -> Successfully Verified; 0-> Failed
                }
            }
            else
            {
                return -1; //Not Found
            }
        }
        else if($type=="doc")
        {
            $stat=$db->getData("select verifyStatus from doctor where email='$email' and token='$token'");
            if(mysqli_num_rows($stat)>0)
            {
                $stat=mysqli_fetch_array($stat);
                if($stat[0]==1)
                {
                    return 2; //Already Verified
                }
                else if($stat[0]==-1)
                {
                    $res=$db->insert_update_delete("update doctor set verifyStatus=1 where email='$email' and token='$token'");
                    return $res; //1 -> Successfully Verified; 0-> Failed
                }
            }
            else
            {
                return -1; //Not Found
            }
        }
    }

    public function passwordReset($email,$pID, $type)
    {
        $db=new Database();
        if($type=="patient")
        {
            $stat=$db->getData("select * from patient where email = '$email' and id='$pID' and status='1'");
            if(mysqli_num_rows($stat)>0)
            {
                $newPassword=getToken(6);
                $passEncry=sha1($newPassword);
                $st=$db->insert_update_delete("update patient set password='$passEncry' where email='$email' and id='$pID'");
                
                sendActiveReset("", $email, $newPassword, 1);
                return $st;
            }
            else
            {
                return -1;
            }
        }
        else if($type=="doctor")
        {
            $stat=$db->getData("select * from doctor where email = '$email'");
            if(mysqli_num_rows($stat)>0)
            {
                $newPassword=getToken(6);
                $passEncry=sha1($newPassword);
                $st=$db->insert_update_delete("update doctor set password='$passEncry' where email='$email'");
                
                sendActiveReset("", $email, $newPassword, 1);
                return $st;
            }
            else
            {
                return -1;
            }
        }
    }
}
?>