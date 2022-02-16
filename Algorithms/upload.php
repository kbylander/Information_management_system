<?php

$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];

$document1 = file_get_contents($fasta1);
$document2 = file_get_contents($fasta2);

$filename1 = "input/input1.fasta";
$filename2 = "input/input2.fasta";

file_put_contents($filename1, $document1);
file_put_contents($filename2, $document2);
echo "Your files were uploaded successfully";
exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Function_call.R');

?>



    