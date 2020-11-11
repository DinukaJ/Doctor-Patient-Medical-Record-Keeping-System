<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId = "pat45";
$patient="";
if(isset($_SESSION["user"]))
{
    // $patient=unserialize($_SESSION['user']);
    // $patient=$patient->getUserId();
}
else
{
    //header("Location: ../login.php");
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
   <!-- Edit Profile Modal -->
   <?php getEditProfile($patient)?>
    <!-- End of Edit Profile View -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalUpdateDet);
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
        }
    </script>
</body>
</html>