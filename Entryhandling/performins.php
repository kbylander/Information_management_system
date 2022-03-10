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

if((!empty($fileSize)) && ($fileSize<30000)){
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
            removeUTF8($ffile);
            include 'filefastahandler.php';

        }else
        {
            $_SESSION['HeaderError'] = 'File could not be moved to correct destination';
        }
    }else {
        $_SESSION['HeaderError'] = 'Only .fasta fileformats allowed';
    }
}
else{
    $_SESSION['HeaderError'] = 'Filesize too large';
}


//This section will handle text inputs
if(!empty($_POST['fastatext'])){
    $ffile = $_POST['fastatext'];
    if (strlen($_POST['fastatext']) <30000){
        include 'filefastahandler.php';
    }
    else{
        $_SESSION['HeaderError'] = 'Max 30 000 characters';
    }
}

elseif(empty($ftext) && empty($fileSize)){
    $_SESSION['HeaderError'] = 'Empty submission';
}

//If there was an error, bring it back to the upload page and display the error. 
if (!empty($_SESSION['HeaderError'])){    
    header('Location:./insertform.php');
}


function removeUTF8($s){
  if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
       return substr($s,3);
   }else{
       return $s;
   }
}

?>

