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
    
     <!-- The Modal for Update User Details-->
     <div id="patientFullData" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-long inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>

        <div class="detailsSection">
            <div class="row">
                <div class="c-12 c-m-4">
                    <h2>Patient Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    First Name:
                </div>
                <div class="c-12 c-m-10 answer" id="firstNameData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    Last Name:
                </div>
                <div class="c-12 c-m-10 answer" id="lastNameData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    Phone: 
                </div>
                <div class="c-12 c-m-10 answer" id="phoneData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    Age:
                </div>
                <div class="c-12 c-m-10 answer" id="ageData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    Email: 
                </div>
                <div class="c-12 c-m-10 answer" id="emailData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-2">
                    Address: 
                </div>
                <div class="c-12 c-m-10 answer" id="addressData">
                </div>
            </div>
    
        <!-- <div class="c-12 c-m-8">
            <div class="row">
                <div class="c-12 c-l-5">
                    <div class="box">
                        <ul>
                            <li class="title">Recent Prescriptions</li>
                            <a><li class="upperClick">Prescription 5</li></a>
                            <a><li class="upperClick">Prescription 4</li></a>
                            <a><li class="upperClick">Prescription 3</li></a>
                            <a><li class="upperClick">Prescription 2</li></a>
                            <a><li class="upperClick">Prescription 1</li></a>
                            <li><button type="button" class="btn btnAddPres" style="" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Prescriptions</button></li>
                        </ul>
                    </div>
                </div>
                <div class="c-12 c-l-6">
                    <div class="box">
                        <ul>
                            <li class="title">Recent Reports</li>
                            <a><li class="upperClick">Report 5</li></a>
                            <a><li class="upperClick">Report 4</li></a>
                            <a><li class="upperClick">Report 3</li></a>
                            <a><li class="upperClick">Report 2</li></a>
                            <a><li class="upperClick">Report 1</li></a>
                            <li><button type="button" class="btn btnAddPres" style="" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Reports</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
            
        </div>
        <div class="bottomModel">
                <div class="row">
                <div class="c-12 c-l-6" style="text-align:left">
                </div>
                    <div class="c-12 c-l-6">
                        <button type="button" class="btn btnNormal upCancel" id="patClose">Close</button> 
                    </div>
                </div>
        </div>

        </div>
    </div>
    <!-- End of the Modal for Patient Details-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        var modalPatient=document.getElementById("patientFullData");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalPatient);
            })
            $('#patClose').click(()=>{
                close(modalPatient);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalPatient) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatient);
            }
        }
    </script>
    <script>
        getpatients("");
        
        //Function to open the patient data modal
        function patientDataModal(pId)
        {
            open(modalPatient);
            $.ajax({
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:{patientID:pId,type:'patientData'},
                dataType:'json',
                success:function(data){
                    $('#firstNameData').html(data[1]);
                    $('#lastNameData').html(data[2]);
                    $('#phoneData').html(data[3]);
                    $('#ageData').html(data[6]);
                    $('#emailData').html(data[4]);
                    $('#addressData').html(data[7]);
                }
            });
        }
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
                    //Open patient data modal when click on view
                    var patientFullData=document.getElementById("patientFullData");
                    $('.viewMed').click(function(){
                        var pId=$(this).attr('id');

                        patientDataModal(pId);
                    });
                }   
            });
        }
        var serPat=document.getElementById("searchPat");
        serPat.addEventListener("keydown", function(e){
            setTimeout(function(){
                a=serPat.value;
                getpatients(a);
            },100);
        });
    </script>
</body>
</html>