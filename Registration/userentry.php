<?php
$sql_stmt = "INSERT INTO users (username, hash, email, admin, active) VALUES ('$username', '$hash', '$email', 0, false)";
require '../transactions.php';
dbtransactions($sql_stmt);
?>

