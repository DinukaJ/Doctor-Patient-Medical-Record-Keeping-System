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
                                 <label>No. of Items</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Prescription No</div>
                    <div class='c-4' class='medicName'>Patient Name</div>
                    <div class='c-2' class='medicQty'>Item Count</div>
                    <div class='c-2' class='medicQty'>Date</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-3">
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
                        <button type="button" class="btn btnPatientView" id="viewPres">View</button>
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


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

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