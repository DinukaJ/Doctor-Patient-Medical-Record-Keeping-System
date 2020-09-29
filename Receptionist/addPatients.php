<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');

if(isset($_SESSION["user"]))
{
    $user=unserialize($_SESSION["user"]);
    if($user instanceof doctor)
    {
        $word="Doctor";
    }
    if($user instanceof patient)
    {
        $word="Patient";
    }
}
else
{
    header("Location: login.php");
}

if(isset($_POST["loginBtn"]))
{
    $fname=$_POST["firstName"];
    $lname=$_POST["lastName"];
    $phone=$_POST["phone"];
    $age=$_POST["age"];
    $address=$_POST["address"];
    $patient=new patient();
    $res=$patient->addPatient($fname,$lname,$phone,$age,$address);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fc58a4724c.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/main.css">
    <title>Next Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="c-12 c-l-2 sidePanel">
                <div class="row account">
                    <div class="c-6">
                        <img src="../images/acc.png" width="80%">
                    </div>
                    <div class="c-6">
                        <p class="accountName">Receptionist</p>
                        <a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
                    </div>
                </div>
                <a href="" class="sideLink active">Patients</a>
                <a href="" class="sideLink">Doctors</a>
            </div>
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
    
    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("");

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