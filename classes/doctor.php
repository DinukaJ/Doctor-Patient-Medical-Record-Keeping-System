<?php
include_once('users.php');
class doctor extends users
{
    private $type;
    
    public function setDocType($docType)
    {
        $this->type=$docType;
    }
    public function getDocType()
    {
        return $this->type;
    }

    public function __construct($data="")
    {
        if($data!="")
        {
            $row=mysqli_fetch_array($data);
            $this->setUserId($row[0]);
            $this->setFName($row[1]);
            $this->setLName($row[2]);
            $this->setDP($row[6]);
            $this->setDocType($row[7]);
            $this->setVS($row[9]);
        }
    }
    public function getNewId()
    {
        $db=new Database();
        return $db->getData("select id from doctor order by addedDate desc limit 1");
    }
    public function addDoctor($id,$fname,$lname,$phone,$email,$pass,$type)
    {   
        $db=new Database();
        $passEncry=sha1($pass);
        $verifyToken="";
        $verifyStatus=0; //1-> Verified; -1->Not Verified; -2->Reset Password; 0->No Email
        if($email!="")
        {
            $ifExist=$db->getData("select * from doctor where email='$email' and status=1");
            if(mysqli_num_rows($ifExist)>0)
            {
                return -1;
            }
            else
            {
                $verifyToken=getToken(30);
                $verifyStatus=-1;
                $link="http://localhost/GroupProjectUCSC/Doctor-Patient-Medical-Record-Keeping-System/emailConfirm.php?type=doc&tk=$verifyToken&email=$email";
                sendActiveReset($fname, $email, $link, 0);
            }
        }
        return $db->insert_update_delete("insert into doctor (id,fname,lname,phone,email,password,dp,type,token,verifyStatus,status,addedDate) values('$id','$fname','$lname','$phone','$email','$passEncry','','$type','$verifyToken','$verifyStatus','1')");
       
    }
    public function updateDoctor($id,$fname,$lname,$phone,$email,$pass)
    {   
        $db=new Database();
        $db->insert_update_delete("delete from docusualdays where docId='$id'");
        $docData=$this->getDoctorData($id);
        $docData=mysqli_fetch_assoc($docData);
        $docEmail=$docData["email"];
        $docVerifyStatus=$docData["verifyStatus"];
        $verifyToken="";
        if($email!="" && ($docEmail != $email))
        {
            $ifExist=$db->getData("select * from doctor where email='$email' and id <> '$id'");
            if(mysqli_num_rows($ifExist)>0)
            {
                return -1;//User exists with the same email and password
            }
            $verifyToken=getToken(30);
            $docVerifyStatus=-1;
            $link="http://localhost/GroupProjectUCSC/Doctor-Patient-Medical-Record-Keeping-System/emailConfirm.php?type=doc&tk=$verifyToken&email=$email";
            sendActiveReset($fname, $email, $link, 0);
        }
        else if($email=="")
        {
            $docVerifyStatus=0;
        }
        if($pass=="")
        {
            return $db->insert_update_delete("update doctor set fname='$fname', lname='$lname', phone='$phone', email='$email', token='$verifyToken', verifyStatus='$docVerifyStatus' where id='$id'");
        }
        else
        {
            $passEncry=sha1($pass);
            return $db->insert_update_delete("update doctor set fname='$fname', lname='$lname', phone='$phone', email='$email', password='$passEncry', token='$verifyToken', verifyStatus='$docVerifyStatus' where id='$id'");
        }
    }
    public function addDocUsualDays($id,$day)
    {
        $db=new Database();
        return $db->insert_update_delete("insert into docusualdays values('$id','$day')");
    }
    public function addDocSpecialty($id,$spec)
    {
        $db=new Database();
        return $db->insert_update_delete("insert into docspeciality values('$id','$spec')");
    }
    public function removeDocSpecialty($id,$spec)
    {
        $db=new Database();
        return $db->insert_update_delete("delete from docspeciality where docId='$id' and speciality='$spec'");
    }
    public function disname()
    {
        return $this->getFName();
    }
    // public function getDoc($docId){
    //     $db= new Database();
    //     $data = $db->getData("select * from doctor where id='$docId'");
    //     return $data;
    // }
    public function getDoctorData($id)
    {
        $db=new Database();
        return $db->getData("select * from doctor where id='$id'");
    } 
    public function getDoctorUsualDays($id)
    {
        $db=new Database();
        return $db->getData("select * from docusualdays where docId='$id' order by FIELD(day,
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
         'Sunday');");
    } 
    public function getDoctorSpecialty($id)
    {
        $db=new Database();
        return $db->getData("select * from docspeciality where docId='$id'");
    } 
    public function updateDoctorInfo($fname, $lname, $phone, $docID, $email)
    {
        $db = new Database();
        $ifExist=$db->getData("select * from doctor where email='$email' and id <> '$docID'");
        if($email!="")
        {
            if(mysqli_num_rows($ifExist)>0)
            {
                return -1;
            }
            $verifyToken=getToken(30);
            $docVerifyStatus=-1;
            $link="http://localhost/GroupProjectUCSC/Doctor-Patient-Medical-Record-Keeping-System/emailConfirm.php?type=doc&tk=$verifyToken&email=$email";
            sendActiveReset($fname, $email, $link, 0);
            return $db->insert_update_delete("update doctor set fname='$fname',lname='$lname',phone='$phone',email='$email',token='$verifyToken',verifyStatus='$docVerifyStatus' where id='$docID'");
        }
        else
        {
            $docVerifyStatus=0;
            return $db->insert_update_delete("update doctor set fname='$fname',lname='$lname',phone='$phone',email='$email',verifyStatus='$docVerifyStatus' where id='$docID'");
        }
    }
    public function updateDoctorPass($docID,$newPass)
    {
        $db = new Database();
        return $db->insert_update_delete("update doctor set password='$newPass' where id='$docID'");
    }
    public function getDocCharge()
    {
        $db= new Database();
        $res=$db->getData("select amount from doccharge");
        return $res;
    }
    public function updateDocCharge($charge)
    {
        $db= new Database();
        return $db->insert_update_delete("update doccharge set amount=$charge where id='1'");
    }
    public function getDoctorList($search)
    {
        $db=new Database();
        return $db->getData("select id,fname,lname from doctor where (id like '%$search%' or fname like '%$search%' or lname like '%$search%') and status=1 order by addedDate");
    } 
    public function getDoctorListPatient($name,$spec)
    {
        $db=new Database();
        return $db->getData("select DISTINCT d.* from doctor d join docspeciality ds on d.id=ds.docId where (d.fname like '$name%' or d.lname like '$name%') and ds.speciality like '%$spec%' and status=1");
    }
    public function addSpecDay($id,$specDate,$stat)
    {
        $db=new Database();
        $res=$db->getData("select * from docspecialdays where docId='$id' and date='$specDate'");
        if(mysqli_num_rows($res)>0)
        {
            return -1;
        }
        else
        {
            return $db->insert_update_delete("insert into docspecialdays values('$id','$specDate','$stat')");
        }
    }
    public function getSpecDays($id)
    {
        $db=new Database();
        return $db->getData("select * from docspecialdays where docId='$id' and date>=CURDATE()");
    }
    public function removeSpecDay($id,$specDate)
    {
        $db=new Database();
        return $db->insert_update_delete("delete from docspecialdays where docId='$id' and date='$specDate'");
    }
    public function delDoc($id)
    {
        $db=new Database();
        return $db->insert_update_delete("update doctor set status=0 where id='$id'");
    }
}
?>