<?php
session_start();
$_SESSION['HeaderError']= '';

$filename1 = rand();
$filename2 = rand();
//Load files
$fastaseq1 = $_POST['fastasequence1'];
$fastaseq2 = $_POST['fastasequence2'];

if (isset($fastaseq1) and isset($fastaseq2)) {
    $filepath1 = "../Database/TempFastaFiles/$filename1";
    $filepath2 = "../Database/TempFastaFiles/$filename2";
    file_put_contents($filepath1, $fastaseq1);
    file_put_contents($filepath2, $fastaseq2);
} else {
    echo "No sequence inserted";
}

$_SESSION['file1'] = $filename1;

//Load method of choice
$Method = $_POST['Method'];

//go through each file in a folder, and run the exe

if ($Method == "Genpofad") {
    exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Genpofad.R $filename1 $filename2");
} 

if ($Method == "Matchstates") {
    exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Matchstates.R $filename1 $filename2");
} 

if ($Method == "Daredevil") {
    exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Daredevil.R $filename1 $filename2");
}

if ($Method == "Consensus") {
    exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Consensus.R $filename1 $filename2");
}

include 'Table.php';

unlink("output/output$filename1");
unlink("output/seqname$filename1");
unlink("../Database/TempFastaFiles/$filename1");
unlink("../Database/TempFastaFiles/$filename2");
unlink("output_file/tempfile$filename1");
unlink("output_file/$filename1");
    


?>



    