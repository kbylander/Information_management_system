<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['comparation'])){ //Check if "submit" is empty
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

    $seqIDs = explode(",",$seqIDs);
    $seqIDs = str_replace(array('(',')',"'"), '',$seqIDs);
    $seqID1 = $seqIDs[0];
    $seq1 = $seqs[0];
    $gene1 = $genes[0];
    $species1 = $species[0];
    #first sequence
    require 'fastafilegenerator.php';
    $file1 = fastagensingle($seqID1,$seq1,$gene1,$species1);
    #remove first sequence
    array_shift($seqIDs);
    array_shift($seqs);
    array_shift($genes);
    array_shift($species);
    #rest of sequences
    $file2 = fastamultiplegen($seqIDs,$seqs,$genes,$species);

    //Load method of choice
    $Method = $_POST['Method'];

    $_SESSION['file1'] = $file1;


//go through each file in a folder, and run the exe

    if ($Method == "Genpofad") {
        exec("C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Genpofad.R $file1 $file2");
    } 

    if ($Method == "Matchstates") {
        exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Matchstates.R');
    } 

    if ($Method == "Daredevil") {
        exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Daredevil.R');
    }

    if ($Method == "Consensus") {
        exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Distance_stuff/Consensus.R');
    }

    include 'Distance_stuff/Table.php';

    unlink("Distance_stuff/output/output$file1");
    unlink("Distance_stuff/output/seqname$file1");
    unlink("../Database/TempFastaFiles/$file1");
    unlink("../Database/TempFastaFiles/$file2");
    unlink("Distance_stuff/output_file/$file1");
    unlink("Distance_stuff/output_file/tempfile$file1");
        
}
else{
    header('Location: Calculate.php');
}

}
else{
header('Location: ../index.php');
}
?>
