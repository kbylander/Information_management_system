<?PHP
session_start();

//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
  header('Location: ../index.php');
}
//If the user is logged in they will have access to view all sequences
//We therefor create a query to get the data from the database
else{
$userID = $_SESSION['user'];
$query = "SELECT entryID, gender, species, date FROM entries WHERE addedby LIKE '$userID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB';
}
?>

<!DOCTYPE html>
<html>
<body>
  <h1>Individuals in database</h1>
  <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search in database">
    <table id="entryTable">
        <tr>
            <th>ID</th>
            <th>Gender</th>
            <th>Species</th>
            <th>Date added</th>
        </tr>

<!-- populate table from mysql database -->
    <?php while($row = mysqli_fetch_array($result)):?>
      <tr>
        <td><a href="individual.php?ID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
        <td><?php echo $row[3];?></td>
      </tr>
        <?php endwhile;?>
      </table>


<button onclick="window.location.href='Entryhandling/insertDB.php'">New entry</button>

<!-- Script to real time filter the able -->
<script>
function searchFunction() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("entryTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
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
