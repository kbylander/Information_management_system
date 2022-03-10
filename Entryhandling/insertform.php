<?php session_start();
//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = False;
  }
  if ($_SESSION['loggedin'] == False) {
    header('Location: ../index.php');
  }
?>

<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
<link rel="stylesheet" href="style__entry.css">
    <title>Insert Sequences to Database</title>
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
                    <li><a href="../Registration/userprofile.php">Profile</a></li>
                    <li><a href="../Login/sessiondestroy.php">Log Out</a></li>
                </ul>
            </div>

            <main>
<div class="header">
<h1>INSERT YOUR SEQUENCES</h1>
<?PHP if(isset($_SESSION['HeaderError'])): ?>
<p> <?php echo $_SESSION['HeaderError'] ?> </p>
<?PHP $_SESSION['HeaderError'] = ''; ?> </p>
</div>
<?php endif; ?>

<div class="upload">
<form method="POST" action="performins.php" enctype="multipart/form-data">
<div class="sequence">
    <textarea name="fastatext" cols="80" rows="8" 
    placeholder ="Enter nucleotide sequence in FASTA format here" style="color:black"></textarea>
</div>
    <br>
    <input type="file" id="fileup" name="uploadedFile" ></label>
    <input type="submit" id=submit name="Upload" value="UPLOAD"/>
</form>
</div>
<div id="footer">
  <p>Required header format: >Individual identifier| gene=genename os=speciesname gender=male/female (voluntary)</p>
</div>
</main>
</body>
</html

