<!DOCTYPE html>
<html>
<head>
        <title>User Profile</title>
        <link rel="stylesheet" href="styleprofile.css">
    </head>
<?php //Initiating session and making sure the user gets tagged as not logged in.
session_start();
$_SESSION['RegistrationErrors'] = '';
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
.change-pw{
  border: 5px outset rgb(55, 10, 179); 
  background-color: white;
  text-align: center;
}
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
</style>
    <head>
        <title>User Profile</title>
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
          <h1 id= "A1"> User profile </h1>
          <div class="change-pw">
            <h2>Change Password </h2>
            <form action="changepwd.php" method="POST">
              <input type="password" placeholder="New Password" name="passw" required/>
              <input type="password" placeholder="Confirm Password" name="confirmpassword" required/>
              <input type="submit" value="Submit Changes">
            </form>
            <?php echo $_SESSION['RegistrationErrors']; 
            $_SESSION['RegistrationErrors'] = '';?>
          </div>
          <div class="change-email">
          <h2>Change email </h2>
            <form action="changeemail.php" method="POST">
              <input type="text" class="input-box" placeholder="Enter old email" name="oldemail" required>
              <input type="text" class="input-box" placeholder="Enter new email" name="email" required>
              <input type="submit" value="Submit Changes">
            </form>
            <?php echo $_SESSION['RegistrationErrors']; 
            $_SESSION['RegistrationErrors'] = '';?>
          </div>
          <div class="delete-user">
          <h2>Do you want to delete your account? </h2>
          <form action="deleteuser.php" method="POST">
              <select name="delete" id="delete">
              <option value="Yes" style="color:black">Yes</option>
              <option value="No" style="color:black">No</option>
              </select>
              <input type="submit" value ="Submit Changes">
          </div>
          <div class="Log-out">
            <button id = "b7" onclick="location.href = '../Login/sessiondestroy.php';" type="button">Log out</button>
          </div>

</body>
</html>