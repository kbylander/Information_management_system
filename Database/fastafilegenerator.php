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
    fwrite($file,">" . $IDs[$i] . "|gene=" . $genes[$i] . "|os=" . $species[$i] . "\n" . $seqs[$i] . "\n\n");
  }
  fclose($file);
  return ($filename);
}
?>
