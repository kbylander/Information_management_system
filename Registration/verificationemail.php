<!DOCTYPE html>
<html>
<body>
<?php
include 'registration.php';
include 'passwordhash.php';

$to      = $useremail; 
$subject = 'Verification of Genetic Mach email';
$message = '
  
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: '.$username.'
------------------------
  
Please click this link to activate your account:
http://localhost/IMS-Daredevil/Registration/verify.php?email='.$useremail.'&hash='.$hash.'
  
';
                      
$headers = 'From: daredevilwolves@gmail.com' . "\r\n";
mail($to, $subject, $message, $headers);
?>


</body>
</html>