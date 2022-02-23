<?php
$seqreq = "[ATCGRYSWKMBDHVN.-]";


preg_match($seqreq, strtoupper($header[0]), $matches);
if ($matches != strlen($fasta[0])){
    not a approved fasta sequences
    echo 'jajamen';
}
echo '<br>';
print_r($matches);
$coun= strlen($fasta[0]);
echo $coun;

?>