<!DOCTYPE html>
<html>
<body>
<?php
include '../connectDB.php';
include 'passwordhash.php';
        
if(isset($_GET['email']) and !empty($_GET['email']) and isset($_GET['hash']) and !empty($_GET['hash'])){
    // Verify data
    $useremail = mysqli_real_escape_string($link, $_GET['email']); // Set email variable with escape_string to avoid SQL injection
    $hash = mysqli_real_escape_string($link, $_GET['hash']); // Set hash variable with escape_string to avoid SQL injection
                  
    $search = mysqli_query($link,"SELECT email, hash, active FROM users WHERE email='".$useremail."' AND hash='".$hash."' AND active=false") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);
                  
    if($match > 0){
        // if there is a match, we can activate the account
        mysqli_query($link,"UPDATE users SET active=true WHERE email='".$useremail."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
    }else{
        // no match, this account already active or invalid url
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
                  
}else{
    // Invalid approach
    echo '<div class="statusmsg">This is not valid, please use the link that has been send to your email.</div>';
}
include '../disconnectDB.php';
?>
<div class = "buton">
        <button id = "b7" onclick="location.href = '../Login/login.php';" type="button">Go back</button>
</div>
</body>
</html>
