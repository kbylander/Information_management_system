<?php
session_start();
if(isset($_GET['file']) && $_SESSION['loggedin']){
$seqID = $_GET['file'];

$query = "SELECT sequence.genename, sequence.seq, entries.species FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID LIKE '$seqID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB';

while($row = mysqli_fetch_array($result)):
$gene = $row[0];
$seq = $row[1];
$species = $row[2];
endwhile;

require 'fastafilegenerator.php';
$file = fastagensingle($seqID,$seq,$gene,$species);

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
header('Location: ../index.php');
}
?>
