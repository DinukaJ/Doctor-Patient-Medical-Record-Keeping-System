<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/doctor.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

$docid="";//"doc45";
$doctor="";
if(isset($_SESSION["user"]))
{
    $doctor=unserialize($_SESSION['user']);
    $docid=$doctor->getUserId();
}
else
{
    header("Location: ../login.php");
}
echo"<input type='hidden' value='$docid' id='docID'>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Header Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/headerIncludes.php');?>

    <title>Doctor - Prescribe</title>
</head>
<body>
    <!-- To keep the current prescription id -->
    <input type="hidden" value="" id="currPID" name="currPId">
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("prescribe")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart2">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-4">
                            <div class="box">
                                <input type="text" class="input-field fullWidth" autocomplete='off' name="patientID" id="patientID" placeholder="Enter Patient ID or Name">
                                <div class='text-left mt-4' id='searchResult'>
                                    <div class='' id='subsresult'>
                                        <!-- <div class='row c-12  searchr se1'>$row[0]</div>
                                        <div class='row c-12  searchr se2'>$row[0]</div>
                                        <div class='row c-12  searchr se3'>$row[0]</div>
                                        <div class='row c-12  searchr se4'>$row[0]</div> -->
                                        <input type='hidden' id='secount' value='0'>
                                    </div>
                                </div>
                                <p id="patName">Name: </p>
                                <p id="patAge">Age: </p>
                                <input type="hidden" id="patID" value="">
                                <!-- <button type="button" class="btn btnAddPres" style="margin-top:18px;" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Details</button> -->
                            </div>
                        </div>
                        <!-- <div class="c-12 c-l-3">
                            <div class="box" style="line-height:18px !important">
                                <label for="allergies" style="font-size:0.8em;">Allergies</label>
                                <div class="input-field fullWidth userData disable patientData" style="height:60px; max-height:60px; overflow-y:scroll;" name="allergies" id="allergies">No Data</div><br>
                                <label for="imp_Notes" style="font-size:0.8em;">Important Notes</label>
                                <div class="input-field fullWidth userData disable patientData" style="height:60px; max-height:60px; overflow-y:scroll;" name="imp_Notes" id="imp_Notes">No Data</div>
                            </div>
                        </div> -->
                        <div class="c-12 c-l-3">
                            <button type="button" class="btn btnAddPres medData disable" style="margin-top:18px;" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Details</button>
                            <button type="button" class="btn btnAddPres medData disable viewPatientPrescription" style="margin-top:18px;" name="viewPatientPrescription" id="viewPatientPrescription"><i class="fas fa-prescription-bottle"></i> View Prescriptions</button>
                            <button type="button" class="btn btnAddPres medData disable viewPatientReport" style="margin-top:18px;" name="viewPatientReports" id="viewPatientReports"><i class="fas fa-file-medical-alt"></i> View Reports</button>
                        </div>
                        <!-- <div class="c-12 c-l-3">
                            <div class="box">
                                <ul>
                                    <li class="title">Recent Prescriptions</li>
                                    <a><li class="upperClick">Prescription 5</li></a>
                                    <a><li class="upperClick">Prescription 4</li></a>
                                    <a><li class="upperClick">Prescription 3</li></a>
                                    <a><li class="upperClick">Prescription 2</li></a>
                                    <a><li class="upperClick">Prescription 1</li></a>
                                </ul>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">

                            <div class="box">
                                <ul>
                                    <li class="title">Recent Reports</li>
                                    <a><li class="upperClick">Report 5</li></a>
                                    <a><li class="upperClick">Report 4</li></a>
                                    <a><li class="upperClick">Report 3</li></a>
                                    <a><li class="upperClick">Report 2</li></a>
                                    <a><li class="upperClick">Report 1</li></a>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row patientDataRow addMedicineRow">
                    <div class="c-12 c-l-3">
                        <input type="text" class="input-field fullWidth medData disable" autocomplete='off' name="medicineCode" id="medicineCode" placeholder="Enter Short Code or Medicine Name">
                        <div class='text-left mt-4' id='searchResult'>
                            <div class='' id='subsresultMed'>
                                <!-- <div class='row c-12  searchr se1'>$row[0]</div>
                                <div class='row c-12  searchr se2'>$row[0]</div>
                                <div class='row c-12  searchr se3'>$row[0]</div>
                                <div class='row c-12  searchr se4'>$row[0]</div> -->
                                <input type='hidden' id='secount' value='0'>
                            </div>
                        </div>
                    </div>
                    <div class="c-12 c-l-3">
                        <select class="input-field medData disable" style="width:49%; display:inline;" name="amountPTime" id="amountPTime" placeholder="Amount Per Time">
                            <option value="" disabled selected>Amount Per Time</option>
                            <option value="1">1</option>
                            <option value="1.5">1 1/2</option>
                            <option value="2">2</option>
                        </select>
                        <select class="input-field medData disable" style="width:49%; display:inline;" name="timesPDay" id="timesPDay" placeholder="Times Per Day">
                            <option value="" disabled selected>Times Per Day</option>
                            <option value="1">1 (Night)</option>
                            <option value="2">2 (Morning & Night)</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="c-12 c-l-3">
                        <select class="input-field medData disable" style="width:49%; display:inline;" name="ABMeal" id="ABMeal" placeholder="After/Before meal">
                            <option value="" disabled selected>After/Before Meal</option>
                            <option value="a">After</option>
                            <option value="b">Before</option>
                            <option value="c">Any</option>
                        </select>
                        <select class="input-field medData disable"  style="width:49%; display:inline;" name="duration" id="duration" placeholder="Duration">
                            <option value="" disabled selected>Duration</option>
                            <option value="5 d">5 Day(s)</option>
                            <option value="6 d">6 Day(s)</option>
                            <option value="1 w">1 Week(s)</option>
                            <option value="2 w">2 Week(s)</option>
                            <option value="3 w">3 Week(s)</option>
                            <option value="4 w">4 Week(s)</option>
                        </select>
                    </div>
                    <div class="c-12 c-l-3">
                        <button class="btn btnAddPres medData disable" name="addToPres" id="addToPres"><i class="fas fa-plus"></i> ADD</button>
                    </div>
                </div>  
                <div class="row patientDataRow" style="border-bottom:none;">
                    <div class="c-12 tableCont">
                        <table style="width:100%;" class="presTable" id="presTable">
                            <!-- <tr>
                                <td style="width:2%">1</td>
                                <td style="width:23%">Med Name</td>
                                <td style="width:12%; text-align:center;">5</td>
                                <td style="width:12%; text-align:center;">3</td>
                                <td style="width:14%; text-align:center;">After</td>
                                <td style="width:12%; text-align:center;">3 Weeks</td>
                                <td style="width:25%; text-align:center;"><a class="btn btnPatientView" name="deleteMed" id="medid"><i class="fas fa-times"></i></a></td>
                            </tr>
                            <tr>
                                <td style="width:2%">2</td>
                                <td style="width:23%">Med Name</td>
                                <td style="width:12%; text-align:center;">5</td>
                                <td style="width:12%; text-align:center;">3</td>
                                <td style="width:14%; text-align:center;">After</td>
                                <td style="width:12%; text-align:center;">3 Weeks</td>
                                <td style="width:25%; text-align:center;"><a class="btn btnPatientView" name="deleteMed" id="medid"><i class="fas fa-times"></i></a></td>
                            </tr> -->
                        </table>
                    </div>
                </div>  
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8">
                        <textarea class="input-field fullWidth medData disable" style="height:75px" name="presNote" id="presNote" placeholder="Prescription Note"></textarea>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient btnCancel" name="cancel" id="cancel"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <div class="c-6 c-l-2">
                        <button type="button" class="btn btnNormal btnPatient" name="finish" id="finish"><i class="fas fa-check"></i> Finish</button>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
       <?php getEditProfile($doctor)?>
    <!-- End of Edit Profile View -->

    <!-- Patient Full Data Modal -->
       <?php getFullPatientData()?>
    <!-- Patient Full Data -->

    <!-- Patient Prescription Modal -->
       <?php getPatientPrescriptions()?>
    <!-- Patient Prescription Data -->

    <!-- Patient Reports Modal -->
    <?php getPatientReports()?>
    <!-- Patient Reports Modal -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainDoc.js"></script>
    <script src="../js/searchPres.js"></script>
    <script src="../js/searchRep.js"></script>
    <script>
        var modalPatient=document.getElementById("patientFullData");
        var patientPrescription=document.getElementById("patientPrescription");
        var patientReports=document.getElementById("patientReports");
        $(document).ready(function(){
            $('#viewPatientDetails').click(function(){
                open(modalPatient);
            });
            $('#viewPatientPrescription').click(function(){
                open(patientPrescription);
            });
            $('#viewPatientPrescription2').click(function(){
                open(patientPrescription);
                close(modalPatient);
            });
            $('#viewPatientReports').click(function(){
                open(patientReports);
                close(modalPatient);
            });
            $('#viewPatientReports2').click(function(){
                open(patientReports);
                close(modalPatient);
            });
            $('.close').click(()=>{
                close(modalPatient);
                close(patientPrescription);
                close(patientReports);
            })
            $('#patClose').click(()=>{
                close(modalPatient);
            })
            $('#presClose').click(()=>{
                close(patientPrescription);
            })
            $('#reportClose').click(()=>{
                close(patientReports);
            })
        });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
            if (event.target == modalPatient) {
                    // modalUpdateDet.style.display = "none";
                    close(modalPatient);
            }
            if (event.target == patientPrescription) {
                    // modalUpdateDet.style.display = "none";
                    close(patientPrescription);
            }
            if (event.target == patientReports) {
                    // modalUpdateDet.style.display = "none";
                    close(patientReports);
            }
        }
    </script>
    <script src="../js/search.js"></script>
    <script src="../js/searchDocMed.js"></script>
    <script>
            getPrescriptionMedicine();//Getting prescripton medicine
            //Focus on patient id on page load
            $('#patientID').focus();
            //Disable other input fields until a patient is selected
            $('.userData').prop('disabled',true);
            $('.medData').prop('disabled',true);

            //Changing text fields when user press arrow keys
            $("#amountPTime").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    e.preventDefault();
                    $("#timesPDay").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    e.preventDefault();
                    $("#medicineCode").focus();
                }
            });
            $("#timesPDay").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    e.preventDefault();
                    $("#ABMeal").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    e.preventDefault();
                    $("#amountPTime").focus();
                }
            });
            $("#ABMeal").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    e.preventDefault();
                    $("#duration").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    e.preventDefault();
                    $("#timesPDay").focus();
                }
            });
            $("#duration").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    e.preventDefault();
                    $("#addToPres").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    e.preventDefault();
                    $("#ABMeal").focus();
                }
            });
            $("#addToPres").keydown(function(e){
                if(e.keyCode==37) //Left Arrow
                {
                    e.preventDefault();
                    $("#duration").focus();
                }
            });


            //Add Medicine to Prescription
            function addMedicinePrescription()
            {
                var docId="<?php echo "$docid" ?>";
                var medId=$("#medicineCode").val().split(" ")[0];
                var medType=$("#medicineCode").val().split("-")[2];
                $.ajax({
                    url:"../handlers/prescriptionHandler.php",
                    method:"POST",
                    data:{type:'addMed', prescription:$("#currPID").val(), patID:$("#patID").val(), docID:docId, medID:medId, medT:medType, amountPT:$("#amountPTime").val(), timesPD:$("#timesPDay").val(), afterBefore:$("#ABMeal").val(), duration:$("#duration").val()},
                    dataType:'json',
                    success:function(data){
                        if($("#currPID").val()=="")
                            $("#currPID").val(data[1]);
                        getPrescriptionMedicine();
                        clearMedFields();
                    }   
                });
            }

            //Function to get medicine of the prescription
            function getPrescriptionMedicine()
            {
                if($("#currPID").val()!="")
                {
                    $.ajax({
                        url:"../handlers/prescriptionHandler.php",
                        method:"POST",
                        data:{type:'presMed',prescription:$("#currPID").val()},
                        success:function(data){
                            $("#presTable").html(data);

                            //Action to perform when remove med button clicked
                            $(".delMed").click(function(){
                                if(confirm("Are you sure to delete?"))
                                    deleteMed($(this).val());
                            });
                        }   
                    });
                }
            }
            
            //Clear Medicine Input Fields
            function clearMedFields()
            {
                $("#medicineCode").val("");
                $("#amountPTime").val("");
                $("#timesPDay").val("");
                $("#ABMeal").val("");
                $("#duration").val("");
                $("#medicineCode").focus();
            }

            //Function to delete medicine from prescription
            function deleteMed(mid)
            {
                var mID=mid.split("-")[0];
                var mType=mid.split("-")[1];
                $.ajax({
                    url:"../handlers/prescriptionHandler.php",
                    method:"POST",
                    data:{type:'removeMed', prescription:$("#currPID").val(), medID:mID, medT:mType},
                    dataType:'json',
                    success:function(data){
                        if(data[0]==1)
                            getPrescriptionMedicine();
                    }   
                });   
            }

            //Function to cancel prescription
            function cancelPres()
            {
                var stat=0;
                $.ajax({
                    url:"../handlers/prescriptionHandler.php",
                    method:"POST",
                    data:{type:'deletePres', prescription:$("#currPID").val()},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data[0]!=1 || data[1]!=1)
                            alert("An Error Occurred!");   
                        else
                            stat=1;
                            
                    }   
                });  
                return stat;
            }
            //Function to cancel prescription
            function finishPres()
            {
                $.ajax({
                    url:"../handlers/prescriptionHandler.php",
                    method:"POST",
                    data:{type:'finishPres', prescription:$("#currPID").val()},
                    dataType:'json',
                    success:function(data){

                    }   
                });  
            }

            //When Prescription Note changes update prescription
            $("#presNote").change(function(){
                $.ajax({
                    url:"../handlers/prescriptionHandler.php",
                    method:"POST",
                    data:{type:'addPresNote', prescription:$("#currPID").val(), presNote:$("#presNote").val()},
                    dataType:'json',
                    success:function(data){
                    }   
                });  
            });
            
            //Action to perform when add med button clicked
            $("#addToPres").click(function(){
                addMedicinePrescription();
            });

            //Handle Cancel Button Operation
            $("#cancel").click(function(){
                if(confirm("Are you sure to cancel?"))
                {
                    cancelPres();
                    $(window).unbind('beforeunload');
                    location.reload();
                }
            });

            //Handle Finish Button Operation
            $("#finish").click(function(){
                if(confirm("Are you sure to finish?"))
                {
                    finishPres();
                    $(window).unbind('beforeunload');
                    location.reload();
                }
            });

            //Handle User Page Leave Event to Delete Current Prescription
            $(window).bind('beforeunload',function(){
                return "Are you sure to leave?";
            });
            $(window).bind('unload', function(){
                alert("test");
                if($("#currPID").val()!="")
                {                    
                    cancelPres();
                }
            });
            
    </script>
</body>
</html>