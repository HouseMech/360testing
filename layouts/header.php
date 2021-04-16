<header id="navbar" class="header-container">
  <div class="header-title">
    <a class="header-title-link" href="/index.php"><h1>MyBlogPost</h1></a>
  </div>
  <div class="header-options">
    <div class="header-input">
      <!-- Styling for the search bar. -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    #change relative referencing for index.php
    if($_SERVER['REQUEST_URI'] === "/index.php"){
      echo '<form action="./php/search.php" method="GET">';
    }else{
      echo '<form action="../php/search.php" method="GET">';
    }
     ?>
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <div id="menu" class="header-button">
      <a id="menuItem" href="/index.php">Home</a>
      <!-- Display (Sign In / Profile / Sign Out) buttons depending on user login status. -->
      <script>
        $.ajax({
         url: '/php/index.php',
           success: function (response) {
             var button = $(response);
             $('#menu').append(button);
           }
        });
      </script>
    </div>
  </div>
</header>
