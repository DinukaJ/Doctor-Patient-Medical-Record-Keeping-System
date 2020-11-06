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
    //header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Inventory</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("inventory")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Inventory</h1>
                        </div>
                        <!-- <div class="c-l-8 totText">
                            Total Patients: 10
                        </div> -->
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                                 <input type="text" class="input-field fullWidth" id ="medId" placeholder="Enter Short Code or Medicine Name">       
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                 <label>Total Variety Count:</label>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                 <label>Total Tablet Count:</label>
                            </div>
                        </div>
                        <div class="c-12 c-l-2">
                            <div class="boxSmall">
                                <button type="button" class="btn btnNormal" id="addMed"><i class="fas fa-plus"></i> Add New Medicine</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- prints info -->
            <div class='row patientDataRow addMedicineRow'>
                <div class='c-3' class='medicId'>Medicine ID</div>
                <div class='c-4' class='medicName'>Medicine Name</div>
                <div class='c-4' class='medicQty'>Short Code</div>
                <div class='c-1'>
                
                </div>
            </div>
            <div id="medInfo" ></div>
                <?php
                // $res=$patient->getPatients();
                // $i=1;
                // while($row=mysqli_fetch_assoc($res))
                // {
                //     echo '
                //     <div class="row patientDataRow">
                //         <div class="c-11">
                //             '.$i.'. '.$row['fname'].' '.$row['lname'].'
                //         </div>
                //         <div class="c-1">
                //             <button type="submit" class="btn btnPatientView" name="viewPatient" id="viewPatient">View</button>
                //         </div>
                //     </div>
                //     ';
                //     $i++;
                // }
                ?>           
            </div>
        </div>
    </div>
    <!-- The Modal for Add Medicine-->
    <div id="modalAddMed" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>

        <form method="POST" id="medAddForm">
           <div class="detailsSection">
                <div class="row">
                    <div class="c-12">
                        <h2>Add Medicine</h2>
                    </div>
                </div>
                <div class="row" style="padding:0px; margin:0px;">
                    <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="addMedStatus"></div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="c-12 c-m-3">
                        Medicine Name: 
                    </div>
                    <div class="c-12 c-m-9">
                        <input type="text" class="input-field" style="width:49%; display:inline;" name="medName" id="medName" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-3">
                        QTY: 
                    </div>
                    <div class="c-12 c-m-9">
                        <input type="number" class="input-field" style="width:49%; display:inline;" name="medQTY" id="medQTY" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-3">
                        Price: 
                    </div>
                    <div class="c-12 c-m-9">
                        <input type="number" step="0.01" class="input-field" style="width:49%; display:inline;" name="medPrice" id="medPrice" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-3">
                        Short Code: 
                    </div>
                    <div class="c-12 c-m-9">
                        <input type="text" class="input-field" style="width:49%; display:inline;" name="medSc" id="medSc" placeholder="" required>
                    </div>
                </div> -->
                <div class="row">
                    <div class="c-m-6">
                        <label for="medname">Medicine Name: </label>
                        <input type="text" class="input-field" style="width:100%;" name="medName" id="medNameAdd" placeholder="">
                    </div>
                    <div class="c-m-6">
                        <label for="medSc">Short Code: </label>
                        <input type="text" class="input-field" style="width:100%;" name="medSc" id="medScAdd" placeholder="">
                    </div>
                    <div class="c-m-12" style="padding-top:20px; padding-bottom:10px;">
                        <h4 style="display:inline; margin-right:20px;">Types</h4>
                        <button type="button" style="display:inline" value="" class="btn btnPatientView viewMed addType" name="addType" id="addType"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="c-12" id="typeRowSection">
                        <div class="typeRow row">
                            <div class="c-m-4">
                                <label for="medname">Weight Per Unit: </label>
                                <input type="text" class="input-field medType" style="width:100%;" name="medType" placeholder="200(mg)">
                            </div>
                            <div class="c-m-3">
                                <label for="medname">QTY: </label>
                                <input type="number" class="input-field medQTY" style="width:100%;" name="medQTY" placeholder="">
                            </div>
                            <div class="c-m-4">
                                <label for="medname">Price: </label>
                                <input type="number" class="input-field medPrice" style="width:100%;" name="medPrice" placeholder="">
                            </div>
                            <div class="c-m-1">
                            <label for="medname"></label>
                                <!-- <button type="button" value="" class="btn delType delMed" name="delType"><i class="fas fa-times"></i></button> -->
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal medCancel" id="addMedCancel">Cancel</button> 
                        <button type="button" class="btn btnNormal" id="addMedSave">Save</button> 
                    </div>
                </div>
           </div>
        </form>
        
        </div>
    </div>
    <!-- End of the Modal for Add Medicine-->

 <!-- The Modal for View Inventory-->
