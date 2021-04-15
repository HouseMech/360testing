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
          // $stmt->execute();
          // $result = $stmt->get_result();
          //$num_posts = $result -> num_rows;


          $conn->close();
        ?>
      </div>
  </div>
  <?php include 'layouts/footer.php';?>
  </body>
</html>
