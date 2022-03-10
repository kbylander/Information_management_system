<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$header = array();
$seq = array();
$fastanumber =- 1;

//divides every fasta in the string to two arrays ==> sequences and header array.
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
    //removes hidden strings that may exist in the string from the file input.
    $seq[$key] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $seq[$key]);
    $value = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value);
    $seq[$key]= str_replace('\xBB\xBF', '',$seq[$key]);
    $value= str_replace('\xBB\xBF', '',$seq[$key]);
    
    //checks if the sequence/header contains any illegal charachters.
    if ((validseq($seq[$key])) && (validcharachters($value))){
        include 'headercheck.php';   
    }
    else{
        $_SESSION['HeaderError'] = 'Fasta contained illegal characters: ' . $value;
        header('Location:./insertform.php');
    }
}
?>