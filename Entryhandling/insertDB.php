<?php session_start();
echo $_SESSION['UploadError'];
session_start();
if(empty($_SESSION['loggedin'])){
    header('Location:../index.php');
}
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form method="POST" action="performins.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Choose a file...</span>
      <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile"></label>
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>

</body>
</html

