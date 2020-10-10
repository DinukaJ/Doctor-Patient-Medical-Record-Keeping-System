var curr=0;
var ser=document.getElementById("medId");

var count=document.getElementById("secount");

var val="";
var entered=false;
ser.addEventListener("keydown", function(e){
    entered=false;
	count=document.getElementById("secount");
	if(e.keyCode==40 && count.value!=0){
		//Down Arrow
		if(curr==count.value)
		{
			curr=1;
		}
		else
		{
			curr=curr+1;
		}
		$('.activeser').removeClass('activeser');
		$('.se'+curr).addClass('activeser');
		val=$('.se'+curr).html();
		ser.value=val;
	}
	else if(e.keyCode==38 && count.value!=0){
		//Up Arrow
		if(curr==1)
		{
			curr=count.value;
		}
		else
		{
			curr=curr-1;
		}
		$('.activeser').removeClass('activeser');
		$('.se'+curr).addClass('activeser');
		val=$('.se'+curr).html();
		ser.value=val;
	}
	else if(e.keyCode==13)
	{
        //Enter
        if(ser.value==val)
        {
            putInventoryData();
            entered=true;
        }

	}
	else
	{
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
                        $('#subsresult').html(data);
                        $('#subsresult').slideDown();
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
	}
});

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
            $('.medicPrice').html(data['price']);
            $('.medicQty').html(data['qty']);
            $('.medicSc').html(data['shortCode']);
            // var ageVal=$('#patAge').html();
            // $('#patAge').html(ageVal+data['age']);
            // $('#allergies').val(data['allergies']);
            // $('#imp_Notes').val(data['impNotes']);
            // $('#patientID').prop('disabled',true);
            // $('#patientID').css('background-color','#e8e8e8');
        }
        
    });
}
ser.addEventListener("blur", function(){
	// $('#searchResult').addClass('hideser');
	setTimeout(function(){
        $('#subsresult').slideUp();
        $('#subsresult').html("");
    },300);
    if(!entered)
        ser.value="";
	
});
