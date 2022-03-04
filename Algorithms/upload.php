<?php

$_SESSION['HeaderError']= '';


//Load files
$fastaseq1 = $_POST['fastasequence1'];
$fastaseq2 = $_POST['fastasequence2'];

if (isset($fastaseq1) and isset($fastaseq2)) {
    $filepath1 = "../Database/TempFastaFiles/singlefasta_fasta.fasta";
    $filepath2 = "../Database/TempFastaFiles/multiplefasta_am_fasta.fasta";
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
unlink('../Database/TempFastaFiles/singlefasta_fasta.fasta');
unlink('../Database/TempFastaFiles/multiplefasta_am_fasta.fasta');
unlink('output_file/fastafile.php');



?>



    