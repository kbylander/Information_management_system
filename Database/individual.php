<?php
session_start();

//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
  header('Location: ../index.php');
}
else{
$individualID = $_GET['ID'];
$query = "SELECT seqID, genename FROM sequence WHERE entryID LIKE '$individualID'";
$query2 = "SELECT female, addedby, species, private, date FROM entries WHERE entryID LIKE '$individualID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
$result2 = mysqli_query($link, $query2);
include '../disconnectDB.php';

while($row2 = mysqli_fetch_array($result2)) {
  $gender = $row2['female'];
  $addedby = $row2['addedby'];
  $species = $row2['species'];
  $private = $row2['private'];
  $date = $row2['date'];
  }
}
if($addedby == $_SESSION['user']){
?>

<!DOCTYPE html>
<html>
<body>
  <h1>Sequences uploaded for <?php echo $individualID ?></h1>
  <p><?php echo "$species, ";
  if(!isset($gender)){
    echo "gender unknown";
  }elseif($gender){
    echo "female";
  }else{
    echo "male";
  }?></p>
  <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search among sequences">
    <table id="entryTable">
        <tr>
            <th>ID</th>
            <th>Gene</th>
        </tr>

<!-- populate table from mysql database -->
    <?php while($row = mysqli_fetch_array($result)):?>
      <tr>
        <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
      </tr>
        <?php endwhile;?>
      </table>
<p>Added by: <?php echo "$addedby, $date"?></p>

<button onclick="window.location.href='individualsDB.php'">BACK TO ALL INDIVIDUALS</button>

<!-- Script to real time filter the able -->
<script>
function searchFunction() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("entryTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>
</body>
</html>
<?php }else{
  header("location:individualsDB.php");
} ?>
