<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if(empty($_SESSION['loggedin'])){
    header('Location:../index.php');
}

$iferror=0;
$_SESSION['UploadError'] = '';

// get details of the uploaded file
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$_SESSION['type']=$_SESSION['type'] . $fileType;

// sanitize file-name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

// check if file has one of the following extensions
$allowedfileExtensions = array('txt', 'fasta');

if (in_array($fileExtension, $allowedfileExtensions))
{
    // directory in which the uploaded file will be moved
    $uploadFileDir = '.\uploadedfiles/';
    $dest_path = $uploadFileDir . $newFileName;

    if(move_uploaded_file($fileTmpPath, $dest_path)) 
    {
        $ffile = file_get_contents($dest_path);
        echo $ffile;
        unlink($dest_path);
    }else
    {
        $_SESSION['UploadError'] = $_SESSION['UploadError'] . '<br>' . 'File could not be moved to correct destination';
    }
}else {
    $_SESSION['UploadError'] = $_SESSION['UploadError'] . '<br>' . 'Only .fasta fileformats allowed';
}



if (!empty($_SESSION['UploadError'])){
    $_SESSION['UploadError'] ='File Upload Error: ' . $_SESSION['UploadError'];
    header('Location:./insertDB.php');
}

?>

