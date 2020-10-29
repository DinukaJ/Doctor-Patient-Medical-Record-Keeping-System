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
                <div class="upperPart">

                    <div class="upperFirst row">
                        <div class="c-l-4">
                            <h1 style="margin-top:5px">Add Lab Reports</h1>
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
                                        <label>Select Report Type</label>
                                        <select class="input-field fullWidth" name="reportType" id="reportType">
                                            <option selected disabled>Select Report Type</option>
                                            <option value="t1">T1</option>
                                            <option value="t2">T2</option>
                                            <option value="t3">T3</option>
                                            <option value="t4">T4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Select Patient</label>
                                        <input type="text" class="input-field fullWidth" name="patient" id="patient" placeholder="Enter Patient ID or Name" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Field 1</label>
                                        <input type="text" class="input-field fullWidth" name="f1" id="f1" placeholder="Field 1" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Field 2</label>
                                        <input type="text" class="input-field fullWidth" name="f2" id="f2" placeholder="Field 2" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Field 3</label>
                                        <input type="text" class="input-field fullWidth" name="f3" id="f3" placeholder="Field 3" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Field 4</label>
                                        <input type="text" class="input-field fullWidth" name="f4" id="f4" placeholder="Field 4" required>
                                    </div>
                                </div>
                                <div class="c-m-12">
                                    <div class="group-fields">
                                        <label>Field 5</label>
                                        <input type="text" class="input-field fullWidth" name="f5" id="f5" placeholder="Field 5" required>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <button type="button" class="btn btnLogin" name="cancelBtn" id="cancelBtn"><i class="fas fa-times"></i> CANCEL</button>
                                </div>
                                <div class="c-m-6">
                                    <button type="submit" class="btn btnLogin" name="confirmBtn" id="confirmBtn"><i class="fas fa-check"></i> CONFIRM</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8"></div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="cancel" id="cancel"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="finish" id="finish"><i class="fas fa-check"></i> Finish</button>
                    </div>
                </div>          -->
            </div>
        </div>
    </div>
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
</body>
</html>
