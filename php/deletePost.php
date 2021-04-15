<?php
  include_once "commonFunctions.php";
  startSession();

  // Get pid for post to delete.
  $pid = $_GET['pid'];

  // create connection and delete post (pid) from posts table.
  $conn = createConnection();

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
  
  // Redirect user back to getPosts page.
  header("Refresh:0; url=getPosts.php");
?>