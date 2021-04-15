<?php
  include_once "commonFunctions.php";
  startSession();
  if(!isLoggedIn()){
    exit("you should not be here");
  }

  $pid = $_GET['pid'];
  $adminUser = $_GET['adminUser'];
  $username = $_GET['username'];

  // Create connection.
  $conn = createConnection();

  if (isAdmin()){

    // Begin by deleting all the likes for each post first.
    $stmt = $conn->prepare("DELETE FROM likes WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $stmt->close();

    // Then, delete all comments linked to that post.
    $stmt = $conn->prepare("DELETE FROM comment WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $stmt->close();
    
    // Finally, delete the post from its table. 
    $stmt = $conn->prepare("DELETE FROM post WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $message = 'Post has been deleted.';
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0; url=../php/adminViewPost.php?username=". $username . '&adminUser=' . $adminUser);
    exit('');
  } else {
    exit("You must be an admin to access this page.");
  }
?>