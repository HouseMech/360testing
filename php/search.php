<!DOCTYPE html>
<html lang="en">
  <?php include '../layouts/global_head_include.php';?>
  <script type = "text/javascript" src="./js/getPost.js"></script>
  <body>
  <?php include_once '../layouts/header.php';?>
  <?php include_once "commonFunctions.php"; ?>
  <div class="main-content">
    <?php include '../layouts/sidebar.php';?>
    <div id="center">
      <?php
        global $search;
        $search = $_GET["search"]; 
        echo "<h2 id='subHead'>Search Results for: <b>" . $search . "</b></h2>";
        $conn = createConnection();

        // Fetch all post titles that have titles similar to the search term.
        $stmt = $conn->prepare("SELECT * FROM post WHERE postName Like ? ORDER BY time DESC");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_posts = $result -> num_rows;
        echo "<div id='numPosts'>";
        echo '<h2><u>' . $num_posts . '</u> Post Title Result(s).</h2>';
        echo "</div>";

        if ($result){
          // Append this attributes, one div for each post.
          while ($row = $result->fetch_assoc()){
            // Fetch attributes for each post by each this user.
            $pid = $row['pid'];
            $pUserName = $row['pUserName'];
            $description = $row['description'];
            $time = $row['time'];
            $imagePath = $row['imagePath'];
            $likes = $row['likes'];
            $postTitle = $row['postName'];
            $postTopic = $row['topic'];
            $allowComments = $row['allowComment'];

            // Display post title.
            echo "<div id='blogPost'>";
            echo "<h2>" . $postTitle . "<img class='arrow' src='./img/pageImgs/up_arrow.png' height=25 width=25></h2>";

            // div needed for collapsible post
            echo "<div class='slide'>";

            // Display post time.
            echo "<p id='time-log'>" . $time . "</p>";

            // Display description.
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
              echo "<h3 id='post-item'>" . $postTopic . "</u></h3>";
            }
            echo "</td>";
            echo "<td>" . "<h3 id='post-item'>" . $pUserName . "</h3></td>";
            echo "<td>" . "<h3 id='post-item'>" . '(' . $likes . ') 👍' . "</h3></td>";
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
            echo "</div>";
          }
        }

        // Fetch all post tags that match search term.
        $stmt->close();
        $stmt = $conn->prepare("SELECT * FROM post WHERE topic Like ? ORDER BY time DESC");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_posts = $result -> num_rows;
        echo "<div id='numPosts'>";
        echo '<h2><u>' . $num_posts . '</u> Post Tag Result(s).</h2>';
        echo "</div>";

        if ($result){
          // Append this attributes, one div for each post.
          while ($row = $result->fetch_assoc()){
            // Fetch attributes for each post by each this user.
            $pid = $row['pid'];
            $pUserName = $row['pUserName'];
            $description = $row['description'];
            $time = $row['time'];
            $imagePath = $row['imagePath'];
            $likes = $row['likes'];
            $postTitle = $row['postName'];
            $postTopic = $row['topic'];
            $allowComments = $row['allowComment'];

            // Display post title.
            echo "<div id='blogPost'>";
            echo "<h2>" . $postTitle . "<img class='arrow' src='./img/pageImgs/up_arrow.png' height=25 width=25></h2>";

    
            // div needed for collapsible post
            echo "<div class='slide'>";

            // Display post time.
            echo "<p id='time-log'>" . $time . "</p>";

            // Display description.
            echo "<div id='desc-log'>";
            echo "<h5>" . $description . "</h5>";
            echo "</div>";

            // Link to open attached image in new tab.
            if (!empty($imagePath)) {
              echo "<div id='img-link'><a href=" . $imagePath . ">View Attached Image</a></div>";
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
              echo "<h3 id='post-item'>" . $postTopic . "</u></h3>";
            }
            echo "</td>";
            echo "<td>" . "<h3 id='post-item'>" . $pUserName . "</h3></td>";
            echo "<td>" . "<h3 id='post-item'>" . '(' . $likes . ') 👍' . "</h3></td>";
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
            echo "</div>";
          }
        }

        // Fetch all post profiles that match search term.
        $stmt->close();
        $stmt = $conn->prepare("SELECT * FROM blogUser WHERE userName Like ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_posts = $result -> num_rows;
        echo "<div id='numPosts'>";
        echo '<h2><u>' . $num_posts . '</u> Profile Result(s).</h2>';
        echo "</div>";

        if ($result){
          // Append this attributes, one div for each post.
          while ($row = $result->fetch_assoc()){
            // Fetch attributes for each post by each this user.
            $pUserName = $row['userName'];
            $fName = $row['firstName'];
            $lName = $row['lastName'];

            // Display post title.
            echo "<div id='blogPost'>";
            echo "<h2>" . $pUserName . "</h2>";
            
            // View post button.
            echo "<div id='btn-holder'>";
            echo "<form id='btn-item' action='php/viewProfile.php?user=" . $pUserName . "' method='get'>";
            echo "<button id='btn-view' type='submit' formmethod='post'>View Profile</button>";
            echo "</form>";
            echo "</div>";
            
            echo "</div>";
          }
        }
        echo "<p id='spacer'>____________________________________</p>";
        $conn->close();
      ?>
    </div>
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>