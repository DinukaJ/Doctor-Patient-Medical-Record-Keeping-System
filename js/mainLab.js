
$(document).ready(function(){
    $('#patientID').focus();

});
$(".leftValue").hide();
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
    var x2=0;
    if($("#patientID").val()=="" && val=="")
    {
        $('#patientID').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#patientID').removeClass('errorInput');
    }
    if($(".typeRow").length==0)
    {
        x2=1;
    }
    else if($(".typeRow").length>=1)
    {
        var z=0;
        $('.repRes').each(function(i, obj) {
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
    else if(x2==1)
    {
        $('#addRepStatus').removeClass('error');
        $('#addRepStatus').removeClass('success');
        $('#addRepStatus').addClass('error');
        $('#addRepStatus').html("There is no any report type added.");
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
            data:{type:'repAdd',patId:patID,cmt:$("#comment").val()},
            success:function(data){
                if(data=="-1")
                {
                    $('#addRepStatus').removeClass('error');
                    $('#addRepStatus').removeClass('success');
                    $('#addRepStatus').addClass('error');
                    $('#addRepStatus').html("Something Went Wrong");
                    $('#addRepStatus').slideDown();
                    setTimeout(function(){
                        $('#addRepStatus').slideUp('slow');
                    },5000);
                }
                else
                {
                    var reportId=data;
                    $('.resultSet').each(function(i, obj) {
                        var repId=$(obj).parent().find(".repTypeId").val();
                        $.ajax({
                            url:"../handlers/labHandler.php",
                            method:"POST",
                            data:{type:'repAddData',reportId:reportId,rId:repId,tName:$(obj).find(".testName").html(),result:$(obj).find(".repRes").val()},
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
                                    addStat=1;
                                    $('#addRepStatus').addClass("success");
                                    $('#addRepStatus').html("Successfully Added!");
                                    $('#addRepStatus').slideDown("slow");
                                    setTimeout(function(){
                                        $('#addRepStatus').slideUp("slow");
                                    },2000);
                                    $("#patName").empty();
                                    $("#patAge").empty();
                                    $("#patientID").val("");
                                    $("#typeRowSection").empty();
                                    $("#comment").val("");
                                    $('#reportType').prop('selectedIndex',0);
                                    addedItemsArr=[];
                                    // $("#reportType").prop("disabled",false);
                                }
                            }
                        });
                    });
                }
            }
        });
       

    }
});



//sltRep.addEventListener("click",function(e){

    // $("#reportType").prop("disabled",true);

    // if(sltRep.value!=""){
    //     var rowData = "";
    //     repId = sltRep.value.split("-");
    //     repId = repId[1];
    //     $.ajax({
    //         url:"../handlers/labHandler.php",
    //         method:"POST",
    //         data:{type:'testGet',rid:repId},
    //         dataType:'json',
    //         success:function(data){
    //             rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><select class="input-field fullWidth repTest" name="repTest" >'+data[0]+'</select></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><select class="input-field fullWidth repRange" name="repRange" >'+data[1]+'</select></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
    //             $("#typeRowSection").append(rowData);
    //             $("#upAddType").click(function(){
    //                 var rowData='<div class="typeRow row removeType" style="margin-top:10px;"><div class="c-m-5"><select class="input-field fullWidth repTest" name="repTest">'+data[0]+'</select></div><div class="c-m-3"><input type="text" class="input-field repRes" style="width:100%;" name="repRes" placeholder=""></div><div class="c-m-3"><select class="input-field fullWidth repRange" name="repRange">'+data[1]+'</select></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delMed delTest" name="delType"><i class="fas fa-times"></i></button></div></div>';
    //                 $("#typeRowSection").append(rowData);
    //                 $(".delTest").click(function(){
    //                     $(this).parent().parent().remove();
    //                 });
    //             });
    //             $(".delTest").click(function(){
    //                 $(this).parent().parent().remove();
    //             });

    //         }
    //     });
    // }
    // else{
    //     $(".typeRow").remove();
    // }
//});

