<?php
## set a new user profile pic 
include_once "commonFunctions.php";

startSession();
if(!isLoggedIn()){
  exit("you musn't touch the crystals... get out of here!");
}
$username = $_SESSION["username"];
// check if there is a file array, the file was uploaded through post and the name contains .jpg, JPG, png, or jpeg
if (count($_FILES) > 0 && is_uploaded_file($_FILES['profilePic']['tmp_name']) 
        && (strpos($_FILES['profilePic']['name'], ".jpg") ||
        strpos($_FILES['profilePic']['name'], ".JPG") ||
        strpos($_FILES['profilePic']['name'], ".png")|| 
        strpos($_FILES['profilePic']['name'], ".jpeg" ))) {
  $conn = createConnection();
  ## only commit after file has been successfully downloaded
  mysqli_autocommit($conn, false);  
  // assign destintion
  if(strpos($_FILES['profilePic']['name'], ".jpg") || strpos($_FILES['profilePic']['name'], ".JPG")){
    $destination = "./img/profilePics/".$username.".jpg";
  }elseif(strpos($_FILES['profilePic']['name'], ".png")){
    $destination = "./img/profilePics/".$username.".png";
  }else{
    $destination = "./img/profilePics/".$username.".jpeg";
  }

  echo $destination;
  $conn->query("UPDATE blogUser SET profilePic='$destination' WHERE blogUser.userName='$username'") or die("Unable to insert image ".  mysqli_error($conn));

  $destination = ".".$destination;
  $fileToMove = $_FILES['profilePic']['tmp_name'];
  if (move_uploaded_file($fileToMove,$destination)) {
    mysqli_commit($conn);
    $conn->close();
    #local host
    header("Location:http://localhost/Group32ProjectCosc360/pages/accountSettings.php");
    
  }
  else {
    $conn->close();
    echo "There was a problem moving the file.";
  }       
}else{
  echo "No, file present";
  header("Location:http://localhost/Group32ProjectCosc360/pages/accountSettings.php");
}
?>