var curr=0;
var ser=document.getElementById("patientID");

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
            putPatientData();
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
                url:"../handlers/patientHandler.php",
                method:"POST",
                data:{patientSearch:a, type:'searchP'},
                success:function(data){
                    if(data!="")
                    {
                        $('#subsresult').html(data);
                        $('#subsresult').slideDown();
                        $('.searchr').click(function(){
                            val=$(this).html();
                            ser.value=val;
                            putPatientData();
                            entered=true;
                        });
                    }
                }
                
            });
		},100)
	}
});

function putPatientData()
{
    var pId=val.split(" ");
    pId=pId[0];
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:pId, type:'patientData'},
        dataType:'json',
        success:function(data){
            var nameVal=$('#patName').html();
            $('#patName').html(nameVal+data['fname']+" "+data['lname']);
            var ageVal=$('#patAge').html();
            $('#patAge').html(ageVal+data['age']);
            $('#allergies').val(data['allergies']);
            $('#imp_Notes').val(data['impNotes']);
            $('#patientID').prop('disabled',true);
            $('#patientID').css('background-color','#e8e8e8');
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