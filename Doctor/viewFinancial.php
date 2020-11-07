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

    <title>Doctor - View Financial Records</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("financial")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart3">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-2">
                            <label>Select Month: </label>
                        </div>
                        <div class="c-0 c-l-4">
                            <input class="input-field fullWidth" type="month" id="selectMonth" name="selectMonth" placeholder="Select Month">
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Doctor Charges:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Bill Count:<?php 
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
                        Bill No
                    </div>
                    <div class="c-2">
                        No of Items
                    </div>
                    <div class="c-4">
                        Bill Amount
                    </div>
                    <div class="c-1">
                        <a class="btn btnPatientView" name="viewBill" id="viewBill">View</a>
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