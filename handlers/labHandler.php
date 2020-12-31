<?php
include_once(dirname( dirname(__FILE__) ).'/classes/lab.php');

if(isset($_POST["type"])){

    if($_POST["type"]=="getAllRep")
            getRepDatAll();
    if($_POST["type"]=="searchRep")
            repSearch();
    if($_POST["type"]=="repData")
            getRep();
    if($_POST["type"]=="repDel")
            delRep();  
    if($_POST["type"]=="repAdd")
            repAdd();
    if($_POST["type"]=="repAddData")
            addRepData();
    if($_POST["type"]=="testGet")
            testData();    
    if($_POST["type"]=="reportTypes")
            getReportTypes();    
    if($_POST["type"]=="addReportType")
        addReportType();    
    if($_POST["type"]=="addReportFields")
        addReportFields();    
    if($_POST["type"]=="getReportFields")
        getReportFields();    
    if($_POST["type"]=="deleteReportFields")
        deleteReportFields();    
    if($_POST["type"]=="getReportFieldsAdd")
        getReportFieldsAdd();    
    if($_POST["type"]=="getPatientReport")
        getPatientReport();    
    if($_POST["type"]=="getReportDataTable")
        getReportDataTable();    
}

function getRepDatAll(){
    $output="";
    $lab = new lab();
    $data = $lab->getAllRep();
    $numRows=mysqli_num_rows($data);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){

            $output.="<div class='row patientDataRow'>
            <div class='c-2' class='patId'>$row[0]</div>
            <div class='c-2' class='repId'>$row[1]</div>
            <div class='c-3' class='repType'>$row[3]</div>
            <div class='c-4' class='repType'>$row[2]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewRep' name='viewRep' id='viewRep-$row[1]'>View</button>
            </div>
      </div>";
        }
    }
    echo json_encode(array($output, $numRows));
}

function repSearch(){
    $output="";
    $lab = new lab();
    $data = $lab->repSearch($_POST["id"]);
    $numRows=mysqli_num_rows($data);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){
           
            $output.="<div class='row patientDataRow'>
            <div class='c-2' class='patId'>$row[0]</div>
            <div class='c-2' class='repId'>$row[1]</div>
            <div class='c-3' class='repType'>$row[3]</div>
            <div class='c-4' class='repType'>$row[2]</div>
            <div class='c-1'>
                <button type='button' class='btn btnPatientView viewRep' name='viewRep' id='viewRep-$row[1]'>View</button>
            </div>
      </div>";
        }
    }
    echo json_encode(array($output, $numRows));
}

//gets report data
function getRep(){
    $lab = new lab();
    $patId=""; $name=""; $repId=""; $type=""; $date="";
    $data = $lab->repSearch($_POST["repId"]);
    $output="";
    while($row = mysqli_fetch_array($data))
    {
        $patId=$row[0]; $name=$row[4]." ".$row[5]; $repId=$row[1]; $type=$row[3]; $date=$row[2];
        $output.='
        <div class="row">
        <div class="c-4 c-m-4">
            '.$row[7].'
        </div>
        <div class="c-4 c-m-4">
            '.$row[8].'
        </div>
        <div class="c-4 c-m-4">
            '.$row[9].'
        </div>
    </div>
        ';
    }
    echo json_encode(array($patId,$name,$repId,$type,$date,$output));
}

//delete report data
function delRep(){
    $lab = new lab();
    $stat = $lab->repDelete($_POST["repId"]);
    echo $stat;
}

//Add patient report
function repAdd()
{
    $lab = new lab();
    $pid=$_POST["patId"];
    $cmt=$_POST["cmt"];
    $today=date("Y-m-d");
    $stat=$lab->repAdd($pid,$cmt,$today);
    echo $stat;
}

//Add patient report data
function addRepData()
{
    $lab = new lab();
    $reportId = $_POST["reportId"];
    $rId = $_POST["rId"];
    $tName = $_POST["tName"];
    $result = $_POST["result"];
    
    $stat = $lab->repAddData($reportId,$rId,$tName,$result);
    echo $stat;
}

