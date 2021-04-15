<?php
include_once "commonFunctions.php";

startSession();

$username = $_POST['userName'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$conn = createConnection();
// hiden is placed in password input so if user changes it also change password
if(strcmp($password, "") !== 0){
    $stmt = $conn->prepare("UPDATE bloguser SET password=?, firstName=?, lastName=?, email=? WHERE userName=?");
    $stmt->bind_param("sssss", $hash, $fName, $lName, $email, $username);
    $stmt->execute();
    $conn -> close();
    exit("sucess");
}else{
    $stmt = $conn->prepare("UPDATE bloguser SET firstName=?, lastName=?, email=? WHERE userName=?");
    $stmt->bind_param("ssss", $fName, $lName, $email, $username);
    $stmt->execute();
    $conn -> close();
    exit("sucess");
}

?>