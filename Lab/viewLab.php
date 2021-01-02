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
            <?php getSideNav("viewLab")?>
               <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
                    <div class="upperPart">
                            <div class="upperFirst row">
                                <div class="c-l-12">
                                    <h1 style="margin-top:5px">View Lab Reports</h1>
                                </div>
                                <!-- <div class="c-l-8 totText">
                                    Total Patients: 10
                                </div> -->
                            </div>
                            <div class="upperFirst row">
                                <div class="c-12 c-l-8">
                                    <div class="boxSmall">
                                        <input type="text" class="input-field" style="width:60%; display:inline;" id ="pnrId" placeholder="Patient ID or Name or Report ID">
                                    </div>
                                </div>
                                <div class="c-12 c-l-4 totText">
                                    <div class="boxSmall">
                                        <label>Total Reports: <span id="totalCount"></span></label>   
                                    </div>
                                </div>
                            </div>
                    </div>
                         
                <!-- prints info -->
                    <div class='row patientDataRow addMedicineRow'>
                      <div class='c-2' class='repId'>Report ID</div>  
                      <div class='c-5' class='patId'>Patient Name</div>
                      <div class='c-4' class='repType'>Date</div>
                      <div class='c-1'></div>
                    </div> 
                <!--Adding Reports-->
                  <div id="reportInfo"></div>
               </div>
        </div>
    </div>

<!-- The Modal for View Report-->
<div id="modalViewRep" class="modal modal2">

<!-- Modal content -->
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
            <div class="c-12">
                <h2>Report Details</h2>
            </div>
        </div>
        <div class="c-12" style="padding-left:0px; padding-right:0px;">
            <div class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-4">
                    <center><b>Report ID: <span id="reportNo"></span></b></center>
                </div>
                <div class="c-4">
                    <center><b>Patient Name: <span id="patName"></span></b></center>
                </div>
                <div class="c-4">
                    <center><b>Date: <span id="reportDate"></span></b></center>
                </div>
            </div>
            <div id="commentRow" class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-12">
                    <b>Comment: <span id="comment"></span></b>
                </div>
            </div>
            <div class="row patientDataRow" style="border-bottom:none;">
                <div class="c-12 tableCont2" style="padding-left:0px; padding-right:0px;">
                    <table style="width:100%; font-size:0.8em !important;" class="presTable addMedicineRow id="reportTable">
                        <tr style="height:20px;">
                            <th style="width:30%">Test Name</th>
                            <th style="width:30%">Result</th>
                            <th style="width:30%; text-align:center;">Range</th>
                        </tr>
                    </table>
                    <table id="patReportData" style="width:100%; font-size:0.8em !important;" class="presTable" id="reportTable">
         
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>    
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="closeRep">Close</button>
                <!-- <button type="button" class="btn btnNormal" id="updateRep">Edit</button> -->
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Report-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    
    <script src="../js/searchRep.js"></script>
    <script>
        // Get the modal Reports
        var modalViewRep = document.getElementById("modalViewRep");
        var modalUpdateRep = document.getElementById("modalUpdateRep");

        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalViewRep);
                close(modalUpdateRep);
            })
            $('#closeRep').click(()=>{
                close(modalViewRep);
            })
            $('#updateRepCancel').click(()=>{
                close(modalUpdateRep);
            })
        });

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event){
            if(event.target==modalViewRep){
                close(modalViewRep);
            }
            if(event.target==modalUpdateRep){
                close(modalUpdateRep);
            } 
        }
    </script>
</body>
</html>
