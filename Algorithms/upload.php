<?php
//Load files
$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];

//Load method of choice
$Method = $_POST['Method'];

$document1 = file_get_contents($fasta1);
$document2 = file_get_contents($fasta2);

// Naming file
$lines1 = explode("\n", $document1);
$lines2 = explode("\n", $document2);
    
// extract header
$header1 = substr($lines1[0], 1);
$header2 = substr($lines2[0], 1);

$header1 = trim($header1);
$header2 = trim($header2);

$filename1 = "input/$header1.fasta";
$filename2 = "input/$header2.fasta";
//                          //

file_put_contents($filename1, $document1);
file_put_contents($filename2, $document2);
//echo "Your files were uploaded successfully";

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

//unlink('output/output.php');
//unlink('output/seqname.php');
//unlink('output/table.php');
?>



    