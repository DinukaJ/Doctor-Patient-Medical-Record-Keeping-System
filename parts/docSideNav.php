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
            <div class="c-6"><a href="../"><button type="button" class="btn btnNormal btnPatient" name="editProfile" id="editProfile"><i class="fas fa-user-edit"></i> Edit Profile</button></a></div>
            <div class="c-6"><a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Doctor/prescribe.php" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">Prescribe</a>
        <a href="../Doctor/viewPatients.php" class="sideLink ';if($type=="patients"){echo 'active';} echo'">View Patients</a>
        <a href="../Doctor/viewInventory.php" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">View Inventory</a>
        <a href="../Doctor/viewFinancial.php" class="sideLink ';if($type=="financial"){echo 'active';} echo'">View Financial Records</a>
    </div>';
}
?>
