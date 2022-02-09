
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$password = $_POST['userpassword'];
$email = $_POST['useremail'];

$passwlen = strlen($password);
$passw=$password;

//check if inserted is an email and correct email
include '../Registration/emailsecurity.php';

//check if user inserted anytyhing into password box, returns boolean
if(($passwlen > 7) && $isemail) {
    echo 'password is long enough';


    include '../connectDB.php';
    $query = "SELECT hash FROM users WHERE email LIKE '$email'";
    $result = mysqli_query($link, $query);
    $number_of_entries = mysqli_num_rows($result);
    if ($number_of_entries != 0){
    include '../disconnectDB.php';


    while($row = mysqli_fetch_array($result)) {

        $hash=$row['hash'];
    }
    if (password_verify($passw, $hash)) {
        echo 'Password is valid!';
        } else {
            echo 'Wrong password.';
        }
    } else{
        echo "email not in db";
    }

}
else{
    echo 'password aint long enough';
}
  
//if all correct; start session with userID remembered

?>