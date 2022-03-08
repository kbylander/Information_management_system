<?php
session_start();
$_SESSION['HeaderError']= '';

//creates atribute names from header.
$entryid=substr($value,$firstchar+1,$entryIDend-$firstchar-1);
$genename = substr($value, $genestart+5, $speciesnamepos-$genestart-5);
$gender = -1;

if (!empty(strpos($value,'gender='))){
    $genderpos = strtoupper(strpos($value,'gender='));
    $gender = substr($value,$genderpos+7,strlen($value)-1);
    $species=substr($value,$speciesnamepos+3, $genderpos-$speciesnamepos-3);
    if (str_contains($gender,'MALE')){
        $gender = 0;
    }
    elseif(strtoupper($gender == 'FEMALE')){
        $gender = 1;
    }
    else{
        $_SESSION['HeaderError']= 'Header: ' . $value . ' is in incorrect format';
        header('Location:./insertform.php'); 
    }
}
else{
    $species=substr($value,$speciesnamepos+3,strlen($value)-1);
}    

$currentuser= $_SESSION['user'];
$currentseq = $seq[$key];

//assign name for entryID.
$entryid_unique=$entryid . '_' . $currentuser;

//to check if entryid exists for the current user in the db
$fetchinfo2 = "SELECT addedby FROM entries WHERE entryID LIKE '$entryid_unique'";

//Find #sequences in db to assign seqID to given sequence. 
$fetchnumber = "SELECT count(seqID) FROM sequence";

//$numberrows = mysqli_query($link, $fetchnumber);

//find number of sequences in db. 
include '../connectDB.php';
$no_seq = mysqli_fetch_array(mysqli_query($link,$fetchnumber));
$var2 = mysqli_fetch_array(mysqli_query($link,$fetchinfo2));
include '../disconnectDB.php';


//assign a name for seqID.
$resnumberofrows = $no_seq[0]+1;
$seqid = 'S' . $resnumberofrows;

//find if entryID exist in db and for specific user.
$noentryidUser = $var2[0];

//if gender exists in the header, manipulate query accordingly 
if ($gender<0){
    $sql_entry = "INSERT INTO entries (entryID, species, addedby) VALUES ('$entryid_unique', '$species', '$currentuser')";
}
else {
    $sql_entry = "INSERT INTO entries (entryID, species, addedby, female) VALUES ('$entryid_unique', '$species', '$currentuser', '$gender')";
}
$sql_seq = "INSERT INTO sequence (seqID, genename, entryID, seq, seqaddedby) VALUES ('$seqid', '$genename', '$entryid_unique', '$currentseq', '$currentuser')";

//if entryID already exists, it will insert to sequence table, without creating a new record in the entries table. 
if ($noentryidUser == $currentuser){
    dbtransactions($sql_seq);
    if (!$query){
        $_SESSION['HeaderError'] = 'could not complete the transaction: ' . $value; 
        header('Location:insertform.php');    
    }

}
else{
    dbtransactions($sql_entry);
    dbtransactions($sql_seq);
    if (!$query){
        $_SESSION['HeaderError'] = 'could not complete the transaction: ' . $value; 
        header('Location:insertform.php');    
    }
}

//redirect to sequences table of specific user.
$_SESSION['HeaderError'] = '';
header('Location:../Database/sequencesDB.php');    
?>
