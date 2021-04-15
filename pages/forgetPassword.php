<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>MyBlogPost</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type = "text/javascript" src="../js/forgetPassword.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
  </head>
  <body>
  <?php include_once '../layouts/header.php';?>

  <div class="main-content">
    <div id="center">
      <div class="signup-container">
        <form class="signup-form" action="">
          <fieldset>
            <p> enter your email </p>
            <p><label for="email">Email:</label></p>
            <p><input type="email" name="email" id="email"  maxlength="30" /></p>
            <p><input type="submit" value="Recover Password" id="signIn-btn"/></p>
            <p id="message"></p>
           </form>
      </div>
    </div>
  </div>
