$(document).ready(function(){
    $("#allergyStatus").hide();
    $("#impStatus").hide();
});
var curr=0;
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
    pId=pId[0];
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:pId, type:'patientData'},
        dataType:'json',
        success:function(data){
            $("#patID").val(pId);
            var nameVal=$('#patName').html();
            $('#patName').html(nameVal+data['fname']+" "+data['lname']);
            var ageVal=$('#patAge').html();
            $('#patAge').html(ageVal+data['age']);
            $('#patientID').prop('disabled',true);
            $('#patientID').addClass('disable');
            $('.userData').removeClass('disable');
            $('.userData').prop('disabled',false);
            $('.medData').removeClass('disable');
            $('.medData').prop('disabled',false);
            $('#medicineCode').focus();
            //Patient Data Modal
            $("#pfirstName").html(data['fname']);
            $("#plastName").html(data['lname']);
            $("#pphone").html(data['phone']);
            $("#age").html(data['age']);
            $("#address").html(data['address']);
            getAllergyIMDetails(pId);
        }
        
    });
}
//For Patients Page
function putPatientData2(pidVal)
{
    val=pidVal;
    var pId=pidVal.split(" ");
    pId=pId[0];
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:pId, type:'patientData'},
        dataType:'json',
        success:function(data){
            //Patient Data Modal
            $("#pfirstName").html(data['fname']);
            $("#plastName").html(data['lname']);
            $("#pphone").html(data['phone']);
            $("#age").html(data['age']);
            $("#address").html(data['address']);
            getAllergyIMDetails(pId);
        }
        
    });
}

function getAllergyIMDetails(pId)
{
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:pId, type:'getAllergy'},
        dataType:'json',
        success:function(data){
            $("#allergyBox").html(data[0]);
            $("#impBox").html(data[1]);

            $(".delAllergy").click(function(){
                delAllergy(pId,$(this).attr("id"));
            });
            $(".delImp").click(function(){
                delImp(pId,$(this).attr("id"));
            });
        }
        
    });
}
$("#addAllergy").click(function(){
    var pId=val.split(" ");
    pId=pId[0];
    if($("#newAllergy").val()=="")
    {
        $("#newAllergy").addClass('errorInput');
    }
    else
    {
        $.ajax({
            url:"../handlers/patientHandler.php",
            method:"POST",
            data:{patientID:pId, type:'addAllergy', allergy:$("#newAllergy").val()},
            success:function(data){
                if(data==-1)
                {
                    $('#allergyStatus').removeClass('error');
                    $('#allergyStatus').removeClass('success');
                    $('#allergyStatus').addClass('error');
                    $('#allergyStatus').html("Allergy Already Added");
                    $('#allergyStatus').slideDown();
                    setTimeout(function(){
                        $('#allergyStatus').slideUp("slow");
                    },2000);
                }
                else if(data==0)
                {
                    $('#allergyStatus').removeClass('error');
                    $('#allergyStatus').removeClass('success');
                    $('#allergyStatus').addClass('error');
                    $('#allergyStatus').html("Something Went Wrong.");
                    $('#allergyStatus').slideDown();
                    setTimeout(function(){
                        $('#allergyStatus').slideUp("slow");
                    },2000);
                }
                else
                {
                    getAllergyIMDetails(pId);
                    $("#newAllergy").val("");
                }
            }
            
        });
    }
});
$("#addImportantNote").click(function(){
    var pId=val.split(" ");
    pId=pId[0];
    if($("#newImp").val()=="")
    {
        $("#newImp").addClass('errorInput');
    }
    else
    {
        $.ajax({
            url:"../handlers/patientHandler.php",
            method:"POST",
            data:{patientID:pId, type:'addImp', imp:$("#newImp").val()},
            success:function(data){
                if(data==-1)
                {
                    $('#impStatus').removeClass('error');
                    $('#impStatus').removeClass('success');
                    $('#impStatus').addClass('error');
                    $('#impStatus').html("Note Already Added");
                    $('#impStatus').slideDown();
                    setTimeout(function(){
                        $('#impStatus').slideUp("slow");
                    },2000);
                }
                else if(data==0)
                {
                    $('#impStatus').removeClass('error');
                    $('#impStatus').removeClass('success');
                    $('#impStatus').addClass('error');
                    $('#impStatus').html("Something Went Wrong.");
                    $('#impStatus').slideDown();
                    setTimeout(function(){
                        $('#impStatus').slideUp("slow");
                    },2000);
                }
                else
                {
                    getAllergyIMDetails(pId);
                    $("#newImp").val("");
                }
            }
            
        });
    }
});

function delAllergy(id,allergy)
{
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:id, type:'delAllergy', allergy:allergy},
        success:function(data){
            getAllergyIMDetails(id);
        }
        
    });
}
function delImp(id,impNotes)
{
    $.ajax({
        url:"../handlers/patientHandler.php",
        method:"POST",
        data:{patientID:id, type:'delImp', imp:impNotes},
        success:function(data){
            getAllergyIMDetails(id)
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
