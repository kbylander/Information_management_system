<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$filename = rand();
$fastaseq1 = $_POST['fastasequence1'];
if (isset($fastaseq1)) {
    $filepath1 = "../Database/TempFastaFiles/$filename";
    file_put_contents($filepath1, $fastaseq1);
} else {
    echo "No sequence inserted";
}

if(isset($_POST['comparation2'])){ //Check if "submit" is empty
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $seqIDs = "('".join("','",$selected)."')";
    $query = "SELECT sequence.genename, sequence.seq, entries.species FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID IN $seqIDs";
    include '../connectDB.php';
    $result = mysqli_query($link, $query);
    include '../disconnectDB.php';

    $genes = array();
    $seqs = array();
    $species = array();

    while($row = mysqli_fetch_array($result)):
      array_push($genes, $row[0]);
      array_push($seqs, $row[1]);
      array_push($species, $row[2]);
    endwhile;

    require 'fastafilegenerator.php';
    $seqIDs = explode(",",$seqIDs);
    $seqIDs = str_replace(array('(',')',"'"), '',$seqIDs);
    $file2 = fastamultiplegen($seqIDs,$seqs,$genes,$species);

    //Load method of choice
    $Method = $_POST['Method'];

    $_SESSION['file1'] = $filename;

//go through each file in a folder, and run the exe
    if ($Method == "Genpofad") {
        exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Genpofad.R $filename $file2");
    } 

    if ($Method == "Matchstates") {
        exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Matchstates.R $filename $file2");
    } 

    if ($Method == "Daredevil") {
        exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Daredevil.R $filename $file2");
    }

    if ($Method == "Consensus") {
        exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Consensus.R $filename $file2");
    }

    include 'Distance_stuff/Table.php';

  
    unlink("Distance_stuff/output/output$filename");
    unlink("Distance_stuff/output/seqname$filename");
    unlink("../Database/TempFastaFiles/$filename");
    unlink("../Database/TempFastaFiles/$file2");
    unlink("Distance_stuff/output_file/$filename");
    unlink("Distance_stuff/output_file/tempfile$filename");
        
        
}
else{
    header('Location: Calculate.php');
}

}
else{
header('Location: ../index.php');
}
?>