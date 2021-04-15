<?php 
include_once "commonFunctions.php";

$email = $_POST["email"];

$conn = createConnection();
// check if email and password are valid 
$stmt = $conn->prepare("SELECT email password FROM blogUser WHERE email = ? ");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
// if null that email is not in the database
if(is_null($row)){
    exit("Invalid email");
}else{
    $stmt->close();
    //generate a new password from 10000-99999
    $newPass = rand(10000, 99999);
    $hash = password_hash($newPass,
          PASSWORD_DEFAULT);
    // putting hash into sql statement because user does not effect output
    //update blogUser set bloguser.password = 123456 where email = 'rileyclark14@icloud.com'
    $stmt = $conn->prepare("UPDATE blogUser SET blogUser.password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash ,$email);
    $stmt->execute();
    $conn -> close();
    // set up email
    $to = $email;
    $subject = "My Blog Post password reset";
    $message = "your password has been changed to $newPass";
    $header = "From: myblogpost1234@gmail.com";
    // send email
    if(mail($to, $subject, $message, $header)){
        exit("success");
    }else
        exit("unable to send");
}
?>