<?php
//FASTA header format: >SeqID| gene= os=
function fastagensingle($ID, $seq, $gene, $species){
  $filename = "singlefasta_fasta.fasta";
  $file = fopen("TempFastaFiles/" . $filename, "w");
  fwrite($file,">" . $ID . "|gene=" . $gene . "|os=" . $species . "\n" . $seq);
  fclose($file);
  return ($filename);
}

function fastamultiplegen($IDs,$seqs,$genes,$species){
  $filename = "multiplefasta_am_fasta.fasta";
  $file = fopen("TempFastaFiles/" . $filename, "w");
  for ($i = 0; $i < count($seqs); $i++)  {
    $IDs[$i] = rtrim($IDs[$i]);
    $genes[$i] = rtrim($genes[$i]);
    $species[$i] = rtrim($species[$i]);
    $seqs[$i] = rtrim($seqs[$i]);
    fwrite($file,">" . $IDs[$i] . "|gene=" . $genes[$i] . "|os=" . $species[$i] . "\n" . $seqs[$i] . "\n" );
  }
  fclose($file);
  return ($filename);
}
?>
