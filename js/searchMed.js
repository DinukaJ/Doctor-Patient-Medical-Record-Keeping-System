var ser=document.getElementById("medId");
var popInfo = document.getElementsByName("viewMed");
var count=document.getElementById("secount");


setTimeout(function(){
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
        }   
    });
},100);

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


//handling getting med data 
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
            // var nameVal=$('#patName').html();
            $('.medicId').html(data['id']);
            $('.medicName').html(data['name']);
            $('#medicPrice').html(data['price']);
            $('#medicQty').html(data['qty']);
            $('#medicSc').html(data['shortCode']);
            // var ageVal=$('#patAge').html();
            // $('#patAge').html(ageVal+data['age']);
            // $('#allergies').val(data['allergies']);
            // $('#imp_Notes').val(data['impNotes']);
            // $('#patientID').prop('disabled',true);
            // $('#patientID').css('background-color','#e8e8e8');
        }
        
    });
}


popInfo.addEventListener("click",function(e){
   var id = e.target.attr("id");
   putInventoryData(id);
});