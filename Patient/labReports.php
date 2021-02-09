<?php
//Do the edits
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/classes/prescription.php');
include_once(dirname( dirname(__FILE__) ).'/parts/patientSideNav.php');

$patId = "";//"pat45";
$patient="";
if(isset($_SESSION["user"]))
{
    $patient=unserialize($_SESSION['user']);
    $patId=$patient->getUserId();
}
else
{
    header("Location: ../login.php");
}
echo"<input type='hidden' value='$patId' id='patientID'>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Lab Reports</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("labRep")?>

            <div class="c-12 c-l-10" style="padding-left:0px; padding-right:0px;">
                <div class="upperPart">
                <div class="upperFirst row">
                        <div class="c-l-12">
                        <h1 style="margin-top:5px">Lab Reports</h1>
                        </div>
                    </div>
                   <div class="upperFirst row">  
                        <div class="c-12 c-l-6">
                            <div class="boxSmall">
                                <label>No. of Reports: <span id="noOfReports"></span></label>
                            </div>
                        </div>
                  </div>  
                </div>

                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='repId'>Report Id</div>
                    <div class='c-3' class='repDate'>Report Date</div>
                    <div class='c-5' class='repCmt'>Comment</div>
                    <div class='c-1'>
                    
                    </div>
                </div>

                <!--Adding Reports-->
                <div id="reportInfo"></div>

                <?php
                // $res=$patient->getPatients();
                // $i=1;
                // while($row=mysqli_fetch_assoc($res))
                // {
                //     echo '
                //     <div class="row patientDataRow">
                //         <div class="c-11">
                //             '.$i.'. '.$row['fname'].' '.$row['lname'].'
                //         </div>
                //         <div class="c-1">
                //             <button type="submit" class="btn btnPatientView" name="viewPatient" id="viewPatient">View</button>
                //         </div>
                //     </div>
                //     ';
                //     $i++;
                // }
                ?>           
            </div>
        </div>
    </div>
   <!-- Edit Profile Modal -->
   <?php getEditProfile($patient)?>
    <!-- End of Edit Profile View -->


<!-- The Modal for View Report-->
<div id="modalViewRep" class="modal modal2">

<!-- Modal content -->
 <div class="modal-content-long inventoryModal">
    <div class="row">
        <div class="c-12">
        <span class="close closeMed">&times;</span>
        </div>
    </div>
   <div class="detailsSection">
        <div class="row">
            <div class="c-12">
                <h2>Report Details</h2>
            </div>
        </div>
        <div class="c-12" style="padding-left:0px; padding-right:0px;">
            <div class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-4">
                    <center><b>Report ID: <span id="reportNo"></span></b></center>
                </div>
                <div class="c-4"></div>
                <div class="c-4">
                    <center><b>Date: <span id="reportDate"></span></b></center>
                </div>
            </div>
            <div id="commentRow" class="row addMedicineRow" style="padding:5px; margin-left:0px; margin-right:0px;">
                <div class="c-12">
                    <b>Comment: <span id="comment"></span></b>
                </div>
            </div>
            <div class="row patientDataRow" style="border-bottom:none;">
                <div class="c-12 tableCont2" style="padding-left:0px; padding-right:0px;">
                    <table style="width:100%; font-size:0.8em !important;" class="presTable addMedicineRow id="reportTable">
                        <tr style="height:20px;">
                            <th style="width:30%">Test Name</th>
                            <th style="width:30%">Result</th>
                            <th style="width:30%; text-align:center;">Range</th>
                        </tr>
                    </table>
                    <table id="patReportData" style="width:100%; font-size:0.8em !important;" class="presTable" id="reportTable">
         
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                        <tr>
                            <td style="width:30%; text-align:center;">1</td>
                            <td style="width:30%; text-align:center;">Med Name</td>
                            <td style="width:30%; text-align:center;">5</td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>    
        </div>
        <div class ="bottomModel row">
            <div class="c-12">
                <button type="button" class="btn btnNormal btnCancel" id="closeRep">Close</button>
                <!-- <button type="button" class="btn btnNormal" id="updateRep">Edit</button> -->
            </div>
        </div>
    </div> 
 </div>
</div>
<!-- End of the Modal for View Report-->
    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainPatient.js"></script>
    <script src="../js/searchPatRep.js"></script>
    <script>
        var modalViewRep=document.getElementById("modalViewRep");
        $(document).ready(function(){
            getAllLab();
            $('.close').click(()=>{
                close(modalUpdateDet);
                close(modalViewRep);
            })
            $('#closeReport').click(()=>{
                close(modalViewRep);
            })
            $('#upCancel').click(()=>{
                close(modalUpdateDet);
            })
            $('.btnCancel').click(()=>{
                close(modalViewRep);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalViewRep) {
                    // modalUpdateDet.style.display = "none";
                    close(modalViewRep);
            }
        }

        function getAllLab(){
            var patID = "<?php echo "$patId"?>";
            $.ajax({
                url:"../handlers/labHandler.php",
                method:"POST",
                data:{patientID:patID,type:'getPatLab'},
                dataType:'json',
                success:function(data){
                    $('#reportInfo').html(data[0]);
                    $('#noOfReports').html(data[1]);
                    $('.viewRep').click(function(){
                        $("#reportDate").html($(this).parent().parent().find('.repDate').html());
                        $("#reportNo").html(this.id.split("-")[1]);
                        getReportDataTable(this.id.split("-")[1]);
                        open(modalViewRep);
                    });
                }
            });
        }

        function getReportDataTable(id){
            $.ajax({
                url:"../handlers/labHandler.php",
                method:"POST",
                data:{reportID:id, type:'getReportDataTable'},
                dataType: 'json',
                success:function(data){
                    var d=data[0].replaceAll("~"," ");
                    $("#patReportData").html(d);
                    if(data[1]!="")
                    {
                        $("#comment").html(data[1]);
                        $("#commentRow").show();
                    }
                    else
                    {
                        $("#commentRow").hide();
                    }
                }
                
            });
        }
    </script>
</body>
</html>