

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