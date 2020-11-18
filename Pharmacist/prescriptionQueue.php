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

    <title>Prescription Queue</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("presQueue")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Prescription Queue</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-12">
                            <div class="boxSmall">
                                <label>No. of Prescriptions in Queue: 10<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='medicId'>Prescription No</div>
                    <div class='c-4' class='medicName'>Patient Name</div>
                    <div class='c-4' class='medicQty'>Item Count</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div class="row patientDataRow">
                    <div class="c-3">
                        1
                    </div>
                    <div class="c-4">
                        Pasindu Dissanayake
                    </div>
                    <div class="c-4">
                        10
                    </div>
                    <div class="c-1">
                        <button type="button" class="btn btnPatientView viewPres" id="viewPres">View</button>
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
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
            <div class="c-12">
                <h2>Prescription Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Prescription ID: <span class="answer" id="predId">1</span>
            </div>
            <div class="c-12 c-m-2">
                Patient ID: <span class="answer" id="patientId">p-1</span>
            </div>
            <div class="c-12 c-m-4">
                Patient Name: <span class="answer" id="patientName">Pasindu Dissanayake</span>
            </div>
            <div class="c-12 c-m-3">
                Date: <span class="answer" id="doi">2020-11-17</span>
            </div>
            <div class="c-12"><hr></div>
        </div>  
        <div class="row">
            <div class="c-4 c-m-3">
                <b>Med Name</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Amount Per Time</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Times Per Day</b>
            </div>
            <div class="c-4 c-m-2">
                <b>Before / After Meal</b>
            </div>
            <div class="c-4 c-m-3">
                <b>Duration</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="presVals">
            <div class="row">
                <div class="c-4 c-m-3">
                    Amoxicillin
                </div>
                <div class="c-4 c-m-2">
                    2
                </div>
                <div class="c-4 c-m-2">
                    3
                </div>
                <div class="c-4 c-m-2">
                    After
                </div>
                <div class="c-4 c-m-3">
                    1 Week(s)
                </div>
            </div>
        </div>    
        </div>
        <div class ="bottomModel row">
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
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
            <div class="c-12">
                <h2>Bill</h2>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-3">
                Prescription ID: <span class="answer" id="predId">1</span>
            </div>
            <div class="c-12 c-m-2">
                Patient ID: <span class="answer" id="patientId">p-1</span>
            </div>
            <div class="c-12 c-m-4">
                Patient Name: <span class="answer" id="patientName">Pasindu Dissanayake</span>
            </div>
            <div class="c-12 c-m-3">
                Date: <span class="answer" id="doi">2020-11-17</span>
            </div>
            <div class="c-12"><hr></div>
        </div>  
        <div class="row">
            <div class="c-4 c-m-4">
                <b>Med Name</b>
            </div>
            <div class="c-4 c-m-4">
                <b>QTY</b>
            </div>
            <div class="c-4 c-m-4">
                <b>Price</b>
            </div>
            <div class="c-12"><hr></div>
        </div>
        <div id="billVals">
            <div class="row">
                <div class="c-4 c-m-4">
                    Amoxicillin
                </div>
                <div class="c-4 c-m-4">
                    20
                </div>
                <div class="c-4 c-m-4">
                    250
                </div>
            </div>
        </div>  
        <div class="row" style="margin-top:50px;">
            <div class="c-12"><hr></div>
            <div class="c-12">
                <b>Total Amount:- <span id="totalAmount">Rs.250</span></b>
            </div>
            <div class="c-12"><hr></div>
        </div>  
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="endBill" style="width:auto;">Print & End Bill</button>  
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for Bill-->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the Prescription view modal
       var modal = document.getElementById("modalViewPres");
        //Model Bill
       var modal = document.getElementById("modalBill");

        $(document).ready(function(){
            //click on view
            $(".viewPres").click(()=>{
                open(modalViewPres);
            });
            $(".close").click(()=>{
                close(modalViewPres);
                close(modalBill);
            })
            $("#billCreate").click(()=>{
                close(modalViewPres);
                open(modalBill);
            });
            $("#endBill").click(()=>{
                close(modalBill);
            })
        })

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modalViewPres) {
            // modal.style.display = "none";
                $(modalViewPres).slideUp();
            }
        if (event.target == modalBill) {
            // modal.style.display = "none";
                $(modalBill).slideUp();
            }
        }
    </script>
</body>
</html>