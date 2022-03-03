<?php
session_start();
//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
  header('Location: ../index.php');
}
else{ //If permited to be on this site
$seqID = $_GET['seqID']; //Define variable from clicked link on page before, used in SQL query
$query = "SELECT entries.addedby FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID LIKE '$seqID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB.php';

  while($row = mysqli_fetch_array($result)){
    $addedby = $row[0];
    echo $addedby;
  }
  //Control if the user should be able to delete this sequence
  if($addedby != $_SESSION['user']){
    header('Location: sequencesDB.php');
  } else {
    //The user have access and will delete the seq
    $query = "DELETE FROM sequence WHERE seqID LIKE '$seqID'";
    include '../connectDB.php';
    $result = mysqli_query($link, $query);
    include '../disconnectDB.php';
    //After deletion, return user to all sequences
    header('Location: sequencesDB.php');
  }
}
?>
