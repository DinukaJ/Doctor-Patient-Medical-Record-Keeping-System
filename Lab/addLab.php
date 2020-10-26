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
                <div class="upperPart3">
                        <div class="upperFirst row">
                            <div class="c-12 c-l-6">
                                <div class="boxSmall">
                                    <label>Report Type:</label>
                                        <select>
                                            <option value="0">Select Report</option>
                                            <option value="1">ZZZ</option>
                                            <option value="2">YYY</option>
                                        </select>
                                </div>
                            </div>
                            <div class="c-12 c-l-6">
                                <div class="boxSmall">
                                    <label>Select Patient:</label>
                                    <input type="text" class="input-field" style="width:75%; display:inline;" id ="patId" placeholder="Patient ID or Name">
                                </div>
                            </div>
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
