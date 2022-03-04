<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$header = array();
$seq = array();
$fastanumber =- 1;

foreach($fasta as $key => $value) { 
    if (str_contains($value, '>')) {
        $fastanumber += 1;
    } 
    if ((strlen($value)> 30) || (!empty($seq[$fastanumber]))){
        if (empty($seq[$fastanumber])){
            $seq[$fastanumber] = $value;
        }
        else {
        $seq[$fastanumber] = $seq[$fastanumber] . $value;
        }
    }
    else {
        if (empty($header[$fastanumber])){
            $header[$fastanumber] = $value;
        }
        else {
        $header[$fastanumber] = $header[$fastanumber] . ' ' . $value;
        }
    }
}

require __DIR__ . '/checktextcharacters.php';
foreach ($header as $key => $value){
    if ((ValidTextCharacters($seq[$key])) && (ValidTextCharacters($value))){
        echo 'texten funka';
    }
    else{
        //header('Location:./insertform.php');
    }
}

include 'test.php';


//require __DIR__ . '/checkfilecharacters.php';
//foreach ($header as $key => $value){
//    if ((ValidFileCharacters($seq[$key])) && (ValidFileCharacters($value))){
//        echo 'filen funka';
//   }
//    else{
//        header('Location:./insertform.php');
//    }
//}
    
?>