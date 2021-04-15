
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>MyBlogPost</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type = "text/javascript" src="../js/signIn.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
  </head>
  <body>

<!-- have to manually implement the header until I can resolve some pathing issues -->
    <header id="navbar" class="header-container">
      <div class="header-title">
        <h1>MyBlogPost</h1>
      </div>
      <div class="header-options">
        <div class="header-input">
          <input type="text" placeholder="Search...">
        </div>

        <div id="menu" class="header-button">
          <a id="menuItem" href="../index.php">Home</a>
        </div>
      </div>
    </header>


  <div class="main-content">
    <div id="center">
      <h2 id='subHead'>Sign In:</h2>
      <div class="signup-container">
        <form class="signup-form" action="">
          <fieldset>
            <p><label for="email">Email:</label></p>
            <p><input type="email" name="email" id="email"  maxlength="30" /></p>

            <p><label for="password">Password:</label></p>
            <p><input type="password" name="password" id="password"  maxlength="15" /></p>
            <a href="forgetPassword.php" id="forgetP">Forgot Password?</a>
            <h3 id="message"></h3>
            <p><input type="submit" value="Sign In" id="signIn-btn"/></p>
            <p><input type="button" value="Sign Up" onclick="signUp_Visit()" id="signUp-btn"/></p>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>
