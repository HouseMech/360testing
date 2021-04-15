<!DOCTYPE html>
<html lang="en">

  <?php include 'layouts/global_head_include.php';?>
  <script type = "text/javascript" src="./js/getPost.js"></script>
  <body>
    <?php include_once 'layouts/header.php';?>
    <?php include 'php/commonFunctions.php';?>

  <div class="main-content">
      <?php include 'layouts/sidebar.php';?>

      <div id="center">
        <h2 id='subHead'>Home Feed:</h2>
        <?php
          // Insert this bottom line into any page that can be viewed as both logged in/logged out state.
          if (empty($_SESSION["username"])){$username = 'NULL';} else {$username = $_SESSION['username'];}
          // HOT POSTS.
          // Create connection and fetch the top 5 most liked posts.
          $conn = createConnection();
          $stmt = $conn->prepare("SELECT * FROM post ORDER BY likes DESC LIMIT 5");
          $stmt->execute();
          $result = $stmt->get_result();
          $num_posts = $result -> num_rows;

          if ($num_posts == 0){
            echo "<p id='helper'>Currently no Public Post to Show.";
            echo "<p style='text-align:center;'><i>(No posts have been saved to database)</i></p>";
          } else {
            // Display top 5 posts onto home page.
            if ($result){
              echo '<p id="helper">Viewing the Top (' . $num_posts . ') Most Liked Post(s) on BlogPost!</p>';
              while ($row = $result->fetch_assoc()){
                $pid = $row['pid'];
                $pUserName = $row['pUserName'];
                $description = $row['description'];
                $time = $row['time'];
                $imagePath = $row['imagePath'];
                $likes = $row['likes'];
                $postTitle = $row['postName'];
                $postTopic = $row['topic'];
                $allowComments = $row['allowComment'];

                echo "<div id='blogPost'>";
                echo "<h2>" . $postTitle . "<img class='arrow' src='./img/pageImgs/up_arrow.png' height=25 width=25></h2>";

                // div needed for collapsable post
                echo "<div class='slide'>";

                echo "<p id='time-log'>" . $time . "</p>";

                echo "<div id='desc-log'>";
                echo "<h5>" . $description . "</h5>";
                echo "</div>";

                // If attached image.
                if (!empty($imagePath)) {
                  echo "<div id='img-link'><a href='./img/pimg/" . $imagePath . "' target='_blank'>View Attached Image</a></div>";
                }

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

                echo "</td>";
                echo "<td>";
                echo "<form method='GET' action='php/viewProfile.php'>";
                echo "<input id='post-item' name='user' type='submit' value=" . $pUserName . "></input>";
                echo "</form>";
                echo "</td>";
                
                echo "<td>";
                echo "<form id='btn-item' action='php/like.php?pid=" . $pid . "&user=" . $username .  "' method='get'>";
                echo "<button id='post-item' type='submit' formmethod='post'>" . '(' . $likes . ') 👍' . "</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
                echo "</table>";
                echo "</div>";

                echo "<div id='btn-holder'>";

                echo "<form id='btn-item' action='php/post.php?pid=" . $pid . "' method='get'>";
                echo "<button id='btn-view' type='submit' formmethod='post'>View Post</button>";
                echo "</form>";

                echo "</div>";
                echo "</div>";
                echo "<p id='spacer'>____________________________________</p>";
                echo "</div>";
              }
              $conn->close();
            }
          }
        ?>
      </div>
  </div>
  <?php include 'layouts/footer.php';?>
  </body>
</html>
