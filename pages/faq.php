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
    <h2 id='subHead'>FAQ Page:</h2>
    <div id='pbody'>
      <h3 id='tBody'>Welcome to BlogPost!</h3>
      <div id='ppBody'>
        <p>
          This is a blogging site project created for COSC 360 (Web Programming).
          With BlogPost, you can view blog post made by other public members on this site,
          or publish your own posts to be viewed by the public.
        </p>
        <p>
          You can view other posts and comments made by others by using the search bar above.<br>
          (<i>You are not required to be signed-in to access this feature.</i>) <br>
          If you wish to post or comment, than you must <a href='pages/signIn.php'>Sign-In</a>.
        </p>
        <p>
          If you do not have an account already, please visit the <a href='pages/signUp.php'>Sign-Up</a> link.
        </p>
        <p>
          Thank you for visiting BlogPost!<br> Please see the
          <a href='pages/contact.php'>Contact Us</a>
          page if you have any issues or suggestions!
        </p>
      </div>
    </div>
    
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>