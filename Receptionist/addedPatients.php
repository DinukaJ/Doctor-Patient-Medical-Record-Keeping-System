<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
}
else
{
    // header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Added Patients</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("patient")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-2">
                            <a href="addPatients.php"><button type="button" class="btn btnNormal btnPatient" name="addPatient" id="addPatient"><i class="fas fa-plus"></i> ADD PATIENTS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedPatients.php"><button type="submit" class="btn btnNormal btnPatient active" name="addPatient" id="addPatient"><i class="fas fa-search"></i> VIEW PATIENTS</button></a>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-4">
                            <input type="text" class="input-field fullWidth" name="searchPat" id="searchPat" placeholder="Enter Patient ID or Name" required>
                        </div>
                        <div class="c-l-8 totText">
                            Total Patients: <span id="totalCountPat"></span>

                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='patId'>Patient ID</div>
                    <div class='c-4' class='patFirstName'>First Name</div>
                    <div class='c-4' class='patLastName'>Last Name</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="patientData"></div>
                       
            </div>
        </div>
    </div>

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <!-- <script>
        var modalPatient=document.getElementById("patientFullData");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalUpdateDet);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
        }
    </script> -->
    <script>
        $(document).ready(function(){
            getpatients("");
      

            //Function to get the added patients
            function getpatients(serVal)
            {
                $.ajax({
                    url:"../handlers/patientHandler.php",
                    method:"POST",
                    data:{type:'searchPRecep', patientSearch:serVal},
                    dataType:'json',
                    success:function(data){
                        $("#patientData").html(data[0]);
                        $("#totalCountPat").html(data[1]);
                    }   
                });
            }
            var serPat=document.getElementById("searchPat");
            serPat.addEventListener("keydown", function(e){
                setTimeout(function(){
                    a=serPat.value;
                
                    curr=0;
                    $.ajax({
                        url:"../handlers/patientHandler.php",
                        method:"POST",
                        data:{patientSearch:a, type:'searchPRecep'},
                        dataType:'json',
                        success:function(data){
                            $("#patientData").html(data[0]);
                            $("#totalCountPat").html(data[1]);
                        }   
                        
                    });
                },100);
            });
        });
    </script>
</body>
</html>