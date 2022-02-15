<?php
session_start();
$_SESSION['RegistrationErrors'] = ''; //Session variable to display any errors when trying to register
/* Defining and storing variables from the registration form */
$username = $_POST['username'];
$password = $_POST['userpassword'];
$confirmpassword = $_POST['confirmpassword'];
$email = $_POST['useremail'];
$affiliation = $_POST['affiliation'];

/* Running all the required scripts to check if login information in sufficient */
include 'passwordsecurity.php'; //This script does all password security checks
include 'emailsecurity.php'; //This script does the email check
include 'duplicateentrycheck.php'; //This script checks the database so the username and passwords are unique

//if(isset($_POST['captcha_challenge']) && $_POST['captcha_challenge'] == $_SESSION['captcha_text']) {
// Check if captcha was correctly entered
//If statements to confirm if a user can be added or what is wrong with the entry.
  if($strongpassword && $isemail && $uniqueuser){
    include 'passwordhash.php'; //Hashes the password
    include 'userentry.php'; //Saves user info to database
    header("Location:../Login/login.php"); //Redirects user to login page if the registration is successful
  }
  else{
    $_SESSION['RegistrationErrors'] = "Registration unsuccessful"."<br><br>"; //Adds an error message according to the error at hand
  //If statement to check if the username and email are unique. Returned from duplicateentrycheck.php
    if($uniqueuser != True){
    $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Email or username already taken. '."<br>";//Adds an error message according to the error at hand
    }
  //If statement to check if the email is the correct. Returned from emailsecurity.php
    if($isemail != True){
      $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Email address is not the correct format. '."<br>";//Adds an error message according to the error at hand
    }
  //If statement to check if the password meet the set requirements. Returned from passwordsecurity.php
    if($strongpassword != True){
      $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Password should be at least 8 characters in length and should include at least one upper case letter and one number. '."<br>";
    }
  //If statement to check if the fields for passwords are matching. Returned from password security.php
    if($matchingpasswords != True){
      $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Passwords entered were not matching. '."<br>";//Adds an error message according to the error at hand
    }
    header("Location:registration.php"); //Registration was unsuccessful. The user is redirected back to the registration form
  }
  // Capthca was not correctly entered
 /*else {
  echo '<p>You entered an incorrect Captcha.</p>';
}*/
?>
