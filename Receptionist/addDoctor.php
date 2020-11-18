<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(!isset($_SESSION["user"]))
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

    <title>Add Patients</title>
    <style>
        #rightScroll{
            max-height:80vh;
            overflow-y:scroll;
        }
    </style>
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
                            <a href="addPatients.php"><button type="button" class="btn btnNormal btnPatient active" name="addPatient" id="addPatient"><i class="fas fa-plus"></i> ADD DOCTORS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedPatients.php"><button type="submit" class="btn btnNormal btnPatient" name="addPatient" id="addPatient"><i class="fas fa-search"></i> VIEW DOCTORS</button></a>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-12">
                            <h1 style="margin-top:5px">Enter Doctor Details</h1>
                        </div>
                        <!-- <div class="c-l-8 totText">
                            Total Patients: 10
                        </div> -->
                    </div>
                </div>
                <div class="row" style="padding:0px; margin:0px;">
                    <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="updateStatusInfo"></div>
                    </div>
                </div>
                <div class="row patientDataRow" id="rightScroll">
                    <div class='c-12'>
                        <form action="#" method="POST" id="newPat">
                            <div class="row">
                                <div class="c-12" style="padding-top:0px">
                                    <h1>Doctor ID:- <span id="patIDDis"></span></h1>
                                    <input type="hidden" id="patId" name="patId" value="">
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>First Name</label>
                                        <input type="text" class="input-field fullWidth" name="firstName" id="firstName" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Last Name</label>
                                        <input type="text" class="input-field fullWidth" name="lastName" id="lastName" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Phone No</label>
                                        <input type="text" class="input-field fullWidth" name="phone" id="phone" placeholder="Phone No">
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Email</label>
                                        <input type="text" class="input-field fullWidth" name="email" id="email" placeholder="Email (Optional)">
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <div class="group-fields">
                                        <label>Password</label>
                                        <input type="password" class="input-field fullWidth" name="pass" id="pass" placeholder="Password">
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
                                            <input type="text" class="input-field fullWidth" id="newAllergy" placeholder="Enter New Specialty">
                                        </div>
                                        <div class="c-1" style="padding:0px">
                                        <button type="button" class="btn btnAddPres" style="padding:0px;" name="addAllergy" id="addAllergy"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="c-12" style="padding-right:0px;">
                                            <div class="scrollBox" id="allergyBox">
                                                <div class="row allergyRow">
                                                    <div class="c-11" style="padding-right:0px;">
                                                        Specialty 1
                                                    </div>
                                                    <div class="c-1" style="padding-left:2px;">
                                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div> 
                                                <div class="row allergyRow">
                                                    <div class="c-11" style="padding-right:0px;">
                                                    Specialty 2
                                                    </div>
                                                    <div class="c-1" style="padding-left:2px;">
                                                        <button class="btn btnPatientView2" name="viewPatient" id="viewPatient"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-m-6">
                                    <h4>Usual Attending Days</h4>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Monday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Tuesday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Wednesday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Thursday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Friday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Saturday</label><br>
                                    <input type="checkbox" id="atMon" name="day" value="Monday">
                                    <label for="atMon"> Sunday</label><br>
                                </div>
                                <div class="c-m-6">
                                    <button type="reset" class="btn btnLogin btnNormal" name="cancelBtn" id=""><i class="fas fa-times"></i> CANCEL</button>
                                </div>
                                <div class="c-m-6">
                                    <button type="submit" class="btn btnLogin btnNormal" name="loginBtn" id="patSave"><i class="fas fa-check"></i> SAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script>
        $('#updateStatusInfo').hide();
        $('#specialtyStatus').hide();


        $('#phone').change(function(){
            $("#pass").val($("#phone").val());
        });
        $('#newPat').on('submit',function(e){
            e.preventDefault();
            var errMsg="";
            var x=0;
            if($('#firstName').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#firstName').addClass('errorInput');
                errMsg+="First Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#firstName').removeClass('errorInput');
            }
            if($('#lastName').val().match(/^[A-Za-z]+$/)==null)
            {
                $('#lastName').addClass('errorInput');
                errMsg+="<br>Last Name Must Contain Only Letters.";
                x=1;
            }
            else
            {
                $('#lastName').removeClass('errorInput');
            }
            if($('#phone').val().length<10 || $('#phone').val().length>10)
            {
                $('#phone').addClass('errorInput');
                errMsg+="<br>Phone Number Must Contain Only 10 Digits. (07******** / 011*******)";
                x=1;
            } 
            else
            {
                $('#phone').removeClass('errorInput');
            }
            if(isNaN($('#age').val()) || $("#age").val()<=0 ||  $("#age").val()>=150)
            {
                $('#age').addClass('errorInput');
                errMsg+="<br>Invalid Age";
                x=1;
            } 
            else
            {
                $('#age').removeClass('errorInput');
            }
            if(($("#email").val()!="") && ($("#email").val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null))
            {
                $('#email').addClass('errorInput');
                errMsg+="<br>Invalid Email.";
                x=1;
            }
            else
            {
                $('#email').removeClass('errorInput');
            }
            if($("#pass").val()=="")
            {
                $('#pass').addClass('errorInput');
                errMsg+="<br>Password Cannot be Blank";
                x=1;
            }
            else
            {
                $('#pass').removeClass('errorInput');
            }
            if(x==1)
            {
                $('#updateStatusInfo').removeClass('error');
                $('#updateStatusInfo').removeClass('success');
                $('#updateStatusInfo').addClass('error');
                $('#updateStatusInfo').html(errMsg);
                $('#updateStatusInfo').slideDown();
                setTimeout(function(){
                    $('#updateStatusInfo').slideUp('slow');
                },5000);
                return false;
            }
            else
            {
                $('#updateStatusInfo').removeClass('error');
                $('#updateStatusInfo').removeClass('success');
                $.ajax({
                    url:"../handlers/patientHandler.php",
                    method:"POST",
                    data:$('#newPat').serialize()+"&type=addPat",
                    success:function(data){
                        if(data==1){
                            $('#updateStatusInfo').addClass("success");
                            $('#updateStatusInfo').html("Successfully Added!");
                            $('#updateStatusInfo').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatusInfo').slideUp("slow");
                            },2000);
                            resetAll();
                        }
                        else{
                            $('#updateStatusInfo').addClass("error");
                            $('#updateStatusInfo').html("Failed!");
                            $('#updateStatusInfo').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatusInfo').slideUp("slow");
                            },2000);
                }
                    }
                });
            }
        });
        //function to reset all.
        function resetAll()
        {
            $("#newPat").trigger("reset");
            getId();
        }
        // Function to get the new patient id
        function getId()
            {
                $.ajax({
                    url:"../handlers/patientHandler.php",
                    method:"POST",
                    data:{type:'getID'},
                    success:function(data){
                        if(data=="")
                        {
                            $("#patId").val("p-1");
                            $("#patIDDis").html("p-1");
                        }
                        else
                        {
                            var arr=data.split("-");
                            var num=parseInt(arr[1]) + 1;
                            $("#patId").val("p-"+num);
                            $("#patIDDis").html("p-"+num);
                        }
                    }
                });
            }
    </script>

</body>
</html>