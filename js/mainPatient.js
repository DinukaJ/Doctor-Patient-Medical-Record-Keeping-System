var modalUpdateDet = document.getElementById("modalUpdateDet");
$('#editProfilePat').click(()=>{
    $('.editProfile input').removeClass('errorInput');
    var patID = $("#patientID").val();
    open(modalUpdateDet);
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:patID,type:'patientData'},
        dataType:'json',
        success:function(data){
            $('#firstName').val(data['fname']);
            $('#lastName').val(data['lname']);
            $('#phone').val(data['phone']);
            $('#email').val(data['email']);
            $('#age').val(data['age']);
            $('#address').val(data['address']);

        }
    });
});

$('#usrDetailUpPat').on('submit',function(e){
    var patID = $("#patientID").val();
    e.preventDefault();
    var errMsg="";
    var x=0;
    $('#updateStatusInfo').removeClass('error');
    $('#updateStatusInfo').removeClass('success');
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
    if($('#age').val()=="" || $('#age').val()=="0")
    {
        $('#age').addClass('errorInput'); 
        errMsg+="<br>Invalid Age.";
        x=1;      
    } 
    else
    {
        $('#age').removeClass('errorInput');  
    }
    if($('#address').val()=="")
    {
        $('#address').addClass('errorInput'); 
        errMsg+="<br>Address Cannot be Empty.";
        x=1;      
    } 
    else
    {
        $('#address').removeClass('errorInput');  
    }
    if(x==1)
    {
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
        $('#updateStatusInfo').addClass("success");
        $('#updateStatusInfo').html("Processing....");
        $('#updateStatusInfo').slideDown("slow");
        $.ajax({
            url:"../handlers/patientHandler.php",
            method:"POST",
            data:$('#usrDetailUpPat').serialize()+"&type=upDet&patientID="+patID,
            success:function(data){
                if(data==1){
                    $('#updateStatusInfo').addClass("success");
                    $('#updateStatusInfo').html("Successfully Updated!");
                    $('#updateStatusInfo').slideDown("slow");
                    setTimeout(function(){
                        $('#updateStatusInfo').slideUp("slow");
                    },2000);
                }
                else if(data==-1)
                {
                    $('#updateStatusInfo').addClass('error');
                    $('#updateStatusInfo').html('Patient with this email already exists!');
                    $('#updateStatusInfo').slideDown();
                    setTimeout(function(){
                        $('#updateStatusInfo').slideUp();
                    },2000);
                }
                else{
                    $('#updateStatusInfo').addClass("error");
                    $('#updateStatusInfo').html("Update Failed!");
                    $('#updateStatusInfo').slideDown("slow");
                    setTimeout(function(){
                        $('#updateStatusInfo').slideUp("slow");
                    },2000);
        }
            }
        });
    }
});

$('#usrPassUpPat').on('submit',function(e){
    e.preventDefault();
    var patID = $("#patientID").val();
    $('#errorMsgPass').removeClass('error');
    $('#errorMsgPass').removeClass('success');
    if($('#newPass').val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9\S]{6,20}$/)==null)
    {
        $('#newPass').addClass('errorInput');
        $('#errorMsgPass').addClass('error');
        $('#errorMsgPass').html('Password Must Contain a Uppercase Letter, Lowercase Letter, Number, and 6-20 Characters.');
        $('#errorMsgPass').slideDown();
        setTimeout(function(){
            $('#errorMsgPass').slideUp('slow');
        },2000);
        return false;
    }
    else if($('#newPass').val()!=$('#newPassConfirm').val())
    {
        $('#newPass').removeClass('errorInput');
        $('#newPassConfirm').addClass('errorInput');
        $('#errorMsgPass').addClass('error');
        $('#errorMsgPass').html('Passwords Do Not Match');
        $('#errorMsgPass').slideDown();
        setTimeout(function(){
            $('#errorMsgPass').slideUp('slow');
        },2000);
        return false;
    }
    else{
        var newPass = $('#newPass').val();
        $.ajax({
            url:"../handlers/patientHandler.php",
            method:"POST",
            data:{nPass:newPass,pid:patID,type:'upPass'},
            success:function(data){
                if(data==1)
                {
                    $('#errorMsgPass').addClass('success');
                    $('#errorMsgPass').html('Updated Successfully');
                    $('#errorMsgPass').slideDown();
                    setTimeout(function(){
                        $('#errorMsgPass').slideUp();
                    },2000);
                }
                else if(data==-1)
                {
                    $('#errorMsgPass').addClass('error');
                    $('#errorMsgPass').html('This password is not allowed!');
                    $('#errorMsgPass').slideDown();
                    setTimeout(function(){
                        $('#errorMsgPass').slideUp();
                    },2000);
                }
                else
                {
                    $('#errorMsgPass').addClass('error');
                    $('#errorMsgPass').html('Update Failed!');
                    $('#errorMsgPass').slideDown();
                    setTimeout(function(){
                        $('#errorMsgPass').slideUp();
                    },2000);
                }
            }
        });
    }
})

function getDoctors(name,specialty)
{
    $.ajax({
        url:"../handlers/doctorHandler.php",
        method:"POST",
        data:{type:'searchD',name:name,spec:specialty},
        success:function(data){
            $("#docData").html(data);
            $(".viewDocDates").click(function(){
                dp=$(this).parent().parent().find(".imgSection").find(".docDp").attr("src");
                docName=$(this).parent().find(".docName").html();
                docSpec=$(this).parent().find(".docSpec").html();
                setDocDataModal($(this).attr("docId"),dp,docName,docSpec);
                open(modalViewDocData);
            });
        }
    });
}

$("#docNameSearch").on("keydown",function(){
    setTimeout(function(){
		a=$("#docNameSearch").val();
        getDoctors(a,"");
    },100)
});

function setDocDataModal(id,dp,docName,docSpec)
{
    $("#docDpModal").attr("src",dp);
    $("#docNameModal").html(docName);
    $("#docSpecModal").html(docSpec);

    $.ajax({
        url:"../handlers/doctorHandler.php",
        method:"POST",
        data:{type:'docDataModal',id:id},
        dataType:'json',
        success:function(data){
            $("#docNormalDaysModal").html(data[0]);
            $("#docSpecDaysModal").html(data[1]);
        }
    });
}