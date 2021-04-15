<?php

  // Function used to generate random (unique) filenames.
  function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < $length; $i++) { $key .= $keys[array_rand($keys)]; }
    return $key;
  }

  include_once "commonFunctions.php";
  startSession();
  $username = $_SESSION["username"];

  // Get form info. 
  $title = $_POST['pTitle']; // required
  $desc = $_POST['pDesc']; // required
  $tags = $_POST['pTags']; // optional

  // check if there is a file array, the file was uploaded through post and the name contains .jpg, JPG, png, or jpeg
  if (count($_FILES) > 0 && is_uploaded_file($_FILES['pImg']['tmp_name']) && (strpos($_FILES['pImg']['name'], ".jpg") || strpos($_FILES['pImg']['name'], ".JPG") || strpos($_FILES['pImg']['name'], ".png") || strpos($_FILES['pImg']['name'], ".jpeg" ))) {
    $conn = createConnection();
    ## only commit after file has been successfully downloaded.
    // assign a unique filename, that is unique for each post.
    $randF = random_string(12);
    if(strpos($_FILES['pImg']['name'], ".jpg") || strpos($_FILES['pImg']['name'], ".JPG")){
      $filename = $randF.".jpg";
      $destination = "./img/pImg/".$filename;
    }elseif(strpos($_FILES['pImg']['name'], ".png")){
      $filename = $randF.".png";
      $destination = "./img/pImg/".$filename;
    }else{
      $filename = $randF.".jpeg";
      $destination = "./img/pImg/".$filename;
    }

    echo $destination;
    $destination = ".".$destination;
    $fileToMove = $_FILES['pImg']['tmp_name'];
    if (move_uploaded_file($fileToMove,$destination)) {
      mysqli_commit($conn);
      $conn->close();
      header("Location: ../php/viewProfile.php?user=" . $_SESSION['username']);
    }
    else {
      $conn->close();
      echo "There was a problem moving the file.";
    }       
  }

  // Determine if commenting is turned on/off. 
  $allowComments = 1;
  if (isset($_POST['pComments'])){
    $allowComments = 1;
  } else {
    $allowComments = 0;
  }

  // create connection and insert post into database.
  $conn = createConnection();
  //create time of post
  $curTime = date("Y-m-d H:i:s");
  $stmt = $conn->prepare("INSERT INTO post (pid, pUserName, description, time, imagePath, likes, postName, topic, allowComment) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $likes = 0;
  $stmt->bind_param("sssssssss", $pid, $_SESSION['username'], $desc, $curTime, $filename, $likes, $title, $tags, $allowComments);
  if($stmt->execute()){
    $stmt->close();
    $conn->close();
    header("Location: ../php/viewProfile.php?user=" . $_SESSION['username']);
    exit("success");
  } else{
    $conn->close();
    exit("Could not submit post. Please try again!");
  }
  
?>