//getting tests for each report type
function testData()
{
    $output1="";
    $output2="";
    $lab = new lab();
    $rId = $_POST["rid"];
    $data = $lab->getRepInfo($rId);
    if(mysqli_num_rows($data)){
        while($row=mysqli_fetch_array($data)){
            $output1.="<option value=$row[0]>$row[0]</option>";
            $output2.="<option value=$row[1]>$row[1]</option>"; 
        }
    }
    echo json_encode(array($output1,$output2));
}

//Get report types
function getReportTypes()
{
    $selectVal=$_POST["selectType"];
    $output="<option selected disabled value=''>Select Report Type</option>";
    $lab=new lab();
    $data = $lab->getReportTypes();
    if(mysqli_num_rows($data))
    {
        while($row=mysqli_fetch_array($data))
        {
            if($selectVal==$row[1])
                $output.="<option value='$row[0]' selected>$row[1]</option>";
            else
                $output.="<option value='$row[0]'>$row[1]</option>";
        }
    }
    echo $output;
}

//Add new report types
function addReportType()
{
    $repType=$_POST["repType"];
    $lab=new lab();
    $data = $lab->addReportType($repType);
    echo $data;
}

//Add report fields
function addReportFields()
{
    $rId=$_POST["repId"];
    $tName=$_POST["testName"];
    $val1=$_POST["value1"];
    $val2=$_POST["value2"];
    $range=$_POST["rangeVal"];
    $unit=$_POST["unitVal"];
    $lab=new lab();
    if($range=="-")
    {
        $rangeValue=$val1." ".$range." ".$val2."~".$unit; 
    }
    else
    {
        $rangeValue=$range." ".$val2."~".$unit;
    }
    $stat=$lab->addReportFields($rId,$tName,$rangeValue);
    if($stat!=1)
        echo -1;
    else
    {
        echo getReportFields($rId);
    }
}

//Get added report fields of a report type
function getReportFields($rId="")
{
    if($rId=="")
    {
        $rId=$_POST["repId"];
    }
    $lab=new lab();
    $data=$lab->getReportFields($rId);
    $output="";
    $testname="";
    $outDone=0;
    if(mysqli_num_rows($data))
    {
        $output.='<div class="wholeSection">';
        while($row=mysqli_fetch_array($data))
        {
            if($testname==$row[1])
            {
                $output.='
                <div class="testNameSection">
                    <div class="typeRow row">
                        <div class="c-m-4">
                            <p></p>
                        </div>
                        <div class="c-m-4" style="text-align:center;">
                            <p>'.explode("~",$row[2])[0].'</p>
                        </div>
                        <div class="c-m-3">                                          
                            <p>'.explode("~",$row[2])[1].'</p>
                        </div>
                        <div class="c-m-1" style="padding-top:5px; text-align:center;">
                            <button type="button" value="'.$row[0].'~'.$row[1].'~'.$row[2].'" class="btn delMed delTestName" name="delTestName"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
                ';
            }
            else
            {
                if($outDone==1)
                {
                    $output.='
                    <div class="typeRow row">
                        <div class="c-m-4">
                            
                        </div>
                        <div class="c-m-4" style="text-align:center;">
                            <div class="row" style="margin:0px; padding:0px;">
                                <div class="c-4 leftValue">
                                    <input type="number" min="0" class="input-field val1" style="width:100%;" name="val1" id="val1" placeholder="Value">
                                </div>
                                <div class="c-4">
                                    <select class="input-field fullWidth rangeType" name="rangeType" style="font-size:1.2em;">
                                        <option value="<"><</option>
                                        <option value=">">></option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="c-4">
                                    <input type="number" min="0" class="input-field val2" style="width:100%;" name="val2" id="val2" placeholder="Value">
                                </div>
                            </div>
                        </div>
                        <div class="c-m-3">                                          
                            <select class="input-field fullWidth unit" name="unit" id="unit">
                                <option value="mg/dl">mg/dl</option>
                                <option value="g/dl">g/dl</option>
                            </select>
                        </div>
                        <div class="c-m-1" style="padding-top:5px; text-align:center;">
                            <button type="button" value="'.$testname.'" class="btn btnPatientView viewMed addMoreUnits" name="addMoreUnits"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="c-12"><hr class="lightHr"></div>
                    </div>
                    </div>
                    <div class="wholeSection">
                    ';
                }
               $testname=$row[1];
               $output.='
                <div class="testNameSection">
                    <div class="typeRow row">
                        <div class="c-m-4">
                            <p><b>'.$row[1].'</b></p>
                        </div>
                        <div class="c-m-4" style="text-align:center;">
                            <p>'.explode("~",$row[2])[0].'</p>
                        </div>
                        <div class="c-m-3">                                          
                            <p>'.explode("~",$row[2])[1].'</p>
                        </div>
                        <div class="c-m-1" style="padding-top:5px; text-align:center;">
                            <button type="button" value="'.$row[0].'~'.$row[1].'~'.$row[2].'" class="btn delMed delTestName" name="delTestName"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
                ';
                $outDone=1;
            }
        }
        $output.='
        <div class="typeRow row">
            <div class="c-m-4">
                
            </div>
            <div class="c-m-4" style="text-align:center;">
                <div class="row" style="margin:0px; padding:0px;">
                    <div class="c-4 leftValue">
                        <input type="number" min="0" class="input-field val1" style="width:100%;" name="val1" id="val1" placeholder="Value">
                    </div>
                    <div class="c-4">
                        <select class="input-field fullWidth rangeType" name="rangeType" style="font-size:1.2em;">
                            <option value="<"><</option>
                            <option value=">">></option>
                            <option value="-">-</option>
                        </select>
                    </div>
                    <div class="c-4">
                        <input type="number" min="0" class="input-field val2" style="width:100%;" name="val2" id="val2" placeholder="Value">
                    </div>
                </div>
            </div>
            <div class="c-m-3">                                          
                <select class="input-field fullWidth unit" name="unit" id="unit">
                    <option value="mg/dl">mg/dl</option>
                    <option value="g/dl">g/dl</option>
                </select>
            </div>
            <div class="c-m-1" style="padding-top:5px; text-align:center;">
                <button type="button" value="'.$testname.'" class="btn btnPatientView viewMed addMoreUnits" name="addMoreUnits"><i class="fas fa-plus"></i></button>
            </div>
            <div class="c-12"><hr class="lightHr"></div>
        </div>
        </div>
        ';
    }
    echo $output;
}

