<?php
$sql_stmt = "INSERT INTO users (username, hash, email, accessID) VALUES ('$username', '$hash', '$email', 1)";
include '../connectDB.php';
mysqli_query($link,$sql_stmt);
include '../disconnectDB.php';
?>
