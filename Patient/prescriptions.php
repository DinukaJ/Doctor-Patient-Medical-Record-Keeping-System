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
<div id="modalUpdateDet" class="modal modal2">

<!-- Modal content -->
<div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
<form method="POST" id="usrDetailUp">
   <div class="detailsSection">
   <div class="alerMSG" id="updateStatus"></div>
        <div class="row">
            <div class="c-12 c-m-2">
                First Name: 
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="firstName" id="firstName" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Last Name: 
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="lastName" id="lastName" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Phone: 
            </div>
            <div class="c-12 c-m-10">
                <input type="number" class="input-field" style="width:49%; display:inline;" name="phone" id="phone" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Age: 
            </div>
            <div class="c-12 c-m-10">
                <input type="number" class="input-field" style="width:49%; display:inline;" name="age" id="age" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Address: 
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="address" id="address" placeholder="" required>
            </div>
        </div>
   </div>
   <div class="bottomModel">
        <div class="row">
        <div class="c-12 c-l-6" style="text-align:left">
            <button type="button" class="btn btnNormal changePass" id="changePass">Change Password</button> 
        </div>
            <div class="c-12 c-l-6">
                <button type="button" class="btn btnNormal upCancel" id="upCancel">Cancel</button> 
                <button type="submit" class="btn btnNormal" id="updateDetSave">Save</button> 
            </div>
        </div>
   </div>
</form>
</div>
</div>
<!-- End of the Modal for Update User Details-->

<!-- The Modal for Update User Password-->
<div id="modalUpdatePass" class="modal modal2">

<!-- Modal content -->
<div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
<form method="POST" id="usrPassUp">
   <div class="detailsSection">
   <div class="alerMSG" id="updateStatus"></div>
        <div class="row">
            <div class="c-12 c-m-2">
                Current Password: 
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="curPass" id="curPass" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                New Password: 
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="newPass" id="newPass" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="c-12 c-m-2">
                Re-Type New:
            </div>
            <div class="c-12 c-m-10">
                <input type="text" class="input-field" style="width:49%; display:inline;" name="newRePass" id="newRePass" placeholder="" required>
            </div>
        </div>
   </div>
   <div class="bottomModel">
        <div class="row">
            <div class="c-12">
                <button type="button" class="btn btnNormal upPassCancel" id="upPassCancel">Cancel</button> 
                <button type="submit" class="btn btnNormal" id="updatePass">Change</button> 
            </div>
        </div>
   </div>
</form>
</div>
</div>
<!-- End of the Modal for Update User Password-->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
    var modalUpdateDet = document.getElementById("modalUpdateDet");
    var modalUpdatePass = document.getElementById("modalUpdatePass");
       
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
              $(modalUpdateDet).slideUp();
        }
        }

        $(document).ready(function(){
            getAllPres();
            $('.close').click(()=>{
                close(modalUpdateDet);
                close(modalUpdatePass);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
            $('#upPassCancel').click(()=>{
                close(modalUpdatePass);
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

                    $('#changePass').click(()=>{
                        open(modalUpdatePass);
                    })
                }
            });
        });


    </script>

</body>
</html>