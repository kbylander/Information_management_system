<?php
function fastagensingle($ID, $seq, $gene, $species){
$filename = $ID . "_fasta.fasta";
$file = fopen("TempFastaFiles/" . $filename, "w");
fwrite($file,">GM|" . $ID . "| gene=" . $gene . " os=" . $species . "\n" . $seq);
fclose($file);
return ($filename);
}
?>
