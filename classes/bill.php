<?php
include_once("database.php");

class bill
{

    public function __construct()
    {
        
    }

    //adding bill details
    public function addBill($presId,$amt,$doi,$docCharge,$billType){
        $db = new Database();
        $stat = $db->insert_update_delete("insert into bill values ('$presId',null,'$doi','$amt','$docCharge','$billType')");
        if($stat)
        {
            $res=$db->getData("select id from bill order by id desc limit 1");
            $id=mysqli_fetch_array($res)[0];
            return $id;
        }
        return $stat;
    }
    public function addBillItems($billId,$medId,$medType,$medQty,$medTot){
        $db = new Database();
        $stat = $db->insert_update_delete("insert into billitems values ('$billId','$medId','$medType','$medQty','$medTot')");

        return $stat;
    }

    //viewing bill details
    public function viewBill($billId){
        $db = new Database();
        $data = $db->getData("select * from bill where id = '$billId'");
        return $data;
    }

    public function viewBillAllData($billId)
    {
        $db=new Database();
        $data=$db->getData("select m.name,bi.type,bi.qty,bi.totPrice from bill b join billitems bi on b.id=bi.billId JOIN medicine m on bi.medId=m.id where b.id=$billId");
        return $data;
    }

    public function getBillData($docType,$docID,$month)
    {
        $db=new Database();
        // if($docType=="1")
        // {
        //     $stat=$db->getData("select b.*, count(pr.med_ID) as noMed from bill b join prescriptions p on b.presId = p.id join prescription_medicine pr on p.id=pr.pres_ID where b.doi like '$month%'");
        // }
        // else
        // {
            $data=$db->getData("select b.*, count(pr.med_ID) as noMed from bill b join prescriptions p on b.presId = p.id join prescription_medicine pr on p.id=pr.pres_ID where p.docId='$docID' and b.doi like '$month%'");
        // }
        $docCharge=$db->getData("select SUM(docCharge), COUNT(id)  from(select b.* from bill b join prescriptions p on b.presId = p.id join prescription_medicine pr on p.id=pr.pres_ID where p.docId='$docID' and b.doi like '$month%' group by b.id) as totalTable");
        return array($data,$docCharge);
    }
    public function getBillPatient($billId)
    {
        $db=new Database();
        $data=$db->getData("select pa.id, CONCAT(pa.fname,' ',pa.lname) as Name from bill b join prescriptions p on b.presId=p.id join patient pa on p.patientId=pa.id where b.id=$billId");
        return $data;
    }

    public function getChart($year)
    {
        $db=new Database();
        $data=$db->getData("select sum(amount), MONTH(doi) from bill where YEAR(doi)='$year' group by MONTH(doi)");
        return $data;
    }
}
?>