<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$iferror=0;
$_SESSION['UploadError'] = '';

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('txt', 'fasta');
 
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = 'C:\MAMP\htdocs\ims_daredevil\IMS-Daredevil\Entryhandling\uploadedfiles/';
      $dest_path = $uploadFileDir . $newFileName;
 
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
    echo 'very najs';
    echo $fileExtension;
    }else
      {
        $iferror = true;
        echo 'fel';
    }
    }
    else
    {
        $iferror = 1;
    
    }
  }
  else
  {
    $iferror = 1;
}
}

if ($iferror==1){
    $_SESSION['UploadError'] = $_SESSION['UploadError'] . 'File Upload Error: Only fasta formats allowed.';
    header('Location:./insertDB.php');

}

$ffile = file_get_contents($dest_path);
echo $ffile;
unlink($dest_path);

?>

