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

      <?php
        startSession();
      ?>
      <?php if (isAdmin()): ?>
        <?php
          $conn = createConnection();
          $stmt = "SELECT * FROM blogUser;";
          $results = mysqli_query($conn, $stmt);
          $row_cnt = $results->num_rows;
        ?>
          <h2 id="subHead">Admin panel</h2>
          <textarea id="search" placeholder="Search User"></textarea>
          <div class="user-amount">Total Number of users: <?php echo $row_cnt;?></div>

          <table class="admin-table">
            <tr>
              <th>Username:</th>
              <th>First Name:</th>
              <th>Last Name:</th>
              <th>Email:</th>
              <th>Status:</th>
              <th>View Profile:</th>
              <th>View Posts:</th>
              <th>Delete Account:</th>
            </tr>
          <?php
            while ($row = mysqli_fetch_assoc($results))
            {
              echo "<tr>";
              echo "<td>".$row['userName']."</td>";
              echo "<td>".$row['firstName']."</td>";
              echo "<td>".$row['lastName']."</td>";
              echo "<td>".$row['email']."</td>";
              if ($row['isAdmin'] == 1){
                echo "<td>Admin</td>";
              } else { echo "<td>Client</td>"; }
              echo "<td>". "<a href='php/viewProfile.php?user=". $row['userName'] .  "'>View</a>";
              echo "<td>". "<a href='./php/adminViewPost.php?username=". $row['userName'] . '&adminUser=' . $_SESSION['username'] .  "'>View</a>";
              echo "<td>". "<a href='php/adminDeleteAccount.php?username=". $row['userName'] . '&adminUser=' . $_SESSION['username'] .  "'>❌</a>";
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
