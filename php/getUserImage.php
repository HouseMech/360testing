<?php
## checks to see if user has profile pic if it does it displays it if not displays the generic one.
include_once "commonFunctions.php";
startSession();
# if user not logged in display defualt

if(!isLoggedIn()){
    echo "<img id='userProfilePicture' src='https://painrehabproducts.com/wp-content/uploads/2014/10/facebook-default-no-profile-pic.jpg' alt='userProfilePicture'>";
}else{
    $username = $_SESSION['username'];
    $conn = createConnection();
    $result = $conn->query("SELECT profilePic From blogUser WHERE userName='$username'");
    $row = $result->fetch_assoc();
    # if user is logged in but doesn't have a profile pic show defualt
    if(is_null($row['profilePic'])){
        echo "<img id='userProfilePicture' src='https://painrehabproducts.com/wp-content/uploads/2014/10/facebook-default-no-profile-pic.jpg' alt='userProfilePicture'>";
    }else{
        echo "<img id='userProfilePicture' src='".$row['profilePic']."'/>";
    }
    $conn -> close();
}
?>