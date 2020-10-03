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
                <p class="accountName2">Patient Name</p>
                
            </div>
            <div class="c-6"><a href="../"><button type="button" class="btn btnNormal btnPatient" name="editProfile" id="editProfile"><i class="fas fa-sign-out-alt"></i> Edit Profile</button></a></div>
            <div class="c-6"><a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Patient/prescriptions.php" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">View Prescriptions</a>
        <a href="../Patient/labReports.php" class="sideLink ';if($type=="labRep"){echo 'active';} echo'">View Lab Reports</a>
        <a href="../Patient/docStatus.php" class="sideLink ';if($type=="docStatus"){echo 'active';} echo'">View Doctor Status</a>
    </div>';
}
?>
