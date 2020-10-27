

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