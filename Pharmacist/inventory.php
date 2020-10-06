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
                <div class="upperPart4" style="padding-top: 10px;">
                <button type="button" class="btn btnNormal" id="addMed">Add New Medicine</button>
                </div>
                <div class="upperPart3">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                                 <input type="text" class="input-field fullWidth" placeholder="Enter Short Code or Medicine Name">       
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                 <label>Total Variety Count:</label>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                 <label>Total Table Count:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-3">
                        1
                    </div>
                    <div class="c-8">
                        1
                    </div>
                    <div class="c-1">
                        <button type="submit" class="btn btnPatientView" name="viewPatient" id="viewPatient">View</button>
                    </div>
                </div>
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
    <!-- The Modal -->
    <div id="modalAddMed" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-long inventoryModal">
            <div class="row">
                <div class="col-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
           <div class="detailsSection">
                <div class="row">
                    <div class="c-12 c-m-2">
                        Medicine Name: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="text" class="input-field" style="width:49%; display:inline;" name="medName" id="medName" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        QTY: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="text" class="input-field" style="width:49%; display:inline;" name="medQTY" id="medQTY" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-2">
                        Price: 
                    </div>
                    <div class="c-12 c-m-10">
                        <input type="text" class="input-field" style="width:49%; display:inline;" name="medPrice" id="medPrice" placeholder="">
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal" id="addMedCancel">Cancel</button> 
                        <button type="button" class="btn btnNormal" id="addMedSave">Save</button> 
                    </div>
                </div>
           </div>
        </div>

    </div>


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the modal Add Medicine Model
        var modalAddMed = document.getElementById("modalAddMed");

        function open(modal) {
            modal.style.display = "block";
        }
        function close(modal){
            modal.style.display = "none";
        }

        $(document).ready(function(){
            //Add Medicine Model
            $("#addMed").click(()=>{
                open(modalAddMed);
            });
            $(".close").click(()=>{
                close(modalAddMed);
            });
            $("#addMedCancel").click(()=>{
                close(modalAddMed);
            });
        });
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalAddMed) {
            modalAddMed.style.display = "none";
            }
        }
    </script>
</body>
</html>