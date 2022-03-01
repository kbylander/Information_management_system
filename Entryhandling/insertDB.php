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

    //to check if entry id already exists
    $fetchinfo = "SELECT * FROM entries, sequence WHERE entryID LIKE $entryid and seqaddedby LIKE $currentuser and entryaddedby LIKE $currentuser";
    $results=mysqli_query($link,$fetchinfo);

    //to insert unique seqID
    $fetchnumber = "SELECT count(seqID) FROM sequence";
    $numberrows = mysqli_query($link,$fetchnumber);
    $row = mysqli_fetch_array($numberrows);
    $resnumberofrows = $row[0]+1;
    $seqid = $entryid . '_' . $genename .'_S' . $resnumberofrows;

    echo $seqid; echo gettype($seqid);

    if (!empty($results)){
        
        $sql_stmt2= "INSERT INTO sequence (seqID, genename, entryID, seq, seqaddedby, priv) VALUES ('$seqid', '$genename', '$entryid', '$currentseq', '$currentuser', $priv)";
        mysqli_query($link,$sql_stmt2);
    }
    else{
        $sql_stmt= "INSERT INTO entries (entryID, species, entryaddedby, priv) VALUES ('$entryid', '$species', '$currentuser', $priv)";
        $sql_stmt2= "INSERT INTO sequence (seqID, genename, entryID, seq, seqaddedby, priv) VALUES ('$seqid','$genename', '$entryid', '$currentseq', '$currentuser', $priv)";
     
        mysqli_query($link,$sql_stmt);
        mysqli_query($link,$sql_stmt2);
    }
    include '../disconnectDB.php';
}
?>
