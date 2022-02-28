<?php
$sql_stmt = "INSERT INTO users (username, hash, email, admin) VALUES ('$username', '$hash', '$email', 0)";
include '../connectDB.php';
mysqli_query($link,$sql_stmt);
include '../disconnectDB.php';
?>
