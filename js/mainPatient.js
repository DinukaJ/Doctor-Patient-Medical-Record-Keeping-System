var modalUpdateDet = document.getElementById("modalUpdateDet");
$('#editProfile').click(()=>{
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

$('#usrDetailUp').on('submit',function(e){
    var patID = $("#patientID").val();
    e.preventDefault();
    
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:$('#usrDetailUp').serialize()+"&type=upDet&patientID="+patID,
        success:function(data){
            if(data==1){
                $('#updateStatusInfo').addClass("success");
                $('#updateStatusInfo').html("Successfully Updated!");
                $('#updateStatusInfo').slideDown("slow");
                setTimeout(function(){
                    $('#updateStatusInfo').slideUp("slow");
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
});

$('#usrPassUp').on('submit',function(e){
    e.preventDefault();
    var patID = $("#patientID").val();
   
    if($('#newPass').val().match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9\S]{6,20}$/)==null)
    {
        $('#errorMsg').addClass('error');
        $('#errorMsg').html('Password Must Contain a Uppercase Letter, Lowercase Letter, Number, and 6-20 Characters.');
        $('#errorMsg').slideDown();
        setTimeout(function(){
            $('#errorMsg').slideUp('slow');
        },2000);
        return false;
    }
    else if($('#newPass').val()!=$('#newPassConfirm').val())
    {
        $('#errorMsg').addClass('error');
        $('#errorMsg').html('Passwords Do Not Match');
        $('#errorMsg').slideDown();
        setTimeout(function(){
            $('#errorMsg').slideUp('slow');
        },2000);
        return false;
    }
    else{
        var newPass = $('#newPass').val();
        $.ajax({
            url:"../handlers/patientHandler.php",
            method:"POST",
            data:{nPass:newPass,pid:patID,type:'upPass'},
            success:function(){
                $('#errorMsg').addClass('success');
                $('#errorMsg').html('Updated Successfully');
                $('#errorMsg').slideDown();
                setTimeout(function(){
                    $('#errorMsg').slideUp();
                },2000);
            }
        });
    }
})