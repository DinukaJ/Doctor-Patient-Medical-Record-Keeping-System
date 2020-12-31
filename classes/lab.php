<?php
include_once("database.php");

class lab{

    public function getAllRep(){
        $db = new Database();
        return $db->getData("select * from labreport");
    }

    public function repSearch($id){
        $db = new Database();
        $data = $db->getData("select r.*, p.fname, p.lname from labpatientrepdata r join patient p on p.id like '%$id%' or p.fname like '%$id%' or p.lname like '%$id%' or r.id like '%$id%'");
        return $data;
    }

    public function repDelete($id){
        $db = new Database();
        $stat = $db->insert_update_delete("delete from labreport where id='$id'");
        return $stat;
    }

    public function repUpdate($id,$type,$f1,$f2,$f3,$f4,$f5){
        $db = new Database();
        $stat = $db->insert_update_delete("update labreport set type='$type',field1='$f1',field2='$f2',field3='$f3',field4='$f4',field5='$f5' where id='$id'");
        return $stat;
    }

    public function repAdd($pid,$cmt,$today)
    {
        $db=new Database();
        $data=$db->getData("select id from labpatientrep order by id desc limit 1");
        $repId="";
        if(mysqli_num_rows($data))
        {
            $repId=mysqli_fetch_array($data)[0]+1;
        }
        else
        {
            $repId=1;
        }
        $stat=$db->insert_update_delete("insert into labpatientrep values('$repId','$pid','$today','$cmt')");
        if($stat)
            return $repId;
        else
            return -1;
    }

    public function repAddData($reportId,$rId,$tName,$result)
    {
        $db = new Database();
        $stat = $db->insert_update_delete("insert into labpatientrepdata values ('$reportId','$rId','$tName','$result')");
        return $stat;
    }

    public function getRepInfo($rid)
    {
        $db = new Database();
        $data = $db->getData("select testName,normalRange from labreportdata where repId='$rid'");
        return $data;
    }

    public function getReportTypes()
    {
        $db = new Database();
        $data = $db->getData("select * from labreport");
        return $data;
    }
    public function addReportType($repType)
    {
        $db=new Database();
        $data=$db->getData("select * from labreport where type='$repType'");
        if(mysqli_num_rows($data))
            return -1;
        else
        {
            $stat=$db->insert_update_delete("insert into labreport values(null,'$repType')");
            return $stat;
        }
    }
    public function addReportFields($rId,$tName,$rangeValue)
    {
        $db=new Database();
        $stat=$db->insert_update_delete("insert into labreportdata values('$rId','$tName','$rangeValue')");
        return $stat;
    }
    public function getReportFields($rId)
    {
        $db=new Database();
        $data=$db->getData("select * from labreportdata where repId='$rId' order by testName");
        return $data;
    }

    public function deleteReportFields($rId, $testName, $range)
    {
        $db = new Database();
        $stat=$db->insert_update_delete("delete from labreportdata where repId='$rId' and testName='$testName' and normalRange='$range'");
        return $stat;
    }

    public function getPatientRep($pid)//getting a patient's prescriptions
    {  
        $db = new Database();
        $data = $db->getData("select * from labpatientrep where pid='$pid' order by doi desc");
        return $data;
    }
}

?>