<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_POST['search']))
{
    $valueToSearch = $_POST['searchvalue'];
    $tableToSearch = $_POST['dbtable'];
    if($tableToSearch=="users"){
      if($valueToSearch == ''){
        $query = "SELECT * FROM users WHERE username LIKE '%".$valueToSearch."%' LIMIT 5";
      }else{
        $query = "SELECT * FROM users WHERE username LIKE '%".$valueToSearch."%'";
      }
    }elseif($tableToSearch=="entries"){
      if($valueToSearch == ''){
        $query = "SELECT * FROM entries WHERE entryID LIKE '%".$valueToSearch."%' OR addedby LIKE '%".$valueToSearch."%' LIMIT 5";
      }else{
        $query = "SELECT * FROM entries WHERE entryID LIKE '%".$valueToSearch."%' OR addedby LIKE '%".$valueToSearch."%'";
      }
    }else{
      if($valueToSearch == ''){
        $query = "SELECT * FROM sequence WHERE seqID LIKE '%".$valueToSearch."%' OR entryID LIKE '%".$valueToSearch."%' OR seqaddedby LIKE '%".$valueToSearch."%' LIMIT 5";
      }else{
        $query = "SELECT * FROM sequence WHERE seqID LIKE '%".$valueToSearch."%' OR entryID LIKE '%".$valueToSearch."%' OR seqaddedby LIKE '%".$valueToSearch."%'";
      }
    }

    $search_result = filterTable($query);

}
else {
    $tableToSearch = FALSE;
    $query = "SELECT * FROM users LIMIT 5";
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
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
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
                <option value="users" <?php if(!isset($tableToSearch) || $tableToSearch == 'users'){echo("selected");}?>>Users</option>
                <option value="entries" <?php if($tableToSearch == 'entries'){echo("selected");}?>>Individuals</option>
                <option value="sequence" <?php if($tableToSearch == 'sequence'){echo("selected");}?>>Sequences</option>
              </select>
              <input type="submit" name="search" value="search"/>
            </form>
            <?php if(!($tableToSearch) || $tableToSearch == 'users'){?>
            <h1>Users</h1>
            <table class="content-table" id="userTable">
              <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Active</th>
                </tr>
              </thead>
              <form action="admindelete.php" method="post">
              <tbody>
              <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                  <td><input type="checkbox" name="selected[]" value="<?php echo $row[0]?>"></td>
                  <td><?php echo $row[0];?></td>
                  <td><?php echo $row[2];?></td>
                  <td><?php if($row[3]){echo "Yes";}else{echo "No";};?></td>
                  <td><?php if($row[4]){echo "Yes";}else{echo "No";};?></td>
                </tr>
                  <?php endwhile;?>
              </tbody>
              </table>
              <input type="submit" name="submit_users" value="Inactivate users"/>
              <?php } ?>

            <?php if($tableToSearch == 'entries'){?>
                <h1>Individuals</h1>
                <table class="content-table" id="userTable">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gender</th>
                        <th>Added by</th>
                        <th>Species</th>
                        <th>Private</th>
                        <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = mysqli_fetch_array($search_result)):?>
                    <tr>
                      <td><a href="../Database/individual.php?ID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                      <td><?php if($row[1]){echo "Female";}elseif(!isset($row[1])){echo "Unknown";}else{echo "Male";};?></td>
                      <td><?php echo $row[2];?></td>
                      <td><?php echo $row[3];?></td>
                      <td><?php if($row[4]){echo "Yes";}else{echo "No";};?></td>
                      <td><?php echo $row[5];?></td>
                    </tr>
                      <?php endwhile;?>
                  </tbody>
                  </table> <?php } ?>

                <?php if($tableToSearch == 'sequence'){?>
                    <h1>Users</h1>
                    <table class="content-table" id="userTable">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gene</th>
                            <th>Entry ID</th>
                            <th>Added by</th>
                            <th>Private</th>
                            <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php while($row = mysqli_fetch_array($search_result)):?>
                        <tr>
                          <td><a href="../Database/sequence.php?seqID=<?php echo $row[0] ?>"><?php echo $row[0];?></td>
                          <td><?php echo $row[1];?></td>
                          <td><a href="../Database/individual.php?ID=<?php echo $row[2] ?>"><?php echo $row[2];?></td>
                          <td><?php echo $row[4];?></td>
                          <td><?php if($row[5]){echo "Yes";}else{echo "No";};?></td>
                          <td><?php echo $row[6];?></td>
                        </tr>
                          <?php endwhile;?>
                      </tbody>
                    </table> <?php } ?>
            <br>
      </div>
</html>
