var ser=document.getElementById("medId");
// var popInfo = document.getElementsByName("viewMed");
var modalViewMed = document.getElementById("modalViewMed");

//getting all info at first load
$(document).ready(function(){
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
            $(".viewMed").click(function(){             
                modalView(this.id);
            });
        }   
    });
});

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
                    modalView(this.id);
                });
            }   
        });
    },100)
});


//handling getting med data when view clicked
function putInventoryData(id)
{
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{medId:id, type:'medData'}, 
        dataType:'json',
        success:function(data){
            $('#medicId').html(data['id']);
            $('#medicName').html(data['name']);
            $('#medicPrice').html(data['price']);
            $('#medicQty').html(data['qty']);
            $('#medicSc').html(data['shortCode']);

            var modalViewMed = document.getElementById("modalViewMed");

            //View Medicine Model
            $(".viewMed").click(()=>{
                open(modalViewMed);
            });

            $(".close").click(()=>{
                close(modalViewMed);
            });
        }
        
    });
}

//listening to the view
// popInfo.addEventListener("click",function(e){
function modalView(id)
{
    //var mId = $(val).attr('id');//getting id of the clicked row
    medId=id.split("-");// splitting the id to get the medicine id
    medId=medId[1]; // assigning the medicine id

    putInventoryData(medId); // passing the id to fill the pop up with data
}