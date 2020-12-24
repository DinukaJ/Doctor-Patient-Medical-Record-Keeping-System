
$(document).ready(function(){
    $('#patientID').focus();
});
$('#addRepStatus').hide();
$('#updateStatus').hide();

var ser=document.getElementById("patientID");
var count=document.getElementById("secount");
var sltRep = document.getElementById("reportType");

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
if(ser!=null){
    ser.addEventListener("blur", function(){
        // $('#searchResult').addClass('hideser');
        setTimeout(function(){
            $('#subsresult').slideUp();
            $('#subsresult').html("");
        },300);
        if(!entered)
            ser.value="";
        
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

// $("#upAddType").click(function(){
//     var rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><input type="text" class="input-field repTest" style="width:100%;" name="repTest" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRange" style="width:100%;" name="repRange" placeholder=""></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
//     $("#typeRowSection").append(rowData);
//     $(".delTest").click(function(){
//         $(this).parent().parent().remove();
//     });
// });


$("#finish").click(function(){
    var errMsg="";
    var x=0;
    if($("#patientID").val()=="" && val=="")
    {
        $('#patientID').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#patientID').removeClass('errorInput');
    }
    if($("#reportType").val()==null)
    {
        $('#reportType').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#reportType').removeClass('errorInput');
    }
    // if($(".typeRow").length>1)
    // {
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
    // }
    // else
    // {
    //     $(".repTest").removeClass('errorInput');
    //     if($(".repRes").val()=="")
    //     {
    //         $(".repRes").addClass('errorInput');
    //         x=1;
    //     }
    //     else
    //         $(".repRes").removeClass('errorInput');
    //     if($(".repRange").val()=="")
    //     {
    //         $(".repRange").addClass('errorInput');
    //         x=1;
    //     }
    //     else
    //         $(".repRange").removeClass('errorInput');
    // }

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
        var addStat=0;
        var patID=val.split(' ')[0];
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'repAdd',patId:patID,repType:$('#reportType').val()},
            success:function(data){
                if(data=="-1"){
                    $('#addRepStatus').addClass("error");
                    $('#addRepStatus').html("Failed!");
                    $('#addRepStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#addRepStatus').slideUp("slow");
                    },2000);
                }
                else
                {
                    addStat=1;
                    addReportData(data);
                    $('#patientID').val()="";
                }
            }
        });

    }
});

function addReportData(rId)
{
    
    $('.typeRow').each(function(i, obj) {
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'repAddData',rId:rId,repTest:$(obj).find(".repTest").val(),repRes:$(obj).find(".repRes").val(),repRange:$(obj).find(".repRange").val()},
            success:function(data){
                if(data!=1){
                    $('#addRepStatus').addClass("error");
                    $('#addRepStatus').html("Adding Failed!");
                    $('#addRepStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#updateStatus').slideUp("slow");
                    },2000);
                }
                else
                {
                    $('#addRepStatus').addClass("success");
                    $('#addRepStatus').html("Successfully Added!");
                    $('#addRepStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#addRepStatus').slideUp("slow");
                    },2000);
                    $('#patientID').val("");
                    val="";
                    $('#reportType').val(null);
                    $(".removeType").remove();
                    $('.repTest').val("");
                    $('.repRes').val("");
                    $('.repRange').val("");
                    $("#patName").html("");
                    $("#patAge").html("");
                }
            }
        });
    });
}


sltRep.addEventListener("click",function(e){
    // if(sltRep.value=="Lipid Profile-19"){
    //     var rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><input type="text" class="input-field repTest" style="width:100%;" name="repTest" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><input type="text" class="input-field repRange" style="width:100%;" name="repRange" placeholder=""></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
    //     $("#typeRowSection").append(rowData);
    //     $(".delTest").click(function(){
    //         $(this).parent().parent().remove();
    //     });
    $(".delTest").click(function(){
        $(this).parent().parent().remove();
    });
    if(sltRep.value!=""){
        var rowData = "";
        repId = sltRep.value.split("-");
        repId = repId[1];
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'testGet',rid:repId},
            dataType:'json',
            success:function(data){
                rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><select class="input-field fullWidth" name="testName" id="testName">'+data[0]+'</select></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><select class="input-field fullWidth" name="testRange" id="testRange">'+data[1]+'</select></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
                $("#typeRowSection").append(rowData);
                $("#upAddType").click(function(){
                    var rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><select class="input-field fullWidth" name="testName" id="testName">'+data[0]+'</select></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><select class="input-field fullWidth" name="testRange" id="testRange">'+data[1]+'</select></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
                    $("#typeRowSection").append(rowData);
                    $(".delTest").click(function(){
                        $(this).parent().parent().remove();
                    });
                });
                $(".delTest").click(function(){
                    $(this).parent().parent().remove();
                });

            }
        });
    }
    else{
        $(".typeRow").remove();
    }
});
