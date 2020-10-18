<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId = "pat45";
if(isset($_SESSION["user"]))
{
    $patient = new patient();
    $pres=new prescription();
}
else
{
    //header("Location: ../login.php");
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
                <div class="upperPart3">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                             <div class="boxSmall">
                                 <label>Doctor</label>
                             </div>
                        </div>
                        <div class="c-12 c-l-4">
                             <div class="boxSmall" style="text-align:center">
                                 <label>Prescription No.</label>
                            </div>
                        </div>
                        <div class="c-12 c-l-1"></div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>No. of Prescriptions:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
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


 <!-- The Modal for View Prescriptions-->
 <div id="modalViewPres" class="modal modal2">

<!-- Modal content -->
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
    <div class="row">
        <div class="c-12 c-m-4">
            <b>Doctor Name: </b><span id="docName"></span>
        </div>
        <div class="c-12 c-m-4">
            <b>Date: </b><span id="presDate"></span>
        </div>           
        <div class="c-12 c-m-4">
            <b>Prescription No: </b><span id="presNo"></span>
         </div>
    </div>
    <div class="row" style="border-bottom:1px solid #ced4da;">
        <div class="c-m-1"></div>
        <div class="c-12 c-m-2">
            <b>Medicine Name:</b>
         </div>
        <div class="c-12 c-m-2">
            <b>Amount Per Day</b>
        </div> 
        <div class="c-12 c-m-2">
            <b>Times Per Day</b>
        </div> 
        <div class="c-12 c-m-2">
            <b>Before/After</b>
        </div> 
        <div class="c-12 c-m-2">
            <b>Duration</b>
        </div> 
        <div class="c-m-1"></div> 
    </div>
   <div class="presMedDet" id="presMedDet"></div>
        <!-- <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="viewCancel">Cancel</button>
            </div>
        </div> -->
    </div> 
 </div>
</div>
<!-- End of the Modal for View Prescriptions-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script>
    var modalViewPres = document.getElementById("modalViewPres");
        $(document).ready(function(){
            getAllPres();
            $('.close').click(()=>{
                close($(this).parent());
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
                success:function(data){
                    $('#presInfo').html(data);
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