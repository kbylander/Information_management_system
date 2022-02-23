<?php
foreach($fasta as $key => $value) { 
    if (str_contains($value, '>')) {
        $fastanumber += 1;
    } 
    if ((strlen($value)> 30) || (!empty($seq[$fastanumber]))){
        if (empty($seq[$fastanumber])){
            $seq[$fastanumber] = $value;
        }
        else {
        $seq[$fastanumber] = $seq[$fastanumber] . $value;
        }
    }
    else {
        if (empty($header[$fastanumber])){
            $header[$fastanumber] = $value;
        }
        else {
        $header[$fastanumber] = $header[$fastanumber] . ' ' . $value;
        }
    }
}
?>