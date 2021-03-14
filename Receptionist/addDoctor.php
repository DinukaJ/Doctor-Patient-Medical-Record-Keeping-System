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

    <title>Add Doctors</title>
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
                            <a href="addDoctor.php"><button type="button" class="btn btnNormal btnPatient active" name="addDoctor" id="addDoctor"><i class="fas fa-plus"></i> ADD DOCTORS</button></a>
                        </div>
                        <div class="c-l-2">
                            <a href="addedDoctors.php"><button type="submit" class="btn btnNormal btnPatient" name="viewDoctor" id="viewDoctor"><i class="fas fa-search"></i> VIEW DOCTORS</button></a>
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
                <!-- <div class="row" style="padding:0px; margin:0px;">
                    
                </div> -->
                <div class="row patientDataRow" style="padding-top:0px;" id="rightScroll">
                <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="updateStatusInfo"></div>
                    </div>
                    <div class='c-12'>
                        <form action="#" method="POST" id="newDoc">
                            <div class="row">
                                <div class="c-12" style="padding-top:0px">
                                    <h1>Doctor ID:- <span id="docIDDis"></span></h1>
                                    <input type="hidden" id="docId" name="docId" value="">
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
                                <div class="c-m-6">
                                    <button type="reset" class="btn btnLogin btnNormal btnCancel" name="cancelBtn" id=""><i class="fas fa-times"></i> CANCEL</button>
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
        getId();
        $('#specialtyStatus').hide();
        var chkCount=0;

        $('#phone').change(function(){
            $("#pass").val($("#phone").val());
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

        $('#newDoc').on('submit',function(e){
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
                errMsg+="<br>Phone Number Must Contain Only 10 Digits. (07******** / 011*******).";
                x=1;
            } 
            else
            {
                $('#phone').removeClass('errorInput');
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
                errMsg+="<br>Password Cannot be Blank.";
                x=1;
            }
            else
            {
                $('#pass').removeClass('errorInput');
            }
            if(chkCount==0)
            {
                errMsg+="<br>At Least One Day Must be Selected.";
                x=1;
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
                $('#updateStatusInfo').addClass("success");
                $('#updateStatusInfo').html("Processing....");
                $('#updateStatusInfo').slideDown("slow");
                $("#patSave").prop("disabled",true);
                var specialties="";
                $('.specialtyValue').each(function(i, obj) {
                    specialties+=$(obj).html()+",";
                });
                specialties=specialties.slice(0, -1);
                $.ajax({
                    url:"../handlers/doctorHandler.php",
                    method:"POST",
                    data:$('#newDoc').serialize()+"&type=addDoc&special="+specialties,
                    success:function(data){
                        $("#patSave").prop("disabled",false);
                        if(data==1){
                            $('#updateStatusInfo').addClass("success");
                            $('#updateStatusInfo').html("Successfully Added!");
                            $('#updateStatusInfo').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatusInfo').slideUp("slow");
                            },2000);
                            resetAll();
                        }
                        else if(data==-1)
                        {
                            $('#updateStatusInfo').addClass("error");
                            $('#updateStatusInfo').html("Doctor with the same email already exists!");
                            $('#updateStatusInfo').slideDown("slow");
                            setTimeout(function(){
                                $('#updateStatusInfo').slideUp("slow");
                            },2000);
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
            $("#newDoc").trigger("reset");
            $("#specialtyBox").html("");
            getId();
        }
        // Function to get the new patient id
        function getId()
        {
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'getID'},
                success:function(data){
                    if(data=="")
                    {
                        $("#docId").val("doc-1");
                        $("#docIDDis").html("doc-1");
                    }
                    else
                    {
                        var arr=data.split("-");
                        var num=parseInt(arr[1]) + 1;
                        $("#docId").val("doc-"+num);
                        $("#docIDDis").html("doc-"+num);
                    }
                }
            });
        }

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
                    $("#specialtyBox").append('<div class="row allergyRow docSpecialties"><div class="c-11 specialtyValue" style="padding-right:0px;">'+$("#newSpecialty").val().trim()+'</div><div class="c-1" style="padding-left:2px;"><button type="button" class="btn btnPatientView2 removeSpecialty" name="removeSpecialty"><i class="fas fa-times"></i></button></div></div>');
                    $("#newSpecialty").val("");
                    $(".removeSpecialty").click(function(){
                        $(this).parent().parent().remove();
                    });
                }
            }
        });

        
    </script>

</body>
</html>