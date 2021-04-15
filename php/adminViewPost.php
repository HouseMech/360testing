<!DOCTYPE html>
<html lang="en">
  <?php include '../layouts/global_head_include.php';?>
  <script type = "text/javascript" src="./js/adminPanel.js"></script>
  <?php include_once "../php/commonFunctions.php"; ?>

  <body>
    <?php include_once '../layouts/header.php';?>

  <div class="main-content">
      <?php include '../layouts/sidebar.php';?>

      <div id="center">

      <?php startSession(); ?>
      <?php if (isAdmin()): ?>
        <?php
          $username = $_GET['username'];
          $adminUser = $_GET['adminUser'];

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
            $stmt = $conn->prepare("SELECT * FROM post WHERE pUserName = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row_cnt = $result->num_rows;

          } else { exit("You must be an admin to access this page."); }
          
        ?>
          <h2 id="subHead">Admin panel</h2>
          <textarea id="search" placeholder="Search Post"></textarea>
          <div class="user-amount">Viewing all post for user: <?php echo $username;?></div>
          
          <table class="admin-table">
            <tr>
              <th>Title:</th>
              <th>Topic:</th>
              <th>Description:</th>
              <th>Post Time:</th>
              <th># Likes:</th>
              <th>Comments Allowed:</th>
              <th>Delete Post</th>
            </tr>
          <?php
            if ($row_cnt == 0){
              echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
            } 
            while ($row = mysqli_fetch_assoc($result))
            {
              echo "<tr>";
              echo "<td>".$row['postName']."</td>";
              echo "<td>".$row['topic']."</td>";
              echo "<td>".$row['description']."</td>";
              echo "<td>".$row['time']."</td>";
              echo "<td>".$row['likes']."</td>";
              if ($row['allowComment'] == 1){
                echo "<td>On</td>";
              } else { echo "<td>Off</td>"; }
              echo "<td>". "<a href='php/adminDeletePost.php?pid=". $row['pid'] . '&adminUser=' . $adminUser . "&username=" . $username . "'>❌</a>";
              echo "</tr>";
            }
            $conn->close();
          ?>
        </table>

      <?php else: ?>
        <h1>You do not have access to this page</h1>
      <?php endif ?>
      </div>
  </div>
  <?php include '../layouts/footer.php';?>
  </body>
</html>
