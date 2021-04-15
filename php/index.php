<?php
  include_once "commonFunctions.php";
  startSession();
?>
<?php if (isLoggedIn()): ?>
  <a id="menuItem" href="php/viewProfile.php?user=<?php echo $_SESSION['username']; ?>">Profile</a>
  <?php if (isAdmin()): ?>
    <a id="menuItem" href="./pages/adminPanel.php">Admin</a>
  <?php endif ?>
  <a id="menuItem" href="php/signOut.php">Sign Out</a>
<?php else: ?>
  <a id="menuItem" href="pages/signIn.php">Sign In</a>
<?php endif ?>
