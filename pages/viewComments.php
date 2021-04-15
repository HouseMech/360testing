<!DOCTYPE html>
<html lang="en">
  <?php include '../layouts/global_head_include.php';?>

  <body>
  <?php include_once '../layouts/header.php';?>
  <div class="main-content">
    <?php include '../layouts/sidebar.php';?>
    <div id="center">
      <h2 id='subHead'>View Your Comments:</h2>
      <?php
        include_once "../php/commonFunctions.php";
        startSession();
        // Prevent user from accessing this page unless signed in.
        if (empty($_SESSION["username"])){$username = 'NULL';} else {$username = $_SESSION['username'];}
        if ($username != 'NULL'){
          // Fetch all comments from this user.
          $conn = createConnection();
          $stmt = $conn->prepare("SELECT * FROM comment WHERE cUserName = ? ");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();
          $num_posts = $result -> num_rows;
          if ($num_posts == 1){
            echo "<div id='numPosts'>";
            echo '<h2>You have <u>' . $num_posts . '</u> comment!</h2>';
            echo "</div>";
          } else {
            echo "<div id='numPosts'>";
            echo '<h2>You have <u>' . $num_posts . '</u> comments!</h2>';
            echo "</div>";
          }
          if ($result){
            // Append this attributes, one div for each comment.
            while ($row = $result->fetch_assoc()){
              // Fetch attributes for each post by each this user.
              $pid = $row['pid'];
              $cid = $row['cid'];
              $pUserName = $row['cUserName'];
              $comment = $row['commentContent'];
              $time = $row['time'];
              $likes = $row['likes'];

              // Display post time.
              echo "<div id='blogPost'>";
              echo "<p id='time-log'>" . $time . "</p>";

              // Display comment.
              echo "<div id='desc-log'>";
              echo "<h5>" . $comment . "</h5>";
              echo "</div>";

              echo "<div id='btn-holder'>";
              // View Post button.
              echo "<form id='btn-item' action='php/post.php?pid=" . $pid . "' method='get'>";
              echo "<button id='btn-view' type='submit' formmethod='post'>View Post</button>";
              echo "</form>";

              // Delete comment button.
              echo "<form id='btn-item' action='php/deleteComment.php?pid=" . $pid . "&cid=" . $cid . "' method='get'>";
              echo "<button id='btn-delete' type='submit' formmethod='post'>Delete Comment</button>";
              echo "</form>";

              echo "</div>";

              echo "</div>";
              echo "<p id='spacer'>____________________________________</p>";
            }
          }
        } else {
          echo "<div id='numPosts'>";
          echo '<h2>You must be signed in to view this page.</h2>';
          echo "</div>";
        }
      ?>
    </div>
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>
