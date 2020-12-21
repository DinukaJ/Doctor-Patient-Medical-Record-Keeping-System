<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId = "";//"pat45";
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

    <title>Lab Reports</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("labRep")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Lab Reports</h1>
                        </div>
                    </div>
                   <div class="upperFirst row">  
                        <div class="c-12 c-l-6">
                            <div class="boxSmall">
                                <label>No. of Reports: <span id="noOfReports"></span></label>
                            </div>
                        </div>
                  </div>  
                </div>

                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Report Id</div>
                    <div class='c-4' class='medicName'>Report Type</div>
                    <div class='c-4' class='medicQty'>Date</div>
                    <div class='c-1'>
                    
                    </div>
                </div>

                <div class="row patientDataRow">
                    <div class="c-3">
                        1
                    </div>
                    <div class="c-4">
                        Blood Report
                    </div>
                    <div class="c-4">
                        2020-11-01
                    </div>
                    <div class="c-1">
                        <button type="button" class="btn btnPatientView viewReport" name="viewReport" id="viewReport">View</button>
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
   <!-- Edit Profile Modal -->
   <?php getEditProfile($patient)?>
    <!-- End of Edit Profile View -->


<!-- The Modal for View Report-->
<div id="modalViewRep" class="modal modal2">

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
                <h2>Report Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Report ID: <span class="answer" id="reportId"></span>
            </div>
            <div class="c-12 c-m-2">
                Patient ID: <span class="answer" id="patientId"></span>
            </div>
            <div class="c-12 c-m-3">
                Name: <span class="answer" id="patientName"></span>
            </div>
            <div class="c-12 c-m-3">
                Type: <span class="answer" id="rType"></span>
            </div>
            <div class="c-12 c-m-2">
                Date: <span class="answer" id="doi"></span>
            </div>
            <div class="c-12"><hr></div>
        </div>  
        <div class="row">
            <div class="c-4 c-m-4">
                <b>Test Name</b>
            </div>
            <div class="c-4 c-m-4">
                <b>Result</b>
            </div>
            <div class="c-4 c-m-4">
                <b>Range</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="repTypes">
            <div class="row">
                <div class="c-4 c-m-4">
                    HDL - Cholesterol
                </div>
                <div class="c-4 c-m-4">
                    36 mg/dl
                </div>
                <div class="c-4 c-m-4">
                    40-60
                </div>
            </div>
        </div>    
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="closeReport">Close</button>
                <!-- <button type="button" class="btn btnNormal" id="updateRep">Edit</button> -->
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Report-->
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
        var labReport=document.getElementById("modalViewRep");
        $(document).ready(function(){
            $(".viewReport").click(function(){
                open(labReport);
            });
            $('.close').click(()=>{
                close(modalUpdateDet);
                close(labReport);
            })
            $('#closeReport').click(()=>{
                close(labReport);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == labReport) {
                    // modalUpdateDet.style.display = "none";
                    close(labReport);
            }
        }
    </script>
</body>
</html>