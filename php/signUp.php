<?php
// add new user to database unless someone else has the same username or email.
// if account registration correct set session varable 'login' to true
include_once "commonFunctions.php";

// start session so if the user is logged in can be tracked across pages
// session_status means there is no session started
startSession();
// if user already loggeed in exit
if(isLoggedIn()){
    exit("You are already logged in!");
}

// get info from post
$userName = $_POST["userName"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$email = $_POST["email"];
$password = $_POST["password"];
// encrypt password
$hash = password_hash($password,
          PASSWORD_DEFAULT);


// create connection
$conn = createConnection();
// email and username are already validated by validEmailAndPassword.php so no need to check if they are valid
$stmt = $conn->prepare("INSERT INTO blogUser (userName, password, firstName, lastName, email ) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $userName, $hash , $fName, $lName, $email);
if($stmt->execute()){
    $_SESSION["login"] = true;
    $_SESSION["email"] = $email;
    $_SESSION['username'] = $userName;
    // Determine username for user and store as session['username']. Helpful for other pages.
    $stmt->close();
    $conn->close();
    include_once "setUserimage.php";

    exit("success");
}else{
    $conn->close();
    exit("Something went wrong at our end try again");
}
?>
