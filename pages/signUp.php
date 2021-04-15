<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MyBlogPost</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type = "text/javascript" src="../js/signUp.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
  </head>

  <body>
  <?php include '../layouts/header.php';?>

  <div class="main-content">
    <div id="center">
      <h2 id='subHead'>Sign Up:</h2>
      <div class="signup-container">
        <form enctype="multipart/form-data" class="signup-form" action="../php/signUp.php" method="post" >
          <fieldset>
            <p><label for="userName">UserName:</label></p>
            <p><input type="text" name="userName" id="userName" maxlength="15" /></p>

            <p><label for="fName">First Name:</label></p>
            <p><input type="text" name="fName" id="fName" maxlength="15" /></p>

            <p><label for="lName">Last Name:</label></p>
            <p><input type="text" name="lName" id="lName" maxlength="15" /></p>

            <p><label for="email">Email:</label></p>
            <p><input type="email" name="email" id="email" maxlength="30" /></p>

            <p><label for="password">Password:</label></p>
            <p><input type="password" name="password" id="password" maxlength="15"/></p>

            <p><label for="confirmPassword">Confirm Password:</label></p>
            <p><input type="password" name="confirmPassword" id="confirmPassword" maxlength="15" /></p>

            <label for="pImg">(Optional) Upload a profile picture <i>(.jpg, .jpeg, or .png): </i></label>
            <p><input type="file" id="pImg" name="profilePic" accept="image/*"/></p>

            <p><input type="submit" value="Sign Up" id="signUp-btn"/></p>
            <h3 id="message"></h3>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>
