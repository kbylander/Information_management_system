<?php
session_start();
$_SESSION['user']='';
$_SESSION['loggedin'] = FALSE;
$_SESSION['LoginError'] = '';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$passw = $_POST['userpassword'];
$user = $_POST['username'];
$userID=$user;
$passwlen = strlen($passw);

if($passwlen > 7) {
    echo 'password is long enough';

    include '../connectDB.php';
    $query = "SELECT * FROM users WHERE username LIKE '$userID'";
    $result = mysqli_query($link, $query);
    $number_of_entries = mysqli_num_rows($result);

    include '../disconnectDB.php';

    if ($number_of_entries != 0){

    while($row = mysqli_fetch_array($result)) {

        $act = $row['active']; //if not a user active, don't let to go inside
        if (!$act){
            $_SESSION['LoginError'] = $_SESSION['LoginError'] . 'Login failed' . '<br>';
            header("location:login.php");
        }
        $hash=$row['hash'];
        echo $hash;
    }
    if (password_verify($passw, $hash)) {
        $_SESSION['user']=$userID;
        $_SESSION['loggedin'] = TRUE;
        header('Location:../index.php');


        } else {
            $_SESSION['LoginError'] = $_SESSION['LoginError'] . 'Login failed' . '<br>';
            header("location:login.php");

        }
    } else{
        $_SESSION['LoginError'] = $_SESSION['LoginError'] . 'Login failed' . '<br>';
        header("location:login.php");

    }

}
else{
    $_SESSION['LoginError'] = $_SESSION['LoginError'] . 'Login failed' . '<br>';
    header("location:login.php");

}

?>
