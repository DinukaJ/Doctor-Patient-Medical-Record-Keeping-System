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
                      <div class='c-3' class='patId'>Patient ID</div>
                      <div class='c-4' class='repId'>Report ID</div>
                      <div class='c-4' class='repType'>Type</div>
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
 <div class="modal-content-short2 inventoryModal">
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
        <div class="row">
            <div class="c-12 c-m-6">
                <div class="row">
                    <div class="c-12 c-m-6">
                        Patient ID:
                    </div>
                    <div class="c-12 c-m-6 answer" id="patientId">
                </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-6">
                        Report ID: 
                    </div>
                        <div class="c-12 c-m-6 answer" id="reportId"></div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-6">
                        Date of Issue: 
                    </div>

                        <div class="c-12 c-m-6 answer" id="doi"></div>
                </div>                
                <div class="row">
                    <div class="c-12 c-m-6">
                        Type: 
                    </div>
                        <div class="c-12 c-m-6 answer" id="rType"></div>
                </div>
            </div>
            <div class="c-12 c-m-6">
                <div class="row">
                    <div class="c-12 c-m-6">
                            Test Name: 
                    </div>
                    <div class="c-12 c-m-6 answer" id="f1"></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Result: 
                        </div>
                            <div class="c-12 c-m-6 answer" id=f2></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Units:
                        </div>
                            <div class="c-12 c-m-6 answer" id="f3"></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Range: 
                        </div>
                            <div class="c-12 c-m-6 answer" id="f4"></div>
                    </div>
                    <!-- <div class="row">
                        <div class="c-12 c-m-6">
                            Field 5: 
                        </div>
                            <div class="c-12 c-m-6 answer" id="f5"></div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="deleteRep">Delete</button>
                <button type="button" class="btn btnNormal" id="updateRep">Edit</button>
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Report-->

<!-- The Modal for Update Report-->
<div id="modalUpdateRep" class="modal modal2">

<!-- Modal content -->
<div class="modal-content-short2 inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
<form method="POST" id="repUpForm">
    <input type="hidden" value="" id="repUpID" name="repUpID">
   <div class="detailsSection">
   <div class="alerMSG" id="updateStatus"></div>
        <div class="row">
            <div class="c-12">
                <h2>Update Report Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Type: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpType" id="repUpType" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Field 1: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpFi1" id="repUpFi1" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Field 2: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpFi2" id="repUpFi2" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Field 3: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpFi3" id="repUpFi3" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Field 4: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpFi4" id="repUpFi4" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Field 5: 
            </div>
            <div class="c-12 c-m-9">
                <input type="text" class="input-field" style="width:100%; display:inline;" name="repUpFi5" id="repUpFi5" placeholder="" required>
            </div>
        </div>
   </div>
   <div class="bottomModel">
        <div class="row">
            <div class="c-12">
                <button type="button" class="btn btnNormal medCancel" id="updateRepCancel">Cancel</button> 
                <button type="submit" class="btn btnNormal" id="updateRepSave">Save</button> 
            </div>
        </div>
   </div>
</form>
</div>
</div>
<!-- End of the Modal for Update Report-->

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
