<?php

//splits every word and linebreak into an array
$split=preg_split('[\n]', $ffile);
$splitfastas= array();

foreach($split as $value) {
    $listed=preg_split('[ ]', $value);
    foreach ($listed as $word){
        array_push($splitfastas,$word);
    }
}
include 'fastadivider.php';
?>

