<?php
$username = $_POST['username'];
$password = $_POST['userpassword'];
$confirmpassword = $_POST['confirmpassword'];
$email = $_POST['useremail'];

//Very incomplete if statements! Should be combined when everything is set up. Used for debugging as of right now.
//This part is the password check, to validate password security
include 'passwordsecurity.php'; //This script does all password security checks
if($strongpassword){ //Strong password means that the entered passwords are matching and it satisfies the password security standard
  include 'passwordhash.php'; //Hashes the password, store $hash to database
  echo "strong password $password $hash ";
}
elseif($matchingpasswords){ //The password is not strong enough but they are matching
  echo 'Password should be at least 8 characters in length and should include at least one upper case letter and one number';
}
else{ //The password is not matching, might be strong enough however
  echo 'Entered passwords must match';
}

//This section does the email check
include 'emailsecurity.php'; //This script does the email check
if($isemail){ //If the email entered is an actual email
  echo 'This is a proper email address';
}
else{ //The email entered is not structured like an email
  echo 'Enter a proper email address';
}

include 'duplicateentrycheck.php';
/*if $uniqueusername{
  echo "Unique: $debug";//$numberofentries";
}
else{
  echo "Not unique: $debug";
}*/
echo " $username";

include 'userentry.php';
?>
