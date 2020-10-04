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
                <p class="accountName2">Pharmacist Name</p>
                
            </div>
            <div class="c-6"><a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Doctor/prescribe.php" class="sideLink ';if($type=="presQueue"){echo 'active';} echo'">Prescription Queue</a>
        <a href="../Doctor/viewPatients.php" class="sideLink ';if($type=="prescriptions"){echo 'active';} echo'">Prescriptions</a>
        <a href="../Doctor/viewInventory.php" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">Inventory</a>
    </div>';
}
?>