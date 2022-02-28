<?php
session_start();
$_SESSION['HeaderError']= '';

foreach ($header as $key => $value){
    $female = null;
    $private = true;
    $entryIDend= strpos($value,'|');
    $genestart = strpos($value,'gene=');
    $speciesnamepos = strpos($value,'os=');
    $firstchar=$value[0];

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
    $sql_stmt= "INSERT INTO entries (entryID, female, addedby, species) VALUES ('$entryid', $female, '$currentuser', '$species')";
 
    include '../connectDB.php';
    mysqli_query($link,$sql_stmt);
    include '../disconnectDB.php';

    echo gettype($female); echo '<br>'; echo $entryid; echo '<br>'; echo $species; echo '<br>'; echo $genename;  echo '<br>'; echo $currentuser; echo '<br>'; echo gettype($private);

}
//    $sql_stmt= "INSERT INTO entries.entryID, entries.female, entries.addedby, entries.species, entries.priv, sequence.genename, sequence.entryID, sequence.seq, sequence.priv VALUES $entryid, $female, $_SESSION['user'], $species, $private, $genename, $entryid, $seq[$key], $private;";

//>GM1_S2| gene=FOXP2 os=Canis lupus CCACGCGTCCGCCCTGACCGTGCCAAGGGTAGAGCCGCGGCCTCGGCCGGTCAGCTCCCCCTCCGCCGCT TCGGGGCCTGCGGGGTTCTGGCCTCGCGTCTCGGAACCCTTCGGAGGGGGAGGCCGGAGGAGGCCGCGGC AGCTCCGGGAACTCCGCCGGCCGAGCCGGGGGAGCTTCCGTATCCTAAACCTTAGGAAGTTCCCAGCGTT GCTCGGGGTCTGCGGCCCGCTAACGGCCCCGCAGAATAGGTGCTGCCCCGAGATGGACGCGCCGCCCGCG AAGCTTGAGGTTCCGAGAGGCGAACCTCTTCCGCAGCCGCCTAAGTGACCGAGCCGGGACGCGAACCCCG TGACCACCCTTGTGCCGCCTCCCACCTGCCCCAGCAGAGGTGTATGTGGACGTGAATGTAGGGCCCCGAA GTGTGACGGGCAGTTCAAGAACCTCATGTGTCAGTAATTAACACTGTGGACACCTCCCATGAGGATATGA GGGTTCATCTTTCACCCGCCTGGCAACCTGCTCCTCAGACAGGTCCGTCAAA
?>
