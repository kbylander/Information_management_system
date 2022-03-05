<?php
session_start();

if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
  header('Location: ../index.php');
}
else{
  $gender = $_POST["gender"];
  $indID = $_POST["indID"];

  if($gender=="F"){
    $query = "UPDATE entries SET female = 1 WHERE entryID LIKE '$indID'";
  }elseif($gender=="M"){
    $query = "UPDATE entries SET female = 0 WHERE entryID LIKE '$indID'";
  }else{
    $query = "UPDATE entries SET female = NULL WHERE entryID LIKE '$indID'";
  }

  include '../connectDB.php';
  $result = mysqli_query($link, $query);
  include '../disconnectDB.php';
  //After deletion, return user to all sequences
  header("Location: individual.php?ID=$indID");
}


 ?>
