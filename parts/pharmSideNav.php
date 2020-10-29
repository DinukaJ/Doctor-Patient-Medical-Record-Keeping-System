<?php
function getSideNav($type)
{
    echo '
    <div class="c-12 c-l-2 sidePanel">
        <div class="row account">
            <div class="c-6">
                <img src="../images/acc.png" width="80%">
            </div>
            <div class="c-6">
                <p class="accountName">Pharmacist</p>
                <a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
            </div>
        </div>
        <a href="../Pharmacist/prescriptionQueue.php" class="sideLink ';if($type=="presQueue"){echo 'active';} echo'">Prescription Queue</a>
        <a href="../Pharmacist/prescriptions.php" class="sideLink ';if($type=="prescriptions"){echo 'active';} echo'">Prescriptions</a>
        <a href="../Pharmacist/inventory.php" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">Inventory</a>
    </div>';
}
?>

