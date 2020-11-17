
$(document).ready(function(){
    $('#patientID').focus();
});


var ser=document.getElementById("patientID");
var count=document.getElementById("secount");

var val="";
var entered=false;
if(ser!=null){
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
}

function putPatientData()
{
    var pId=val.split(" ");
    var fname="";
    pId=pId[0];
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:pId, type:'patientData'},
        dataType:'json',
        success:function(data){
            fname = data['fname']+' '+data['lname'];
            $("#patName").html(fname);
            $("#patAge").html(data['age']);
            $('#subsresult').slideUp();
        }
        
    });
}

$("#upAddType").click(function(){
    var rowData='<div class="typeRow row" style="margin-top:10px;"><div class="c-m-5"><input type="text" class="input-field repTest" style="width:100%;" name="repTest" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRange" style="width:100%;" name="repRange" placeholder=""></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
    $("#typeRowSection").append(rowData);
    $(".delTest").click(function(){
        $(this).parent().parent().remove();
    });
});

$("#finish").click(function(){
    var errMsg="";
    var x=0;
    if($("#patientID").val()=="")
    {
        $('#patientID').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#patientID').removeClass('errorInput');
    }
    if($("#reportType").val()=="")
    {
        $('#reportType').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#reportType').removeClass('errorInput');
    }
    if($(".typeRow").length>1)
    {
        var z=0;
        $('.repTest').each(function(i, obj) {
            if($(obj).val()=="")
            {
                $(obj).addClass('errorInput');
                z=1;
            }
            else
                $(obj).removeClass('errorInput');
        });
        $('.repRes').each(function(i, obj) {
            if($(obj).val()=="")
            {
                $(obj).addClass('errorInput');
                z=1;
            }
            else
                $(obj).removeClass('errorInput');
        });
        $('.repRange').each(function(i, obj) {
            if($(obj).val()=="")
            {
                $(obj).addClass('errorInput');
                z=1;
            }
            else
                $(obj).removeClass('errorInput');
        });
        if(z==1)
        {
            x=1;
        }
    }
    else
    {
        $(".repTest").removeClass('errorInput');
        if($(".repRes").val()=="")
        {
            $(".repRes").addClass('errorInput');
            x=1;
        }
        else
            $(".repRes").removeClass('errorInput');
        if($(".repRange").val()=="")
        {
            $(".repRange").addClass('errorInput');
            x=1;
        }
        else
            $(".repRange").removeClass('errorInput');
    }

    if(x==1)
    {
        $('#addRepStatus').removeClass('error');
        $('#addRepStatus').removeClass('success');
        $('#addRepStatus').addClass('error');
        $('#addRepStatus').html("These Fields Cannot be Empty.");
        $('#addRepStatus').slideDown();
        setTimeout(function(){
            $('#addRepStatus').slideUp('slow');
        },5000);
    }
    else
    {
        $('#addRepStatus').removeClass('error');
        $('#addRepStatus').removeClass('success');
        $('.typeRow').each(function(i, obj) {
            $.ajax({
                url:"../handlers/labHandler.php",
                method:"POST",
                data:{type:'repAdd',patId:$('#patientID').val(),repType:$('#reportType').val(),repTest:$(obj).find(".repTest").val(),repRes:$(obj).find(".repRes").val(),repRange:$(obj).find(".repRange").val()},
                success:function(data){
                    if(data!=1){
                        $('#updateStatus').addClass("error");
                        $('#updateStatus').html("Update Failed!");
                        $('#updateStatus').slideDown("slow");
                        setTimeout(function(){
                            $('#updateStatus').slideUp("slow");
                        },2000);
                    }
                    else
                    {
                        $('#patientID').val()="";
                    }
                }
            });
        });
    }
});

