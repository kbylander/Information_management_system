<?php

//read in file
$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];

require __DIR__ . '/DD_function.php';
Daredevil($fasta1, $fasta2);

?>