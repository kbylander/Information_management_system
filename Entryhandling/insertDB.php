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

    $fetchinfo = "SELECT * FROM entries, sequence WHERE entryID LIKE $entryid";
    $select=mysqli_query($link,$fetchinfo);
    //$num_entries = mysqli_num_rows($select);

    if (!empty($select)){
        $sql_stmt2= "INSERT INTO sequence (genename, entryID, seq, priv) VALUES ('$genename', '$entryid', '$currentseq',$priv)";
        mysqli_query($link,$sql_stmt2);
    }
    else{
        $sql_stmt= "INSERT INTO entries (entryID, addedby, species, priv) VALUES ('$entryid', '$currentuser', '$species',$priv)";
        $sql_stmt2= "INSERT INTO sequence (genename, entryID, seq, priv) VALUES ('$genename', '$entryid', '$currentseq',$priv)";
     
        mysqli_query($link,$sql_stmt);
        mysqli_query($link,$sql_stmt2);
    }
    include '../disconnectDB.php';
}
//    $sql_stmt= "INSERT INTO entries.entryID, entries.female, entries.addedby, entries.species, entries.priv, sequence.genename, sequence.entryID, sequence.seq, sequence.priv VALUES $entryid, $female, $_SESSION['user'], $species, $private, $genename, $entryid, $seq[$key], $private;";

//>GM1_S2| gene=FOXP2 os=Canis lupus CCACGCGTCCGCCCTGACCGTGCCAAGGGTAGAGCCGCGGCCTCGGCCGGTCAGCTCCCCCTCCGCCGCT TCGGGGCCTGCGGGGTTCTGGCCTCGCGTCTCGGAACCCTTCGGAGGGGGAGGCCGGAGGAGGCCGCGGC AGCTCCGGGAACTCCGCCGGCCGAGCCGGGGGAGCTTCCGTATCCTAAACCTTAGGAAGTTCCCAGCGTT GCTCGGGGTCTGCGGCCCGCTAACGGCCCCGCAGAATAGGTGCTGCCCCGAGATGGACGCGCCGCCCGCG AAGCTTGAGGTTCCGAGAGGCGAACCTCTTCCGCAGCCGCCTAAGTGACCGAGCCGGGACGCGAACCCCG TGACCACCCTTGTGCCGCCTCCCACCTGCCCCAGCAGAGGTGTATGTGGACGTGAATGTAGGGCCCCGAA GTGTGACGGGCAGTTCAAGAACCTCATGTGTCAGTAATTAACACTGTGGACACCTCCCATGAGGATATGA GGGTTCATCTTTCACCCGCCTGGCAACCTGCTCCTCAGACAGGTCCGTCAAA
?>
