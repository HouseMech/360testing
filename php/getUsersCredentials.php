<?php
# Current assumption sidebar is hidden so only logged in users can see account settings
# so will not check if they are logged in might have to change later..
include_once "commonFunctions.php";

startSession();

$conn = createConnection();

$username = $_SESSION['username'];
# not using a prepared statement because username has already been validated
$result = $conn->query("SELECT * From blogUser WHERE userName='$username'");
# since no one can share a username and this user is currently logged in
# based off assumption there must be an output
$row = $result->fetch_assoc();
# return json output
echo json_encode($row);
$conn -> close();
?>
