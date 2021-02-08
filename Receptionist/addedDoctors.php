<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
}
else
{
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Added Doctors</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("doctor")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                    <div class="c-l-2">
                            <a href="addDoctor.php"><button type="button" class="btn btnNormal btnPatient" name="addDoctor" id="addDoctor"><i class="fas fa-plus"></i> ADD DOCTORS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedDoctors.php"><button type="submit" class="btn btnNormal btnPatient active" name="viewDoctor" id="viewDoctor"><i class="fas fa-search"></i> VIEW DOCTORS</button></a>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-4">
                            <input type="text" class="input-field fullWidth" name="searchDoc" id="searchDoc" placeholder="Enter Doctor ID or Name" required>
                        </div>
                        <div class="c-l-8 totText">
                            Total Doctors: <span id="totalCountDoc"></span>

                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='patId'>Doctor ID</div>
                    <div class='c-8' class='patFirstName'>Name</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="doctorData"></div>
                       
            </div>
        </div>
    </div>
    
     <!-- The Modal for Doctor Details-->
     <div id="docFullData" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>

        <div class="detailsSection">
            <div class="row">
                <div class="c-12">
                    <h2>Doctor Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    First Name:
                </div>
                <div class="c-12 c-m-8 answer" id="firstNameData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Last Name:
                </div>
                <div class="c-12 c-m-8 answer" id="lastNameData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Phone: 
                </div>
                <div class="c-12 c-m-8 answer" id="phoneData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Email: 
                </div>
                <div class="c-12 c-m-8 answer" id="emailData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Specialties: 
                </div>
                <div class="c-12 c-m-8 answer" id="specialityData">
                </div>
            </div>
            <div class="row">
                <div class="c-12 c-m-4">
                    Normal Days: 
                </div>
                <div class="c-12 c-m-8 answer" id="normalDaysData">
                </div>
            </div>            
        </div>
        <div class="bottomModel">
                <div class="row">
                <div class="c-12 c-l-6" style="text-align:left">
                </div>
                    <div class="c-12 c-l-6">
                        <button type="button" class="btn btnNormal btnCancel" id="deleteMed">Delete</button>
                        <button type="button" class="btn btnNormal" id="updateMed">Edit</button> 
                    </div>
                </div>
        </div>

        </div>
    </div>
    <!-- End of the Modal for Doctor Details-->

    <!-- The Modal for Update Medicine-->
    <div id="modalUpdatePat" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
        <form method="POST" id="medUpForm">
            <input type="hidden" value="" id="docUpID" name="docUpID">
           <div class="detailsSection">
           <div class="alerMSG" id="updateStatus"></div>
                <div class="row">
                    <div class="c-12 c-m-5">
                        <h2>Update Patient Details</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        First Name: 
                    </div>
                    <div class="c-12 c-m-8">
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="patUpFname" id="patUpFname" placeholder="First Name">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        Last Name: 
                    </div>
                    <div class="c-12 c-m-8">
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="patUpLname" id="patUpLname" placeholder="Last Name">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        Phone: 
                    </div>
                    <div class="c-12 c-m-8">
                        <input type="number" class="input-field" style="width:100%; display:inline;" name="patUpPhone" id="patUpPhone" placeholder="Phone">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        Age: 
                    </div>
                    <div class="c-12 c-m-8">
                        <input type="number" class="input-field" style="width:100%; display:inline;" name="patUpAge" id="patUpAge" placeholder="Age">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        Email: 
                    </div>
                    <div class="c-12 c-m-8">
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="patUpEmail" id="patUpEmail" placeholder="Email">
                    </div>
                </div>
                <div class="row">
                    <div class="c-12 c-m-4">
                        Address: 
                    </div>
                    <div class="c-12 c-m-8">
                        <textarea type="number" class="input-field fullWidth" name="patUpAddress" id="patUpAddress" placeholder="Address"></textarea>
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal medCancel" id="updateMedCancel">Cancel</button> 
                        <button type="submit" class="btn btnNormal" id="updateMedSave">Save</button> 
                    </div>
                </div>
           </div>
        </form>
        </div>
    </div>
    <!-- End of the Modal for Update Medicine-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        var modalDoctor=document.getElementById("docFullData");
        var modalPatientUpdate=document.getElementById("modalUpdatePat");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalDoctor);
                close(modalPatientUpdate);
            })
            $('#patClose').click(()=>{
                close(modalDoctor);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalDoctor) {
                    // modalUpdateDet.style.display = "none";
                    close(modalDoctor);
            }
            if (event.target == modalPatientUpdate) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatientUpdate);
            }
        }
    </script>
    <script>
        getDocs("");
        $('#updateStatus').hide();
        $("#updateMed").click(function(){
            close(modalDoctor);
            open(modalPatientUpdate);
        });
        var pId="";
        //Function to open the patient data modal
        function doctorDataModal(pId)
        {
            open(modalDoctor);
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{docID:pId,type:'doctorData2'},
                dataType:'json',
                success:function(data){
                    $('#docUpID').val(data[0][0]);
                    $('#firstNameData').html(data[0][1]);
                    // $('#patUpFname').val(data[1]);

                    $('#lastNameData').html(data[0][2]);
                    // $('#patUpLname').val(data[2]);

                    $('#phoneData').html(data[0][3]);
                    // $('#patUpPhone').val(data[3]);

                    $('#emailData').html(data[0][4]);
                    // $('#patUpEmail').val(data[4]);

                    $('#specialityData').html(data[2].slice(0, -1));
                    $('#normalDaysData').html(data[1].slice(0, -1));

                }
            });
        }
        //Function to get the added patients
        function getDocs(serVal)
        {
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'searchDRecep', doctorSearch:serVal},
                dataType:'json',
                success:function(data){
                    $("#doctorData").html(data[0]);
                    $("#totalCountDoc").html(data[1]);
                    //Open patient data modal when click on view

                    $('.viewDoc').click(function(){
                         pId=$(this).attr('id');

                        doctorDataModal(pId);
                    });
                }   
            });
        }
        var serPat=document.getElementById("searchDoc");
        serPat.addEventListener("keydown", function(e){
            setTimeout(function(){
                a=serPat.value;
                getDocs(a);
            },100);
        });
    
            var pId = document.getElementById("patID");
    
        $('#deleteMed').click(function(){
           if(confirm("Are You Sure?")){
            $.ajax({
               url:"../handlers/patientHandler.php",
               method:"POST",
               data: {id:pId,type:'delPat'},
               success:function(){
                   close(modalPatient);
                   getpatients("");
               }
            });
           }
           else{
             return false;
           }
           
        });
    </script>
</body>
</html>