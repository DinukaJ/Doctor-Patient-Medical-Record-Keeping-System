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
                    <div class='c-5' class='patFirstName'>Name</div>
                    <div class='c-3' class='patLastName'>Age</div>
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
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>

        <div class="detailsSection">
            <div class="row">
                <div class="c-12">
                    <h2>Patient Details</h2>
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
                    Age:
                </div>
                <div class="c-12 c-m-8 answer" id="ageData">
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
                    Address: 
                </div>
                <div class="c-12 c-m-8 answer" id="addressData">
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
                        <button type="button" class="btn btnNormal btnCancel" id="deleteMed">Delete</button>
                        <button type="button" class="btn btnNormal" id="updateMed">Edit</button> 
                    </div>
                </div>
        </div>

        </div>
    </div>
    <!-- End of the Modal for Patient Details-->

    <!-- The Modal for Update Medicine-->
    <div id="modalUpdatePat" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
        <form method="POST" id="patUpForm">
            <input type="hidden" value="" id="patUpID" name="patUpID">
           <div class="detailsSection">
           <div class="alerMSG" id="updateStatus"></div>
                <div class="row">
                    <div class="c-12">
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
                        <input type="text" class="input-field" style="width:100%; display:inline;" name="patUpPhone" id="patUpPhone" placeholder="Phone">
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
                    <input type="hidden" id="oldEmail" name="oldEmail">
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
                <div class="row">
                    <div class="c-12 c-m-4">
                        Password: 
                    </div>
                    <div class="c-12 c-m-8">
                    <input type="password" class="input-field" style="width:100%; display:inline;" name="patUpPass" id="patUpPass" placeholder="Password">
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal medCancel btnCancel" id="patUpdateClose">Cancel</button> 
                        <button type="submit" class="btn btnNormal" id="updatePat">Save</button> 
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
        var modalPatient=document.getElementById("patientFullData");
        var modalPatientUpdate=document.getElementById("modalUpdatePat");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalPatient);
                close(modalPatientUpdate);
            })
            $('#patClose').click(()=>{
                close(modalPatient);
            })
            $('#patUpdateClose').click(()=>{
                close(modalPatientUpdate);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalPatient) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatient);
            }
            if (event.target == modalPatientUpdate) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatientUpdate);
            }
        }
    </script>
    <script>
        getpatients("");
        $('#updateStatus').hide();
        $("#updateMed").click(function(){
            close(modalPatient);
            open(modalPatientUpdate);
        });
        var pId="";
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
                    $('#patUpID').val(data[0]);
                    $('#firstNameData').html(data[1]);
                    $('#patUpFname').val(data[1]);

                    $('#lastNameData').html(data[2]);
                    $('#patUpLname').val(data[2]);

                    $('#phoneData').html(data[3]);
                    $('#patUpPhone').val(data[3]);

                    $('#ageData').html(data[6]);
                    $('#patUpAge').val(data[6]);

                    $('#emailData').html(data[4]);
                    $('#oldEmail').html(data[4]);
                    $('#patUpEmail').val(data[4]);

                    $('#addressData').html(data[7]);
                    $('#patUpAddress').val(data[7]);
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
                    $('.viewPat').click(function(){
                         pId=$(this).attr('id');

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

        $('#patUpForm').on('submit',function(e){
            e.preventDefault();
            var errMsg="";
            var x=0;
            if($('#patUpFname').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#patUpFname').addClass('errorInput');
                errMsg+="First Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#patUpFname').removeClass('errorInput');
            }
            if($('#patUpLname').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#patUpLname').addClass('errorInput');
                errMsg+="<br>Last Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#patUpLname').removeClass('errorInput');
            }
            if($('#patUpPhone').val().length<10 || $('#patUpPhone').val().length>10)
            {
                $('#patUpPhone').addClass('errorInput');
                errMsg+="<br>Phone Number Must Contain Only 10 Digits. (07******** / 011*******)";
                x=1;
            } 
            else
            {
                $('#patUpPhone').removeClass('errorInput');
            }
            if(isNaN($('#patUpAge').val()) || $("#patUpAge").val()<=0 ||  $("#patUpAge").val()>=150)
            {
                $('#patUpAge').addClass('errorInput');
                errMsg+="<br>Invalid Age";
                x=1;
            } 
            else
            {
                $('#patUpAge').removeClass('errorInput');
            }
            if(($("#patUpEmail").val()!="") && ($("#patUpEmail").val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null))
            {
                $('#patUpEmail').addClass('errorInput');
                errMsg+="<br>Invalid Email.";
                x=1;
            }
            else
            {
                $('#patUpEmail').removeClass('errorInput');
            }
            if(x==1)
            {
                $('#updateStatus').removeClass('error');
                $('#updateStatus').removeClass('success');
                $('#updateStatus').addClass('error');
                $('#updateStatus').html(errMsg);
                $('#updateStatus').slideDown();
                setTimeout(function(){
                    $('#updateStatus').slideUp('slow');
                },5000);
                return false;
            }
            else
            {
                $('#updateStatus').removeClass('error');
                $('#updateStatus').removeClass('success');
                $('#updateStatus').addClass("success");
                $('#updateStatus').html("Processing....");
                $('#updateStatus').slideDown("slow");
                $("#updatePat").prop("disabled",true);
                $.ajax({
                    url:"../handlers/patientHandler.php",
                    method:"POST",
                    data:$('#patUpForm').serialize()+"&type=upPat",
                    success:function(data){
                        $("#updatePat").prop("disabled",false);
                        if(data==1){
                            getpatients("");
                            $('#updateStatus').addClass("success");
                            $('#updateStatus').html("Successfully Updated!");
                            $('#updateStatus').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatus').slideUp("slow");
                            },2000);                           
                        }
                        else if(data==-1)
                        {
                            $('#updateStatus').addClass("error");
                            $('#updateStatus').html("Patient with the same email and password already exists! Use a different password!");
                            $('#updateStatus').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatus').slideUp("slow");
                            },2000);
                        }
                        else{
                            $('#updateStatus').addClass("error");
                            $('#updateStatus').html("Failed!");
                            $('#updateStatus').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatus').slideUp("slow");
                            },2000);
                }
                    }
                });
            }
        });
    </script>
</body>
</html>