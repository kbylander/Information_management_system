<?php
$sql_stmt = "SELECT username FROM users WHERE username LIKE '$username'";
include '../connectDB.php';
$select = mysqli_query($link, $sql_stmt);
$num_entries = mysqli_num_rows($select);
if ($num_entries > 0){
  $uniqueusername = False;
}
else{
  $uniqueusername = True;
}

$sql_stmt = "SELECT email FROM users WHERE email LIKE '$email'";
$select = mysqli_query($link, $sql_stmt);
$num_entries = mysqli_num_rows($select);
if ($num_entries > 0){
  $uniqueemail = False;
}
else{
  $uniqueemail = True;
}

if($uniqueusername && $uniqueemail){
  $uniqueuser = True;
}
else {
  $uniqueuser = False;
}
include '../disconnectDB.php';
?>
