<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
include_once(dirname( dirname(__FILE__) ).'/parts/recepSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
}
else
{
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Added Doctors</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("docStatus")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-m-6">
                        <h1 style="margin-top:5px">Doctor Attending Status</h1>
                        </div>
                        <div class="c-m-6">
                        <p style="margin-top:20px">(Select a Doctor to Change the Attending Status)</p>
                        </div>
                    </div>
                    <div class="upperSecond row">
                        <div class="c-l-4">
                            <input type="text" class="input-field fullWidth" name="searchDoc" id="searchDoc" placeholder="Enter Doctor ID or Name" required>
                        </div>
                        <div class="c-l-8 totText">
                            Total Doctors: <span id="totalCountDoc"></span>

                        </div>
                    </div>
                </div>
                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='patId'>Doctor ID</div>
                    <div class='c-8' class='patFirstName'>Name</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="doctorData"></div>
                       
            </div>
        </div>
    </div>
    
     <!-- The Modal for Doctor Details-->
     <div id="docFullData" class="modal modal2">

        <!-- Modal content -->
        <div class="modal-content-short2 inventoryModal">
            <div class="row">
                <div class="c-12">
                <span class="close closeMed">&times;</span>
                </div>
            </div>

        <div class="detailsSection">
            <div class="c-12">
                <h4>Doctor Attending Status</h4>
                <div class="row" style="padding:0px; margin:0px;">
                    <div class="c-12" style="padding:0px; margin:0px;">
                        <div class="alerMSG" id="dateStatus"></div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" id="docId">
                    <div class="c-7" style="padding-right:4px">
                        <input type="date" class="input-field fullWidth" id="specialDate" name="specialDate" min="<?php echo date("Y-m-d");?>">
                    </div>
                    <div class="c-4" style="padding-right:4px">
                        <select class="input-field fullWidth" id="attStatus" name="attStatus">
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <div class="c-1" style="padding:0px">
                        <button type="button" class="btn btnAddPres" style="padding:0px;" name="addDate" id="addDate"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="c-12" style="padding-right:0px;">
                        <div class="scrollBox" id="dateBox">
                            <!--Specialties-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomModel">
                <div class="row">
                <div class="c-12 c-l-6" style="text-align:left">
                </div>
                    <div class="c-12 c-l-6">
                        <button type="button" class="btn btnNormal btnCancel" id="patClose">Close</button>
                    </div>
                </div>
        </div>

        </div>
    </div>
    <!-- End of the Modal for Doctor Details-->

    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        var modalDoctor=document.getElementById("docFullData");
        $(document).ready(function(){
            $('.close').click(()=>{
                close(modalDoctor);
            })
            $('#patClose').click(()=>{
                close(modalDoctor);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalDoctor) {
                    // modalUpdateDet.style.display = "none";
                    close(modalDoctor);
            }
        }
    </script>
    <script>
        getDocs("");
        $('#updateStatus').hide();
        $('#dateStatus').hide();


        var pId="";
        var chkCount=0;
        //Function to open the patient data modal
        function doctorDataModal(pId)
        {
            $("#docId").val(pId);
            loadDateBox(pId);
            open(modalDoctor);
        }
        //Function to get the added patients
        function getDocs(serVal)
        {
            $("#dateBox").html("");
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'searchDRecep', doctorSearch:serVal, btn:"Select"},
                dataType:'json',
                success:function(data){
                    $("#doctorData").html(data[0]);
                    $("#totalCountDoc").html(data[1]);
                    //Open patient data modal when click on view

                    $('.viewDoc').click(function(){
                         pId=$(this).attr('id');

                        doctorDataModal(pId);
                    });
                }   
            });
        }
        function loadDateBox(pId)
        {
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'getSpecDays', docId:pId},
                success:function(data){
                    $("#dateBox").html(data);
                }   
            });
        }
        var serPat=document.getElementById("searchDoc");
        serPat.addEventListener("keydown", function(e){
            setTimeout(function(){
                a=serPat.value;
                getDocs(a);
            },100);
        });
        
        $("#addDate").click(function(){
            var x=0;
            if($("#specialDate").val()=="")
            {   
                $("#specialDate").addClass("error");
                x=1;
            }
            else
            {
                $("#specialDate").removeClass("error");
            }

            if(x==0)
            {
                $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'addSpecDay', specDate:$("#specialDate").val(), stat:$("#attStatus").val(), docId:$("#docId").val()},
                success:function(data){
                    if(data=='-1')
                    {
                        $('#dateStatus').removeClass('error');
                        $('#dateStatus').removeClass('success');
                        $('#dateStatus').addClass('error');
                        $('#dateStatus').html("There's Another Record for the Selected Date");
                        $('#dateStatus').slideDown();
                        setTimeout(function(){
                            $('#dateStatus').slideUp('slow');
                        },5000);
                    }
                    else
                    {
                        $("#dateBox").append('<div class="row allergyRow docSpecDays"><div class="c-11 specialtyValue" style="padding-right:0px;">'+$("#specialDate").val()+' - '+$("#attStatus").val()+'</div><div class="c-1" style="padding-left:2px;" specDate='+$("#specialDate").val()+'><button type="button" class="btn btnPatientView2 removeSpecDate" name="removeSpecialty"><i class="fas fa-times"></i></button></div></div>');
                    }
                }   
            });
            }
        });

        $(document).on('click','.removeSpecDate',function(){
            var specDate=$(this).attr("specDate");
            var dateBox=$(this);
            $.ajax({
                url:"../handlers/doctorHandler.php",
                method:"POST",
                data:{type:'removeSpecDay', specDate:specDate, docId:$("#docId").val()},
                success:function(data){
                    if(data)
                    {
                        $(dateBox).parent().parent().remove();
                    }
                }   
            });
        });
    </script>
</body>
</html>