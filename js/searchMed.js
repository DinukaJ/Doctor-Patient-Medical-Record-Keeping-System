
var ser=document.getElementById("medId");
var modalViewMed = document.getElementById("modalViewMed");
var modalUpdateMed = document.getElementById("modalUpdateMed");
var upId;

//getting all info at first load
$(document).ready(function(){
    getAllMed();
    $("#updateStatus").hide();
});

function getAllMed()
{
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
            $(".viewMed").click(function(){             
                putInventoryData(this.id);
            });
        }   
    });
}
//updating list based on the user input
var a;
ser.addEventListener("keydown",function(){
    setTimeout(function(){
		a=ser.value;
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{medSearch:a, type:'searchMed'},
            success:function(data){
                $('#medInfo').html(data);
                $(".viewMed").click(function(){
                    putInventoryData(this.id);
                });
            }   
        });
    },100)
});


//handling getting med data when view clicked
function putInventoryData(id)
{
    medId=id.split("-");// splitting the id to get the medicine id
    medId=medId[1]; // assigning the medicine id
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{medId:medId, type:'medData'}, 
        dataType:'json',
        success:function(data){
            $('#medicId').html(data['id']);
            $('#medicName').html(data['name']);
            $('#medicPrice').html(data['price']);
            $('#medicQty').html(data['qty']);
            $('#medicSc').html(data['shortCode']);

             //View Medicine Model
            open(modalViewMed);
            upId = medId;
            //values get filled accordingly when the update button clicked
            $("#updateMed").click(()=>{
                open(modalUpdateMed);
                close(modalViewMed);
                $('#medUpID').val(data['id']);
                $('#medUpName').val(data['name']);
                $('#medUpPrice').val(data['price']);
                $('#medUpQty').val(data['qty']);
                $('#medUpSc').val(data['shortCode']);
            })

        }
        
    });
}

//Adding data to the database
$('#medAddForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: $('#medAddForm').serialize()+"&type=addMed",
        success:function(data){
            close(modalAddMed);
            getAllMed();
        }
    });
});

//Updating Data
$('#medUpForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: $('#medUpForm').serialize()+"&type=upMed&id=upId",
        success:function(data){
            // close(modalUpdateMed);
            if(data==1)
            {   
                $("#updateStatus").addClass("success");
                $("#updateStatus").html("Successfully Updated!");
                $("#updateStatus").slideDown("slow");
                setTimeout(function(){
                    $("#updateStatus").slideUp("slow");
                },2000);
            }
            else
            {
                $("#updateStatus").addClass("error");
                $("#updateStatus").html("Update Failed!");
                $("#updateStatus").slideDown("slow");
                setTimeout(function(){
                    $("#updateStatus").slideUp("slow");
                },2000);
            }
            getAllMed();
        }
    });
});

//Deleting Data
$('#deleteMed').click(function(){

    if(confirm("Are You Sure?")){
     $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: {id:upId,type:'delMed'},
        success:function(){
            close(modalViewMed);
            getAllMed();
        }
     });
    }
  else{
      return false;
    }


});

