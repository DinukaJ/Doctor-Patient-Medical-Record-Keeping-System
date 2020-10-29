var ser = document.getElementById("pnrId");
var modalViewRep = document.getElementById("modalViewRep");

$(document).ready(function(){
    getAllRep();
});


function getAllRep(){
    $.ajax({
        url:'../handlers/labHandler.php',
        method:'POST',
        data:{type:'getAllRep'},
        dataType:'json',
        success:function(data){
            $('#reportInfo').html(data[0]);
            $('#totalCount').html(data[1]);
            $('.viewRep').click(function(){
            putReportData(this.id);
            });
        }
    });
}

ser.addEventListener("keydown",function(){
    setTimeout(function(){
        $.ajax({
            url:'../handlers/labHandler.php',
            method:'POST',
            data:{id:ser.value,type:'searchRep'},
            dataType:'json',
            success:function(data){
                $('#reportInfo').html(data[0]);
                $('#totalCount').html(data[1]);
                $('.viewRep').click(function(){
                    putReportData(this.id);
                });
            }
        });
    },100)
});

//handling getting Rep data when view clicked
function putReportData(id)
{
    repId=id.split("-");// splitting the id to get the report id
    repId=repId[1]; // assigning the report id
    $.ajax({
        url:"../handlers/labHandler.php",
        method:"POST",
        data:{repId:repId, type:'repData'}, 
        dataType:'json',
        success:function(data){
            $('#patientId').html(data['patientId']);
            $('#reportId').html(data['id']);
            $('#doi').html(data['doi']);
            $('#rType').html(data['type']);
            $('#f1').html(data['field1']);
            $('#f2').html(data['field2']);
            $('#f3').html(data['field3']);
            $('#f4').html(data['field4']);
            $('#f5').html(data['field5']);

             //View Report Model
            open(modalViewRep);
            
            // $("#updateMed").click(()=>{
            //     open(modalUpdateMed);
            //     close(modalViewMed);
            //     $('#medUpID').val(data['id']);
            //     $('#medUpName').val(data['name']);
            //     $('#medUpPrice').val(data['price']);
            //     $('#medUpQty').val(data['qty']);
            //     $('#medUpSc').val(data['shortCode']);
            // })

        }
        
    });
}