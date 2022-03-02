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
    $seqIDs = implode("", $seqIDs);
    require 'fastafilegenerator.php';
    $file1 = fastagensingle($seqIDs,$seqs,$genes,$species);
    
  }
  else{
    header('Location: Calculate.php');
  }

}
else{
  header('Location: ../index.php');
}
?>
