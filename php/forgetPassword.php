<?php 
include_once "commonFunctions.php";

$email = $_POST["email"];

$conn = createConnection();
// check if email and password are valid 
$stmt = $conn->prepare("SELECT email password FROM bloguser WHERE email = ? ");
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
    //update bloguser set bloguser.password = 123456 where email = 'rileyclark14@icloud.com'
    $stmt = $conn->prepare("UPDATE bloguser SET bloguser.password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash ,$email);
    $stmt->execute();
    $conn -> close();
    // set up email
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://be.trustifi.com/api/i/v1/email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\"recipients\":[{\"email\":\"$email\"}],\"title\":\"MyblogPost Password Reset.\",\"html\":\"<p>Your new password is <b>$newPass</b> </p>\"}",
        CURLOPT_HTTPHEADER => array(
            "x-trustifi-key: fff5a03a51196bc00fea3bea514f4310c664f494c9c0ee4a" ,
            "x-trustifi-secret: 4fdf1346265f385f832d88d377e7cbbe",
            "content-type: application/json"
        )
    ));
    
    // send email
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo "password changed successfully check email inbox for new password.";
    }
}
?>