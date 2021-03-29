var curr=0;
var serMed=document.getElementById("medicineCode");

var count=document.getElementById("secountMed");

var val="";
var entered=false;
serMed.addEventListener("keydown", function(e){
    if(e.keyCode!=39)
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
		serMed.value=val;
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
		serMed.value=val;
	}
	else if(e.keyCode==13)
	{
        //Enter
        if(serMed.value==val)
        {
            //putPatientData();
            entered=true;
            $("#amountPTime").focus();
        }
    }
    else if(e.keyCode==39)
    {
        $("#amountPTime").focus();
    }
	else
	{
		var a;
		setTimeout(function(){
			a=serMed.value;
		
            curr=0;
            $.ajax({
                url:"../handlers/inventoryHandler.php",
                method:"POST",
                data:{medSearch:a, type:'searchDocMed'},
                success:function(data){
                    if(data!="")
                    {
                        $('#subsresultMed').html(data);
                        $('#subsresultMed').slideDown();
                        $('.searchr').click(function(){
                            val=$(this).html();
                            serMed.value=val;
                            //putPatientData();
                            entered=true;
                        });
                    }
                }
                
            });
		},100)
	}
});

serMed.addEventListener("blur", function(){
	// $('#searchResult').addClass('hideser');
	setTimeout(function(){
        $('#subsresultMed').slideUp();
        $('#subsresultMed').html("");
    },300);
    if(!entered)
    	serMed.value="";
	
});
