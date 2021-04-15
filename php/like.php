<?php
  include_once "commonFunctions.php";
  startSession();
  $pid = $_GET['pid'];

  // Determine user login.
  if (empty($_SESSION["username"])){
    $user = 'NULL';
  } else {
    $user = $_GET['user'];
  }

  if ($user == 'NULL'){
    $message = 'Please login to like a post!';
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0; url=post.php?pid=" . $pid);
  } else {
    // Create connection.
    $conn = createConnection();

    // Get current number of likes for this post.
    $stmt = $conn->prepare("SELECT * FROM likes WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_likes = $result -> num_rows;
    $stmt->close();
    
    // Next determine whether the current user has already liked this post (determine dislike/like).
    $stmt = $conn->prepare("SELECT * FROM likes WHERE cUserName = ? AND pid = ?");
    $stmt->bind_param("ss", $user, $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $liked = $result -> num_rows;

    // If post is already liked, 
    if ($liked == 0){
      // Insert user into likes table for that pid (to determine that the user has liked this post).
      $stmt = $conn->prepare("INSERT INTO likes (pid, cUserName) VALUES (?,?)");
      $stmt->bind_param("ss", $pid, $user);
      $stmt->execute();
      $stmt->close();

      // Increment likes by 1 (like).
      $stmt = $conn->prepare("UPDATE post SET likes = ? WHERE pid = ?");
      $num_likes = $num_likes + 1;
      $stmt->bind_param("ss", $num_likes, $pid);
      if($stmt->execute()){
        $stmt->close();
        $conn->close();
        // Redirect user back to getPosts page.
        header("Refresh:0; url=post.php?pid=" . $pid);
        exit("success");
      }
    } else {
      // Delete user from likes table.
      $stmt = $conn->prepare("DELETE FROM likes WHERE cUserName = ?");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $stmt->close();

      // Else, decrement the likes by 1. (dislike)
      $stmt = $conn->prepare("UPDATE post SET likes = ? WHERE pid = ?");
      $num_likes = $num_likes - 1;
      $stmt->bind_param("ss", $num_likes, $pid);
      if($stmt->execute()){
        $stmt->close();
        $conn->close();
        // Redirect user back to getPosts page.
        header("Refresh:0; url=post.php?pid=" . $pid);
        exit("success");
      }
    }  
    $conn->close();
  }  
?>