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

if(ser)
{
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
}

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
            console.log(data);
            $('#patientId').html(data[0]);
            $('#patientName').html(data[1]);
            $('#reportId').html(data[2]);
            $('#doi').html(data[4]);
            $('#rType').html(data[3]);
            $('#repTypes').html(data[5]);

             //View Report Model
            open(modalViewRep);

            //Delete the Report
            // $('#deleteRep').click(()=>{
            //     if(confirm("Are You Sure?")){
            //         deleteRepData(repId);
            //     }
            //     else{
            //         return false;
            //     }
            // });
            
            // $("#updateRep").click(()=>{
            //     open(modalUpdateRep);
            //     close(modalViewRep);
            //     $('#repUpID').val(data['id']);
            //     $('#repUpType').val(data['type']);
            //     $('#repUpFi1').val(data['field1']);
            //     $('#repUpFi2').val(data['field2']);
            //     $('#repUpFi3').val(data['field3']);
            //     $('#repUpFi4').val(data['field4']);
            //     $('#repUpFi5').val(data['field5']);
            // })

        }
        
    });
}

function deleteRepData(id){
    $.ajax({
        url:'../handlers/labHandler.php',
        method:'POST',
        data:{repId:id, type:'repDel'},
        success:function(data){
            close(modalViewRep);
            getAllRep();
        }
    });
}

// $('#repUpForm').on('submit',(e)=>{
//     e.preventDefault();
//     $.ajax({
//         url:'../handlers/labHandler.php',
//         method:'POST',
//         data:$('#repUpForm').serialize()+"&type=repUp",
//         success:function(data){
//             if(data==1)
//             {   
//                 $("#updateStatus").addClass("success");
//                 $("#updateStatus").html("Successfully Updated!");
//                 $("#updateStatus").slideDown("slow");
//                 setTimeout(function(){
//                     $("#updateStatus").slideUp("slow");
//                 },2000);
//             }
//             else
//             {
//                 $("#updateStatus").addClass("error");
//                 $("#updateStatus").html("Update Failed!");
//                 $("#updateStatus").slideDown("slow");
//                 setTimeout(function(){
//                     $("#updateStatus").slideUp("slow");
//                 },2000);
//             }

//             getAllRep();
//         }
//     });
// });


//Get patient reports in doctor
function getReports(id)
{
    $.ajax({
        url:"../handlers/labHandler.php",
        method:"POST",
        data:{patientID:id, type:'getPatientReport'},
        dataType: "json",
        success:function(data){
            $("#reportList").html(data[0]);
            getReportDataTable(data[1]);
            $("#reportNo").html(data[1]);
            $("#reportDate").html(data[2]);
            $(".patientDataRowRep").click(function(){
                $("#reportNo").html($(this).find(".reportListID").html());
                $("#reportDate").html($(this).find(".reportListDate").html());
                getPresDataTable($(this).find(".reportListID").html());
                $(".patientDataRowRep").removeClass("active");
                $(this).addClass("active");
            });
        }
        
    });
}
$(".viewPatientReport").click(function(){
    var pId=$("#patientID").val();//.split(" ");
   // pId=pId[0];
   getReports(pId);
});

function getReportDataTable(id)
{
    $.ajax({
        url:"../handlers/labHandler.php",
        method:"POST",
        data:{reportID:id, type:'getReportDataTable'},
        success:function(data){
            var d=data.replaceAll("~"," ");
            $("#patReportData").html(d);
        }
        
    });
}