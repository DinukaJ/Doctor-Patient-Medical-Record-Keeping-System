<?php
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

    <title>Prescription Queue</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("presQueue")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Prescription Queue</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-m-10">
                            <div class="boxSmall">
                                <label>No. of Prescriptions in Queue:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                                <span id="itemCount"></span>
                            </div>
                        </div>
                        <div class="c-m-2" style="text-align:right">
                            <button type="button" class="btn docChargeBtn" id="editDocCharge">Edit Doctor Charge</button>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Prescription No</div>
                    <div class='c-4' class='medicName'>Patient Name</div>
                    <div class='c-4' class='medicName'>No of Items</div>
                    <!-- <div class='c-4' class='medicQty'>Item Count</div> -->
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="presInfo">
                    <!-- <div class="c-3">
                        1
                    </div>
                    <div class="c-4">
                        Pasindu Dissanayake
                    </div>
                    <div class="c-4">
                        10
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
        <div class="detailsSection" id="printPresSec" style="padding-bottom:20px;">
            <div class="row">
                <div class="c-12">
                    <h2>Prescription</h2>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    ID: <span class="answer presId" id="presId"></span>
                </div>
                <div class="c-12 c-m-4">
                    Doctor Name: <span class="answer docName" id="docName"></span>
                </div>
                <div class="c-12 c-m-4">
                    Patient Name: <span class="answer patName" id="patName"></span>
                </div>
                <div class="c-12 c-m-2">
                    Date: <span class="answer doi" id="doi"></span>
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
                    </div> -->
                <!-- </div> -->
            </div>
            <div id="addressPart">
                <div class="row">
                    <div class="c-12"><hr></div>
                    <div class="c-12" style="text-align:center; padding-top:20px">
                        <p style="line-height:0px;">Madagoda Medical Center</p>
                        <p style="line-height:8px;">Contact No: 0112754212</p>
                    </div>
                </div>
            </div>   
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal presPrint" id="presPrint">Print</button> 
                <button type="button" class="btn btnNormal" id="billCreate">Create Bill</button> 
            </div>
        </div>
    </div>
</div>
<!-- End of the Modal for View Prescription-->

    <!-- The Modal for Bill-->
<div id="modalBill" class="modal modal2">
<!-- Modal content -->
    <div class="modal-content-long inventoryModal">
        <div class="row">
            <div class="c-12">
            <span class="close closeMed">&times;</span>
            </div>
        </div>
        <div class="detailsSection" id="printBillSec" style="padding-bottom:20px;">
            <div class="row">
                <div class="c-12">
                    <h2>Bill</h2>
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
                <div class="c-12 c-m-3">
                    <b>Med Name</b>
                </div>
                <div class="c-12 c-m-3">
                    <b>Types</b>
                </div>
                <div class="c-12 c-m-2">
                    <b>QTY</b>
                </div>
                <div class="c-12 c-m-2">
                    <b>Price</b>
                </div>
                <div class="c-12 c-m-2">
                    <b>Total Price</b>
                </div>
                <div class="c-12"><hr></div>
            </div>
            <div id="billVals">
                <!-- <div class="row">
                    <div class="c-4 c-m-4"></div>
                    <div class="c-4 c-m-4"></div>
                    <div class="c-4 c-m-4"></div>
                </div> -->
            </div>  
            <div class="row">
                <div class="c-12"><hr></div>
                <div class="c-12" style="text-align:right; padding-right:11%;">
                    <b>Total Amount:- Rs.<span id="totalAmount"></span></b>
                </div>
                <div class="c-12"><hr></div>
            </div>  
            <div id="addressPart">
                <div class="row">
                    <div class="c-12" style="text-align:center; padding-top:20px">
                        <p style="line-height:0px;">Madagoda Medical Center</p>
                        <p style="line-height:8px;">Contact No: 0112754212</p>
                    </div>
                </div>
            </div>  
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="endBill" style="width:auto;">Print & End Bill</button>  
            </div>
        </div>
    </div>
</div>
<!-- End of the Modal for Bill-->

    <!-- The Modal for Doc Charge-->
<div id="docCharge" class="modal">
<!-- Modal content -->
    <div class="modal-content-short">
        <div class="row">
            <div class="c-12">
            <span class="close closeMed">&times;</span>
            </div>
        </div>
        <div class="row" style="padding:0px; margin:0px;">
            <div class="c-12" style="padding:0px; margin:0px;">
                <div class="alerMSG" id="docChargeStatus"></div>
            </div>
        </div>
        <div class="detailsSection">
            <div class="row">
                <div class="c-12">
                    <h2>Edit Doctor Charge</h2>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Enter Doctor Charge: Rs.
                </div>
                <div class="c-12 c-m-8">
                    <input type="number" class="input-field medQty" style="width:100%;" name="docC" id="docC" placeholder="">
                </div>
            </div>   
        </div>
        <div class="bottomModel row" style="margin-top:50px; text-align:right;">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="updateDocCharge" style="width:auto;">Update</button>  
            </div>
        </div>
    </div>
</div>
<!-- End of the Modal for Doc Charge-->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the Prescription view modal
       var modalViewPres = document.getElementById("modalViewPres");
        //Model Bill
       var modalBill = document.getElementById("modalBill");
        //Model docCharge
       var docCharge = document.getElementById("docCharge");

        $(document).ready(function(){
            $(".close").click(()=>{
                close(modalViewPres);
                close(modalBill);
                close(docCharge);
            })
            $("#billCreate").click(()=>{
                close(modalViewPres);
                open(modalBill);
            });
            $("#endBill").click(()=>{
                close(modalBill);
            })
        })

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalViewPres) {
            // modal.style.display = "none";
                $(modalViewPres).slideUp();
            }
        if (event.target == modalBill) {
            // modal.style.display = "none";
                $(modalBill).slideUp();
            }
        if (event.target == docCharge) {
            // modal.style.display = "none";
                $(docCharge).slideUp();
            }
        }
    </script>
    <script src="../js/searchPres.js"></script>
    <script src="../js/jQuery.print.js"></script>
    <script type='text/javascript'>
        $(function() {
            $("#presPrint").on('click', function() {
            $("#printPresSec").print({

            // Use Global styles
            globalStyles : false, 

            // Add link with attrbute media=print
            mediaPrint : false, 

            //Custom stylesheet
            stylesheet : "../css/mainPrint.css", 

            //Print in a hidden iframe
            iframe : true, 

            // Don't print this
            noPrintSelector : ".avoid-this",
            
            // Add this at bottom
            prepend : "jQueryScript.net",

            // Manually add form values
            manuallyCopyFormValues: true,

            // resolves after print and restructure the code for better maintainability
            deferred: $.Deferred(),

            // timeout
            timeout: 250,

            // Custom title
            title: null,

            // Custom document type
            doctype: '<!doctype html>'

            });
        });
    });
        $(function() {
            $("#endBill").on('click', function() {
            $("#printBillSec").print({

            // Use Global styles
            globalStyles : false, 

            // Add link with attrbute media=print
            mediaPrint : false, 

            //Custom stylesheet
            stylesheet : "../css/mainPrint.css", 

            //Print in a hidden iframe
            iframe : true, 

            // Don't print this
            noPrintSelector : ".avoid-this",

            // Manually add form values
            manuallyCopyFormValues: true,

            // resolves after print and restructure the code for better maintainability
            deferred: $.Deferred(),

            // timeout
            timeout: 250,

            // Custom title
            title: null,

            // Custom document type
            doctype: '<!doctype html>'

            });
        });
    });
    </script> 
</body>
</html>