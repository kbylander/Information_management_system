<?php
//FASTA header format: >SeqID| gene= os=
function fastagensingle($ID, $seq, $gene, $species){
  $filename = substr(md5(time() . rand()) . ".fasta",-16);
  $file = fopen("TempFastaFiles/" . $filename, "w");
  fwrite($file,">" . $ID . "|gene=" . $gene . "|os=" . $species . "\n" . chunk_split($seq,80));
  fclose($file);
  return ($filename);
}

function fastamultiplegen($IDs,$seqs,$genes,$species){
  $filename = substr(md5(time() . rand()) . ".fasta",-16);
  $file = fopen("TempFastaFiles/" . $filename, "w");
  for ($i = 0; $i < count($seqs); $i++)  {
    $IDs[$i] = rtrim($IDs[$i]);
    $genes[$i] = rtrim($genes[$i]);
    $species[$i] = rtrim($species[$i]);
    $seqs[$i] = rtrim($seqs[$i]);
    fwrite($file,">" . $IDs[$i] . "|gene=" . $genes[$i] . "|os=" . $species[$i] . "\n" . chunk_split($seqs[$i],80) );
  }
  fclose($file);
  return ($filename);
}
?>
