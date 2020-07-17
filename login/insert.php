<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneC = $_POST['phoneCode'];
$phone = $_POST['phone'];

$host = "localhost";
$dbusr = "root";
$dbpass = "";
$dbname = "test";

$conn = new mysqli($host,$dbusr,$dbpass,$dbname);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errorno().')'.mysqli_connect_error());
}
else{
    $SELECT = "SELECT email FROM input where email = ? Limit 1";
    $INSERT = "INSERT INTO input (username,password,gender,email,phoneCode,phone) values (?,?,?,?,?,?)";
    
    //prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssd",$username,$password,$gender,$email,$phoneC,$phone);
        $stmt-> execute();
        echo "New record inserted succesfully";
    }else{
        echo "someone already registered using this email";
    }
    $stmt->close();
    $conn->close();
}



?>