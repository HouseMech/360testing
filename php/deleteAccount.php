<?php
  include_once "commonFunctions.php";
  startSession();
  if(!isLoggedIn()){
    exit("you should not be here");
  }
  $username = $_SESSION['username'];

  // Create connection.
  $conn = createConnection();

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
  $stmt = $conn->prepare("DELETE FROM bloguser WHERE userName = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  // Redirect user back to home page.
  Session_start();
  Session_destroy();
  $_SESSION["login"] = false;
  header("Location: ../index.php");
?>