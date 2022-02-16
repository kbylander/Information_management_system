<?php
//PHPs built in hashing function. Returns the hashed password combined with the salt.
//Use password_varify in the login function.
$hash = password_hash($password, PASSWORD_DEFAULT);
?>
