<?php
//Load files
$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];

//Load method of choice
$Method = $_POST['Method'];

$document1 = file_get_contents("Fasta_test/$fasta1");
$document2 = file_get_contents("Fasta_test/$fasta2");

$filename1 = "input/Fasta1.fasta";
$filename2 = "input/Fasta2.fasta";

file_put_contents($filename1, $document1);
file_put_contents($filename2, $document2);

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

?>



    