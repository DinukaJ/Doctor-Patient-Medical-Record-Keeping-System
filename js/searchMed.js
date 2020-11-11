
var ser=document.getElementById("medId");
var modalViewMed = document.getElementById("modalViewMed");
var modalUpdateMed = document.getElementById("modalUpdateMed");


//getting all info at first load
$(document).ready(function(){
    getAllMed();
    $("#updateStatus").hide();
});

function getAllMed()
{
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{type:'getMed'},
        success:function(data){
            $('#medInfo').html(data);
            $(".viewMed").click(function(){             
                putInventoryData(this.id);
            });
        }   
    });
}
//updating list based on the user input
var a;
ser.addEventListener("keydown",function(){
    setTimeout(function(){
		a=ser.value;
        $.ajax({
            url:"../handlers/inventoryHandler.php",
            method:"POST",
            data:{medSearch:a, type:'searchMed'},
            success:function(data){
                $('#medInfo').html(data);
                $(".viewMed").click(function(){
                    putInventoryData(this.id);
                });
            }   
        });
    },100)
});


//handling getting med data when view clicked
function putInventoryData(id)
{
    medId=id.split("-");// splitting the id to get the medicine id
    medId=medId[1]; // assigning the medicine id
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data:{medId:medId, type:'medData'}, 
        dataType:'json',
        success:function(data){
            $('#medicId').html(data[0]);
            $('#medicName').html(data[1]);
            $('#medicSc').html(data[2]);
            $('#medTypes').html(data[3]);

             //View Medicine Model
            open(modalViewMed);
            delId = medId;
            //values get filled accordingly when the update button clicked
            $("#updateMed").click(()=>{
                open(modalUpdateMed);
                close(modalViewMed);
                $('#medUpID').val(data['id']);
                $('#medUpName').val(data['name']);
                $('#medUpPrice').val(data['price']);
                $('#medUpQty').val(data['qty']);
                $('#medUpSc').val(data['shortCode']);
            })

        }
        
    });
}

//Adding data to the database
// $('#medAddForm').on('submit',function(e){
//     e.preventDefault();
//     $.ajax({
//         url:"../handlers/inventoryHandler.php",
//         method:"POST",
//         data: $('#medAddForm').serialize()+"&type=addMed",
//         success:function(data){
//             close(modalAddMed);
//             getAllMed();
//         }
//     });
// });

//Updating Data
$('#medUpForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: $('#medUpForm').serialize()+"&type=upMed",
        success:function(data){
            // close(modalUpdateMed);
            if(data==1)
            {   
                $("#updateStatus").addClass("success");
                $("#updateStatus").html("Successfully Updated!");
                $("#updateStatus").slideDown("slow");
                setTimeout(function(){
                    $("#updateStatus").slideUp("slow");
                },2000);
            }
            else
            {
                $("#updateStatus").addClass("error");
                $("#updateStatus").html("Update Failed!");
                $("#updateStatus").slideDown("slow");
                setTimeout(function(){
                    $("#updateStatus").slideUp("slow");
                },2000);
            }
            getAllMed();
        }
    });
});

//Deleting Data
$('#deleteMed').click(function(){

    if(confirm("Are You Sure?")){
     $.ajax({
        url:"../handlers/inventoryHandler.php",
        method:"POST",
        data: {id:delId,type:'delMed'},
        success:function(){
            close(modalViewMed);
            getAllMed();
        }
     });
    }
  else{
      return false;
    }
    
});


//Add New Medicine
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


