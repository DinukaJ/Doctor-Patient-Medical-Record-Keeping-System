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
    if($doctor->getDocType()==0)
    {
        header("Location: prescribe.php");
    }
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
                            <input type="text" class="input-field fullWidth" name="medId" id="medId" placeholder="Enter Short Code or Medicine Name">
                        </div>
                        <div class="c-0 c-l-2">
                            
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Variant Count: <span id="totVariant"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Medicine ID</div>
                    <div class='c-4' class='medicName'>Medicine Name</div>
                    <div class='c-4' class='medicQty'>Short Code</div>
                    <div class='c-1'></div>
                </div>
                <div id="medInfo" ></div> 
            </div>
        </div>
    </div>
    
    
    <!-- Edit Profile Modal -->
    <?php getEditProfile($doctor)?>
    <!-- End of Edit Profile View -->

     <!-- The Modal for View Inventory-->
<div id="modalViewMed" class="modal modal2">
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
                <h2>Medicine Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Medicine ID: <span class="answer" id="medicId"></span>
            </div>
            <div class="c-12 c-m-6">
                Medicine Name: <span class="answer" id="medicName"></span>
            </div>
            <div class="c-12 c-m-3">
                Short Code: <span class="answer" id="medicSc"></span>
            </div>
            <div class="c-12"><hr></div>
        </div>
              
        <div class="row">
            <div class="c-12 c-m-6">
                <b>Type</b>
            </div>
            <div class="c-12 c-m-3">
                <b>QTY</b>
            </div>
            <div class="c-12 c-m-3">
                <b>Price</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="medTypes">

        </div>
   </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="deleteMed">Delete</button>
                <button type="button" class="btn btnNormal" id="updateMed">Edit</button>
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Medicine-->

<!-- The Modal for Update Medicine-->
<div id="modalUpdateMed" class="modal modal2">

<!-- Modal content -->
<div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
<form method="POST" id="medUpForm">
   <input type="hidden" value="" id="medUpID" name="medUpID">
   <div class="detailsSection">

        <div class="row">
            <div class="c-12">
                <h2>Update Medicine</h2>
            </div>
        </div>

   <div class="row" style="padding:0px; margin:0px;">
       <div class="c-12" style="padding:0px; margin:0px;">
        <div class="alerMSG" id="updateStatus"></div>
       </div>
   </div> 
   
        <div class="row">
            <div class="c-m-6">
                <label for="medname">Medicine Name: </label>
                <input type="text" class="input-field medName" style="width:100%;" name="medUpName" id="medUpName" placeholder="">
            </div>
            <div class="c-m-6">
                <label for="medSc">Short Code: </label>
                <input type="text" class="input-field medSc" style="width:100%;" name="medUpSc" id="medUpSc" placeholder="">
            </div>
        </div>

        <div class="row">
            <div class="c-m-12" style="padding-top:20px; padding-bottom:10px;">
                <h4 style="display:inline; margin-right:20px;"> Add More</h4>
                <button type="button" style="display:inline" value="" class="btn btnPatientView upAddType" name="upAddType" id="upAddType"><i class="fas fa-plus"></i></button>
            </div>
            <div class="c-12 c-m-4">
                <b>Weight</b>
            </div>
            <div class="c-12 c-m-4">
                <b>QTY</b>
            </div>
            <div class="c-12 c-m-4">
                <b>Price</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="medUpTypes"></div>
        <div id="addMedUpTypes"></div>
   </div>
   <div class="bottomModel">
        <div class="row">
            <div class="c-12">
                <button type="button" class="btn btnNormal medCancel btnCancel" id="upMedCancel">Cancel</button> 
                <button type="button" class="btn btnNormal" id="upMedSave">Save</button> 
            </div>
        </div>
   </div>
</form>
</div>
</div>
<!-- End of the Modal for Update Medicine-->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/searchMed.js"></script>
    <script src="../js/mainDoc.js"></script>
    <script src="../js/mainPatient.js"></script>
    <script>
        var modalViewMed=document.getElementById("modalViewMed");
        var modalUpdateMed=document.getElementById("modalUpdateMed");
        $(document).ready(function(){
            $('.viewMed').click(function(){
                open(modalViewMed);
                close(modalUpdateMed);
            });
            $('.close').click(()=>{
                close(modalViewMed);
                close(modalUpdateMed);
            })
            $("#updateMed").click(function(){
                close(modalViewMed);
                open(modalUpdateMed);
            });
            $("#upMedCancel").click(function(){
                close(modalUpdateMed);
            });
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalViewMed) {
                    // modalUpdateDet.style.display = "none";
                    close(modalViewMed);
            }
            if (event.target == modalUpdateMed) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateMed);
            }
        }
    </script>
</body>
</html>