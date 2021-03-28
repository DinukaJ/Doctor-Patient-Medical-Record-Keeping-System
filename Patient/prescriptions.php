<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId ="";//"p-1";
$patient="";
if(isset($_SESSION["user"]))
{
    $patient=unserialize($_SESSION['user']);
    $patId=$patient->getUserId();
}
else
{
    header("Location: ../login.php");
}
echo"<input type='hidden' value='$patId' id='patientID'>";
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
            <?php getSideNav("prescribe")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                        <button class="menuBtn" id="menuBtn"><i class="fas fa-bars"></i></button><h1 style="margin-top:5px;display:inline;">Prescriptions</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>No. of Prescriptions: <span id="noOfPres"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-4 c-m-3' class='medicId'>Prescription ID</div>
                    <div class='c-3 c-m-4' class='medicName'>Doctor Name</div>
                    <div class='c-2' class='medicQty'>Item Count</div>
                    <div class='c-2' class='medicQty'>Date</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
              <div id="presInfo"></div>
        
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <?php getEditProfile($patient)?>
    <!-- End of Edit Profile View -->

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
        <div class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
            <div class="c-12 c-m-4">
                Prescription ID: <span class="answer" id="presId"></span>
            </div>
            <div class="c-12 c-m-4">
                Doctor Name: <span class="answer" id="docName"></span>
            </div>
            <div class="c-12 c-m-4">
                Date: <span class="answer" id="doi"></span>
            </div>
        </div>  
        <div class="row addMedicineRow" id="commentRowPres" style="padding:5px; margin-left:0px; margin-right:0px;">
            <div class="c-12">
                Comment: <span class="answer" id="commentPres"></span>
            </div>
        </div>  

        <div class="row patientDataRow" style="border-bottom:none;">
            <div class="c-12 tableCont2" style="padding-left:0px; padding-right:0px;">
                <table style="width:100%; font-size:0.8em !important;" class="presTable addMedicineRow id="reportTable">
                    <tr style="height:20px;">
                        <th style="width:2%">No</th>
                        <th style="width:23%">Name</th>
                        <th style="width:12%; text-align:center;">Amount Per Time</th>
                        <th style="width:12%; text-align:center;">Times Per Day</th>
                        <th style="width:14%; text-align:center;">After/Before Meal</th>
                        <th style="width:12%; text-align:center;">Duration</th>
                    </tr>
                </table>
                <table id="presVals" style="width:100%; font-size:0.8em !important;" class="presTable" id="reportTable">

                </table>
            </div>
        </div>    
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="closePres">Close</button> 
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Prescription-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
    var modalViewPres = document.getElementById("modalViewPres");
        $(document).ready(function(){
            getAllPres();
            $('.close').click(()=>{
                close(modalUpdateDet);
                close(modalViewPres);
            })
            $('#closePres').click(()=>{
                close(modalViewPres);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
            $('#viewCancel').click(()=>{
                close(modalViewPres);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalViewPres) {
                    // modalUpdateDet.style.display = "none";
                    close(modalViewPres);
            }
        }
        function getAllPres(){
            var patID = "<?php echo "$patId"?>";
            $.ajax({
                url:"../handlers/prescriptionHandler.php",
                method:"POST",
                data:{patientID:patID,type:'getPres'},
                dataType:'json',
                success:function(data){
                    $('#presInfo').html(data[0]);
                    $('#noOfPres').html(data[1]);
                    $('.viewPres').click(function(){
                        open(modalViewPres);
                        getPresInfo($(this));
                    });
                }
            });
        }
        function getPresInfo(btn){
            // presId = id.split("-");
            // presId = presId[1];
            // $.ajax({
            //     url:"../handlers/prescriptionHandler.php",
            //     method:"POST",
            //     data:{presID:presId,type:'presInfo'},
            //     dataType:'JSON',
            //     success:function(data){
            //         $("#presMedDet").html(data[0]);
            //         $("#presNo").html(presId);
            //         $("#docName").html(data[1]);
            //         $("#presDate").html(data[2]);
            //     }
            // });
            id = $(btn).attr("presId");
            patId = $(btn).attr("patId");
            patName = $(btn).attr("patName");
            day = $(btn).attr("day");
            docName=$(btn).attr("docName");
            if($(btn).attr("note")!="")
            {
                $("#commentRowPres").show();
                $("#commentPres").html($(btn).attr("note"));
            }
            else
            {
                $("#commentRowPres").hide();
            }
            $.ajax({
                url:"../handlers/prescriptionHandler.php",
                method:"POST",
                data:{type:'getPresDataTable',presID:id},
                success:function(data){
                    $("#presVals").html(data);
                    $("#presId").html(id);
                    $("#docName").html(docName);
                    $("#doi").html(day);
                    open(modalViewPres);
                }
            });
        }
    </script>

</body>
</html>