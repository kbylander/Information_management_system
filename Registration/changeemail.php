<!DOCTYPE html>
<html>
<body>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = $_SESSION['user'];
$newemail = $_POST['newemail'];
$query2 = "UPDATE users SET users.email = $newemail, users.active = 0 WHERE users.username = $user";
include '../connectDB.php';
$result = mysqli_query($link, $query2);
include '../disconnectDB.php';
$query3 = "SELECT users.hash FROM users WHERE users.username = $user";
include '../connectDB.php';
$result = mysqli_query($link, $query3);
include '../disconnectDB.php';


#new verification step
$to      = $newemail; 
$subject = 'Verification of Genetic Mach email';
$message = '
  
Thanks for changing your email!
Your email has been changed and we need that you verify your new email account, please follow the link.
  
------------------------
Username: '.$user.'
------------------------
  
Please click this link to activate your account:
http://localhost/IMS-Daredevil/verify.php?email='.$newemail.'&hash='.$result.'
  
';
                      
$headers = 'From: daredevilwolves@gmail.com' . "\r\n";
mail($to, $subject, $message, $headers);
$msg = 'Your email has been changed, please verify it by clicking the activation link that has been send to your new email.';
echo $msg;
?>
<div class = "buton">
        <button id = "b7" onclick="location.href = '../Login/login.php';" type="button">Go back</button>
</div>

</body>
</html>