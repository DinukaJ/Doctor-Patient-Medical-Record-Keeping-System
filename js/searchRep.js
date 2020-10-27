var ser = getElementById("pnrId");

$(document).ready(function(){
    getAllRep();
});


function getAllRep(){
    $.ajax({
        url:'../handlers/labHandler.php',
        method:'POST',
        data:{type:'getAllRep'},
        success:function(data){
            $('#reportInfo').html(data);
        }
    });
}

ser.addEventListener("keydown",function(){
    setTimeout(function(){
        $.ajax({
            url:'../handler/labHandler.php',
            method:'POST',
            data:{id:ser.value,type:'searchRep'},
            success:function(data){
                $('#reportInfo').html(data);
            }
        });
    },100)
});
