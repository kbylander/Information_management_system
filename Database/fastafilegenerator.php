<?php
function fastagensingle($ID, $seq, $gene, $species){
  $filename = $ID . "_fasta.fasta";
  $file = fopen("TempFastaFiles/" . $filename, "w");
  fwrite($file,">GM|" . $ID . "| gene=" . $gene . " os=" . $species . "\n" . $seq);
  fclose($file);
  return ($filename);
}

function fastamultiplegen($IDs,$seqs,$genes,$species){
  $filename = $IDs[0]."_am_fasta.fasta";
  $file = fopen("TempFastaFiles/" . $filename, "w");

  for ($i = 0; $i < count($seqs); $i++)  {
    fwrite($file,">GM|" . $IDs[$i] . "| gene=" . $genes[$i] . " os=" . $species[$i] . "\n" . $seqs[$i] . "\n\n");
  }
  fclose($file);
  return ($filename);
}
?>
