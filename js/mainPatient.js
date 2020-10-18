var modalUpdateDet = document.getElementById("modalUpdateDet");
$('#editProfile').click(()=>{
    var patID = $("#patientID").val();
    open(modalUpdateDet);
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:patID,type:'patientData'},
        dataType:'json',
        success:function(data){
            $('#firstName').val(data['fname']);
            $('#lastName').val(data['lname']);
            $('#phone').val(data['phone']);
            $('#age').val(data['age']);
            $('#address').val(data['address']);

        }
    });
});

$('#usrDetailUp').on('submit',function(e){
    var patID = $("#patientID").val();
    e.preventDefault();
    
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:$('#usrDetailUp').serialize()+"&type=upDet&patientID="+patID,
        success:function(data){
            if(data==1){
                $('#updateStatusInfo').addClass("success");
                $('#updateStatusInfo').html("Successfully Updated!");
                $('#updateStatusInfo').slideDown("slow");
                setTimeout(function(){
                    $('#updateStatusInfo').slideUp("slow");
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
});