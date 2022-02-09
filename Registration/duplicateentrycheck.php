<?php
//$sql = "INSERT INTO users (username, hash, email, accessID)
//VALUES ('$username', '$hash', '$email', 1)";

include '../connectDB.php';
$query = mysqli_query($link, "SELECT * FROM users WHERE username='$username'");
/*if (mysqli_num_rows($query) > 0){
  $uniqueusername = False;
}
else{
  $uniqueusername = True;
}*/
$debug = "TEST";
//mysqli_query($link, $sql);
include '../disconnectDB.php';
?>
