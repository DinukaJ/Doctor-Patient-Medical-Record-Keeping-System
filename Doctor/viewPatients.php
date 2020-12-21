<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

$docid="";//"doc45";
$doctor="";
if(isset($_SESSION["user"]))
{
    $doctor=unserialize($_SESSION['user']);
    $docid=$doctor->getUserId();
}
else
{
    header("Location: ../login.php");
}
echo"<input type='hidden' value='$docid' id='docID'>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Doctor - View Patients</title>
</head>
<body>
    <input type="hidden" id="patientID">
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("patients")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                            <h1 style="margin-top:5px">Patients</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                            <input type="text" class="input-field fullWidth" name="searchPat" id="searchPat" placeholder="Enter Patient ID or Name">
                        </div>
                        <div class="c-l-8 totText">
                            Total Patients: <span id="totalCountPat"></span>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='patId'>Patient ID</div>
                    <div class='c-5' class='patFirstName'>Name</div>
                    <div class='c-3' class='patLastName'>Age</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="patientData"></div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <?php getEditProfile($doctor)?>
    <!-- End of Edit Profile View -->

    <!-- Patient Full Data Modal -->
    <?php getFullPatientData()?>
    <!-- Patient Full Data -->

    <!-- Patient Prescription Modal -->
    <?php getPatientPrescriptions()?>
    <!-- Patient Prescription Data -->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainDoc.js"></script>
    <script src="../js/mainPatient.js"></script>
    <script src="../js/search.js"></script>
    <script>
        var modalPatient=document.getElementById("patientFullData");
        var modalPatientUpdate=document.getElementById("modalUpdatePat");
        var patientPrescription=document.getElementById("patientPrescription");
        $(document).ready(function(){
            $('#viewPatientPrescription2').click(function(){
                open(patientPrescription);
                close(modalPatient);
            });
            $('.close').click(()=>{
                close(modalPatient);
                close(patientPrescription);
            })
            $('#patClose').click(()=>{
                close(modalPatient);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalPatient) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatient);
            }
            if (event.target == patientPrescription) {
                    // modalUpdateDet.style.display = "none";
                    close(patientPrescription);
            }
        }
    </script>
    <script>
        getpatients("");
        // $('#updateStatus').hide();
        // $("#updateMed").click(function(){
        //     close(modalPatient);
        //     open(modalPatientUpdate);
        // });

        //Function to open the patient data modal
        // function patientDataModal(pId)
        // {
        //     open(modalPatient);
        //     $.ajax({
        //         url:"../handlers/patientHandler.php",
        //         method:"POST",
        //         data:{patientID:pId,type:'patientData'},
        //         dataType:'json',
        //         success:function(data){
        //             $('#patUpID').val(data[0]);
        //             $('#firstNameData').html(data[1]);
        //             $('#patUpFname').val(data[1]);

        //             $('#lastNameData').html(data[2]);
        //             $('#patUpLname').val(data[2]);

        //             $('#phoneData').html(data[3]);
        //             $('#patUpPhone').val(data[3]);

        //             $('#ageData').html(data[6]);
        //             $('#patUpAge').val(data[6]);

        //             $('#emailData').html(data[4]);
        //             $('#patUpEmail').val(data[4]);

        //             $('#addressData').html(data[7]);
        //             $('#patUpAddress').val(data[7]);
        //         }
        //     });
        // }
        //Function to get the added patients
        function getpatients(serVal)
        {
            $.ajax({
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:{type:'searchPRecep', patientSearch:serVal},
                dataType:'json',
                success:function(data){
                    $("#patientData").html(data[0]);
                    $("#totalCountPat").html(data[1]);
                    //Open patient data modal when click on view
                    var patientFullData=document.getElementById("patientFullData");
                    $('.viewMed').click(function(){
                        var pId=$(this).attr('id');
                        $("#patientID").val(pId);
                        putPatientData2(pId);
                        open(modalPatient);
                    });
                }   
            });
        }
        var serPat=document.getElementById("searchPat");
        serPat.addEventListener("keydown", function(e){
            setTimeout(function(){
                a=serPat.value;
                getpatients(a);
            },100);
        });
    </script>
</body>
</html>