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
  $passw = $_POST['passw'];
  $confirmpassword = $_POST['confirmpassword'];
include 'passwordsecurity.php';
//If statement to check if the password meet the set requirements. Returned from passwordsecurity.php
if(!$strongpassword){
    $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Password should be at least 8 characters in length and should include at least one upper case letter and one number. '."<br>";
  }
//If statement to check if the fields for passwords are matching. Returned from password security.php
if(!$matchingpasswords){
    $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Passwords entered were not matching. '."<br>";//Adds an error message according to the error at hand
  } 
if ($strongpassword && $matchingpasswords) {
        $hash = password_hash($confirmpassword, PASSWORD_DEFAULT);
        $user = $_SESSION['user'];
        $query = "UPDATE users SET users.hash = '$hash' WHERE users.username = '$user'";
        require '../transactions.php';
        dbtransactions($query);
        $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'You have succesfully changed your password'."<br>";
}
header("Location: userprofile.php");
        ?>


</body>
</html>