var ser = document.getElementById("pnrId");

$(document).ready(function(){
    getAllRep();
});


function getAllRep(){
    $.ajax({
        url:'../handlers/labHandler.php',
        method:'POST',
        data:{type:'getAllRep'},
        dataType:'json',
        success:function(data){
            $('#reportInfo').html(data[0]);
            $('#totalCount').html(data[1]);
        }
    });
}

ser.addEventListener("keydown",function(){
    setTimeout(function(){
        $.ajax({
            url:'../handlers/labHandler.php',
            method:'POST',
            data:{id:ser.value,type:'searchRep'},
            dataType:'json',
            success:function(data){
                $('#reportInfo').html(data[0]);
                $('#totalCount').html(data[1]);
            }
        });
    },100)
});
