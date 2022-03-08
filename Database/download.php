<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//From sequence.php
if(isset($_GET['file']) && $_SESSION['loggedin']){
  $seqID = $_GET['file'];

  $query = "SELECT sequence.genename, sequence.seq, entries.species, entries.entryID FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID LIKE '$seqID'";
  include '../connectDB.php';
  $result = mysqli_query($link, $query);
  include '../disconnectDB.php';

  while($row = mysqli_fetch_array($result)):
  $gene = $row[0];
  $seq = $row[1];
  $species = $row[2];
  $entryID=explode('_',$row[3]);
  $entryID_short = $entryID[0];
  endwhile;

  require 'fastafilegenerator.php';
  $file = fastagensingle("$entryID_short".'|'."$seqID",$seq,$gene,$species);

  ignore_user_abort(true);
  header('Content-Description: File Transfer');
  header('Content-Disposition: attachment; filename='.basename($file));
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize("TempFastaFiles/" . $file));
  header("Content-Type: text/plain");
  readfile("TempFastaFiles/" . $file);

  unlink("TempFastaFiles/" . $file);
}
//Multiple sequences, from sequences.DB
elseif(isset($_POST['submit_multiple'])){ //Check if "submit" is empty aswell
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $seqIDs = "('".join("','",$selected)."')";
    $query = "SELECT sequence.genename, sequence.seq, entries.species, entries.entryID FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID IN $seqIDs";
    include '../connectDB.php';
    $result = mysqli_query($link, $query);
    include '../disconnectDB.php';

    $genes = array();
    $seqs = array();
    $species = array();
    $entryIDs_short = array();

    while($row = mysqli_fetch_array($result)):
      array_push($genes, $row[0]);
      array_push($seqs, $row[1]);
      array_push($species, $row[2]);
      $entryID=explode('_',$row[3]);
      array_push($entryIDs_short, $entryID[0]);
    endwhile;

    $seqIDs = explode(",",$seqIDs);
    $seqIDs = str_replace(array('(',')',"'"), '',$seqIDs);
    for ($i = 0; $i < count($seqs); $i++)  {
      $seqIDs[$i] = "$entryIDs_short[$i]".'|'."$seqIDs[$i]";
    }
    require 'fastafilegenerator.php';
    $file = fastamultiplegen($seqIDs,$seqs,$genes,$species);

    ignore_user_abort(true);
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("TempFastaFiles/" . $file));
    header("Content-Type: text/plain");
    readfile("TempFastaFiles/" . $file);

    unlink("TempFastaFiles/" . $file);
  }
  else{
    header('Location: sequencesDB.php');
  }

}
else{
  header('Location: ../index.php');
}
?>
