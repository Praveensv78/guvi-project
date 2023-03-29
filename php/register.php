<?php

$firstname = $_POST['firstname'];
$lasstname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];
$password = $_POST['password'];

if(!empty($firstname) || !empty($lastname) || !empty($email) || !empty($mobile) || !empty($dob) || !empty($password))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "register";
}


// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
    die('Connect Error ('.
    mysqli_connect_errno() .') '
    . mysqli_connect_error());
}

else{
    $SELECT = "SELECT email from
    register Where email = ? Limit 1"
    ;
    $SELECT = "SELECT mobile from
    register Where mobile = ? Limit 1"
    ;
    $INSERT = "INSERT Into register (
        firstname, lastname, email, mobile, dob, password )
        values(?,?,?,?,?,?)";

        
//Prepare statement
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum = $stmt->num_rows;

//Prepare statement
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("i", $mobile);
$stmt->execute();
$stmt->bind_result($mobile);
$stmt->store_result();
$rnum = $stmt->num_rows;

//checking username
if($rnum==0) {
$stmt->close();
$stmt = $conn->prepare($INSERT);
$stmt->bind_param("sssiis", $firstname,$lasstname,$email,$mobile,$dob,$password);
$stmt->executed();
echo "New record inserted succesfully";
}
else{
    echo "Someone already register uding this email";
}
$stmt->close();
$conn->close();
}
else{
    echo "All field are required";
    die();
}
?>