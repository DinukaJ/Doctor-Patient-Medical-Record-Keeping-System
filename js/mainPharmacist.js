$(document).ready(function(){
    $("#addMedStatus").hide();
});
//Add More Types
$("#addType").click(function(){
    $("#typeRowSection").append('<div class="typeRow row"><div class="c-m-4"><label for="medname">Type Name: </label><input type="text" class="input-field medType" style="width:100%;" name="medType" placeholder=""></div><div class="c-m-3"><label for="medname">QTY: </label><input type="number" class="input-field medQTY" style="width:100%;" name="medQTY" placeholder=""></div><div class="c-m-4"><label for="medname">Price: </label><input type="number" class="input-field medPrice" style="width:100%;" name="medPrice" placeholder=""></div><div class="c-m-1"><label for="medname"></label><button type="button" value="" class="btn delType delMed" name="delType"><i class="fas fa-times"></i></button></div></div>');
    $(".delMed").click(function(){
        $(this).parent().parent().remove();
    });
});
//Remove Types
$(".delMed").click(function(){
    $(this).parent().parent().remove();
});
//Execute when save button clicked

$("#addMedSave").click(function(){
    var errMsg="";
    var x=0;
    if($("#medNameAdd").val()=="")
    {
        $('#medNameAdd').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#medNameAdd').removeClass('errorInput');
    }
    if($("#medScAdd").val()=="")
    {
        $('#medScAdd').addClass('errorInput');
        x=1;
    }
    else
    {
        $('#medScAdd').removeClass('errorInput');
    }
    if($(".typeRow").length>1)
    {
        var z=0;
        $('.medType').each(function(i, obj) {
            if($(obj).val()=="")
            {
                $(obj).addClass('errorInput');
                z=1;
            }
            else
                $(obj).removeClass('errorInput');
        });
        $('.medQTY').each(function(i, obj) {
            if($(obj).val()=="")
            {
                $(obj).addClass('errorInput');
                z=1;
            }
            else
                $(obj).removeClass('errorInput');
        });
        $('.medPrice').each(function(i, obj) {
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
        $(".medType").removeClass('errorInput');
        if($(".medQTY").val()=="")
        {
            $(".medQTY").addClass('errorInput');
            x=1;
        }
        else
            $(".medQTY").removeClass('errorInput');
        if($(".medPrice").val()=="")
        {
            $(".medPrice").addClass('errorInput');
            x=1;
        }
        else
            $(".medPrice").removeClass('errorInput');
    }

    if(x==1)
    {
        $('#addMedStatus').removeClass('error');
        $('#addMedStatus').removeClass('success');
        $('#addMedStatus').addClass('error');
        $('#addMedStatus').html("These Fields Cannot be Empty.");
        $('#addMedStatus').slideDown();
        setTimeout(function(){
            $('#addMedStatus').slideUp('slow');
        },5000);
    }
    else
    {
        $('#addMedStatus').removeClass('error');
        $('#addMedStatus').removeClass('success');
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{type:'addMed',medName:$("#medNameAdd").val(),medSc:$("#medScAdd").val()},
            success:function(data){
                if(data){
                    addMedTypes(data);
                    $('#addMedStatus').addClass("success");
                    $('#addMedStatus').html("Successfully Updated!");
                    $('#addMedStatus').slideDown("slow");
                    getAllMed();
                    setTimeout(function(){
                        $('#addMedStatus').slideUp("slow");
                    },2000);
                    $("#medNameAdd").val("");
                    $("#medScAdd").val("");
                }
                else{
                    $('#addMedStatus').addClass("error");
                    $('#addMedStatus').html("Update Failed!");
                    $('#addMedStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#addMedStatus').slideUp("slow");
                    },2000);
                }
            }
        });
    }
});

//Function to add medicine types
function addMedTypes(id)
{
    $('.typeRow').each(function(i, obj) {
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{type:'addMedTypes',medId:id,medType:$(obj).find(".medType").val(),price:$(obj).find(".medPrice").val(),qty:$(obj).find(".medQTY").val()},
            success:function(data){
                if(data!=1){
                    $('#addMedStatus').addClass("error");
                    $('#addMedStatus').html("Update Failed!");
                    $('#addMedStatus').slideDown("slow");
                    setTimeout(function(){
                        $('#addMedStatus').slideUp("slow");
                    },2000);
                }
                if(i==0)
                {
                    $(obj).find(".medType").val("");
                    $(obj).find(".medPrice").val("");
                    $(obj).find(".medQTY").val("");
                }
                else
                    $(obj).remove();
            }
        });
    });
}
//Clear after adding
function clearFields()
{

}
//Updating existing records after data adding
function getAllMed()
{
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
        }   
    });
}