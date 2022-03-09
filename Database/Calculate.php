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
  $result2 = mysqli_query($link,$query);
  $result3 = mysqli_query($link,$query);
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
    <link rel="stylesheet" href="test.css">
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
        </div>


<div class="tab">
    <button class="tablinks" onclick="opentab(event, 'input')" id="defaultOpen">PASTE to PASTE</button>
    <button class="tablinks" onclick="opentab(event, 'option2')">FILE to FILE</button>
    <button class="tablinks" onclick="opentab(event, 'option3')">PASTE to FILE</button>
</div>
<!-- Tab content -->
<div id="input" class="tabcontent">
  <h1 id= "A1"> Insert two sequences to compare </h1>
    <h2>Choose your algorithm:</h2>
    <form action="../Algorithms/upload.php" method="POST">
        <select name="Method" id="Method">
        <option value="Genpofad" style="color:black">Genpofad</option>
        <option value="Matchstates" style="color:black">Matchstates</option>
        <option value="Daredevil" style="color:black">Daredevil</option>
        <option value="Consensus" style="color:black">Consensus score</option>
        </select>
        <input type="submit" name="submit" value ="Calculate genetic distance">
        <div class="sequence">
            <div>
                <h3 id= "A1"> Focal sequence </h3>
                <textarea name="fastasequence1" cols="80" rows="8" 
                placeholder ="Enter nucleotide sequence in FASTA format here" style="color:black"></textarea>
            </div>
            <div>
                <h3 id= "A1"> Compared sequences </h3>
                <textarea name="fastasequence2" cols="80" rows="8" 
                placeholder ="Enter nucleotide sequence in FASTA format here" style="color:black"></textarea>
            </div>
        </div>
    </form>
</div>

<div id="option3" class="tabcontent">
    <h1 id= "A2"> Insert one sequence and compare with db </h1>
    <h2>Choose your algorithm:</h2>
    <form action="preparecomparation2.php" method="POST">
        <select name="Method" id="Method">
        <option value="Genpofad" style="color:black">Genpofad</option>
        <option value="Matchstates" style="color:black">Matchstates</option>
        <option value="Daredevil" style="color:black">Daredevil</option>
        <option value="Consensus" style="color:black">Consensus score</option>
        <input type="submit" name="comparation" value="CALCULATE"/>
        </select><br>
        <div>
            <h3 id= "A1"> Focal sequence </h3>
            <textarea name="fastasequence1" cols="80" rows="8" 
            placeholder ="Enter nucleotide sequence in FASTA format here" style="color:black"></textarea>
        </div><br><br>
        <input type="text" class="searchInput" onkeyup="searchFunction3()" placeholder="Search in database">
        <table id="entryTable3" class="scrolltable">
            <thead><tr>
            <th style="width:16%"></th>
                <th>ID</th>
                <th>Gene name</th>
                <th>Species</th>
                <th>Individual ID</th>
                <th>Gender</th>
            </thead></tr>
    <!--</table>-->
    <!-- populate table from mysql database -->
    <!--<table id="entryTable"> -->
            <tbody>
            <?php while($row = mysqli_fetch_array($result3)):?>
            <tr>
                <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>" style="width:20%"></td>
                <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php $name=explode('_',$row[3]); echo $name[0];?></td>
                <td><?php if(is_null($row[4])){echo "Unknown";}
                elseif ($row[4]){echo "Female";}
                else{echo "male";}?></td>
            </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </form>
</div>
<div id="option2" class="tabcontent">
                    <h1 id= "A2"> Select two sequences from db to compare </h1>
                    <div class="search">
                    <h2>Choose your algorithm:</h2>
                    <form action="preparecomparation.php" method="POST">
                    <select name="Method" id="Method">
                    <option value="Genpofad" style="color:black">Genpofad</option>
                    <option value="Matchstates" style="color:black">Matchstates</option>
                    <option value="Daredevil" style="color:black">Daredevil</option>
                    <option value="Consensus" style="color:black">Consensus score</option>
                    <input type="submit" name="comparation" value="CALCULATE"/>
                    </select><br>
                    <input type="text" class="searchInput" onkeyup="searchFunction()" placeholder="Search in database">
                    <table id="entryTable" class="scrolltable">
                    <thead><tr>
                    <th style="width:16%"></th>
                        <th>ID</th>
                        <th>Gene name</th>
                        <th>Species</th>
                        <th>Individual ID</th>
                        <th>Gender</th>
                    </thead></tr>
                    <!--</table>-->
                    <!-- populate table from mysql database -->
                    <!--<table id="entryTable"> -->
                        <tbody>
                        <?php while($row = mysqli_fetch_array($result)):?>
                        <tr>
                            <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>" style="width:20%"></td>
                            <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[2];?></td>
                            <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php $name=explode('_',$row[3]); echo $name[0];?></td>
                            <td><?php if(is_null($row[4])){echo "Unknown";}
                            elseif ($row[4]){echo "Female";}
                            else{echo "male";}?></td>
                        </tr>
                         <?php endwhile;?>
                        </tbody></table>
                    <input type="text" class="searchInput" onkeyup="searchFunction2()" placeholder="Search in database">
                    <table id="entryTable2" class="scrolltable">
                    <thead><tr>
                    <th style="width:16%"></th>
                        <th>ID</th>
                        <th>Gene name</th>
                        <th>Species</th>
                        <th>Individual ID</th>
                        <th>Gender</th>
                    </thead></tr>
                    <!--</table>-->
                    <!-- populate table from mysql database -->
                    <!--<table id="entryTable"> -->
                        <tbody>
                        <?php while($row = mysqli_fetch_array($result2)):?>
                        <tr>
                            <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>" style="width:20%"></td>
                            <td><a href="sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[2];?></td>
                            <td><a href="individual.php?ID=<?php echo $row[3] ?>"><?php $name=explode('_',$row[3]); echo $name[0]; ?></td>
                            <td><?php if(is_null($row[4])){echo "Unknown";}
                            elseif ($row[4]){echo "Female";}
                            else{echo "male";}?></td>
                        </tr>
                            <?php endwhile;?>
                        </tbody></table>
                        </form>
                        </div>
                    </div>
                    <br>

</body>


<script>
    // creates active class, specifying what tab is active and hides the other.  
function opentab(evt, option) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(option).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>

<script>
//Selects a default active tab. 
document.getElementById("defaultOpen").click();
</script>

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

function searchFunction2() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("searchInput2");
    filter = input.value.toUpperCase();
    table = document.getElementById("entryTable2");
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

function searchFunction3() {
    var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("searchInput3");
    filter = input.value.toUpperCase();
    table = document.getElementById("entryTable3");
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



