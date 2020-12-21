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
                        <h1 style="margin-top:5px">Prescriptions</h1>
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
                    <div class='c-3' class='medicId'>Prescription No</div>
                    <div class='c-4' class='medicName'>Doctor Name</div>
                    <div class='c-2' class='medicQty'>Item Count</div>
                    <div class='c-2' class='medicQty'>Date</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
              <div id="presInfo"></div>
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
        <div class="row">
            <div class="c-12 c-m-3">
                Prescription ID: <span class="answer" id="predId">1</span>
            </div>
            <div class="c-12 c-m-2">
                Patient ID: <span class="answer" id="patientId">p-1</span>
            </div>
            <div class="c-12 c-m-4">
                Doctor Name: <span class="answer" id="patientName">Rukmal Weerasinghe</span>
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
                        getPresInfo(this.id);
                    });
                }
            });
        }
        function getPresInfo(id){
            presId = id.split("-");
            presId = presId[1];
            $.ajax({
                url:"../handlers/prescriptionHandler.php",
                method:"POST",
                data:{presID:presId,type:'presInfo'},
                dataType:'JSON',
                success:function(data){
                    $("#presMedDet").html(data[0]);
                    $("#presNo").html(presId);
                    $("#docName").html(data[1]);
                    $("#presDate").html(data[2]);
                }
            });
        }
    </script>

</body>
</html>