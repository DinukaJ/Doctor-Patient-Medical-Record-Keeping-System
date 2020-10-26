
function getAllRep(){
    $.ajax({
        url:'../handlers/labHandler.php',
        method:'POST',
        data:{type:'getAllRep'},
        dataType:'json',
        success:function(data){
            $('#reportInfo').html(data);
        }
    });
}