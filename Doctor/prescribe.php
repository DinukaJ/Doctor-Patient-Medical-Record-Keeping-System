<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

if(isset($_SESSION["user"]))
{
    $patient=new patient();
}
else
{
    //header("Location: ../login.php");
}
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
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("prescribe")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart2">
                    <div class="upperFirst row">
                        <div class="c-12 c-l-3">
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
                                <a href=""><button type="button" class="btn btnAddPres" style="margin-top:18px;" name="viewPatientDetails" id="viewPatientDetails"><i class="fas fa-search"></i> View All Details</button></a>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="box" style="line-height:18px !important">
                                <label for="allergies" style="font-size:0.8em;">Allergies</label>
                                <textarea class="input-field fullWidth userData disable" style="height:60px" name="allergies" id="allergies" placeholder="Allergies"></textarea><br>
                                <label for="imp_Notes" style="font-size:0.8em;">Important Notes</label>
                                <textarea class="input-field fullWidth userData disable" style="height:60px" name="imp_Notes" id="imp_Notes" placeholder="Important Notes"></textarea>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
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
                        </div>
                    </div>
                </div>
                <div class="row patientDataRow addMedicineRow">
                    <div class="c-12 c-l-3">
                        <input type="text" class="input-field fullWidth medData disable" name="medicineCode" id="medicineCode" placeholder="Enter Short Code or Medicine Name">
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
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="c-12 c-l-3">
                        <select class="input-field medData disable" style="width:49%; display:inline;" name="ABMeal" id="ABMeal" placeholder="After/Before meal">
                            <option value="" disabled selected>After/Before Meal</option>
                            <option value="af">After</option>
                            <option value="bf">Before</option>
                        </select>
                        <select class="input-field medData disable"  style="width:49%; display:inline;" name="duration" id="duration" placeholder="Duration">
                            <option value="" disabled selected>Duration</option>
                            <option value="1-w">1 Week</option>
                            <option value="2-w">2 Week</option>
                        </select>
                    </div>
                    <div class="c-12 c-l-3">
                        <button class="btn btnAddPres medData disable" name="addToPres" id="addToPres"><i class="fas fa-plus"></i> ADD</button>
                    </div>
                </div>  
                <div class="row patientDataRow" style="border-bottom:none;">
                    <div class="c-12 tableCont">
                        <table style="width:100%;" class="presTable">
                            <tr>
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
                            </tr>
                        </table>
                    </div>
                </div>  
                <div class="row patientDataRow presBottom">
                    <div class="c-12 c-l-8">
                        <textarea class="input-field fullWidth medData disable" style="height:75px" name="presNote" id="presNote" placeholder="Prescription Note"></textarea>
                    </div>
                    <div class="c-6 c-l-2">
                        <a href="../"><button type="button" class="btn btnNormal btnPatient" name="editProfile" id="editProfile"><i class="fas fa-times"></i> Cancel</button></a>
                    </div>
                    <div class="c-6 c-l-2">
                        <a href="../logout.php"><button type="button" class="btn btnNormal btnPatient" name="logout" id="logout"><i class="fas fa-check"></i> Finish</button></a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <!-- <div id="myModal" class="modal">

        <div class="modal-content container">
        <span class="close">&times;</span>
           
        </div>

    </div> -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        //btn.onclick = 
        function open() {
            modal.style.display = "block";
        }
        if(modal)
        {   
            open();
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    </script>
    <script src="../js/search.js"></script>
    <script src="../js/searchDocMed.js"></script>
    <script>
        $(document).ready(function(){
            //Focus on patient id on page load
            $('#patientID').focus();
            //Disable other input fields until a patient is selected
            $('.userData').prop('disabled',true);
            $('.medData').prop('disabled',true);
            //Update patient data when the doctor change those
            $("#allergies").change(function(){
                updatePatientData();
            });
            $("#imp_Notes").change(function(){
                updatePatientData();
            });
            //Function to update patient data
            function updatePatientData()
            {
                $.ajax({
                    url:"../handlers/patientHandler.php",
                    method:"POST",
                    data:{type:'upPatientAllergies', patID:$("#patID").val(), allergy:$("#allergies").val(), importantNotes:$("#imp_Notes").val()},
                    success:function(data){

                    }   
                });
            }

            //Changing text fields when user press arrow keys
            $("#amountPTime").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    $("#timesPDay").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    $("#medicineCode").focus();
                }
            });
            $("#timesPDay").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    $("#ABMeal").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    $("#amountPTime").focus();
                }
            });
            $("#ABMeal").keydown(function(e){
                if(e.keyCode==39) //Right Arrow
                {
                    $("#duration").focus();
                }
                if(e.keyCode==37) //Left Arrow
                {
                    $("#timesPDay").focus();
                }
            });
            $("#duration").keydown(function(e){
                if(e.keyCode==37) //Left Arrow
                {
                    $("#ABMeal").focus();
                }
            });
        });
    </script>
</body>
</html>