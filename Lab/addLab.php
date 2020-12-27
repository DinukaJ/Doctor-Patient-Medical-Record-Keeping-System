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

    <title>Lab Reports</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("addLab")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">

                    <div class="upperFirst row">
                        <div class="c-l-8">
                            <h1 style="margin-top:5px">Add Lab Reports</h1>
                        </div>
                        <div class="c-12 c-l-4" style="margin-top:20px">
                            <div class="patName" style="padding-bottom:10px;">
                            <label for="patName"><b>Name:  </b><span id="patName" name="patName"></span></label>
                            </div>
                            <div class="patAge">
                            <label for="patAge"><b>Age:  </b><span id="patAge" name="patAge"></span></label>
                            </div> 
                                <input type="hidden" id="patID" value="">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding:0px; margin:0px;">
                    <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="addRepStatus"></div>
                    </div>
                </div>
                <div class="row" style="padding:0px; margin:0px;">
                    <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="updateStatus"></div>
                    </div>
                </div>
                <div class="row patientDataRow" style="border-bottom:none;">
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>Select Patient</label>
                            <input type="text" class="input-field fullWidth" autocomplete='off' name="patientID" id="patientID" placeholder="Enter Patient ID or Name">
                            <div class='text-left mt-4' id='searchResult'>
                            <div class='' id='subsresult'>
                                <input type='hidden' id='secount' value='0'>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>Select Report Type</label>
                            <select class="input-field fullWidth" name="reportType" id="reportType">
                            </select>
                        </div>
                    </div>
                    <div class="c-m-4">
                        <b>Test Name</b>
                    </div>
                    <div class="c-m-4">
                        <b>Result</b>
                    </div>
                    <div class="c-m-4">
                        <b>Range</b>
                    </div>
                    <div class="c-12"><hr></div>
                    
                    <div class="c-12" id="typeRowSectionReport">
                        <!-- <div class="typeRow row">
                            <input type="hidden" value="" name="repTypeId" class="repTypeId">
                            <div class="c-11">
                                <p class="reportType"><b><u>Lipid Profile</u></b></p>
                            </div>
                            <div class="c-m-1" style="padding-top:5px; text-align:center;">
                                <button type="button" value="" class="btn delMed" name="delTestName"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="resultSet c-12 row" style="margin-bottom:10px;">
                                <div class="c-m-4 testName">
                                    Test Name 1
                                </div>
                                <div class="c-m-4">
                                    <input type="number" class="input-field repRes" style="width:100%;" name="repRes" placeholder="">
                                </div>
                                <div class="c-m-4">                                          
                                    <100 <br> 200-500
                                </div>
                                <div class="c-m-4">
                                </div>
                                <div class="c-m-4">
                                </div>
                                <div class="c-m-4">                                          
                                    <100 <br> 200-500
                                </div>
                            </div>
                            <div class="resultSet c-12 row" style="margin-bottom:10px;">
                                <div class="c-m-4 testName">
                                    Test Name 1
                                </div>
                                <div class="c-m-4">
                                    <input type="number" class="input-field repRes" style="width:100%;" name="repRes" placeholder="">
                                </div>
                                <div class="c-m-4">                                          
                                    <100
                                </div>
                            </div>
                            <div class="c-12"><hr class="lightHr"></div>
                        </div> -->
                    </div>                            
                                                        
                </div>
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8">
                        <textarea class="input-field fullWidth comment" style="height:75px" name="comment" id="comment" placeholder="Comment"></textarea>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient btnCancel" name="cancel" id="cancel"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="finish" id="finish"><i class="fas fa-check"></i> Finish</button>
                    </div>
                </div>  
                        
            </div>
        </div>
    </div>
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script src="../js/mainLab.js"></script>
</body>
</html>
