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
      <span class="file-name"> </span>
      <label for="file-upload"> <input type="file" id="file-upload" name="uploadedFile"></label>
    </div>
    <input type="text" class="input-box" placeholder="Paste fasta files here" name="fastatext" >

 
    <input type="submit" name="Upload" value="Upload" />
  </form>

</body>
</html

