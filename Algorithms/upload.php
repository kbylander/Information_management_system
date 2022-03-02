<?php

$_SESSION['HeaderError']= '';


//Load files
//$fasta1 = $_POST['fastafile1'];
//$fasta2 = $_POST['fastafile2'];
$fastaseq1 = $_POST['fastasequence1'];
$fastaseq2 = $_POST['fastasequence2'];

//if (isset($fasta1)) {
//    $document1 = file_get_contents("Fasta_test/$fasta1");
//    $document2 = file_get_contents("Fasta_test/$fasta2");


//    $filename1 = "input/Fasta1.fasta";
//    $filename2 = "input/Fasta2.fasta";

//    file_put_contents($filename1, $document1);
//    file_put_contents($filename2, $document2);
//} 

if (isset($fastaseq1) and isset($fastaseq2)) {
    $filepath1 = "input/Fasta1.fasta";
    $filepath2 = "input/Fasta2.fasta";
    file_put_contents($filepath1, $fastaseq1);
    file_put_contents($filepath2, $fastaseq2);
} else {
    echo "No sequence inserted";
}

//Load method of choice
$Method = $_POST['Method'];

//go through each file in a folder, and run the exe

if ($Method == "Genpofad") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Genpofad.R');
} 

if ($Method == "Matchstates") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Matchstates.R');
} 

if ($Method == "Daredevil") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Daredevil.R');
}

if ($Method == "Consensus") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Consensus.R');
}


include 'Table.php';

unlink('output/output.php');
unlink('output/seqname.php');
unlink('input/Fasta1.fasta');
unlink('input/Fasta2.fasta');
unlink('output_file/fastafile.php');

?>



    