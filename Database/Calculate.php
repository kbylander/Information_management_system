<?php //Initiating session and making sure the user gets tagged as not logged in.
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
  $query = "SELECT sequence.seqID, sequence.genename, entries.species, entries.entryID, entries.female FROM sequence LEFT JOIN entries ON sequence.entryID = entries.entryID WHERE addedby LIKE '$userID'";
  include '../connectDB.php';
  $result = mysqli_query($link, $query);
  include '../disconnectDB.php';
  }
?>
<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
</style>
    <head>
        <title>Welcome to Genetic Match.com</title>
        <link rel="stylesheet" href="style_calculate.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <img src="../wolf_icon.png" class="logo">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="databasemenu.php">Database</a></li>
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
            <div class="input">
            <h1 id= "A1"> Option 1: Insert two sequences to compare </h1>
                <h2>Choose your algorithm:</h2>
                <form action="../Algorithms/upload.php" method="POST">
                    <select name="Method" id="Method">
                    <option value="Genpofad">Genpofad</option>
                    <option value="Matchstates">Matchstates</option>
                    <option value="Daredevil">Daredevil</option>
                    <option value="Consensus">Consensus score</option>
                    </select>
                    <input type="submit" name="submit" value ="Calculate genetic distance">

                    <div class="sequence">
                    <div>
                        <h3 id= "A1"> Sequence 1 </h3>
                        <textarea name="fastasequence1" cols="80" rows="8" 
                        placeholder ="Enter nucleotide sequence in FASTA format here"></textarea>
                    </div>
                    <div>
                        <h3 id= "A1"> Sequence 2 </h3>
                        <textarea name="fastasequence2" cols="80" rows="8" 
                        placeholder ="Enter nucleotide sequence in FASTA format here"></textarea>
                    </div>
               
            </div>
            
                </form>
                <div class="option2">
                    <h1 id= "A2"> Option 2: Select two sequences from db to compare </h1>
                    <div class="search">
                    <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search in database">
                    <form action="preparecomparation.php" method="post">
                    <table id="entryTable">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Gene name</th>
                        <th>Species</th>
                        <th>Individual ID</th>
                        <th>Gender</th>
                    </tr>
                    <!--</table>-->
                    <!-- populate table from mysql database -->
                    <!--<table id="entryTable"> -->
                        <?php while($row = mysqli_fetch_array($result)):?>
                        <?php foreach($row as $value){
                            //Print the element out.
                            echo $value, '<br>';
                        }?>
                        <tr>
                            <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>"></td>
                            <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[2];?></td>
                            <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php echo $row[3];?></td>
                            <td><?php if(is_null($row[4])){echo "Unknown";}
                            elseif ($row[4]){echo "Female";}
                            else{echo "male";}?></td>
                        </tr>
                            <?php endwhile;?>
                        </table>
                    <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search in database">
                    <table id="entryTable">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Gene name</th>
                        <th>Species</th>
                        <th>Individual ID</th>
                        <th>Gender</th>
                    </tr>
                    <?php echo 'holi'?>
                    <!--</table>-->
                    <!-- populate table from mysql database -->
                    <!--<table id="entryTable"> -->
                        <?php while($row = mysqli_fetch_array($result)):?>
                        <tr>
                            <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>"></td>
                            <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[2];?></td>
                            <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php echo $row[3];?></td>
                            <td><?php if(is_null($row[4])){echo "Unknown";}
                            elseif ($row[4]){echo "Female";}
                            else{echo "male";}?></td>
                        </tr>
                            <?php endwhile;?>
                        </table>
                        <?php echo 'holi'?>
                        <input type="submit" name="comparation" value="CALCULATE"/>

                        </form>
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