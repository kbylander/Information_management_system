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
    echo "Genpofad selected";
} 

if ($Method == "Matchstates") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Matchstates.R');
    echo "Matchstates selected";
} 

if ($Method == "Daredevil") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Daredevil.R');
    echo "Daredevil selected";
}

if ($Method == "Consensus") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Consensus.R');
    echo "Consensus selected";
}


exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Create_table.R');


$outputtable = "output/table.php";

$outputtable = file_get_contents($outputtable);
echo $outputtable;

unlink('output/output.php');
unlink('output/seqname.php');
unlink('output/table.php');
?>



    