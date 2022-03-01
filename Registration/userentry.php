<?php
$sql_stmt = "INSERT INTO users (username, hash, email, admin, active) VALUES ('$username', '$hash', '$email', 0, false)";
include '../connectDB.php';
mysqli_query($link,$sql_stmt);
include '../disconnectDB.php';
?>
