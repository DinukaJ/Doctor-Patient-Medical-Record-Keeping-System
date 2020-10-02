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
                <p class="accountName">Doctor Name</p>
                <a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
            </div>
        </div>
        <a href="" class="sideLink ';if($type=="prescribe"){echo 'active';} echo'">Prescribe</a>
        <a href="" class="sideLink ';if($type=="patients"){echo 'active';} echo'">View Patients</a>
        <a href="" class="sideLink ';if($type=="inventory"){echo 'active';} echo'">View Inventory</a>
        <a href="" class="sideLink ';if($type=="financial"){echo 'active';} echo'">View Financial Records</a>
    </div>';
}
?>
