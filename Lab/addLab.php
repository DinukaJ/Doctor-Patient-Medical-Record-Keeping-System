<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');
include_once(dirname( dirname(__FILE__) ).'/parts/labSideNav.php');

if(isset($_SESSION["user"]))
{
    $lab = new lab();
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
            <?php getSideNav("addLab")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
            <div class="row patientDataRow">
                    <div class='c-12'>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Select Report Type</label>
                                        <select class="input-field fullWidth" name="reportType" id="reportType">
                                            <option selected disabled>Select Report Type</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Select Patient</label>
                                        <input type="text" class="input-field fullWidth" name="patient" id="patient" placeholder="Enter Patient ID or Name" required>
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
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8"></div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="cancel" id="cancel"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="finish" id="finish"><i class="fas fa-check"></i> Finish</button>
                    </div>
                </div>         
            </div>
        </div>
    </div>
</body>
</html>
