<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$header = array();
$seq = array();
$fastanumber =- 1;

foreach($splitfastas as $key => $value) { 
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

require 'checktextcharacters.php';
foreach ($header as $key => $value){
    if ((validseq($seq[$key])) && (validcharachters($value))){
        include 'headercheck.php';    
    }
    else{
        $_SESSION['UploadError'] = 'Fasta contained illegal characters.';
        header('Location:./insertform.php');
    }
}

?>