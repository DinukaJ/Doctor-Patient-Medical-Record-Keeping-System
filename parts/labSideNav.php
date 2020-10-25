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
                <p class="accountName2">Lab Person</p>
                
            </div>
            <div class="c-6"><a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></a></div>
        </div>
        <a href="../Lab/addLab.php" class="sideLink ';if($type=="addLab"){echo 'active';} echo'">Add Lab Reports</a>
        <a href="../Lab/viewLab.php" class="sideLink ';if($type=="viewLab"){echo 'active';} echo'">View Lab Reports</a>
    </div>';
}
?>
