<?php session_start();
echo $_SESSION['UploadError'];
session_start();
if(empty($_SESSION['loggedin'])){
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
<!--<link rel="stylesheet" href="style__entry.css">-->
    <title>Insert Sequences to Database</title>
</head>
<body>
<div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="../Database/databasemenu.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                </ul>
            </div>

<main>
<div class="upload">
<h1>INSERT YOUR SEQUENCES</h1>
<br>
<form method="POST" action="performins.php" enctype="multipart/form-data">
      <span class="file-name"> </span>
      <label class="file-upload">File upload fasta here<input type="file" id="file-upload" name="uploadedFile"></label>
    <br>
    <br>
    <input type="text", id=searchInput class="input-box" placeholder="Paste fasta texts here" name="fastatext" >
    <br>
    <input type="submit" name="Upload" value="UPLOAD", id=uploadbutton />
</form>
</div>
<p> preferred header format: >Individual identifier | gene= genename os= speciesname = male/female (voluntary) </p>
</main>
</body>
</html

