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

    <title>Doctor Status</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("docStatus")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                <div class="upperFirst row">
                    <div class="c-l-12">
                    <h1 style="margin-top:5px">Doctor Status</h1>
                    </div>
                </div>
                  <div class="upperFirst row">
                        <div class="c-12 c-l-3">
                             <div class="boxSmall wrapper">
                                 <input class="input-field " placeholder="Enter Doctor Name">
                             </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                            <input type="date" class="input-field" >
                            </div>
                        </div>
                        <div class="c-12 c-l-6">
                            <div class="boxSmall">
                            <input class="input-field " placeholder="Enter Speciality">
                            </div>
                        </div>
                    </div>
                  </div>  
                </div>
                <div class="row patientDataRow">
                    <div class="c-4">
                        1
                    </div>
                    <div class="c-7">
                        1
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