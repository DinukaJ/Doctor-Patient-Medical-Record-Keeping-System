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
            <?php getSideNav("viewLab")?>
               <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
                    <div class="upperPart">
                            <div class="upperFirst row">
                                <div class="c-l-4">
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
                            Field 1: 
                    </div>
                    <div class="c-12 c-m-6 answer" id="f1"></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Field 2: 
                        </div>
                            <div class="c-12 c-m-6 answer" id=f2></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Field 3:
                        </div>
                            <div class="c-12 c-m-6 answer" id="f3"></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Field 4: 
                        </div>
                            <div class="c-12 c-m-6 answer" id="f4"></div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-6">
                            Field 5: 
                        </div>
                            <div class="c-12 c-m-6 answer" id="f5"></div>
                    </div>
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

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    
    <script src="../js/searchRep.js"></script>
    <script>
        // Get the modal Reports
        var modalViewRep = document.getElementById("modalViewRep");

        $(document).ready(function(){

            $(".close").click(()=>{
                close(modalViewRep);
            });
        });
 
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalViewRep) {
            // modalAddMed.style.display = "none";
                close(modalViewRep);
            }
    }
    </script>
</body>
</html>
