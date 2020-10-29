<?php
function getSideNav($type)
{
    echo '
    <div class="c-12 c-l-2 sidePanel">
        <div class="row account">
            <div class="c-5">
                <img src="../images/acc.png" width="80%">
            </div>
            <div class="c-7">
                <p class="accountName">Receptionist</p>
                <a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
            </div>
        </div>
        <a href="" class="sideLink ';if($type=="patient"){echo 'active';} echo'">Patients</a>
        <a href="" class="sideLink ';if($type=="doctor"){echo 'active';} echo'">Doctors</a>
    </div>';
}
?>