$("#cancel").click(function(){
    $("#patName").empty();
    $("#patAge").empty();
    $("#patientID").val("");
    $("#typeRowSection").empty();
    $("#comment").val("");
    $('#reportType').prop('selectedIndex',0);
    // $("#reportType").prop("disabled",false);
});

$(document).on("change",".rangeType",function(){
    if($(this).val()=="-")
    {

        $(this).parent().parent().find(".leftValue").show();
    }
    else
    {
        $(this).parent().parent().find(".leftValue").hide();
    }
});

function loadTestTypes($type)
{
    $.ajax({
        url:"../handlers/labHandler.php",
        method:"POST",
        data:{type:'reportTypes',selectType:$type},
        success:function(data){
            $("#reportType2").html(data);
            $("#reportType").html(data);
        }
    });
}
loadTestTypes("");

$("#upAddNewType").click(function(){
    if($("#newReportType").val()=="")
    {
        $('#newReportType').addClass('errorInput');
    }
    else
    {
        $('#newReportType').removeClass('errorInput');
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'addReportType', repType:$("#newReportType").val()},
            success:function(data){
                if(data=="-1")
                {
                    $('#addRepStatus').addClass('error');
                    $('#addRepStatus').html("This Report Type is Already Added.");
                    $('#addRepStatus').slideDown();
                    setTimeout(function(){
                        $('#addRepStatus').slideUp('slow');
                    },5000);
                }
                else
                {
                    loadTestTypes($("#newReportType").val());
                    $("#newReportType").val("");
                }
            }
        });
    }
});

$("#addTestType").click(function(){
    var x=0;
    var rId;
    var tName;
    var val1=null;
    var val2;
    var range;
    var unit;
    if($("#reportType2").val()==null)
    {
        x=1;
        $("#reportType2").addClass('errorInput');
    }
    else
    {
        $("#reportType2").removeClass('errorInput');
        rId=$("#reportType2").val();
    }
    if($(this).parent().parent().find(".testName").val()=="")
    {
        x=1;
        $(this).parent().parent().find(".testName").addClass('errorInput');
    }
    else
    {
        $(this).parent().parent().find(".testName").removeClass('errorInput');
        tName=$(this).parent().parent().find(".testName").val();
    }
    if($(this).parent().parent().find(".rangeType").val()=="-")
    {
        if($(this).parent().parent().find(".val1").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val1").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val1").removeClass('errorInput');
            val1= $(this).parent().parent().find(".val1").val();
        }
        if($(this).parent().parent().find(".val2").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val2").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val2").removeClass('errorInput');
            val2= $(this).parent().parent().find(".val2").val();
        }
    }
    else
    {
        if($(this).parent().parent().find(".val2").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val2").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val2").removeClass('errorInput');
            val2= $(this).parent().parent().find(".val2").val();
        }
    }
    range=$(this).parent().parent().find(".rangeType").val();
    unit=$(this).parent().parent().find(".unit").val();

    if(x==0)
    {
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'addReportFields', repId:rId, testName:tName, value1:val1, value2:val2, rangeVal:range, unitVal:unit},
            success:function(data){
                if(data=="-1")
                {
                    $('#addRepStatus').addClass('error');
                    $('#addRepStatus').html("This Test Name is Already Added.");
                    $('#addRepStatus').slideDown();
                    setTimeout(function(){
                        $('#addRepStatus').slideUp('slow');
                    },5000);
                }
                else
                {
                    $("#typeRowSectionReportAdd").html(data);
                    $("#typeRowSectionReportAdd").find(".leftValue").hide();
                    clearTestNameInputSection();
                }
            }
        });
    }
});

function clearTestNameInputSection()
{
    $("#testName").val("");
    $("#mainTestNameSection").find(".leftValue").hide();
    $("#mainTestNameSection").find(".val1").val("");
    $("#mainTestNameSection").find(".val2").val("");
    $("#mainTestNameSection").find(".rangeType").prop('selectedIndex',0);
    $("#mainTestNameSection").find(".unit").prop('selectedIndex',0);
}


$(document).on("change","#reportType2",function(){
    $.ajax({
        url:"../handlers/labHandler.php",
        method:"POST",
        data:{type:'getReportFields', repId:$(this).val()},
        success:function(data){
            $("#typeRowSectionReportAdd").html(data);
            $("#typeRowSectionReportAdd").find(".leftValue").hide();
            clearTestNameInputSection();
        }
    });
});

