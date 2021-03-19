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

    <title>Edit Report Types</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("editType")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">

                    <div class="upperFirst row">
                        <div class="c-l-8">
                            <h1 style="margin-top:5px">Edit Report Types</h1>
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
                    <div class="c-m-5">
                        <div class="group-fields">
                            <label>Select Report Type</label>
                            <select class="input-field fullWidth" name="reportType" id="reportType2">

                            </select>
                        </div>
                    </div>
                    <div class="c-m-1" style="padding-top:15px;">
                        <center><h5>OR</h5></center>
                    </div>
                    <div class="c-m-5">
                        <div class="group-fields">
                            <label>Add New Report Type</label>
                            <input type="text" class="input-field fullWidth" name="newReportType" id="newReportType" placeholder="Add New Report Type">
                        </div>
                    </div>
                    <div class="c-m-1" style="padding-top:30px;">
                        <button type="button" style="display:inline" value="" class="btn btnPatientView viewMed upAddType" name="upAddNewType" id="upAddNewType"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="c-m-4">
                        <b>Test Name</b>
                    </div>
                    <div class="c-m-4">
                        <b>Range</b>
                    </div>
                    <div class="c-m-4">
                        <b>Unit</b>
                    </div>
                    <div class="c-12"><hr></div>
                    
                    <div class="c-12" id="">
                        <div class="typeRow row" id="mainTestNameSection">
                            <div class="c-m-4">
                                <input type="text" class="input-field testName" style="width:100%;" name="testName" id="testName" placeholder="Test Name">
                            </div>
                            <div class="c-m-4">
                                <div class="row" style="margin:0px; padding:0px;">
                                    <div class="c-4 leftValue">
                                        <input type="number" class="input-field val1" style="width:100%;" name="val1" id="val1" placeholder="Value">
                                    </div>
                                    <div class="c-4">
                                        <select class="input-field fullWidth rangeType" name="rangeType" style="font-size:1.2em;">
                                            <option value="<"><</option>
                                            <option value=">">></option>
                                            <option value="-">-</option>
                                        </select>
                                    </div>
                                    <div class="c-4">
                                        <input type="number" min="0" class="input-field val2" style="width:100%;" name="val2" id="val2" placeholder="Value">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="c-m-3">                                          
                                <select class="input-field fullWidth unit" name="unit" id="unit">
                                    <option value="mg/dl">mg/dl</option>
                                    <option value="g/dl">g/dl</option>
                                </select>
                            </div>
                            <div class="c-m-1" style="padding-top:5px;">
                                <button type="button" style="display:inline;" value="" class="btn btnPatientView viewMed" name="addTestType" id="addTestType"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>                            
                    <div class="c-12"><hr></div>   
                    
                    <div class="c-12" id="typeRowSectionReportAdd">
                        <!-- <div class="wholeSection">
                            <div class="testNameSection">
                                <div class="typeRow row">
                                    <div class="c-m-4">
                                        <p>Test Name</p>
                                    </div>
                                    <div class="c-m-4" style="text-align:center;">
                                        <p>< 10.5</p>
                                    </div>
                                    <div class="c-m-3">                                          
                                        <p>mg/dl</p>
                                    </div>
                                    <div class="c-m-1" style="padding-top:5px; text-align:center;">
                                        <button type="button" value="" class="btn delMed" name="delTestName"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="typeRow row">
                                <div class="c-m-4">
                                    
                                </div>
                                <div class="c-m-4" style="text-align:center;">
                                    <div class="row" style="margin:0px; padding:0px;">
                                        <div class="c-4 leftValue">
                                            <input type="number" class="input-field" style="width:100%;" name="val1" id="val1" placeholder="Value">
                                        </div>
                                        <div class="c-4">
                                            <select class="input-field fullWidth rangeType" name="rangeType" style="font-size:1.2em;">
                                                <option value="<"><</option>
                                                <option value=">">></option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                        <div class="c-4">
                                            <input type="number" class="input-field" style="width:100%;" name="val2" id="val2" placeholder="Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="c-m-3">                                          
                                    <select class="input-field fullWidth" name="unit" id="unit">
                                        <option value="mg/dl">mg/dl</option>
                                        <option value="g/dl">g/dl</option>
                                    </select>
                                </div>
                                <div class="c-m-1" style="padding-top:5px; text-align:center;">
                                    <button type="button" value="" class="btn btnPatientView viewMed addMoreUnits" name="addMoreUnits"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="c-12"><hr class="lightHr"></div>
                            </div>
                        </div> -->
                    </div>    

                </div>
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8">
                    </div>
                    <div class="c-12 c-l-2">
                        
                    </div>
                    <div class="c-12 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient btnCancel" name="clearBtn" id="clearBtn"><i class="fas fa-times"></i> Clear</button>
                    </div>
                    <!-- <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="finish" id="finish"><i class="fas fa-check"></i> Finish</button>
                    </div> -->
                </div>  
                        
            </div>
        </div>
    </div>
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script>
    //blocking entering minus values in .val2
    $(".val2").change(function(){
        if($(this).val()<0){
            $(this).val("");
            $(this).addClass("errorInput");
            setTimeout(function(){
                $(".val2").removeClass("errorInput");
            },2000);
        }
    });
    </script>

    <script src="../js/mainLab.js"></script>
</body>
</html>
