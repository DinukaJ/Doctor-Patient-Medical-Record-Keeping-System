var ser=document.getElementById("medId");
// var popInfo = document.getElementsByName("viewMed");
var modalViewMed = document.getElementById("modalViewMed");

//getting all info at first load
$(document).ready(function(){
    getAllMed();
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


            // //View Medicine Model
            open(modalViewMed);

            $(".close").click(()=>{
                close(modalViewMed);
            });
        }
        
    });
}
