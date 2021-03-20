

//getting all info at first load
$(document).ready(function(){
    getTodayPres();
    getPres();
    $("#updateStatus").hide();
});

//Get today new prescriptions for the prescription queue in pharmacist
function getTodayPres(){
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{type:'getTodayPres'},
        dataType:"json",
        success:function(data){
            $("#presInfo").html(data[0]);
            $("#itemCount").html(data[1]);
            $(".viewPres").click(function(){            
                putPresData(this.id);
            });
        }   
    });
}

//getting all the prescriptions
function getPres(){
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{type:'getPresInfo'},
        dataType:"json",
        success:function(data){
            $("#presData").html(data[0]);
            $("#dataCount").html(data[1]);
            $(".viewPres").click(function(){            
                putPresData(this.id);
            });
        }   
    });
}

//Get patient prescriptions in doctor
function getPrescriptions(id)
{
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{patientID:id, type:'getPatientPres'},
        dataType: "json",
        success:function(data){
            $("#presList").html(data[0]);
            getPresDataTable(data[1]);
            $("#presNo").html(data[1]);
            $("#presDate").html(data[2]);
            $(".patientDataRow2").click(function(){
                $("#presNo").html($(this).find(".presListID").html());
                $("#presDate").html($(this).find(".presListDate").html());
                getPresDataTable($(this).find(".presListID").html());
                $(".patientDataRow2").removeClass("active");
                $(this).addClass("active");
            });
        }
        
    });
}
$(".viewPatientPrescription").click(function(){
    var pId=$("#patientID").val().split(" ");
   pId=pId[0];
    getPrescriptions(pId);
});

function getPresDataTable(id)
{
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{presID:id, type:'getPresDataTable'},
        success:function(data){
            $("#patPresData").html(data);
        }
        
    });
}

function putPresData(id){
 splitVal = id.split("~");
 id = splitVal[1];
 patId = splitVal[3];
 patName = splitVal[4]+' '+splitVal[5];
 today = splitVal[6];
 docName=splitVal[7]+' '+splitVal[8];
 $.ajax({
    url:"../handlers/prescriptionHandler.php",
    method:"POST",
    data:{type:'getTodayPresMed',id:id},
    success:function(data){
        $("#presVals").html(data);
        $(".presId").html(id);
        $(".docName").html(docName);
        $(".patName").html(patName);
        $(".doi").html(today);
        open(modalViewPres);
        //Create the bill
        $("#billCreate").click(function(){
            getMedFinInfo();
        });
    }
 });
}

function getMedFinInfo(){
    pid = $('.medName').attr('id');
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{type:'getMedFinInfo',pid:pid},
        dataType:'json',
        success:function (data){
            $("#billVals").html(data[0]);
            $("#totalAmount").html(data[1]);
            
            $(".medQty").change(function () {
                if($(this).val()<0)
                {
                    $(this).val("0");
                }
                else if(parseInt($(this).val())>parseInt($(this).attr("maxAmount")))
                {
                    $(this).val($(this).attr("maxAmount"));
                }
                $(this).parent().parent().find(".medTotPrice").html(($(this).attr("unitPrice")*$(this).val()).toFixed(2));
                var tot=0;
                $('.medTotPrice').each(function(i, obj) {
                    tot=tot+parseFloat($(obj).html());
                });
                tot=tot+parseFloat($("#docCharge").html());
                $("#totalAmount").html(tot.toFixed(2));
            });
        }
    });
}
$("#endBill").on('click',function(){
   createBill($("#totalAmount").html(),pid,$("#docCharge").html());
   // updateMed(billId); //Need to find the error of updateMed
   statusChange(pid);
});

function updateMed(billId){
    $('.billItemRow').each(function(i, obj) {
        medId=$(obj).attr("medId");
        medType=$(obj).find(".medType").html();
        medQty=$(obj).find(".medQty").val();
        medTot=$(obj).find(".medTotPrice").html();
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{type:'updateMed',medId:medId,medType:medType,medQty:medQty},
            success:function (data){
                // window.alert("Success");
            }
        });
        $.ajax({
            url:"../handlers/billHandler.php",
            method:"POST",
            data:{type:'addBillMed',billId:billId,medId:medId,medType:medType,medQty:medQty,medTot:medTot},
            success:function (data){
                // window.alert("Success");
            }
        });
    });
}


function createBill(totAmt,pid,docCharge){

      $.ajax({
        url:"../handlers/billHandler.php",
        method:"POST",
        data:{type:'createBill',totAmt:totAmt,pid:pid,docCharge:docCharge,billType:'pres'},
        success:function (data){
            updateMed(data);
            alert("Bill Successfully Ended!");
        }
    });
}

function statusChange(pid){
    $.ajax({
        url:"../handlers/prescriptionHandler.php",
        method:"POST",
        data:{type:'changeStatus',pid:pid},
        dataType:'json',
        success:function (data){
            getTodayPres();
        }
    });  
}

$("#editDocCharge").click(function(){
    $.ajax({
        url:"../handlers/doctorHandler.php",
        method:"POST",
        data:{type:'getDocCharge'},
        success:function (data){
            $("#docC").val(data);
            open(docCharge);
            $("#docC").change(function(){
                if($(this).val()<0){
                    $(this).val(data);
                    $(this).addClass("errorInput");
                    setTimeout(function(){
                        $("#docC").removeClass("errorInput");
                    },2000);
                }
            });
        }
    });  
});

$("#updateDocCharge").click(function(){
    $('#docChargeStatus').removeClass("success");
    $('#docChargeStatus').removeClass("error");
    var docC=$("#docC").val();
    $.ajax({
        url:"../handlers/doctorHandler.php",
        method:"POST",
        data:{type:'updateDocCharge',charge:docC},
        success:function (data){
            var docCharge = document.getElementById("docCharge");
            // close(docCharge);
            if(data==1){
                $('#docChargeStatus').addClass("success");
                $('#docChargeStatus').html("Successfully Updated!");
                $('#docChargeStatus').slideDown("slow");
                setTimeout(function(){
                    $('#docChargeStatus').slideUp("slow");
                },2000);
            }
            else{
                $('#docChargeStatus').addClass("error");
                $('#docChargeStatus').html("Update Failed!");
                $('#docChargeStatus').slideDown("slow");
                setTimeout(function(){
                    $('#docChargeStatus').slideUp("slow");
                },2000);
            }
        }
    });  
});