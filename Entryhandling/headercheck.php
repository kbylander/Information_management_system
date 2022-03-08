<?php
session_start();

require '../transactions.php';

//fetch starting position of all required header elements. 
foreach ($header as $key => $value){
    $priv = true;
    $entryIDend= strpos($value,'|');
    $genestart = strpos($value,'gene=');
    $speciesnamepos = strpos($value,'os=');
    $firstchar=strpos($value,'>');

    //checks if header contains all required elements
    if ((!str_contains($value[$firstchar],'>'))  || (empty($entryIDend)) || (empty($genestart)) || (empty($speciesnamepos))){
        $_SESSION['HeaderError']= 'Header: ' . $value . ' is in incorrect format';
        header('Location:./insertform.php'); 
    }
    else{
      include 'insertdb.php';
    }
}
?>

