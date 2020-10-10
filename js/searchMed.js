var curr=0;
var ser=document.getElementById("medId");

var count=document.getElementById("secount");

		var a;
		setTimeout(function(){
			a=ser.value;
            curr=0;
            $.ajax({
                url:"../handlers/inventoryHandler.php",
                method:"POST",
                data:{medSearch:a, type:'searchMed'},
                success:function(data){
                    if(data!="")
                    {
                        $('#medInfo').html(data);
                        $('#medInfo').slideDown();
                        $('.searchr').click(function(){
                            val=$(this).html();
                            ser.value=val;
                            putInventoryData();
                            entered=true;
                        });
                    }
                }
                
            });
		},100)


//handling getting med data 
function putInventoryData()
{
    var mId=val.split(" ");
    mId=inId[0];
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{medId:mId, type:'medData'}, 
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
