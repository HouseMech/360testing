<?php
  include_once "commonFunctions.php";
  startSession();
  if(!isLoggedIn()){
    exit("you should not be here");
  }

  $username = $_GET['username'];
  $adminUser = $_GET['adminUser'];

  // Make sure admin doesn't try to delete his own account through user table.
  if ($username == $adminUser){
    $message = "To delete your own admin account, please go to account settings.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0; url=../pages/adminPanel.php");
    exit('');
  }

  // Create connection.
  $conn = createConnection();

  // Verify that the admin is the one making the account deletion for a user.
  $stmt = $conn->prepare("SELECT * FROM blogUser WHERE userName = ?");
  $stmt->bind_param("s", $adminUser);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  $row = $result->fetch_assoc();

  if ($row['isAdmin'] == 1){
    // Delete all comments made by this user.
    $stmt = $conn->prepare("DELETE FROM comment WHERE cUserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();

    // Begin by deleting all likes made by this user.
    $stmt = $conn->prepare("DELETE FROM likes WHERE cUserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();

    // Get all posts made by this user.
    $stmt = $conn->prepare("SELECT pid FROM post WHERE pUserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // If posts exists by this user,
    if ($result){
      while ($row = $result->fetch_assoc()){
        // Get post id for each post.
        $pid = $row['pid'];

        // Delete all comments linked to that post.
        $stmt = $conn->prepare("DELETE FROM comment WHERE pid = ?");
        $stmt->bind_param("s", $pid);
        $stmt->execute();
        $stmt->close();

        // Then, delete the post itself.
        $stmt = $conn->prepare("DELETE FROM post WHERE pid = ?");
        $stmt->bind_param("s", $pid);
        $stmt->execute();
        $stmt->close();
      }
    }

    // Finally, delete the user from the `users` table.
    $stmt = $conn->prepare("DELETE FROM blogUser WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $message = $username . "'s account has been deleted.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0; url=../pages/adminPanel.php");
    exit('');
  } else {
    exit("You must be an admin to access this page.");
  }
?>