//Delete report fields
function deleteReportFields()
{
    $rId=$_POST["repId"];
    $tName=$_POST["testName"];
    $range=$_POST["rangeVal"];
    $lab=new lab();
    $stat=$lab->deleteReportFields($rId, $tName, $range);
    if($stat!=1)
        echo -1;
    else
    {
        echo getReportFields($rId);
    }
}

//Get selected report type fields
function getReportFieldsAdd()
{
    $rId=$_POST["repId"];
    $repName=$_POST["repName"];
    $lab=new lab();
    $data=$lab->getReportFields($rId);
    $output="";
    $outputDone=0;
    $testname="";
    if(mysqli_num_rows($data))
    {
        $output.='
        <div class="typeRow row">
            <input type="hidden" value="'.$rId.'" name="repTypeId" class="repTypeId">
            <div class="c-11">
                <p class="reportType"><b><u>'.$repName.'</u></b></p>
            </div>
            <div class="c-m-1" style="padding-top:5px; text-align:center;">
                <button type="button" value="'.$rId.'" class="btn delMed removeTestName" name="removeTestName"><i class="fas fa-times"></i></button>
            </div>
        ';
        while($row=mysqli_fetch_array($data))
        {
            if($testname==$row[1])
            {
                $output.='
                <div class="c-m-4">
                </div>
                <div class="c-m-4">
                </div>
                <div class="c-m-4">                                          
                    '.$row[2].'
                </div>  
                ';
            }
            else
            {
                if($outputDone==1)
                {
                    $output.='
                    </div>
                    ';
                }
                $testname=$row[1];
                $output.='
                <div class="resultSet c-12 row" style="margin-bottom:10px;">
                    <div class="c-m-4 testName">
                        '.$row[1].'
                    </div>
                    <div class="c-m-4">
                        <input type="number" min="0" class="input-field repRes" style="width:100%;" name="repRes" placeholder="Result">
                    </div>
                    <div class="c-m-4" style="margin-top:5px;">                                          
                        '.$row[2].'
                    </div>
                ';
                $outputDone=1;
            }
        }
        $output.='
        </div>
        ';
    }
    echo $output;
}