<div id="modalViewMed" class="modal modal2">

<!-- Modal content -->
 <div class="modal-content-short2 inventoryModal">
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
                Medicine ID: 
            </div>
            <div class="c-12 c-m-9 answer" id="medicId">
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Medicine Name: 
            </div>
                <div class="c-12 c-m-9 answer" id="medicName"></div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Price: 
            </div>

                <div class="c-12 c-m-9 answer" id="medicPrice"></div>
        </div>                
        <div class="row">
            <div class="c-12 c-m-3">
                Qty: 
            </div>
                <div class="c-12 c-m-9 answer" id="medicQty"></div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Short Code: 
            </div>
                <div class="c-12 c-m-9 answer" id="medicSc"></div>
        </div>
   </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="deleteMed">Delete</button>
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
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
        <form method="POST" id="medUpForm">
            <input type="hidden" value="" id="medUpID" name="medUpID">
           <div class="detailsSection">
           <div class="alerMSG" id="updateStatus"></div>
                <div class="row">
                    <div class="c-12">
                        <h2>Update Medicine Details</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        Medicine Name: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="medUpName" id="medUpName" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        QTY: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="number" class="input-field" style="width:100%; display:inline;" name="medUpQty" id="medUpQty" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        Price: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="number" step="0.01" class="input-field" style="width:100%; display:inline;" name="medUpPrice" id="medUpPrice" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        Short Code: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="medUpSc" id="medUpSc" placeholder="" required>
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal medCancel" id="updateMedCancel">Cancel</button> 
                        <button type="submit" class="btn btnNormal" id="updateMedSave">Save</button> 
                    </div>
                </div>
           </div>
        </form>
        </div>
    </div>
    <!-- End of the Modal for Update Medicine-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the modal Add Medicine Model
        var modalAddMed = document.getElementById("modalAddMed");
        var modalViewMed = document.getElementById("modalViewMed");
        var modalUpdateMed = document.getElementById("modalUpdateMed");

        $(document).ready(function(){
            //Add Medicine Model
            $("#addMed").click(()=>{
                open(modalAddMed);
            });
            $("#updateMed").click(()=>{
                open(modalUpdateMed);
            })
            $(".close").click(()=>{
                close(modalAddMed);
                close(modalUpdateMed); //closes update modal
                close(modalViewMed);
            });
            $("#updateMedCancel").click(()=>{
                close(modalUpdateMed);//closes update modal
                close(modalViewMed); //closes the view modal with the update
            })
            $(".medCancel").click(()=>{
                close(modalAddMed);
                
            });
        });
 
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalAddMed) {
            // modalAddMed.style.display = "none";
                close(modalAddMed);
            }
        if (event.target == modalViewMed) {
            // modalViewMed.style.display = "none";
                close(modalViewMed);
            }
        if(event.target === modalUpdateMed){
            // modalUpdateMed.style.display = "none";
            close(modalUpdateMed);
        }
        }
    </script>
    <script src="../js/searchMed.js"></script>
    <script src="../js/mainPharmacist.js"></script>
</body>
</html>