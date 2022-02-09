<?php

if($password == $confirmpassword) //Checks if entered passwords are matching
{
    $matchingpasswords = True; //Boolean set to true, indicating that passwords are matching

    $uppercase = preg_match('@[A-Z]@', $password); //Checks if password contains at least 1 uppercase character
    $lowercase = preg_match('@[a-z]@', $password); //Checks if password contains at least 1 lowercase character
    $number    = preg_match('@[0-9]@', $password); //Checks if password contains at least 1 number

    //If statement to check if the entered password satisfies criterias
    if($uppercase && $lowercase && $number && strlen($password) > 7) {
        $strongpassword = True; //Password satisfies criterias, boolean set to True
    }
    else{
        $strongpassword = False; //Password does not satisfy criterias, boolean set to False
    }
  }
else{
    $matchingpasswords = False; //Passwords entered are not matching, boolean set to False
}

?>