function getPatientReport()
{
    $output="";
    $lab = new lab();
    $pId = $_POST["patientID"];
    $repData = $lab->getPatientRep($pId);
    $last="";
    $lastDate="";
    if(mysqli_num_rows($repData)){
        $repRow=mysqli_fetch_array($repData);
        $output.= "
            <div class='row patientDataRowRep active' id='pres $repRow[0]'>
                <div class='c-12' style='padding-right:0px;'>
                    <b>ID: </b><span class='reportListID'>".$repRow[0]."</span><br>
                    <b>Date: </b><span class='reportListDate'>".$repRow[2]."</span><br>
                </div>
            </div> 
            ";
            $last=$repRow[0];
            $lastDate=$repRow[2];
        while($repRow=mysqli_fetch_array($repData)){ 
            $output.= "
            <div class='row patientDataRowRep' id='pres $repRow[0]'>
                <div class='c-12' style='padding-right:0px;'>
                    <b>ID: </b><span class='reportListID'>".$repRow[0]."</span><br>
                    <b>Date: </b><span class='reportListDate'>".$repRow[2]."</span><br>
                </div>
            </div> 
            ";
        }
    }
    //echo $output;
    echo json_encode(array($output,$last,$lastDate));
}

function getReportDataTable()
{
    $output="";
    $lab = new lab();
    $reportId = $_POST["reportID"];
    $reportData = $lab->getReportData($reportId);
    $count=1;
    $testname="";
    if(mysqli_num_rows($reportData)){
        while($reportDataRow=mysqli_fetch_array($reportData)){ 
            $ranges=$lab->getReportRanges($reportDataRow[3], $reportDataRow[5]);
            if($testname!=$reportDataRow[4])
            {
                $testname=$reportDataRow[4];
                $output.='<br><h4><u>'.$testname.'</u></h4>';
            }
            $output.='
            <tr>
                <td style="width:30%; text-align:center;">'.$reportDataRow[5].'</td>'.getResultRangeStatus($reportDataRow[6], $reportDataRow[3], $reportDataRow[5]);
            
            
            if(mysqli_num_rows($ranges)==1)
            {
                $output.='<td style="width:30%; text-align:center;">'.mysqli_fetch_array($ranges)[0].'</td>';
            }
            else if(mysqli_num_rows($ranges)>1)
            {
                $output.='<td style="width:30%; text-align:center;">';
                while($rangeRow=mysqli_fetch_array($ranges))
                {
                    $output.=$rangeRow[0].'</br>';
                }
                $output.='</td>';
            }
            $output.='</tr>';
            $count++;
        }
    }
    //echo $output;
    echo $output;
}

function getResultRangeStatus($result,$repId,$testName)
{
    $result=(float)$result;
    $lab = new lab();
    $range=$lab->getReportRanges($repId, $testName);
    $status="";
    $error=0;
    while($row=mysqli_fetch_array($range))
    {
        $arr=explode(" ",$row[0]);
        if($arr[0]=="<")
        {
            if((float)$arr[1]<$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.' (High)</td>';
                return $status;
            }
            else if((float)$arr[1]==$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.'</td>';
                return $status;
            }
            else
            {
                $status='<td style="width:30%; text-align:center; color:green;">'.$result.'</td>';
            }
        }
        else if($arr[0]==">")
        {
            if((float)$arr[1]>$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.' (Low)</td>';
                return $status;
            }
            else if((float)$arr[1]==$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.'</td>';
                return $status;
            }
            else
            {
                $status='<td style="width:30%; text-align:center; color:green;">'.$result.'</td>';
            }
        }
        else if($arr[1]=="-")
        {
            if((float)$arr[0]>$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.' (Low)</td>';
                return $status;
            }
            else if((float)$arr[2]<$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.' (High)</td>';
                return $status;
            }  
            else if((float)$arr[0]==$result || (float)$arr[2]==$result)
            {
                $status='<td style="width:30%; text-align:center; color:red;">'.$result.'</td>';
                return $status;
            } 
            else
            {
                $status='<td style="width:30%; text-align:center; color:green;">'.$result.'</td>';
            }
        }
    }
    return $status;
}
?>