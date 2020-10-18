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

<!-- The Modal for Update User Details-->
<div id="modalUpdateDet" class="modal modal2" style="padding-top:40px">

<!-- Modal content -->
<div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>

   <div class="detailsSection editProfile">
   <div class="alerMSG" id="updateStatusInfo"></div>
    <div class="row">
        <div class="c-12 c-m-6">
            <form method="POST" id="usrDetailUp">
            <input id="patientID" type="hidden" name="patientID" value="<?php echo "$patId"?>">
            <h2>Change User Details</h2>
            <div class="row">
                <div class="c-12 c-m-5">
                    First Name: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="firstName" id="firstName" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Last Name: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="lastName" id="lastName" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Phone: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="number" class="input-field popUpInputs" name="phone" id="phone" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Age: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="number" class="input-field popUpInputs" name="age" id="age" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Address: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="address" id="address" placeholder="" required>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
              
                </div>
                <div class="c-12 c-m-7">
                    <button type="button" class="btn btnNormal btnUp" id="upData">Update Details</button>
                </div>
            </div>
            </form>
        </div>
        <div class="c-12 c-m-6">
            <div class="row">
                <div class="c-12">
                    <form method="POST" id="usrPassUp">
                    <input id="patientID" type="hidden" name="patientID" value="<?php echo "$patId"?>">
                    <h2>Change Profile Picture</h2>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            Select Profile Picture: <br>
                            <img src="../images/acc.png" class="accPic" width="20%">
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="file" class="input-field popUpInputs" name="profilePic" id="profilePic" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                    
                        </div>
                        <div class="c-12 c-m-7">
                            <button type="button" class="btn btnNormal btnUp" id="updatePicture">Update Picture</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    <form method="POST" id="usrPassUp">
                    <input id="patientID" type="hidden" name="patientID" value="<?php echo "$patId"?>">
                    <h2>Change Password</h2>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            New Password: 
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="password" class="input-field popUpInputs" name="firstName" id="firstName" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            Confirm New Password: 
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="password" class="input-field popUpInputs" name="lastName" id="lastName" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                    
                        </div>
                        <div class="c-12 c-m-7">
                            <button type="button" class="btn btnNormal btnUp" id="updatePass">Update Password</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
   <div class="bottomModel">
        <div class="row">
        <div class="c-12 c-l-6" style="text-align:left">
        </div>
            <div class="c-12 c-l-6">
                <button type="button" class="btn btnNormal upCancel" id="upCancel">Cancel</button> 
            </div>
        </div>
   </div>

</div>
</div>
<!-- End of the Modal for Update User Details-->

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
        <div class="c-12 c-m-3">
            <b>Doctor Name:</b>
        </div>
         <div class="c-12 c-m-3" id="docName"></div>
        <div class="c-12 c-m-3">
        <b>Date:</b>
        </div>
         <div class="c-12 c-m-3" id="presDate"></div>            
    </div>
    <div class="row">
        <div class="c-12 c-m-3">
            <b>Prescription No:</b>
         </div>
        <div class="c-12 c-m-3" id="presNo"></div>  
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
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal" id="viewCancel">Cancel</button>
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Prescriptions-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
    var modalUpdateDet = document.getElementById("modalUpdateDet");
    var modalViewPres = document.getElementById("modalViewPres");
       
        function open(modal) {
            //modal.style.display = "block";
            $(modal).slideDown();
        }
        function close(modal){
            // modal.style.display = "none";
            $(modal).slideUp();
        } 
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

        $(document).ready(function(){
            getAllPres();
            $('.close').click(()=>{
                close(modalUpdateDet);
                close(modalViewPres);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
            $('#viewCancel').click(()=>{
                close(modalViewPres);
            })
        });

        function getAllPres(){
            var patID = "<?php echo "$patId"?>";
            $.ajax({
                url:"../handlers/patientHandler.php",
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

        $('#editProfile').click(()=>{
            var patID = "<?php echo "$patId"?>";
            open(modalUpdateDet);
            $.ajax({
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:{patientID:patID,type:'patientData'},
                dataType:'json',
                success:function(data){
                    $('#firstName').val(data['fname']);
                    $('#lastName').val(data['lname']);
                    $('#phone').val(data['phone']);
                    $('#age').val(data['age']);
                    $('#address').val(data['address']);

                }
            });
        });

        $('#usrDetailUp').on('submit',function(e){
            var patID = "<?php echo "$patId"?>";
            e.preventDefault();
            
            $.ajax({
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:$('#usrDetailUp').serialize()+"&type=upDet",
                success:function(data){
                    if(data==1){
                        $('#updateStatusInfo').addClass("success");
                        $('#updateStatusInfo').html("Successfully Updated!");
                        $('#updateStatusInfo').slideDown("slow");
                        setTimeout(function(){
                            $('#updateStatusInfo').slideUp("slow");
                        },2000);
                    }
                    else{
                        $('#updateStatusInfo').addClass("error");
                        $('#updateStatusInfo').html("Update Failed!");
                        $('#updateStatusInfo').slideDown("slow");
                        setTimeout(function(){
                            $('#updateStatusInfo').slideUp("slow");
                        },2000);
            }
                }
            });
        });

        function getPresInfo(id){
            presId = id.split("-");
            presId = presId[1];
            $.ajax({
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:{presID:presId,type:'presInfo'},
                success:function(data){
                    $("#presMedDet").html(data);
                }
            });
        }
    </script>

</body>
</html>