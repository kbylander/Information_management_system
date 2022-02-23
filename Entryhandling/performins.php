<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$_SESSION['UploadError'] = '';


//This section will handle file uploads

// get details of the uploaded file
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

if(!empty($fileSize)){
    // Create a new temporary file name. 
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    //Select allowed formats. 
    $allowedfileExtensions = array('txt', 'fasta');

    //check to see if uploaded file has correct input format. 
    if (in_array($fileExtension, $allowedfileExtensions))
    {
        //select where to put the file
        $uploadFileDir = '.\uploadedfiles/';
        $dest_path = $uploadFileDir . $newFileName;

    //if upload was succesful, fetch it as a string and then remove it. 
        if(move_uploaded_file($fileTmpPath, $dest_path)) 
        {
            $ffile = file_get_contents($dest_path);
            unlink($dest_path);
        }else
        {
            $_SESSION['UploadError'] = $_SESSION['UploadError'] . '<br>' . 'File could not be moved to correct destination';
        }
    }else {
        $_SESSION['UploadError'] = $_SESSION['UploadError'] . '<br>' . 'Only .fasta fileformats allowed';
    }

    include 'filefastahandler.php';
}

//This section will handle text inputs
if(!empty($_POST['fastatext'])){
    $ftext = $_POST['fastatext'];
    include 'textfastahandler.php';
}
elseif(empty($ftext) && empty($fileSize)){
    $_SESSION['UploadError'] = $_SESSION['UploadError'] . '<br>' . 'Empty submission';
}

//If there was an error, bring it back to the upload page and display the error. 
if (!empty($_SESSION['UploadError'])){
    $_SESSION['UploadError'] ='File Upload Error: ' . $_SESSION['UploadError'];
    header('Location:./insertform.php');
}

include 'fastadivider.php';
print_r($header);
echo '<br><br>';
print_r($seq);
include 'headerhandler.php';

?>

