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
//$query = "SELECT seqID, genename, seq, entryID FROM sequence WHERE seqID LIKE '$seqID'";
$query = "SELECT sequence.seqID, sequence.genename, sequence.seq, sequence.entryID, entries.gender, entries.addedby, entries.species FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID LIKE '$seqID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB';
}
?>

<!DOCTYPE html>
<html>
<body>
  <h1>Sequence <?php echo $seqID ?></h1>

    <?php while($row = mysqli_fetch_array($result)):?>
    <?php if($_SESSION['user'] != $row[5]){header('Location: ../index.php');} //Check to see if person has access to this sequence?>
    <p>Gene, <?php echo $row[1];?></p>
    <p>Sequenced from, <a href="individual.php?ID=<?php echo $row[3];?>"><?php echo $row[3];?></a>, <?php echo $row[6];?>,
    <?php if(isset($row[4])){echo $row[4];}
    else{echo 'gender unknown';}
    ?></p>
    <p>Sequence,<br> <?php echo $row[2];?></p>
    <p>Length, <?php echo strlen($row[2]);?> bp</p>
    <p>Added by, <?php echo $row[5];?></p>
    <?php endwhile;?>

<p><a href="download.php?file=<?php echo $seqID?>">Download fasta file</a></p>

<button onclick="window.location.href='sequencesDB.php'">BACK TO ALL SEQUENCES</button>

</body>
</html>
