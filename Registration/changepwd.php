<!DOCTYPE html>
<html>
<body>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$passw = $_POST['newpwd'];
include 'password_hash.php';
$user = $_SESSION['user'];
$query = "UPDATE users SET users.hash = $hash WHERE users.username = $user";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB.php';
?>


</body>
</html>