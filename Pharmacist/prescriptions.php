<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/pharmSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient = new patient();
    $pres=new prescription();
}
else
{
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Prescriptions</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("prescriptions")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Prescriptions</h1>
                        </div>
                        <!-- <div class="c-l-8 totText">
                            Total Patients: 10
                        </div> -->
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-12">
                            <div class="boxSmall">
                                 <label>No. of Items: </label><span id="dataCount"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Prescription No</div>
                    <div class='c-4' class='medicName'>Patient Name</div>
                    <div class='c-2' class='medicQty'>Item Count</div>
                    <div class='c-2' class='medicQty'>Date</div>
                    <div class='c-1'></div>
                </div>
                <div id="presData">
                    <!-- <div class="c-3">
                        1
                    </div>
                    <div class="c-4">
                        Pasindu Dissanayake
                    </div>
                    <div class="c-2">
                        10
                    </div>
                    <div class="c-2">
                        2020-11-01
                    </div>
                    <div class="c-1">
                        <button type="button" class="btn btnPatientView viewPres" id="viewPres">View</button>
                    </div> -->
                </div>         
            </div>
        </div>
    </div>
<!-- The Modal for View Prescription-->
<div id="modalViewPres" class="modal modal2">

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
                <h2>Prescription Details</h2>
            </div>
        </div>
        <div class="row">
        <div class="c-12 c-m-2">
                ID: <span class="answer presId" id="predId"></span>
            </div>
            <div class="c-12 c-m-4">
                Doctor Name: <span class="answer docName" id="docName"></span>
            </div>
            <div class="c-12 c-m-4">
                Patient Name: <span class="answer patName" id="patientName"></span>
            </div>
            <div class="c-12 c-m-2">
                Date: <span class="answer doi" id="doi2"></span>
            </div>
            <div class="c-12"><hr></div>
        </div>  
        <div class="row">
            <div class="c-4 c-m-2">
                <b>Med Name</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Type</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Amount Per Time</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Times Per Day</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Before / After Meal</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Duration</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="presVals">
            <!-- <div class="row">
                <div class="c-4 c-m-3">
                    Amoxicillin
                </div>
                <div class="c-4 c-m-2">
                    2
                </div>
                <div class="c-4 c-m-2">
                    3
                </div>
                <div class="c-4 c-m-2">
                    After
                </div>
                <div class="c-4 c-m-3">
                    1 Week(s)
                </div>
            </div> -->
        </div>    
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="closePres">Close</button> 
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Prescription-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the Prescription view modal
       var modal = document.getElementById("modalViewPres");

        $(document).ready(function(){
            //click on view
            $(".viewPres").click(()=>{
                open(modalViewPres);
            });
            $("#closePres").click(()=>{
                close(modalViewPres);
            });
            $(".close").click(()=>{
                close(modalViewPres);
            })
        })

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalViewPres) {
            // modal.style.display = "none";
                $(modalViewPres).slideUp();
            }
        }
    </script>
    <script src="../js/searchPres.js"></script>
</body>
</html>