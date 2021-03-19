var modalUpdateDet = document.getElementById("modalUpdateDet");
$(document).ready(function(){
    $('.close').click(()=>{
        close(modalUpdateDet);
    })
    $('#upCancel').click(()=>{
        close(modalUpdateDet);
    })
});
$('#editProfile').click(()=>{
    $('.editProfile input').removeClass('errorInput');
    var dID = $("#docID").val();
    open(modalUpdateDet);
    $.ajax({
        url:"../handlers/doctorHandler.php",
        method:"POST",
        data:{docID:dID,type:'doctorData'},
        dataType:'json',
        success:function(data){
            $('#firstName').val(data['fname']);
            $('#lastName').val(data['lname']);
            $('#phone').val(data['phone']);
            $('#email').val(data['email']);
        }
    });
});

$('#usrDetailUp').on('submit',function(e){
    var dID = $("#docID").val();
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
        $.ajax({
            url:"../handlers/doctorHandler.php",
            method:"POST",
            data:$('#usrDetailUp').serialize()+"&type=upDet&docID="+dID,
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
                    $('#updateStatusInfo').html('Doctor with the same email already exists!');
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

$('#usrPassUp').on('submit',function(e){
    e.preventDefault();
    var dID = $("#docID").val();
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
            url:"../handlers/doctorHandler.php",
            method:"POST",
            data:{nPass:newPass,docID:dID,type:'upPass'},
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
});

function getBillData(docType,docID,month)
{
    $.ajax({
        url:"../handlers/billHandler.php",
        method:"POST",
        data:{type:"getBill",docType:docType, docID:docID,month:month},
        dataType:'json',
        success:function(data){
            $("#billData").html(data[0]);
            $("#totalDocCharge").html(data[1]);
            $("#totalBillCount").html(data[2]);
            $('.viewBill').click(function(){
                setBillDataModal($(this).attr("billId"));
                open(modalBill);
            });
        }
    });
}

function setBillDataModal(id)
{
    $("#billId").html(id);
    $.ajax({
        url:"../handlers/billHandler.php",
        method:"POST",
        data:{type:"getBillData",bId:id},
        dataType:'json',
        success:function(data){
            $("#billVals").html(data[0]);
            $("#patientId").html(data[1]);
            $("#patientName").html(data[2]);
            $("#doi").html(data[3]);
            $("#billType").html(data[4]);
            $("#totalAmount").html(data[5]);
        }
    });
}

function getChart(year,cType)
{
    $.ajax({
        url:"../handlers/billHandler.php",
        method:"POST",
        data:{type:"getChart",year:year,cType:cType},
        dataType:'json',
        success:function(data){
            if(cType=="all")
            {
                backColor="rgba(255, 159, 64, 0.2)";
                borderColor="rgba(255, 159, 64, 1)";
                label="All Amount";
            }
            else if(cType=="docCharge")
            {

                backColor='rgba(153, 102, 255, 0.2)';
                borderColor='rgba(153, 102, 255, 1)';
                label="Doctor Charges";
            }
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: [
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor,
                            backColor
                        ],
                        borderColor: [
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor,
                            borderColor
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
}

$("#allAmountsChart").click(function(){
    year=$("#selectMonth").val();
    year=year.split("-")[0];
    $("#allAmountsChart").addClass("active");
    $("#doctorChargesChart").removeClass("active");
    getChart(year,"all");
});
$("#doctorChargesChart").click(function(){
    $("#doctorChargesChart").addClass("active");
    $("#allAmountsChart").removeClass("active");
    getChart(year,"docCharge");
});