<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
  header("location:../index.php");
}

$userquery = "SELECT * FROM users LIMIT 5";
$seqquery = "SELECT seqID,genename,entryID,private,date FROM sequence LIMIT 5";
$indquery = "SELECT * FROM entries LIMIT 5";

include '../connectDB.php';
$userresult = mysqli_query($link, $userquery);
$seqresult = mysqli_query($link, $seqquery);
$indresult = mysqli_query($link, $indquery);
include '../disconnectDB.php';
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
        <title>Admin</title>
        <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <li><a href="../Database/databasemenu.php">Database</a></li>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                </ul>
            </div>
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
        <h1>Users</h1>
        <form action="admin.php" method="POST">
          <input type="text" name="searchvalue" placeholder="Search username"/>
          <input type='hidden' name='searchtype' value='usr'/>
          <input type="submit" value="search"/>
        </form>
        <table id="userTable">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Active</th>
        </tr>
        <?php while($row = mysqli_fetch_array($userresult)):?>
          <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[4];?></td>
          </tr>
            <?php endwhile;?>
          </table>

          <br>
          <h1>Individuals</h1>
          <form action="admin.php" method="POST">
            <input type="text" name="searchvalue" placeholder="Search entry ID"/>
            <input type='hidden' name='searchtype' value='ind'/>
            <input type="submit" value="search"/>
          </form>
          <table id="indTable">
          <tr>
              <th>Individual</th>
              <th>Gender</th>
              <th>Addedby</th>
              <th>Species</th>
              <th>Private</th>
              <th>Date</th>
          </tr>
          <?php while($row = mysqli_fetch_array($indresult)):?>
            <tr>
              <td><?php echo $row[0];?></td>
              <td><?php echo $row[1];?></td>
              <td><?php echo $row[2];?></td>
              <td><?php echo $row[3];?></td>
              <td><?php echo $row[4];?></td>
              <td><?php echo $row[5];?></td>
            </tr>
              <?php endwhile;?>
            </table>

            <br>
            <h1>Sequences</h1>
            <form action="admin.php" method="POST">
              <input type="text" name="searchvalue" placeholder="Search sequence ID"/>
              <input type='hidden' name='searchtype' value='seq'/>
              <input type="submit" value="search"/>
            </form>
            <table id="indTable">
            <tr>
                <th>Sequence ID</th>
                <th>Gene</th>
                <th>Individual</th>
                <th>Private</th>
                <th>Date</th>
            </tr>
            <?php while($row = mysqli_fetch_array($seqresult)):?>
              <tr>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
              </tr>
                <?php endwhile;?>
              </table>
      </body>
</html>
