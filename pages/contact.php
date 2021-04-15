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
    <h2 id='subHead'>Contact Us:</h2>
    <div id='cBody'>
      <h3><u>OKANAGAN CAMPUS</u></h3>
      <p>3333 University Way</p>
      <p>Kelowna, BC Canada V1V 1V7</p>
      <p><a href='tel:250.807.8000'>Call UBCO Now</a></p>
    </div>
    <div id='cBody'>
      <h3><u>VANCOUVER CAMPUS</u></h3>
      <p>2329 West Mall</p>
      <p>Vancouver, BC Canada V6T 1Z4</p>
      <p><a href='tel:604 822 2211'>Call UBC Now</a></p>
    </div>
    
  </div>

  <?php include '../layouts/footer.php';?>
  </body>
</html>