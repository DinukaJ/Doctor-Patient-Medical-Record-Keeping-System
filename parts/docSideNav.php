<?php
function getSideNav($type)
{
    $user=unserialize($_SESSION['user']);
    $name=/*"Doctor Name";*/$user->getFname().' '.$user->getLName();
    $dp="acc.png";
    $docType=$user->getDocType();
    if($user->getDP())
        $dp=$user->getDP();
    
    if($user->getVS()=="-1")
    {
        echo '<div class="c-12 error"><center>Please Verify the Email by Clicking the Link in the Email!</center></div>';
    }
    echo '
    <div class="c-12 c-l-2 sidePanel">
        <div class="row account2">
            <div class="c-5 dp">
                <img src="../images/'.$dp.'" width="80%">
            </div>
            <div class="c-7 name">
                <p class="accountName2">'.$name.'</p>
                
            </div>
            <div class="c-6 usrBtns"><button type="button" class="btn btnNormal btnPatient" name="editProfile" id="editProfile"><i class="fas fa-user-edit"></i> Edit Profile</button></div>
            <div class="c-6 usrBtns"><a href="../logout.php?uType=admin"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Doctor/prescribe.php" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">Prescribe</a>
        <a href="../Doctor/viewPatients.php" class="sideLink ';if($type=="patients"){echo 'active';} echo'">Patients</a>';
        if($docType=='1')
        {
            echo '<a href="../Doctor/viewInventory.php" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">Inventory</a>';
        }
        echo '<a href="../Doctor/viewFinancial.php" class="sideLink ';if($type=="financial"){echo 'active';} echo'">Financial Records</a>
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
function getFullPatientData()
{
    echo'
    <!-- The Modal for Update User Details-->
<div id="patientFullData" class="modal modal2" style="padding-top:40px">

<!-- Modal content -->
<div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>

   <div class="detailsSection editProfile" style="padding-bottom:0px">
    <div class="row">
        <div class="c-12 c-m-4">
            <h2>Patient Details</h2>
            <div class="row">
                <div class="c-12">
                    First Name: <b><span id="pfirstName"></span></b>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    Last Name: <b><span id="plastName"></span></b>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    Phone: <b><span id="pphone"></span></b>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    Age: <b><span id="age"></span></b>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    Address: <b><span id="address"></span></b>
                </div>
            </div>
            <div class="row">
                <div class="c-12">
                    <button type="button" class="btn btnAddPres medData viewPatientPrescription" style="margin-top:18px;" name="viewPatientPrescription2" id="viewPatientPrescription2"><i class="fas fa-prescription-bottle"></i> View Prescriptions</button>
                    <button type="button" class="btn btnAddPres medData viewPatientReport" style="margin-top:18px;" name="viewPatientReports2" id="viewPatientReports2"><i class="fas fa-file-medical-alt"></i> View Reports</button>
                </div>
            </div>
        </div>
        <div class="c-12 c-m-8">
            <div class="row">
                <div class="c-12 c-l-6">
                    <h2>Allergies</h2>
                    <div class="row" style="padding:0px; margin:0px;">
                        <div class="c-12" style="padding:0px; margin:0px;">
                            <div class="alerMSG" id="allergyStatus"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-11" style="padding-right:4px">
                            <input type="text" class="input-field fullWidth" id="newAllergy" placeholder="Enter New Allergy">
                        </div>
                        <div class="c-1" style="padding:0px">
                        <button type="button" class="btn btnAddPres" style="padding:0px;" name="addAllergy" id="addAllergy"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12" style="padding-right:0px;">
                            <div class="scrollBox" id="allergyBox">
                                <div class="row allergyRow">
                                    <div class="c-11" style="padding-right:0px;">
                                        Allergy 1
                                    </div>
                                    <div class="c-1" style="padding-left:2px;">
                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                    </div>
                                </div> 
                                <div class="row allergyRow">
                                    <div class="c-11" style="padding-right:0px;">
                                        Allergy 2
                                    </div>
                                    <div class="c-1" style="padding-left:2px;">
                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-12 c-l-6">
                    <h2>Important Notes</h2>
                    <div class="row" style="padding:0px; margin:0px;">
                        <div class="c-12" style="padding:0px; margin:0px;">
                            <div class="alerMSG" id="impStatus"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-11" style="padding-right:4px">
                            <input type="text" class="input-field fullWidth" id="newImp" placeholder="Enter New Note">
                        </div>
                        <div class="c-1" style="padding:0px">
                        <button type="button" class="btn btnAddPres" style="padding:0px;" name="addImportantNote" id="addImportantNote"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="c-12" style="padding-right:0px;">
                            <div class="scrollBox" id="impBox">
                                <div class="row allergyRow">
                                    <div class="c-11" style="padding-right:0px;">
                                        Note 1
                                    </div>
                                    <div class="c-1" style="padding-left:2px;">
                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                    </div>
                                </div> 
                                <div class="row allergyRow">
                                    <div class="c-11" style="padding-right:0px;">
                                        Note 2
                                    </div>
                                    <div class="c-1" style="padding-left:2px;">
                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
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
                <button type="button" class="btn btnNormal upCancel btnCancel" id="patClose">Close</button> 
            </div>
        </div>
   </div>

</div>
</div>
<!-- End of the Modal for Update User Details-->
    ';

}
function getPatientPrescriptions()
{
    echo'
    <!-- The Modal for Update User Details-->
<div id="patientPrescription" class="modal modal2" style="padding-top:40px">

<!-- Modal content -->
<div class="modal-content-long inventoryModal" style="padding-bottom:5px;">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>

   <div class="detailsSection editProfile" style="padding-bottom:0px">
   <div class="row">
        <div class="c-12">
            <h2 style="margin:0px;">Prescriptions</h2>
        </div>
   </div>
    <div class="row">
        <div class="c-12 c-m-3">
            <div class="scrollBox2" id="presList">
                <div class="row patientDataRow2 active">
                    <div class="c-12" style="padding-right:0px;">
                        <b>ID: </b><span>124</span><br>
                        <b>Date: </b><span>2020/11/5</span><br>
                    </div>
                </div> 
                <div class="row patientDataRow2">
                    <div class="c-12" style="padding-right:0px;">
                        <b>ID: </b><span>123</span><br>
                        <b>Date: </b><span>2020/11/1</span><br>
                    </div>
                </div> 
            </div>
        </div>
        <div class="c-12 c-m-9" style="padding-left:0px; padding-right:0px;">
            <div class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-6">
                    <b>Prescription No: <span id="presNo"></span></b>
                </div>
                <div class="c-6">
                    <b>Date: <span id="presDate"></span></b>
                </div>
            </div>
            <div class="row patientDataRow" style="border-bottom:none;">
                <div class="c-12 tableCont2" style="padding-left:0px; padding-right:0px;">
                    <table style="width:100%; font-size:0.8em !important;" class="presTable addMedicineRow" id="presTableDetails">
                        <tr style="height:20px;">
                            <th style="width:2%">No</th>
                            <th style="width:23%">Name</th>
                            <th style="width:12%; text-align:center;">Amount Per Time</th>
                            <th style="width:12%; text-align:center;">Amount Per Day</th>
                            <th style="width:14%; text-align:center;">After/Before Meal</th>
                            <th style="width:12%; text-align:center;">Duration</th>
                        </tr>
                    </table>
                    <table id="patPresData" style="width:100%; font-size:0.8em !important;" class="presTable" id="presTableDetails">
                        
                    </table>
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
                <button type="button" class="btn btnNormal upCancel btnCancel" id="presClose">Close</button> 
            </div>
        </div>
   </div>

</div>
</div>
<!-- End of the Modal for Update User Details-->
    ';

}
function getPatientReports()
{
    echo'
    <!-- The Modal for Update User Details-->
<div id="patientReports" class="modal modal2" style="padding-top:40px">

<!-- Modal content -->
<div class="modal-content-long inventoryModal" style="padding-bottom:5px;">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>

   <div class="detailsSection editProfile" style="padding-bottom:0px">
   <div class="row">
        <div class="c-12">
            <h2 style="margin:0px;">Reports</h2>
        </div>
   </div>
    <div class="row">
        <div class="c-12 c-m-3">
            <div class="scrollBox2" id="reportList">
                <div class="row patientDataRowRep active">
                    <div class="c-12" style="padding-right:0px;">
                        <b>ID: </b><span>124</span><br>
                        <b>Date: </b><span>2020/11/5</span><br>
                    </div>
                </div> 
                <div class="row patientDataRowRep">
                    <div class="c-12" style="padding-right:0px;">
                        <b>ID: </b><span>123</span><br>
                        <b>Date: </b><span>2020/11/1</span><br>
                    </div>
                </div> 
            </div>
        </div>
        <div class="c-12 c-m-9" style="padding-left:0px; padding-right:0px;">
            <div class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-6">
                    <b>Report No: <span id="reportNo"></span></b>
                </div>
                <div class="c-6">
                    <b>Date: <span id="reportDate"></span></b>
                </div>
            </div>
            <div id="commentRow" class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-12">
                    <b>Comment: <span id="comment"></span></b>
                </div>
            </div>
            <div class="row patientDataRow" style="border-bottom:none;">
                <div class="c-12 tableCont2" style="padding-left:0px; padding-right:0px;">
                    <table style="width:100%; font-size:0.8em !important;" class="presTable addMedicineRow id="reportTable">
                        <tr style="height:20px;">
                            <th style="width:30%">Test Name</th>
                            <th style="width:30%">Result</th>
                            <th style="width:30%; text-align:center;">Range</th>
                        </tr>
                    </table>
                    <table id="patReportData" style="width:100%; font-size:0.8em !important;" class="presTable" id="reportTable">
         
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                    </table>
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
                <button type="button" class="btn btnNormal upCancel btnCancel" id="reportClose">Close</button> 
            </div>
        </div>
   </div>

</div>
</div>
<!-- End of the Modal for Update User Details-->
    ';

}
?>
