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
    public function addMed($pid,$medID,$medType,$amountPerTime,$timesPerDay,$afterBefore,$duration)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("insert into prescription_medicine values('$pid','$medID','$medType','$amountPerTime','$timesPerDay','$afterBefore','$duration')");
        return $stat;
    }
    public function removeMed($id,$medID,$medType)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("delete from prescription_medicine where pres_ID='$id' and med_ID='$medID' and medType_ID='$medType'");
        return $stat;
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
        $result=$db->getData("select count(id) from prescriptions where patientId='$pid'");
        $row=mysqli_fetch_array($result)[0];
        return $row;
    }
    public function getPatientPres($pid)//getting a patient's prescriptions
    {  
        $db = new Database();
        // $data = $db->getData("select * from prescriptions where patientId='$pid' and (status='0' or status='1') order by id desc");
        $data = $db->getData("select p.fname,p.lname,pres.*,COUNT(presM.pres_ID), d.fname,d.lname, pres.note from patient p join prescriptions pres on p.id=pres.patientId join prescription_medicine presM on pres.id = presM.pres_ID join doctor d on d.id=pres.docId where (pres.status=0 or pres.status=1) and p.id='$pid' group by presM.pres_ID");
        return $data;
    }
    public function getPresMedCount($pid)
    {
        $db=new Database();
        $data=$db->getData("select count(med_ID) from prescription_medicine where pres_ID='$pid'");
        $row=mysqli_fetch_array($data)[0];
        return $row;
    }
    public function getPresMeds($id)//getting medicine of a prescription
    {  
        $db = new Database();
        $data = $db->getData("select pm.*, m.name from prescription_medicine pm join medtypes mt on pm.med_ID=mt.id and pm.medType_ID=mt.type join medicine m on mt.id=m.id where pm.pres_ID='$id'");
        return $data;
    }
    public function  getPresMedAll($id)//getting all medicine of a prescription
    {
        $db = new Database();
        $data = $db->getData("select * from prescription_medicine where pres_ID='$id'");
        return $data;
    }
    public function getMedViewData($id)//getting medicine data for view using pres_ID
    {
        $db = new Database();
        $data = $db->getData("select d.fname,d.lname,m.name,p.id,p.doi,pm.amtPerTime,pm.timesPerDay,pm.beforeAfter,pm.duration,mt.type
                              from doctor d
                              join prescriptions p on d.id=p.docId 
                              join prescription_medicine pm on pm.pres_ID=p.id
                              join medicine m on m.id=pm.med_ID
                              join medtypes mt on m.id=mt.id
                              where p.id='$id' and (p.status='0' or p.status='1')");
        return $data;
    }
    public function deletePresAndMeds($id)
    {
        $db = new Database();
        $stat[0] = $db->insert_update_delete("delete from prescription_medicine where pres_ID='$id'");
        $stat[1] = $db->insert_update_delete("delete from prescriptions where id='$id'");
        return $stat;
    }
    public function finishPres($id)
    {
        $db = new Database();
        $stat=$db->insert_update_delete("update prescriptions set status='0' where id='$id'");
        return $stat;
    }
    public function getTodayPres()
    {
        $db = new Database();
        $data = $db->getData("select p.fname,p.lname,pres.*,COUNT(presM.pres_ID), d.fname,d.lname, pres.note from patient p join prescriptions pres on p.id=pres.patientId join prescription_medicine presM on pres.id = presM.pres_ID join doctor d on d.id=pres.docId where pres.doi=CURDATE() AND pres.status=0 group by presM.pres_ID");
        return $data;
    }

    public function getMedFin($id){
        $db = new Database();
        $data = $db->getData("select m.name,pm.medType_ID,mt.price,pm.amtPerTime,pm.timesPerDay,pm.duration, pm.med_ID from medicine m join medtypes mt on m.id=mt.id join prescription_medicine pm on m.id=pm.med_ID where pm.pres_ID='$id'");
        return $data;
    }

    public function getAllPres(){
        $db = new Database();
        $data = $db->getData("select p.fname,p.lname,pres.*,COUNT(presM.pres_ID), d.fname,d.lname, pres.note from patient p join prescriptions pres on p.id=pres.patientId join prescription_medicine presM on pres.id = presM.pres_ID join doctor d on d.id=pres.docId group by presM.pres_ID order by pres.id DESC");
        return $data;
    }

    public function changeStatus($pid){
        $db = new Database();
        $stat = $db->insert_update_delete("update prescriptions set status='1' where id='$pid'");
        return $stat;
    }

}
?>