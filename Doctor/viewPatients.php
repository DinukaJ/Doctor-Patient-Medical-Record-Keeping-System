<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

$docid="doc45";
$doctor="";
if(isset($_SESSION["user"]))
{
    // $doctor=unserialize($_SESSION['user']);
    // $docid=$doctor->getUserId();
}
else
{
    //header("Location: ../login.php");
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
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("patients")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart3">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                            <input type="text" class="input-field fullWidth" name="patientID" id="patientID" placeholder="Enter Patient ID or Name">
                        </div>
                        <div class="c-0 c-l-5">
                            
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>No. of Prescriptions:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-1">
                        1
                    </div>
                    <div class="c-4">
                        Patient Name
                    </div>
                    <div class="c-1">
                        Age
                    </div>
                    <div class="c-5">
                        Address
                    </div>
                    <div class="c-1">
                        <a class="btn btnPatientView" name="viewPatient" id="viewPatient">View</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <!-- <div id="myModal" class="modal">

        <div class="modal-content container">
        <span class="close">&times;</span>
           
        </div>

    </div> -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        //btn.onclick = 
        function open() {
            modal.style.display = "block";
        }
        if(modal)
        {   
            open();
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    </script>
</body>
</html>