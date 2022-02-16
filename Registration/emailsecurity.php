<?php
//Comtrol to see if entered email has the right format, string@domain.com
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
  $isemail = True; //If email follows the format, boolean set to True
}
else{
  $isemail = False; //Email does not follow correct format, boolean set to False
}
?>
