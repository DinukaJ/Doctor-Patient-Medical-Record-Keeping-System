<?php
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');

function addPatient()
{

}
function searchPatient()
{
    $output="";
    $patient =new patient();
    $patientSearch=$_POST["patientSearch"];
    $searchResult=$patient->getPatientsList($patientSearch);
    if(mysqli_num_rows($searchResult))
    {
        while($row=mysqli_fetch_array($searchResult))
        {
            $output.="<li>$row[0] - $row[1] $row[2]</li>";
        }
    }
    echo $output;
}
function updatePatient_Allergy_IN()
{
    $patient = new patient();
    $patID=$_POST["patID"];
    $allergy=$_POST["allergy"];
    $importantNotes=$_POST["importatNotes"];
    $stat=$patient->updatePatient_Allergy_IN($patID,$allergy,$importantNotes);

    echo json_encode(array($stat));
}
?>