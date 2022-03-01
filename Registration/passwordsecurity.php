<?php

if($passw == $confirmpassword) //Checks if entered passwords are matching
{
    $matchingpasswords = True; //Boolean set to true, indicating that passwords are matching

    $uppercase = preg_match('@[A-Z]@', $passw); //Checks if password contains at least 1 uppercase character
    $lowercase = preg_match('@[a-z]@', $passw); //Checks if password contains at least 1 lowercase character
    $number    = preg_match('@[0-9]@', $passw); //Checks if password contains at least 1 number

    //If statement to check if the entered password satisfies criterias
    if($uppercase && $lowercase && $number && strlen($passw) > 7) {
        $strongpassword = True; //Password satisfies criterias, boolean set to True
    }
    else{
        $strongpassword = False; //Password does not satisfy criterias, boolean set to False
    }
  }
else{
    $strongpassword = False;
    $matchingpasswords = False; //Passwords entered are not matching, boolean set to False
}

?>
