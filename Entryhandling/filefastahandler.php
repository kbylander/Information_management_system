<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fastas = array();
$splitbyrow='[\n]';
$splitbyspace='[!]';
$splitfastas=preg_split($splitbyrow, $ffile);

$split=str_replace ( ' ', '!', $splitfastas);

foreach($split as $key => $value){
    $test=preg_split($splitbyspace, $value);
    array_push($fastas, $test);
}

$header = array();
$seq = array();
$fastanumber =- 1;

$indexnumber=0;
foreach ($fastas as $key => $value){
    foreach ($value as $index){
        $fasta[$indexnumber] = $index;
        $indexnumber +=1;
    }
}
include 'fastadivider.php'; //insert a full header into a separate array, same with sequences. 
?>
