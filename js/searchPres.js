

$(document).ready(function(){
    getAllPres();
});

function getAllPres(){
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{type:'getPres'},
        success:function(data){
            $('#presInfo').html(data);
        }
    })
}