$(document).on("click",".addMoreUnits",function(){
    var x=0;
    var rId=$("#reportType2").val();
    var tName=$(this).val();
    var val1=null;
    var val2;
    var range;
    var unit;

    if($(this).parent().parent().find(".rangeType").val()=="-")
    {
        if($(this).parent().parent().find(".val1").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val1").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val1").removeClass('errorInput');
            val1= $(this).parent().parent().find(".val1").val();
        }
        if($(this).parent().parent().find(".val2").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val2").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val2").removeClass('errorInput');
            val2= $(this).parent().parent().find(".val2").val();
        }
    }
    else
    {
        if($(this).parent().parent().find(".val2").val()=="")
        {
            x=1;
            $(this).parent().parent().find(".val2").addClass('errorInput');
        }
        else
        {
            $(this).parent().parent().find(".val2").removeClass('errorInput');
            val2= $(this).parent().parent().find(".val2").val();
        }
    }
    range=$(this).parent().parent().find(".rangeType").val();
    unit=$(this).parent().parent().find(".unit").val();

    if(x==0)
    {
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'addReportFields', repId:rId, testName:tName, value1:val1, value2:val2, rangeVal:range, unitVal:unit},
            success:function(data){
                if(data=="-1")
                {
                    $('#addRepStatus').removeClass('error');
                    $('#addRepStatus').removeClass('success');
                    $('#addRepStatus').addClass('error');
                    $('#addRepStatus').html("This Test Name is Already Added.");
                    $('#addRepStatus').slideDown();
                    setTimeout(function(){
                        $('#addRepStatus').slideUp('slow');
                    },5000);
                }
                else
                {
                    $("#typeRowSectionReportAdd").html(data);
                    $("#typeRowSectionReportAdd").find(".leftValue").hide();
                    clearTestNameInputSection();
                }
            }
        });
    }
});

$(document).on("click",".delTestName",function(){
    var value=$(this).val();
    var rId=value.split("~")[0];
    var tName=value.split("~")[1];
    var range=value.split("~")[2]+"~"+value.split("~")[3];
    if(confirm("Are you sure to delete?"))
    {
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'deleteReportFields', repId:rId, testName:tName, rangeVal:range},
            success:function(data){
                if(data=="-1")
                {
                    $('#addRepStatus').removeClass('error');
                    $('#addRepStatus').removeClass('success');
                    $('#addRepStatus').addClass('error');
                    $('#addRepStatus').html("Something Went Wrong.");
                    $('#addRepStatus').slideDown();
                    setTimeout(function(){
                        $('#addRepStatus').slideUp('slow');
                    },5000);
                }
                else
                {
                    $("#typeRowSectionReportAdd").html(data);
                    $("#typeRowSectionReportAdd").find(".leftValue").hide();
                    clearTestNameInputSection();
                }
            }
        });
    }
});

$("#clearBtn").click(function(){
    location.reload();
});

var addedItemsArr=Array();
$(document).on("change","#reportType",function(){
    if(addedItemsArr.includes($(this).val()))
    {
        $('#addRepStatus').removeClass('error');
        $('#addRepStatus').removeClass('success');
        $('#addRepStatus').addClass('error');
        $('#addRepStatus').html("Already Added");
        $('#addRepStatus').slideDown();
        setTimeout(function(){
            $('#addRepStatus').slideUp('slow');
        },5000);
    }
    else
    {
        $.ajax({
            url:"../handlers/labHandler.php",
            method:"POST",
            data:{type:'getReportFieldsAdd', repId:$(this).val(), repName:$(this).children("option:selected").html()},
            success:function(data){
                var d=data.replaceAll("~"," ");
                $("#typeRowSection").append(d);
                if(data)
                 addedItemsArr.push($("#reportType").val());
            }
        });
    }
});

$(document).on("click",".removeTestName",function(){
    var rId=$(this).val();
    delete addedItemsArr[addedItemsArr.indexOf(rId)];
    $(this).parent().parent().remove();
});
