<!DOCTYPE html>
<html lang="en">

  <?php include '../layouts/global_head_include.php';?>

  <body>
    <?php include_once '../layouts/header.php';?>

  <div class="main-content">
      <?php include '../layouts/sidebar.php';?>

      <div id="center">
      <?php
        header("Location: ../index.php");
        exit();
      ?>
      </div>
  </div>
  <?php include '../layouts/footer.php';?>
  </body>
</html>
