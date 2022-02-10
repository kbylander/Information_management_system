<?php

//read in file
$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];


$file1 = $fasta1;
$document1 = file_get_contents($file1);
$file2 = $fasta2;
$document2 = file_get_contents($file2);

//seperate each line in file
$lines1 = explode("\n", $document1);
$lines2 = explode("\n", $document2);

// extract header
$header1 = $lines1[0];
$header2 = $lines2[0];

// append all sequence lines into one big string
for ($x = 1; $x <= count($lines1); $x++) {
    $sequence1 .= $lines1[$x];
}
for ($x = 1; $x <= count($lines2); $x++) {
    $sequence2 .= $lines2[$x];
}

// add header and sequence into array (key & value)
$test = array(
    "header1" => $header1,
    "sequence1" => $sequence1,
    "header2" => $header2,
    "sequence2" => $sequence2,
);

// length of sequences
$len1 = strlen($test["sequence1"]);
$len2 = strlen($test["sequence2"]);
$min = min($len1, $len2);

// format both sequences to same length
$test["sequence1"] = substr($test["sequence1"], 0, $min);
$test["sequence2"] = substr($test["sequence2"], 0, $min);

// look for differences
for ($x = 0; $x <= $min - 1; $x++) {
    if ($test["sequence1"][$x] != $test["sequence2"][$x])
        $counter += 1;
    $tot += 1;
}

// calculate ratio (distance)
$gen_dist = $counter / $tot;
echo $gen_dist;

?>
