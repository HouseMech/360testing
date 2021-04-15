<!DOCTYPE html>
<html lang="en">
  <?php include '../layouts/global_head_include.php';?>
  <script type="text/javascript" src="./js/newPost.js"></script>
  <body>
  <?php include_once '../layouts/header.php';?>

  <!-- Display sidebar depending on user login status. (Show if logged in, hide if not)-->
  <div class="main-content">
    <?php include '../layouts/sidebar.php';?>
    <div id="center">
    <h2 id='subHead'>New Post:</h2>
    <?php
      include_once "../php/commonFunctions.php";
      startSession();
      // Prevent user from accessing this page unless signed in.
      if (empty($_SESSION["username"])){$username = 'NULL';} else {$username = $_SESSION['username'];}
      if ($username == 'NULL'){
        echo "<div id='numPosts'>";
        echo '<h2>You must be signed in to post.</h2>';
        echo "</div>";
      } else {
        echo '<form method="POST" action="php/newPost.php" id="newPost-form" enctype="multipart/form-data">';
        echo '<fieldset>';
        echo '<label for="pTitle">Post Title:*</label><br/>';
        echo '<input name="pTitle" id="pTitle" type="text" required/><br/>';
        echo '<label for="pDesc">Post Description:*</label><br/>';
        echo '<textarea id="pDesc" name="pDesc" rows="4" cols="50" required></textarea><br/>';
        echo '<label for="pTags">Post Topic:</label><br/>';
        echo '<input name="pTags" id="pTags" type="text" /><br/>';
        echo '<label for="pImg">Upload Image <i>(.jpg)</i>:</label><br/>';
        echo '<input type="file" id="pImg" name="pImg" accept="image/jpeg"><br/>';
        echo '<p id="commentText">';
        echo '<input type="checkbox" id="pComments" name="pComments" value="1" checked/>Allow Comments</p><br/>';
        echo '<p id="message"><p>';
        echo '<input type="submit" value="POST" name="pSubmit" id="pSubmit"/>';
        echo '</fieldset>';
        echo '</form>';
      }
    ?>
    </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>
