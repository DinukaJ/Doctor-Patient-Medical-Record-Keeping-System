<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');
include_once(dirname( dirname(__FILE__) ).'/parts/labSideNav.php');

if(isset($_SESSION["user"]))
{
    $lab = new lab();
}
else
{
    //header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Prescriptions</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("viewLab")?>
               <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px;">
                         <div class="upperPart3">
                                 <div class="upperFirst row">
                                     <div class="c-12 c-l-8">
                                         <div class="boxSmall">
                                             <input type="text" class="input-field" style="width:60%; display:inline;" id ="patId" placeholder="Patient ID or Name or Report ID">
                                         </div>
                                     </div>
                                     <div class="c-12 c-l-4">
                                         <div class="boxSmall">
                                             <label>Total Reports:</label>   
                                         </div>
                                     </div>
                                 </div>
                         </div>
                    <div id="reportInfo"></div>
               </div>
        </div>
    </div>

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    
    <script src="../js/searchRep.js"></script>
</body>
</html>
