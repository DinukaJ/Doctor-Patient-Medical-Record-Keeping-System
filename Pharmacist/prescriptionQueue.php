<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/pharmSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient = new patient();
    $pres=new prescription();
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

    <title>Prescription Queue</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("presQueue")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart3">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-3">
                             <div class="boxSmall">
                                 <label>Prescription No.</label>
                             </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                 <label>No. of Items</label>
                            </div>
                        </div>
                        <div class="c-12 c-l-6">
                            <div class="boxSmall">
                                <label>No. of Prescriptions in Queue:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-3">
                        1
                    </div>
                    <div class="c-8">
                        1
                    </div>
                    <div class="c-1">
                        <button type="button" class="btn btnPatientView" id="viewPres">View</button>
                    </div>
                </div>
                <?php
                // $res=$patient->getPatients();
                // $i=1;
                // while($row=mysqli_fetch_assoc($res))
                // {
                //     echo '
                //     <div class="row patientDataRow">
                //         <div class="c-11">
                //             '.$i.'. '.$row['fname'].' '.$row['lname'].'
                //         </div>
                //         <div class="c-1">
                //             <button type="submit" class="btn btnPatientView" name="viewPatient" id="viewPatient">View</button>
                //         </div>
                //     </div>
                //     ';
                //     $i++;
                // }
                ?>           
            </div>
        </div>
    </div>
    <!-- The Modal for View Prescription-->
    <div id="modalViewPres" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-long">
            <div class="row">
                <div class="col-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
           <div class="detailsSection">
                <div class="row">
                <div class="c-12 c-m-2">
                    </div>
                    <div class="c-12 c-m-2">
                        Medicine Name 
                    </div>
                    <div class="c-12 c-m-2">
                        Amount Per Time 
                    </div>
                    <div class="c-12 c-m-2">
                        Times Per Day 
                    </div>
                    <div class="c-12 c-m-2">
                        Before/ After Meal
                    </div>                    
                    <div class="c-12 c-m-2">
                        Duration 
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-3 c-m-2">
                        1
                    </div>   
                    <div class="c-3 c-m-2">
                        1
                    </div>
                    <div class="c-8 c-m-2">
                        1
                    </div>
                    <div class="c-8 c-m-2">
                        1
                    </div>
                    <div class="c-8 c-m-2">
                        1
                    </div>
                    <div class="c-8 c-m-2">
                        1
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal" id="presPrint">Print</button> 
                        <button type="button" class="btn btnNormal" id="billCreate">Create Bill</button> 
                    </div>
                </div>
           </div>
        </div>
    </div>
    <!-- End of the Modal for View Prescription-->


<!-- The Modal for Bill-->
        <div id="modalBill" class="modal modal2">

<!-- Modal content -->
<div class="modal-content-long">
    <div class="row">
        <div class="col-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
        <div class="c-12 c-m-2">
            </div>
            <div class="c-12 c-m-3">
                Medicine Name 
            </div>
            <div class="c-12 c-m-3">
                Price
            </div>
        </div>
        <div class="row patientDataRow">
            <div class="c-3 c-m-2">
                1
            </div>   
            <div class="c-3 c-m-2">
                1
            </div>
        </div>
   </div>
   <div class="row">
        Total Amount:
   </div>
   <div class="bottomModel">
        <div class="row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="endBill">Print & End Bill</button> 
            </div>
        </div>
   </div>
</div>
</div>
<!-- End of the Modal for Bill-->

    <!-- The Modal -->
    <!-- <div id="myModal" class="modal">

        <div class="modal-content container">
        <span class="close">&times;</span>
           
        </div>

    </div> -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the Prescription view modal
       var modal = document.getElementById("modalViewPres");
        
        //open and closing functions
        function open(modal) {
            modal.style.display = "block";
        }
        function close(modal){
            modal.style.display = "none";
        }

        $(document).ready(function(){
            //click on view
            $("#viewPres").click(()=>{
                open(modalViewPres);
            });
            $(".close").click(()=>{
                close(modalViewPres);
            })
        })
        
        //Model Bill
        var modal = document.getElementById("modalBill");
        
        //open and closing functions
        function open(modal) {
            modal.style.display = "block";
        }
        function close(modal){
            modal.style.display = "none";
        }

        $(document).ready(function(){
            //click on view
            $("#billCreate").click(()=>{
                open(modalBill);
            });
            $(".close").click(()=>{
                close(modalBill);
            })
            $("#endBill").click(()=>{
                close(modalBill);
            })
        })
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    </script>
</body>
</html>