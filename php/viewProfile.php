<!DOCTYPE html>
<html lang="en">
  <?php include '../layouts/global_head_include.php';?>

  <body>
  <?php include_once '../layouts/header.php';?>

  <div class="main-content">
    <?php include '../layouts/sidebar.php';?>

    <div id="center">
    <?php
      include_once "commonFunctions.php";
      startSession();
      $user = $_GET['user'];
      if (empty($_SESSION["username"])){$username = 'NULL';} else {$username = $_SESSION['username'];}

      // Create connection.
      $conn = createConnection();

      // Fetch user's first & last name to view on profile.
      $stmt = $conn->prepare("SELECT userName, firstName, lastName, profilePic FROM blogUser WHERE userName = ?");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $fName = $row['firstName'];
      $lName = $row['lastName'];

      echo "<h2 id='subHead'>Profile:</h2>";

      echo "<div id='ppProfilePage'>";
      if(is_null($row['profilePic'])){
        echo "<img id='userProfilePicture' src='https://painrehabproducts.com/wp-content/uploads/2014/10/facebook-default-no-profile-pic.jpg' alt='userProfilePicture'>";
      }else{
        echo "<img id='userProfilePicture' src='".$row['profilePic']."'/>";
      }
      echo "</div>";

      echo '<p id="sidebar-username" style="color:black;">';
      echo $row['userName'];
      echo '</p>';
      
      echo "<div id='flName'>";
      echo "<h2>" . $fName . " " . $lName . "</h2>";
      echo "</div>";

      // Fetch the user's most recent post to view on profile.
      echo "<p id='spacer'>____________________________________</p>";
      echo "<div id='ppTab'>";
      echo '<h2>Most Recent Post:</h2>';
      echo "</div>";
      echo "<p id='spacer'>____________________________________</p>";

      $conn = createConnection();
      $stmt = $conn->prepare("SELECT * FROM post WHERE pUserName = ? ORDER BY time DESC LIMIT 1");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();
      $num_posts = $result -> num_rows;
      // If recent post exists in db,
      if ($num_posts == 0){
        echo "<div id='numPosts'>";
        echo '<h2 style="color: maroon;">No Recent Post!</h2>';
        echo "</div>";
      } else {
        $row = $result->fetch_assoc();
        $pid = $row['pid'];
        $pUserName = $row['pUserName'];
        $description = $row['description'];
        $time = $row['time'];
        $imagePath = $row['imagePath'];
        $likes = $row['likes'];
        $postTitle = $row['postName'];
        $postTopic = $row['topic'];
        $allowComments = $row['allowComment'];
        $stmt->close();
        
        echo "<div id='blogPost'>";
        echo "<h2>" . $postTitle . "</h2>";
        echo "<p id='time-log'>" . $time . "</p>";
        echo "<div id='desc-log'>";
        echo "<h5>" . $description . "</h5>";
        echo "</div>";

        // Link to open attached image in new tab.
        if (!empty($imagePath)) {
          echo "<div id='img-link'><a href='./img/pimg/" . $imagePath . "' target='_blank'>View Attached Image</a></div>";
        }

        // Display post topic, author, and # likes.
        echo "<div id='post-log'>";
        echo "<table id='post-table'>";
        echo "<tr>";
        echo "<th id='post-header'>Post Topic:</th>";
        echo "<th id='post-header'>Author:</th>";
        echo "<th id='post-header'># Likes:</th>";
        echo "</tr>";
        
        echo "<tr>";
        echo "<td>";
        if (empty($postTopic)){
          echo "<h3 id='post-item'>" . 'None' . "</u></h3>";
        } else {
          echo "<form method='GET' action='php/search.php'>";
          echo "<input id='post-item' name='search' type='submit' value=" . $postTopic . "></input>";
          echo "</form>";
        }

        // View user profile.
        echo "</td>";
        echo "<td>";
        echo "<form method='GET' action='php/viewProfile.php'>";
        echo "<input id='post-item' name='user' type='submit' value=" . $pUserName . "></input>";
        echo "</form>";
        echo "</td>";
        
        // Like button. (Liking the post will direct the user to the post page automatically).
        echo "<td>";
        echo "<form id='btn-item' action='php/like.php?pid=" . $pid . "&user=" . $username .  "' method='get'>";
        echo "<button id='post-item' type='submit' formmethod='post'>" . '(' . $likes . ') 👍' . "</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
        echo "</table>";
        echo "</div>";

        // View post button.
        echo "<div id='btn-holder'>";
        echo "<form id='btn-item' action='php/post.php?pid=" . $pid . "' method='get'>";
        echo "<button id='btn-view' type='submit' formmethod='post'>View Post</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
      }

      // Fetch the user's most recent comment to view on profile.
      echo "<p id='spacer'>____________________________________</p>";
      echo "<div id='ppTab'>";
      echo '<h2>Most Recent Comment:</h2>';
      echo "</div>";
      echo "<p id='spacer'>____________________________________</p>";

      $stmt = $conn->prepare("SELECT * FROM comment WHERE cUserName = ? ORDER BY time DESC LIMIT 1");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();
      $num_posts = $result -> num_rows;

      // If recent comment exists in db.
      if ($num_posts == 0){
        echo "<div id='numPosts'>";
        echo '<h2 style="color: maroon;">No Recent Comment!</h2>';
        echo "</div>";
      } else {
        $row = $result->fetch_assoc();
        $pid = $row['pid'];
        $cid = $row['cid'];
        $pUserName = $row['cUserName'];
        $comment = $row['commentContent'];
        $time = $row['time'];
        $likes = $row['likes'];
        $stmt->close();

        // Display post time.
        echo "<div id='blogPost'>";
        echo "<p id='time-log'>" . $time . "</p>";

        // Display comment.
        echo "<div id='desc-log'>";
        echo "<h5>" . $comment . "</h5>";
        echo "</div>";

        // View post button.
        echo "<div id='btn-holder'>";
        echo "<form id='btn-item' action='php/post.php?pid=" . $pid . "' method='get'>";
        echo "<button id='btn-view' type='submit' formmethod='post'>View Comment</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }

      $conn->close();

    ?>
    </div>
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>