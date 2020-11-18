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

    <title>Doctor - View Inventory</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("inventory")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                            <h1 style="margin-top:5px">Inventory</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                            <input type="text" class="input-field fullWidth" name="patientID" id="patientID" placeholder="Enter Short Code or Medicine Name">
                        </div>
                        <div class="c-0 c-l-2">
                            
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Variant Count:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Tablet Count:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-2' class='patId'>Med ID</div>
                    <div class='c-4' class='patFirstName'>Name</div>
                    <div class='c-2' class='patLastName'>Age</div>
                    <div class='c-4'>Price</div>
                    <div class='c-1'></div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-2">
                        1
                    </div>
                    <div class="c-4">
                        Medicine Name
                    </div>
                    <div class="c-2">
                        QTY
                    </div>
                    <div class="c-3">
                        Price
                    </div>
                    <div class="c-1">
                        <a class="btn btnPatientView" name="editMedicine" id="editMedicine">Edit</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
    
    <!-- Edit Profile Modal -->
    <?php getEditProfile($doctor)?>
    <!-- End of Edit Profile View -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainDoc.js"></script>
    <script src="../js/mainPatient.js"></script>
    <script>
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
        }
    </script>
</body>
</html>