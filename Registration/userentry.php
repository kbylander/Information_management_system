<?php
$sql_stmt = "INSERT INTO users (username, hash, email, accessID, affiliation) VALUES ('$username', '$hash', '$email', 1, '$affiliation')";
include '../connectDB.php';
mysqli_query($link,$sql_stmt);
include '../disconnectDB.php';
?>
