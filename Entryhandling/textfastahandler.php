<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fasta=array();

$splitfastas= explode('\n', $ftext);

foreach($splitfastas as $index){
    $test=explode(' ',$index);
    array_push($fasta, $test);
}

$header = array();
$seq = array();
$fastanumber =- 1;

$fastas=$fasta[0];
$fasta=$fastas;

print_r($fasta);

include 'fastadivider.php';

//print_r($header);
echo '<br><br>';
//print_r($seq);


?>