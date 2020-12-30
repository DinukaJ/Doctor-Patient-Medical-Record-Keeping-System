

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
            $('#presInfo').html(data[0]);
            $("#itemCount").html(data[1]);
            $(".viewMed").click(function(){             
                putInventoryData(this.id);
            });
        }   
    });
}