<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(!isset($_SESSION["user"]))
{
    // header("Location: ../login.php");
}

if(isset($_POST["loginBtn"]))
{
    $fname=$_POST["firstName"];
    $lname=$_POST["lastName"];
    $phone=$_POST["phone"];
    $age=$_POST["age"];
    $address=$_POST["address"];
    $patient=new patient();
    $res=$patient->addPatient(null,$fname,$lname,$phone,$age,$address);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Add Patients</title>
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
                            <a href="addPatients.php"><button type="button" class="btn btnNormal btnPatient active" name="addPatient" id="addPatient"><i class="fas fa-plus"></i> ADD PATIENTS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedPatients.php"><button type="submit" class="btn btnNormal btnPatient" name="addPatient" id="addPatient"><i class="fas fa-search"></i> VIEW PATIENTS</button></a>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-4">
                            <h1 style="margin-top:5px">Enter Patient Details</h1>
                        </div>
                        <!-- <div class="c-l-8 totText">
                            Total Patients: 10
                        </div> -->
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class='c-12'>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>First Name</label>
                                        <input type="text" class="input-field fullWidth" name="firstName" id="firstName" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Last Name</label>
                                        <input type="text" class="input-field fullWidth" name="lastName" id="lastName" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Phone No</label>
                                        <input type="text" class="input-field fullWidth" name="phone" id="phone" placeholder="Phone No" required>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Age</label>
                                        <input type="number" class="input-field fullWidth" name="age" id="age" placeholder="Age" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Address</label>
                                        <textarea type="number" class="input-field fullWidth" name="address" id="address" placeholder="Address" required></textarea>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <button type="submit" class="btn btnLogin" name="loginBtn" id="loginBtn"><i class="fas fa-check"></i> CONFIRM</button>
                                </div>
                                <div class="c-m-6">
                                    <button type="submit" class="btn btnLogin" name="cancelBtn" id="loginBtn"><i class="fas fa-times"></i> CANCEL</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST["loginBtn"]))
        {
            echo'
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content container">
                <span class="close">&times;</span>';
                if($res == 0)
                {
                    echo "Something Went Wrong!";
                }
                else
                {
                    echo "Patient Successfully Added!";
                }
                echo '
                </div>

            </div>';
        }
    ?>
    <!-- The Modal -->
    
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