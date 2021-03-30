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
                        <button type="button" class="btn btnNormal btnCancel" id="deleteDoc">Delete</button>
                        <button type="button" class="btn btnNormal" id="updateDoc">Edit</button> 
                    </div>
                </div>
        </div>

        </div>
    </div>
    <!-- End of the Modal for Doctor Details-->

    <!-- The Modal for Update Medicine-->
    <div id="modalUpdateDoc" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-long inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>
        <form method="POST" id="docUpForm">
            <input type="hidden" value="" id="docUpID" name="docUpID">
           <div class="detailsSection">
           <div class="alerMSG" id="updateStatus"></div>
                <div class="row">
                    <div class="c-12">
                        <h2>Update Doctor Details</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>First Name</label>
                            <input type="text" class="input-field fullWidth" name="firstNameUp" id="firstNameUp" placeholder="First Name">
                        </div>
                    </div>
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>Last Name</label>
                            <input type="text" class="input-field fullWidth" name="lastNameUp" id="lastNameUp" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>Phone No</label>
                            <input type="text" class="input-field fullWidth" name="phoneUp" id="phoneUp" placeholder="Phone No">
                        </div>
                    </div>
                    <div class="c-m-6">
                        <input type="hidden" id="oldEmail" name="oldEmail">
                        <div class="group-fields">
                            <label>Email</label>
                            <input type="text" class="input-field fullWidth" name="emailUp" id="emailUp" placeholder="Email (Optional)">
                        </div>
                    </div>
                    <div class="c-m-6">
                        <div class="group-fields">
                            <label>Password</label>
                            <input type="password" class="input-field fullWidth" name="passUp" id="passUp" placeholder="Password">
                        </div>
                    </div>
                    <div class="c-m-6">
                    </div>
                    <div class="c-12 c-l-6">
                        <h4>Specialties</h4>
                        <div class="row" style="padding:0px; margin:0px;">
                            <div class="c-12" style="padding:0px; margin:0px;">
                                <div class="alerMSG" id="specialtyStatus"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="c-11" style="padding-right:4px">
                                <input type="text" class="input-field fullWidth" id="newSpecialty" placeholder="Enter New Specialty">
                            </div>
                            <div class="c-1" style="padding:0px">
                            <button type="button" class="btn btnAddPres" style="padding:0px;" name="addSpecialty" id="addSpecialty"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="c-12" style="padding-right:0px;">
                                <div class="scrollBox" id="specialtyBox">
                                    <!--Specialties-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-m-6">
                        <h4>Usual Attending Days</h4>
                        <input type="checkbox" id="chkMonday" name="day[]" class="chkDay" value="Monday">
                        <label for="chkMonday"> Monday</label><br>
                        <input type="checkbox" id="chkTuesday" name="day[]" class="chkDay" value="Tuesday">
                        <label for="chkTuesday"> Tuesday</label><br>
                        <input type="checkbox" id="chkWednesday" name="day[]" class="chkDay" value="Wednesday">
                        <label for="chkWednesday"> Wednesday</label><br>
                        <input type="checkbox" id="chkThursday" name="day[]" class="chkDay" value="Thursday">
                        <label for="chkThursday"> Thursday</label><br>
                        <input type="checkbox" id="chkFriday" name="day[]" class="chkDay" value="Friday">
                        <label for="chkFriday"> Friday</label><br>
                        <input type="checkbox" id="chkSaturday" name="day[]" class="chkDay" value="Saturday">
                        <label for="chkSaturday"> Saturday</label><br>
                        <input type="checkbox" id="chkSunday" name="day[]" class="chkDay" value="Sunday">
                        <label for="chkSunday"> Sunday</label><br>
                    </div>
                </div>
           </div>
           <div class="bottomModel">
                <div class="row">
                    <div class="c-12">
                        <button type="button" class="btn btnNormal btnCancel" id="updateMedCancel">Cancel</button> 
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
        var modalDoctorUpdate=document.getElementById("modalUpdateDoc");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalDoctor);
                close(modalDoctorUpdate);
            })
            $('#patClose').click(()=>{
                close(modalDoctor);
            })
            $('#updateMedCancel').click(()=>{
                close(modalDoctorUpdate);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalDoctor) {
                    // modalUpdateDet.style.display = "none";
                    close(modalDoctor);
            }
            if (event.target == modalDoctorUpdate) {
                    // modalUpdateDet.style.display = "none";
                    close(modalDoctorUpdate);
            }
        }
    </script>
    <script>
        getDocs("");
        $('#updateStatus').hide();
        $('#specialtyStatus').hide();
        $("#updateDoc").click(function(){
            close(modalDoctor);
            open(modalDoctorUpdate);
        });

        var pId="";
        var chkCount=0;
        //Function to open the Doctor data modal
        function doctorDataModal(pId)
        {
            $(".chkDay").prop("checked",false);
            open(modalDoctor);
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{docID:pId,type:'doctorData2'},
                dataType:'json',
                success:function(data){
                    $('#docUpID').val(data[0][0]);
                    $('#firstNameData').html(data[0][1]);
                    $('#firstNameUp').val(data[0][1]);

                    $('#lastNameData').html(data[0][2]);
                    $('#lastNameUp').val(data[0][2]);

                    $('#phoneData').html(data[0][3]);
                    $('#phoneUp').val(data[0][3]);

                    $('#emailData').html(data[0][4]);
                    $('#emailUp').val(data[0][4]);
                    $('#oldEmail').val(data[0][4]);

                    $('#specialityData').html(data[2].slice(0, -1));
                    $('#normalDaysData').html(data[1].slice(0, -1));
                    var daysArr=data[1].slice(0,-1).split(',');
                    for(day in daysArr)
                    {
                        $("#chk"+daysArr[day]).prop("checked",true);
                        chkCount++;
                    }
                    var specialtyArr=data[2].slice(0,-1).split(',');
                    $("#specialtyBox").html("");
                    for(special in specialtyArr)
                    {
                        if(specialtyArr[special]!="")
                        {
                            $("#specialtyBox").append('<div class="row allergyRow docSpecialties"><div class="c-11 specialtyValue" style="padding-right:0px;">'+specialtyArr[special]+'</div><div class="c-1" style="padding-left:2px;"><button type="button" class="btn btnPatientView2 removeSpecialty" name="removeSpecialty"><i class="fas fa-times"></i></button></div></div>');
                        }
                    }
                }
            });
        }
        //Function to get the added Doctors
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
    
        var pId = document.getElementById("docUpID");
    
        $('#deleteDoc').click(function(){
           if(confirm("Are You Sure?")){
            $.ajax({
               url:"../handlers/doctorHandler.php",
               method:"POST",
               data: {id:pId,type:'delDoc'},
               success:function(){
                   close(modalDoctor);
                   getDocs("");
               }
            });
           }
           else{
             return false;
           }
           
        });

        $(".chkDay").click(function(){
            if($(this).prop("checked")==true)
            {
                chkCount++;
            }
            else
            {
                chkCount--;
            }
        });

        $("#addSpecialty").click(function(){
            if($("#newSpecialty").val()=="")
            {
                $("#newSpecialty").addClass("errorInput");
            }
            else
            {
                $("#newSpecialty").removeClass("errorInput");
                var chk=0;
                $('.specialtyValue').each(function(i, obj) {
                    if($(obj).html().toLowerCase().trim()==$("#newSpecialty").val().toLowerCase().trim())
                    {
                        chk=1;
                    }
                });
                if(chk==1)
                {

                    $('#specialtyStatus').addClass("error");
                    $('#specialtyStatus').html("Specialty Already Added!");
                    $('#specialtyStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#specialtyStatus').slideUp("slow");
                    },2000);
                }
                else
                {
                    $.ajax({
                        url:"../handlers/doctorHandler.php",
                        method:"POST",
                        data: {id:pId,type:'addDocSpec', spec:$("#newSpecialty").val().trim()},
                        success:function(){
                        }
                    });
                    $("#specialtyBox").append('<div class="row allergyRow docSpecialties"><div class="c-11 specialtyValue" style="padding-right:0px;">'+$("#newSpecialty").val().trim()+'</div><div class="c-1" style="padding-left:2px;"><button type="button" class="btn btnPatientView2 removeSpecialty" name="removeSpecialty"><i class="fas fa-times"></i></button></div></div>');
                    $("#newSpecialty").val("");
                }
            }
        });
        $(document).on("click",".removeSpecialty",function(){
            var specVal=$.trim($(this).parent().parent().find(".specialtyValue").html());
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data: {id:pId,type:'removeDocSpec', spec:specVal},
                success:function(data){
                }
            });
            $(this).parent().parent().remove();
        });

        $('#docUpForm').on('submit',function(e){
            e.preventDefault();
            var errMsg="";
            var x=0;
            if($('#firstNameUp').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#firstNameUp').addClass('errorInput');
                errMsg+="First Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#firstNameUp').removeClass('errorInput');
            }
            if($('#lastNameUp').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#lastNameUp').addClass('errorInput');
                errMsg+="<br>Last Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#lastNameUp').removeClass('errorInput');
            }
            if($('#phoneUp').val().length<10 || $('#phoneUp').val().length>10)
            {
                $('#phoneUp').addClass('errorInput');
                errMsg+="<br>Phone Number Must Contain Only 10 Digits. (07******** / 011*******).";
                x=1;
            } 
            else
            {
                $('#phoneUp').removeClass('errorInput');
            }
            if(($("#emailUp").val()!="") && ($("#emailUp").val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null))
            {
                $('#emailUp').addClass('errorInput');
                errMsg+="<br>Invalid Email.";
                x=1;
            }
            else
            {
                $('#emailUp').removeClass('errorInput');
            }
            if(chkCount==0)
            {
                errMsg+="<br>At Least One Day Must be Selected.";
                x=1;
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
                $("#modalUpdateDoc").animate({ scrollTop: 0 });
                return false;
            }
            else
            {
                $('#updateStatus').removeClass('error');
                $('#updateStatus').removeClass('success');
                $('#updateStatus').addClass("success");
                $('#updateStatus').html("Processing....");
                $('#updateStatus').slideDown("slow");
                $("#updateMedSave").prop("disabled",true);
                $.ajax({
                    url:"../handlers/doctorHandler.php",
                    method:"POST",
                    data:$('#docUpForm').serialize()+"&type=upDoc",
                    success:function(data){
                        $("#modalUpdateDoc").animate({ scrollTop: 0 });
                        $("#updateMedSave").prop("disabled",false);
                        if(data==1){
                            $('#updateStatus').addClass("success");
                            $('#updateStatus').html("Successfully Updated!");
                            $('#updateStatus').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatus').slideUp("slow");
                            },2000);
                            getDocs("");
                        }
                        else if(data==-1)
                        {
                            $('#updateStatus').addClass("error");
                            $('#updateStatus').html("Doctor with the same email already exists!");
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