<?php
$password = $_POST['userpassword'];
$confirmpassword = $_POST['confirmpassword'];
$email = $_POST['useremail'];

if($password == $confirmpassword)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    
    if($uppercase && $lowercase && $number && strlen($password) > 8) {
        echo 'Strong password.';
        
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {  echo 'fan va fint';
        
        }else{
            echo 'fyfan, gör om å rätt';
        }
    }else{
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter and one number';
    }

    
    echo 'matchar';
} else {
    echo 'Strings do not match.';
}

?>