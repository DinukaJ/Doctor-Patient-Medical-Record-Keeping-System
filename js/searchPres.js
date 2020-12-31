

//getting all info at first load
$(document).ready(function(){
    getTodayPres();
    $("#updateStatus").hide();
});

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
    var pId=$("#patientID").val();//.split(" ");
   // pId=pId[0];
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
 splitVal = id.split("-");
 id = splitVal[1];
 patId = splitVal[3];
 patName = splitVal[4]+' '+splitVal[5];
 today = splitVal[6];
 $.ajax({
    url:"../handlers/prescriptionHandler.php",
    method:"POST",
    data:{type:'getTodayPresMed',id=id},
    dataType:"json",
    success:function (data){
        $("#presVals").html(data);
        $(".presId").html(id);
        $(".patId").html(patId);
        $(".patName").html(patName);
        $(".doi").html(today);
    }
 });

}