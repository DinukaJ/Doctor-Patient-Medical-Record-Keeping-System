<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
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

    <title>Prescribe</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("prescribe")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px">
                <div class="upperPart2">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-3">
                            <div class="box">
                                <input type="text" class="input-field fullWidth" name="patientID" id="patientID" placeholder="Enter Patient ID or Name">
                                <p>Name: </p>
                                <p>Age: </p>
                                <a href=""><button type="button" class="btn btnNormal btnPatient" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Details</button></a>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="box">
                                <textarea class="input-field fullWidth" style="height:75px" name="allergies" id="allergies" placeholder="Allergies"></textarea><br>
                                <textarea class="input-field fullWidth" style="height:75px" name="imp_Notes" id="imp_Notes" placeholder="Important Notes"></textarea>
                            </div>
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