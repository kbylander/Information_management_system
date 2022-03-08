<!DOCTYPE html>
<html>
<body>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$user = $_SESSION['user'];
$answer = $_POST['delete'];

if ($answer == "Yes"){
    $query = "UPDATE users SET users.active = 0 WHERE users.username = $user";
    include '../connectDB.php';
    $result = mysqli_query($link, $query);
    header('Location: ../index.php');
include '../disconnectDB.php';
}else{
    header('Location: userprofile.php');

}

?>

</body>
</html>