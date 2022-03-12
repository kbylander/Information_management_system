<?php
session_start();

if(isset($_POST['comparation'])){ //Check if "submit" is empty
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $firstgene = array_shift($selected);
    $seqIDs = "('".join("','",$selected)."')";
    $query1 = "SELECT sequence.genename, sequence.seq, entries.species FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID = '$firstgene'";
    include '../connectDB.php';
    $result1 = mysqli_query($link, $query1);
    include '../disconnectDB.php';
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
    #first sequence
    require 'fastafilegenerator.php';
    $row1 = mysqli_fetch_array($result1);
    $file1 = fastagensingle($firstgene, $row1[1],$row1[0],$row1[2]);
    #rest of sequences
    $file2 = fastamultiplegen($seqIDs,$seqs,$genes,$species);

    //Load method of choice
    $Method = $_POST['Method'];

    $_SESSION['file1'] = $file1;


//go through each file in a folder, and run the exe

if ($Method == "Genpofad") {
    exec('unset DYLD_LIBRARY_PATH ;');
    putenv('DYLD_LIBRARY_PATH');
    putenv('DYLD_LIBRARY_PATH=/usr/bin');
    exec("C:/xampp/R/R-4.1.2/bin/Rscript.exe Distance_stuff/Genpofad.R $file1 $file2");
} 

if ($Method == "Matchstates") {
    exec('unset DYLD_LIBRARY_PATH ;');
    putenv('DYLD_LIBRARY_PATH');
    putenv('DYLD_LIBRARY_PATH=/usr/bin');
    exec("C:/xampp/R/R-4.1.2/bin/Rscript.exe Distance_stuff/Matchstates.R $file1 $file2");
} 

if ($Method == "Daredevil") {
    exec('unset DYLD_LIBRARY_PATH ;');
    putenv('DYLD_LIBRARY_PATH');
    putenv('DYLD_LIBRARY_PATH=/usr/bin');
    exec("C:/xampp/R/R-4.1.2/bin/Rscript.exe Distance_stuff/Daredevil.R $file1 $file2");
}

if ($Method == "Consensus") {
    exec('unset DYLD_LIBRARY_PATH ;');
    putenv('DYLD_LIBRARY_PATH');
    putenv('DYLD_LIBRARY_PATH=/usr/bin');
    exec("C:/xampp/R/R-4.1.2/bin/Rscript.exe Distance_stuff/Consensus.R $file1 $file2");
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
