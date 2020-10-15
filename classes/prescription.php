<?php
include_once("database.php");
include_once("users.php");
class prescription
{
    public function __construct($id="")
    {
        
    }
    public function getNextPID()
    {
        $db=new Database();
        $latestId=$db->getData("select id from prescriptions order by id desc limit 1");
        if(mysqli_num_rows($latestId)==0)
            return 1;
        else
            return mysqli_fetch_array($latestId)[0]+1;
    }
    public function addNewPrescription($docId,$patId,$id,$doi,$status)
    {   
        $db=new Database();
        $stat=$db->insert_update_delete("insert into prescriptions values('$docId','$patId','$id','$doi','','$status')");
        return $stat;
    }
    public function addMed($pid,$medID,$amountPerTime,$timesPerDay,$afterBefore,$duration)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("insert into prescription_medicine values('$pid','$medID','$amountPerTime','$timesPerDay','$afterBefore','$duration')");
        return $stat;
    }
    public function removeMed($id,$medID)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("delete from prescription_medicine where pres_ID='$id' and med_ID='$medID'");
    }
    public function addPrescriptionNote($id,$note)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("update prescriptions set note='$note' where id='$id'");
        return $stat;
    }
    public function getPatientPresNum($pid)
    {
        $db=new Database();
        return $db->getData("select count(id) from prescriptions where id='$pid'");
    }
    public function getPatientPres($pid)//getting a patient's prescriptions
    {
        $db = new Database();
        $data = $db->getData("select * from prescriptions where patientId='$pid'");
        return $data;
    }

}
?>