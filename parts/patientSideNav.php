<?php
function getSideNav($type)
{
    $user=unserialize($_SESSION['user']);
    $name=$user->getFname().' '.$user->getLName();
    $dp="acc.png";
    if($user->getDP()!="")
     {  
         $dp=$user->getDP();
     }

     if($user->getVS()=="-1")
     {
         echo '<div class="c-12 error"><center>Please Verify the Email by Clicking the Link in the Email!</center></div>';
     }
    echo '
    <div class="c-12 c-l-2 sidePanel" id="sidePanelCont">
     <div class="sidePanelCont">
        <div class="row closeButtonRow">
            <div class="c-12">
                <button class="sideNavClose" id="sideNavClose"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="row account2">
            <div class="c-5 dp">
                <img src="../images/'.$dp.'" id="dpImg" width="80%">
            </div>
            <div class="c-7 name">
                <p class="accountName2">'.$name.'</p>
                
            </div>
            <div class="c-6 usrBtns"><button type="button" class="btn btnNormal btnPatient" name="editProfilePat" id="editProfilePat"><i class="fas fa-user-edit"></i> Edit Profile</button></div>
            <div class="c-6 usrBtns"><a href="../logout.php?uType=patient"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Patient/prescriptions.php" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">Prescriptions</a>
        <a href="../Patient/labReports.php" class="sideLink ';if($type=="labRep"){echo 'active';} echo'">Lab Reports</a>
        <a href="../Patient/docStatus.php" class="sideLink ';if($type=="docStatus"){echo 'active';} echo'">Doctor Status</a>
    </div>
    </div>';

}
function getEditProfile($patient)
{
    $user=unserialize($_SESSION['user']);
    $dp="acc.png";
    if($user->getDP()!="")
     {  
         $dp=$user->getDP();
     }
    echo'
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
    <div class="row">
        <div class="c-12 c-m-6">
            <form method="POST" id="usrDetailUpPat">
            <h2>Change User Details</h2>
            <div class="row" style="padding:0px; margin:0px;">
                <div class="c-12" style="padding:0px; margin:0px;">
                    <div class="alerMSG" id="updateStatusInfo"></div>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5" style="padding-bottom:25px;">
                    Patient Id: 
                </div>
                <div class="c-12 c-m-7">
                    <span id="patientId"></span>
                </div>
                <div class="c-12 c-m-5">
                    First Name: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="firstName" id="firstName" placeholder="First Name">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Last Name: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="lastName" id="lastName" placeholder="Last Name">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Phone: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="number" class="input-field popUpInputs" name="phone" id="phone" placeholder="07******** / 011*******">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Email: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="email" id="email" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Age: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="number" class="input-field popUpInputs" name="age" id="age" placeholder="Age">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
                    Address: 
                </div>
                <div class="c-12 c-m-7">
                    <input type="text" class="input-field popUpInputs" name="address" id="address" placeholder="Address">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-5">
              
                </div>
                <div class="c-12 c-m-7">
                    <button type="submit" class="btn btnNormal btnUp" id="upData">Update Details</button>
                </div>
            </div>
            </form>
        </div>
        <div class="c-12 c-m-6">
            <div class="row">
                <div class="c-12">
                    <form method="POST" id="usrProfilePic">
                    <h2>Change Profile Picture</h2>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            Select Profile Picture: <br>
                            <img src="../images/'.$dp.'" class="accPic" id="accPicPrev" width="20%">
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="file" class="input-field popUpInputs" name="profilePic" id="profilePic" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                    
                        </div>
                        <div class="c-12 c-m-7">
                            <button type="submit" class="btn btnNormal btnUp" id="updatePicture">Update Picture</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    <form method="POST" id="usrPassUpPat">
                    <h2>Change Password</h2>
                    <div class="row" style="padding:0px; margin:0px;">
                        <div class="c-12" style="padding:0px; margin:0px;">
                            <div class="alerMSG" id="errorMsgPass"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            New Password: 
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="password" class="input-field popUpInputs" name="newPass" id="newPass" placeholder="" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                            Confirm New Password: 
                        </div>
                        <div class="c-12 c-m-7">
                            <input type="password" class="input-field popUpInputs" name="newPassConfirm" id="newPassConfirm" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12 c-m-5">
                    
                        </div>
                        <div class="c-12 c-m-7">
                            <button type="submit" class="btn btnNormal btnUp" id="updatePass">Update Password</button>
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
    ';

}
?>
