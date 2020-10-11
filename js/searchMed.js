var ser=document.getElementById("medId");
var popInfo = document.getElementsByName("viewMed");

//getting all info at first load
$(document).ready(function(){
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
        }   
    });
});

//updating list based on the user input
var a;
ser.addEventListener("keydown",function(){
		a=ser.value;
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{medSearch:a, type:'searchMed'},
            success:function(data){
                $('#medInfo').html(data);
            }   
        });
});


//handling getting med data when view clicked
function putInventoryData(val)
{
    var mId=val.split("-");
    meId=mId[1];
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{medId:meId, type:'medData'}, 
        dataType:'json',
        success:function(data){
            
            $('#medicId').html(data['id']);
            $('#medicName').html(data['name']);
            $('#medicPrice').html(data['price']);
            $('#medicQty').html(data['qty']);
            $('#medicSc').html(data['shortCode']);
        }
        
    });
}

//listening to the view
popInfo.addEventListener("click",function(e){
   var id = e.target.attr("id");
   putInventoryData(id);
});