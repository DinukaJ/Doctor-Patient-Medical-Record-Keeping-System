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
                        <div class="c-l-8">
                            <h1 style="margin-top:5px">Add Lab Reports</h1>
                        </div>
                        <div class="c-12 c-l-4 boxS">
                                <p id="patName">Name: </p>
                                <p id="patAge">Age: </p>
                                <input type="hidden" id="patID" value="">
                        </div>
                    </div>
                </div>
                <div class="row patientDataRow" style="border-bottom:none;">
                    <div class='c-12'>
                        <div class="row">
                            <div class="c-m-6">
                                <div class="group-fields">
                                    <label>Select Patient</label>
                                    <input type="text" class="input-field fullWidth" autocomplete='off' name="patientID" id="patientID" placeholder="Enter Patient ID or Name">
                                </div>
                            </div>
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
                        </div>
                        <div class="row ">
                            <div class="c-m-12" style="padding-top:20px; padding-bottom:10px;">
                                <h4 style="display:inline; margin-right:20px;"> Add More</h4>
                                <button type="button" style="display:inline" value="" class="btn btnPatientView viewMed upAddType" name="upAddType" id="upAddType"><i class="fas fa-plus"></i></button>
                            </div>
                            <div class="c-m-5">
                                <b>Test Name</b>
                            </div>
                            <div class="c-m-3">
                                <b>Result</b>
                            </div>
                            <div class="c-m-3">
                                <b>Range</b>
                            </div>
                            <div class="c-12"><hr></div>
                            
                            <div class="c-12" id="typeRowSection">
                                <div class="typeRow row">
                                    <div class="c-m-5">
                                        <input type="text" class="input-field repTest" style="width:100%;" name="repTest" placeholder="">
                                    </div>
                                    <div class="c-m-3">
                                        <input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder="">
                                    </div>
                                    <div class="c-m-3">                                          
                                        <input type="text" class="input-field repRange" style="width:100%;" name="repRange" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="medUpTypes"></div><!--//TODO:Edit-->
                        <div id="addMedUpTypes"></div>
                    </div>
                            
                                                        
                </div>
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8">
                        <textarea class="input-field fullWidth" style="height:75px" name="presNote" id="presNote" placeholder="Comment"></textarea>
                    </div>
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
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        $("#upAddType").click(function(){
            var rowData='<div class="typeRow row" style="margin-top:10px;"><div class="c-m-5"><input type="text" class="input-field repTest" style="width:100%;" name="repTest" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRange" style="width:100%;" name="repRange" placeholder=""></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
            $("#typeRowSection").append(rowData);
            $(".delTest").click(function(){
                $(this).parent().parent().remove();
            });
        });
    </script>
</body>
</html>
