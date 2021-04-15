<?php
//makes sure there is not already a connection opened
if(!function_exists('getConnection')){
    // create connection funcion
    function createConnection(){
        // credentials
      $url = parse_url(getenv("mysql://bc005626eca4de:f24623a1@us-cdbr-east-03.cleardb.com/heroku_d75ec31c7fdaee9?reconnect=true"));
      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"], 1);
      $conn = new mysqli($server, $username, $password, $db);
        return $conn;
    }
}

// if no session running starts one
function startSession(){
    if(session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }
}
// checks if user is logged In
function isLoggedIn(){
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        return true;
    }
    return false;
}

// checks if the current user is an administrator
function isAdmin() {
  if (isLoggedIn()) {
    $conn = createConnection();
    $username = $_SESSION['username'];
    $result = $conn->query("SELECT isAdmin From blogUser WHERE userName='$username'");
    $row = $result->fetch_assoc();
    if ($row['isAdmin'] == true) {
      return true;
    }
    else {
      return false;
    }
  }
  else {
    return false;
  }
}
?>
