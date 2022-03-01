<?php
session_start();
$_SESSION['HeaderError']= '';

foreach ($header as $key => $value){
    $priv = true;
    $entryIDend= strpos($value,'|');
    $genestart = strpos($value,'gene=');
    $speciesnamepos = strpos($value,'os=');
    $firstchar=$value[0];

    include '../connectDB.php';

    if(($value[0] != '>') || (empty($entryIDend)) || (empty($genestart)) || (empty($speciesnamepos))){
        $_SESSION['HeaderError']= 'Header: ' . $value . ' is in incorrect format';
        header('Location:./insertform.php');    
    }

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
    $fetchnumber = "SELECT count(seqID) FROM sequence";
    $numberrows = mysqli_query($link,$fetchnumber);
    $row = mysqli_fetch_array($numberrows);
    $resnumberofrows = $row[0]+1;
    $seqid = $entryid . '_' . $genename .'_S' . $resnumberofrows;

    echo $seqid;

    $sql_entry = "INSERT INTO entries (entryID, species, addedby) VALUES ('$entryid', '$species', '$currentuser')";
    $sql_seq = "INSERT INTO sequence (seqID, genename, entryID, seq, seqaddedby) VALUES ('$seqid', '$genename', '$entryid', '$currentseq', '$currentuser')";


    if (!empty($results)){
        mysqli_query($link,$sql_seq);
    }
    else{
        mysqli_query($link,$sql_entry);
        mysqli_query($link,$sql_seq);
    }
    include '../disconnectDB.php';
}
header('Location:../Database/sequencesDB.php');    

?>
