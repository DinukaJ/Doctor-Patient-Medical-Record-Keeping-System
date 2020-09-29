<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
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

    <title>Added Patients</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("patient")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-2">
                            <a href="addPatients.php"><button type="button" class="btn btnNormal btnPatient" name="addPatient" id="addPatient"><i class="fas fa-plus"></i> ADD PATIENTS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedPatients.php"><button type="submit" class="btn btnNormal btnPatient active" name="addPatient" id="addPatient"><i class="fas fa-search"></i> VIEW PATIENTS</button></a>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-4">
                            <input type="text" class="input-field fullWidth" name="emailUsername" id="emailUsername" placeholder="Enter Patient ID or Name" required>
                        </div>
                        <div class="c-l-8 totText">
                            Total Patients: 
                            <?php 
                                $c=$patient->getTotalPatients();
                                $c=mysqli_fetch_array($c)[0];
                                echo $c;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $res=$patient->getPatients();
                $i=1;
                while($row=mysqli_fetch_assoc($res))
                {
                    echo '
                    <div class="row patientDataRow">
                        <div class="c-11">
                            '.$i.'. '.$row['fname'].' '.$row['lname'].'
                        </div>
                        <div class="c-1">
                            <button type="submit" class="btn btnPatientView" name="viewPatient" id="viewPatient">View</button>
                        </div>
                    </div>
                    ';
                    $i++;
                }
                ?>           
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