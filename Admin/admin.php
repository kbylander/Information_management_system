<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_POST['search']))
{
    $valueToSearch = $_POST['searchvalue'];
    $tableToSearch = $_POST['dbtable']
    if($valueToSearch=="users"){
      $query = "SELECT * FROM users WHERE username LIKE '%".$valueToSearch."%'";
    }elseif($valueToSearch=="entries"){
      $query = "SELECT * FROM entries WHERE entryID LIKE '%".$valueToSearch."%'";
    }else{
      $query = "SELECT * FROM sequence WHERE seqID LIKE '%".$valueToSearch."%'"
    }

    $search_result = filterTable($query);

}
else {
    "SELECT * FROM users WHERE username LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}

function filterTable($query)
{
include '../connectDB.php';
$result = mysqli_query($link, $query);
include '../disconnectDB.php';
return $result;
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
        </body>
        <div class = "content">
          <form action="admin.php" method="POST">
            <input type="text" name="searchvalue" placeholder="Search IDs"/>
            <select name="dbtable">
              <option value="users">Users database</option>
              <option value="entries">Individuals</option>
              <option value="sequence">Sequences</option>
            <input type="submit" value="search"/>
          </form>
          <?php if($tableToSearch == 'users')
          <h1>Users</h1>
          <table id="userTable">
          <tr>
              <th>Username</th>
              <th>Email</th>
              <th>Admin</th>
              <th>Active</th>
          </tr>
          <?php while($row = mysqli_fetch_array($search_result)):?>
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
      </div>
</html>
