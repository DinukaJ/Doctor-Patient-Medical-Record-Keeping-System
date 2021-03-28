<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId ="";// "pat45";
$patient="";
if(isset($_SESSION["user"]))
{
    $patient=unserialize($_SESSION['user']);
    $patId=$patient->getUserId();
}
else
{
    header("Location: ../login.php");
}
echo"<input type='hidden' value='$patId' id='patientID'>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Doctor Status</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("docStatus")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart docStatus">
                <div class="upperFirst row">
                    <div class="c-l-12">
                    <button class="menuBtn" id="menuBtn"><i class="fas fa-bars"></i></button><h1 style="margin-top:5px;display:inline;">Doctor Status</h1>
                    </div>
                </div>
                  <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                             <div class="boxSmall wrapper">
                                 <input class="input-field " id="docNameSearch" style="width:100%;" placeholder="Enter Doctor Name">
                             </div>
                        </div>
                        <div class="c-12 c-l-4">
                            <div class="boxSmall">
                            <input class="input-field" id="docSpecSearch" style="width:100%;" placeholder="Enter Speciality">
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row" id="docData" style="width:100%">
                    <!-- <div class="c-6 c-m-3">
                        <div class="docBox">
                            <div class="imgSection">
                                <img src="../images/acc.png">
                            </div>
                            <div class="textSection">
                                <p>Doctor Name</p>
                                <p class="docSpec">Specialty Specialty  Specialty  Specialty  Specialty </p>
                                <a>View Dates</a>
                            </div>
                        </div>
                    </div> -->
                </div>        
            </div>
        </div>
    </div>
   <!-- Edit Profile Modal -->
   <?php getEditProfile($patient)?>
    <!-- End of Edit Profile View -->


<!-- The Modal for View Doctor Data-->
<div id="modalViewDocData" class="modal modal2">

<!-- Modal content -->
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
            <div class="c-12">
                <h2>Doctor Data</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-4 docData">
                <img id="docDpModal" src="../images/acc.png">
                <p><b><span id="docNameModal"></span></b></p>
                <p id="docSpecModal"></p>
            </div>
            <div class="c-12 c-m-4 docData">
                <p><b>Usual Days</b></p>
                <span id="docNormalDaysModal">
                
                </span>
            </div>
            <div class="c-12 c-m-4 docData">
                <p><b>Special Days</b></p>
                <span id="docSpecDaysModal">
                </span>
            </div>
        </div>     
    </div>
    <div class ="bottomModel row">
        <div class="c-12">
            <button type="button" class="btn btnNormal btnCancel" id="closeDocData">Close</button> 
        </div>
    </div>
</div> 
 </div>
<!-- End of the Modal for View Doctor Data-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
        var modalViewDocData=document.getElementById("modalViewDocData");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalUpdateDet);
            })
            $('.close').click(()=>{
                close(modalViewDocData);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
            $('#closeDocData').click(()=>{
                close(modalViewDocData);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalViewDocData) {
                    // modalUpdateDet.style.display = "none";
                    close(modalViewDocData);
            }
        }
        getDoctors("","");
    </script>
</body>
</html>