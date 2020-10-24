<?php
function getSideNav($type)
{
    echo '
    <div class="c-12 c-l-2 sidePanel">
        <div class="row account2">
            <div class="c-6">
                <img src="../images/acc.png" width="80%">
            </div>
            <div class="c-6">
                <p class="accountName2">Doctor Name</p>
                
            </div>
            <div class="c-6"><button type="button" class="btn btnNormal btnPatient" name="editProfile" id="editProfile"><i class="fas fa-user-edit"></i> Edit Profile</button></div>
            <div class="c-6"><a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Doctor/prescribe.php" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">Prescribe</a>
        <a href="../Doctor/viewPatients.php" class="sideLink ';if($type=="patients"){echo 'active';} echo'">View Patients</a>
        <a href="../Doctor/viewInventory.php" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">View Inventory</a>
        <a href="../Doctor/viewFinancial.php" class="sideLink ';if($type=="financial"){echo 'active';} echo'">View Financial Records</a>
    </div>';
}
function getEditProfile($doctor)
{
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
            <form method="POST" id="usrDetailUp">
            <h2>Change User Details</h2>
            <div class="row" style="padding:0px; margin:0px;">
                <div class="c-12" style="padding:0px; margin:0px;">
                    <div class="alerMSG" id="updateStatusInfo"></div>
                </div>
            </div>
            <div class="row">
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
