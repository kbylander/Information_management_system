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
$query = "SELECT sequence.seqID, sequence.genename, sequence.seq, sequence.entryID, entries.female, entries.addedby, entries.species, sequence.private FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE seqID LIKE '$seqID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB.php';
}
?>

<!DOCTYPE html>
<html>
<body>
  <link rel="stylesheet" href="style_sequence.css">
  <div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="DbInfo.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                </ul>
            </div>
  </div>

  <div class = "context">
  <h1>Sequence <?php echo $seqID ?></h1>
    <div class="box">
    <?php while($row = mysqli_fetch_array($result)):?>
    <?php if($_SESSION['user'] != $row[5] && $row[7] == 1){header('Location: sequencesDB.php');} //Check to see if person has access to this sequence?>
    <p>Gene, <?php echo $row[1];?></p> <!-- echos and prints genename -->
    <p>Sequenced from, <a href="individual.php?ID=<?php echo $row[3];?>"><?php echo $row[3];?></a>, <?php echo $row[6];?>, <!-- links to the individual aswell as prints the ID -->
    <?php if(is_null($row[1])){echo "Unknown";} //Checks what gender should be printed
    elseif ($row[1]){echo "Female";}
    else{echo "male";}?></p>
    <p>Sequence,<br> <?php echo $row[2];?></p> <!-- prints the sequence -->
    <p>Length, <?php echo strlen($row[2]);?> bp</p> <!-- calculates and prints the sequence length-->
    <p>Added by, <?php echo $row[5];?>, URL is: <?php if($row[7]){echo "private";}else{echo "shareable";}?></p> <!-- prints the user who uploaded the sequence and if set to private or not -->
    <?php $addedby = $row[5]; //Specifies who added the seqence
    $access = $row[7]; //Defines if private or not
    endwhile;?>

<p><a href="download.php?file=<?php echo $seqID?>">Download fasta file</a>
  <?php if($addedby == $_SESSION['user']){ ?> | <a href="delete.php?seqID=<?php echo $seqID?>">Delete sequence</a>
<?php if($access){?> | <a href="privacy.php?seqID=<?php echo $seqID?>">Make shareable</a>
<?php }else{ ?> | <a href="privacy.php?seqID=<?php echo $seqID?>">Make private</a><?php } } ?></p>

<p><button onclick="window.location.href='sequencesDB.php'">BACK TO ALL SEQUENCES</button></p>
    </div> 
  </div>
</body>
</html>
