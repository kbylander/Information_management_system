<?php
session_start();

//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = False;
  }
  if ($_SESSION['loggedin'] == False) {
    header('Location: ../index.php');
  }

  
$_SESSION['HeaderError']= '';


//loops through each header
foreach ($header as $key => $value){
    $priv = true;
    $entryIDend= strpos($value,'|');
    $genestart = strpos($value,'gene=');
    $speciesnamepos = strpos($value,'os=');
    $firstchar=$value[0];

    include '../connectDB.php';
    //checks if header contains all required elements
    if(($value[0] != '>') || (empty($entryIDend)) || (empty($genestart)) || (empty($speciesnamepos))){
        $_SESSION['HeaderError']= 'Header: ' . $value . ' is in incorrect format';
        header('Location:./insertform.php');    
    }

    //creates atribute names from header.
    $entryid=substr($value,1,$entryIDend-1);
    $genename = substr($value, $genestart+5, $speciesnamepos-$genestart-5);

    if (!empty(strpos($value,'gender='))){
        $genderpos = strpos($value,'gender=');
        $species=substr($value,$speciesnamepos+3,$genderpos);
        $gender = substr($value,$genderpos+7,strlen($value)-1);
    }
    else{
        $species=substr($value,$speciesnamepos+3,strlen($value)-1);
    }    
    $currentuser= $_SESSION['user'];
    $currentseq = $seq[$key];

    //to check if entry id already exists for specific user
    $fetchinfo = "SELECT * FROM entries, sequence WHERE entryID LIKE $entryid and seqaddedby LIKE $currentuser and addedby LIKE $currentuser";
    $results=mysqli_query($link,$fetchinfo);

    //to insert unique seqID
    $fetchnumberseq = "SELECT count(seqID) FROM sequence";
    $fetchnumberentry = "SELECT count(entryID) FROM entries";
    $numberrows = mysqli_query($link,$fetchnumber);
    $row = mysqli_fetch_array($numberrows);
    $resnumberofrows = $row[0]+1;
    $seqid = $entryid . '_' . $genename .'_S' . $resnumberofrows;

    $sql_entry = "INSERT INTO entries (entryID, species, addedby) VALUES ('$entryid', '$species', '$currentuser')";
    
    $sql_seq = "INSERT INTO sequence (seqID, genename, entryID, seq, seqaddedby) VALUES ('$seqid', '$genename', '$entryid', '$currentseq', '$currentuser')";
   
   //if entryID already exists, it will insert to sequence table, without creating a new record in the entries table. 
    if (!empty($results)){
        mysqli_query($link,$sql_seq);
    }
    //if entryid doesn't exist, a new record will be created for both sequence and entries tables. 
    else{
        mysqli_query($link,$sql_entry);
        mysqli_query($link,$sql_seq);
    }
    include '../disconnectDB.php';
}

//redirect to sequences table of specific user.
header('Location:../Database/sequencesDB.php');    

?>
