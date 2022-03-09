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
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
</style>
<head>
    <title>USER PROFILE</title>
    <link rel="stylesheet" href="styleprofile.css">
</head>
    <body>
        <div class="banner">
            <div class="navbar">
                <img src="../wolf_icon.png" class="logo">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <li><a href="../Database/databasemenu.php">Database</a></li>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                    <li><a href="../Registration/userprofile.php">Profile</a></li>
                    <li><a href="../Login/sessiondestroy.php">Log Out</a></li>
                </ul>
            </div>

          <div class="user-profile">
          <h1> User profile </h1>
          <div class="change-pw">
            <h2>Change Password </h2>
            <form action="changepwd.php" method="POST">
              <input type="password" class="input-box" placeholder="New Password" name="passw" required/>
              <input type="password" class="input-box" placeholder="Confirm Password" name="confirmpassword" required/>
              <input type="submit" id=submit name="Upload" value="Submit Changes"/>
            </form>
            <div class='form-errors'>
            <?php echo $_SESSION['RegistrationErrors']; 
            $_SESSION['RegistrationErrors'] = '';?>
            </div>
          </div>
          <div class="change-email">
          <h2>Change email </h2>
            <form action="changeemail.php" method="POST">
              <input type="text" class="input-box" placeholder="Enter old email" name="oldemail" required>
              <input type="text" class="input-box" placeholder="Enter new email" name="email" required>
              <input type="submit" id=submit name="Upload" value="Submit Changes"/>

            </form>
            <div class='form-errors'>
            <?php echo $_SESSION['RegistrationErrors']; 
            $_SESSION['RegistrationErrors'] = '';?>
            </div>
          </div>
          <hr>
          <div class="delete-user">
          <h2>Do you want to delete your account? </h2>
          <form action="deleteuser.php" method="POST">
              <select name="delete" id="delete">
              <option value="Yes" style="color:black">Yes</option>
              <option value="No" style="color:black">No</option>
              </select>
              <input type="submit" id=submit1 name="Upload" value="Submit Changes"/>
          </div>
          </div>
</body>
</html>