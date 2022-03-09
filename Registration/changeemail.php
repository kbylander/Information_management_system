<!DOCTYPE html>
<html>
<body>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
        header('Location: ../index.php');
}
$email = $_POST['email'];
$user = $_SESSION['user'];
include 'emailsecurity.php';
//If statement to check if the email is the correct. Returned from emailsecurity.php
if(!$isemail){
        $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Email address is not the correct format. '."<br>";//Adds an error message according to the error at hand
}else {
        $query2 = "UPDATE users SET users.email = '$email', users.active = 0 WHERE users.username = '$user'";
        require '../transactions.php';
        dbtransactions($query2);
        $query3 = "SELECT users.hash FROM users WHERE users.username = '$user'";
        $result = dbtransactions($query3);
        $hash = mysqli_fetch_array($result);
        $hash = implode($hash);

        #new verification step
        $to      = $email; 
        $subject = 'Verification of Genetic Mach email';
        $message = '
        
        Thanks for changing your email!
        Your email has been changed and we need that you verify your new email account, please follow the link.
        
        ------------------------
        Username: '.$user.'
        ------------------------
        
        Please click this link to activate your account:
        http://localhost/IMS-Daredevil/Registration/verify2.php?email='.$email.'&hash='.$hash.'
        
        ';
                        
        $headers = 'From: daredevilwolves@gmail.com' . "\r\n";
        mail($to, $subject, $message, $headers);
        $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Your email has changed, please verify it by clicking the activation link that has been send to your new email'."<br>";
}
header("Location: userprofile.php");
?>
</body>
</html>