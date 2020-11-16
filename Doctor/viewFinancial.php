<?php
session_start();
include_once(dirname( dirname(__FILE__) ).'/classes/users.php');
include_once(dirname( dirname(__FILE__) ).'/classes/patient.php');
include_once(dirname( dirname(__FILE__) ).'/parts/docSideNav.php');

$docid="doc45";
$doctor="";
if(isset($_SESSION["user"]))
{
    // $doctor=unserialize($_SESSION['user']);
    // $docid=$doctor->getUserId();
}
else
{
    //header("Location: ../login.php");
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
    <link rel="stylesheet" href="../css/Chart/Chart.min.css">
    <title>Doctor - View Financial Records</title>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Getting Side Nav -->
            <?php getSideNav("financial")?>

            <div class="c-12 c-l-10 rightContainer" style="padding-left:0px; padding-right:0px">
                <div class="upperPart">
                    <div class="upperFirst row">
                        <div class="c-l-12">
                            <h1 style="margin-top:5px">Financial Records</h1>
                        </div>
                    </div>
                    <div class="upperFirst row">
                        <div class="c-12 c-l-2">
                            <label>Select Month: </label>
                        </div>
                        <div class="c-0 c-l-4">
                            <input class="input-field fullWidth" type="month" id="selectMonth" name="selectMonth" placeholder="Select Month">
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Doctor Charges:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                        <div class="c-12 c-l-3">
                            <div class="boxSmall">
                                <label>Total Bill Count:<?php 
                                // $pid = $pres->getUserId();
                                // $res = $pres->getPatientPresNum($pid);
                                // echo"<span>$res</span>"?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tableCont3">
                    <div class="row">
                        <div class="c-12">
                            <canvas id="myChart" width="100" height="30vh"></canvas>
                        </div>
                    </div>
                </div>

                <div class='row patientDataRow addMedicineRow'>
                    <div class='c-3' class='patId'>Bill No</div>
                    <div class='c-5' class='patFirstName'>No of Items</div>
                    <div class='c-3' class='patLastName'>Bill Amount</div>
                    <div class='c-1'>
                    
                    </div>
                </div>
                <div id="billData">
                    <div class="row patientDataRow">
                        <div class="c-3">
                            1
                        </div>
                        <div class="c-5">
                            10
                        </div>
                        <div class="c-3">
                            Rs.500
                        </div>
                        <div class="c-1">
                            <a class="btn btnPatientView" name="viewBill" id="viewBill">View</a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <?php getEditProfile($doctor)?>
    <!-- End of Edit Profile View -->


    <!-- Footer Includes -->
    <?php include_once(dirname( dirname(__FILE__) ).'/parts/footerIncludes.php');?>
    <script src="../js/mainDoc.js"></script>
    <script src="../js/mainPatient.js"></script>
    <script src="../js/Chart/Chart.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
      <script>
        window.onclick = function(event) {
            if (event.target == modalUpdateDet) {
                    // modalUpdateDet.style.display = "none";
                    close(modalUpdateDet);
            }
        }
    </script>
</body>
</html>