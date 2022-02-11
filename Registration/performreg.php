<?php
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

if(isset($_POST['captcha_challenge']) && $_POST['captcha_challenge'] == $_SESSION['captcha_text']) {
// Check if captcha was correctly entered 
//If statements to confirm if a user can be added or what is wrong with the entry.
  if($strongpassword && $isemail && $uniqueuser){
    include 'passwordhash.php'; //Hashes the password
    include 'userentry.php'; //Saves user info to database
    echo "Registration complete";
  }
  else{
    echo "Registration unsuccessful:";
    echo "<br><br>";
  //If statement to check if the username and email are unique. Returned from duplicateentrycheck.php
    if($uniqueuser != True){
    echo "Email or username already taken.";
    echo "<br>";
    }
  //If statement to check if the email is the correct. Returned from emailsecurity.php
    if($isemail != True){
      echo "Email address is not the correct format. ";
      echo "<br>";
    }
  //If statement to check if the password meet the set requirements. Returned from passwordsecurity.php
    if($strongpassword != True){
      echo "Password should be at least 8 characters in length and should include at least one upper case letter and one number. ";
      echo "<br>";
    }
  //If statement to check if the fields for passwords are matching. Returned from password security.php
    if($matchingpasswords != True){
      echo "Passwords are not matching.";
      echo "<br>";
    }
  }
  // Capthca was not correctly entered
} else {
  echo '<p>You entered an incorrect Captcha.</p>';
}
?>
