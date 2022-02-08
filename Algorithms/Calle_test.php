<?php
        $fasta1 = $_GET['fastafile1'];
        $fasta2 = $_GET['fastafile2'];

        $output = shell_exec("Rscript function_call.R $fasta1 $fasta2");
        echo $output
  
    ?> 