<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MyBlogPost</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type = "text/javascript" src="../js/accountSettings.js"></script>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <?php include '../layouts/global_head_include.php';?>

  <body>
  <?php include_once '../layouts/header.php';?>

  <div class="main-content">
    <?php include '../layouts/sidebar.php';?>

  <div id="center">
    <h2 id='subHead'>Account Settings:</h2>
    <?php
      include_once "../php/commonFunctions.php";
      startSession();
      // Prevent user from accessing this page unless signed in.
      if (!isLoggedIn()):?>
        <div id='numPosts'>
        <h2>Please sign in to make account changes.</h2>
        </div>
        <?php else: // Edit account form.?>
        <form id="accountForm">';
          <p><label for="userName">Username:</label></p>
          <p><input type="text" name="userName" id="userName" maxlength="15" readonly  style="background-color:grey;"/></p>
          <p><label for="fName">First Name:</label></p>
          <p><input type="text" name="fName" id="fName" maxlength="15" /></p>
          <p><label for="lName">Last Name:</label></p>
          <p><input type="text" name="lName" id="lName" maxlength="15" /></p>
          <p><label for="email">Email:</label></p>
          <p><input type="email" name="email" id="email" maxlength="30" /></p>
          <p><label for="password">Password:</label></p>
          <p><input type="password" name="password" id="password" maxlength="15"/></p>
          <p> Leave password blank If you want it to remain unchanged.</p>
          <p><input type="submit" value="Save" id="saveBtn"/></p>
          <h3 id="message"></h3>
        </form>
        <form enctype="multipart/form-data" id="imageForm" method="post" action="./php/setUserImage.php">
          <label for="pImg">Upload new profile picture <i>(.jpg)</i>:</label>
          <p><input type="file" id="pImg" name="profilePic" accept="image/*"/></p>
          <p><input type="submit" value="Upload" id="uploadBtn"/></p>
        </form>

        <form id='deleteForm' action='./php/deleteAccount.php' method='post'>
          <label for='deleteBtn'>Delete BlogPost Account:</label>
          <p id='terms'>By clicking the 'Delete Account' button below, you agree to delete<br>your account and any posts or comments linked with it.</p>
          <p><input type='submit' value="DeleteAccount"id ='deleteBtn'/></p>
        </form>
        <?php endif; ?>
    
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>