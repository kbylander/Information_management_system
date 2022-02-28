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
$query = "SELECT sequence.seqID, sequence.genename, entries.species, entries.entryID, entries.gender FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE addedby LIKE '$userID'";
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB.php';
}
?>

<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
  <head>
    <link rel="stylesheet" href="individ2.css">
  </head>
  <body>
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

            <div class="LanguageToggle">
                    <div class="GoogleTranslate">
                        <div id="google_translate_element" style="text:right;"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,en,es,it,ja,pt,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                        }
                        </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
            </div>
            <div class="search">
            <h1>Sequences in database</h1>
            <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search in database">
            <table id="entryTable">
          <tr>
              <th>ID</th>
              <th>Gene name</th>
              <th>Species</th>
              <th>Individual ID</th>
              <th>Gender</th>
          </tr>
    <!--</table>-->
    <form action="download.php" method="post">
<!-- populate table from mysql database -->
  <!--<table id="entryTable"> -->
    <?php while($row = mysqli_fetch_array($result)):?>
      <tr>
        <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>"></td>
        <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
        <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php echo $row[3];?></td>
        <td><?php echo $row[4];?></td>
      </tr>
        <?php endwhile;?>
      </table>

<input type="submit" name="submit_multiple" value="DOWNLOAD SELECTED FASTA"/>
<button onclick="window.location.href='individualsDB.php'"><span></span>ALL INDIVIDUALS</button>
<button onclick="window.location.href='../Entryhandling/insertform.php'"><span></span>UPLOAD</button>
  </div>
</div>


<!-- Script to real time filter the table -->
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
