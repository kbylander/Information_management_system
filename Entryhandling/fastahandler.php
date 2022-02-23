<?php

session_start()
$_SESSION['IndIDError'] = false;
$_SESSION['GenenameError'] = false;
$_SESSION['SpeciesError'] = false;

//gör hela forloopen innan mysgl insert
//skicka tillbaka till insertform.php om någon session blir true

//  fasta format here:  > individualID| genename= os= gender=  
$headerrequirements = array('>', 'genename', 'os');
$seqrequirements = array('A','T', 'C', 'G','R','Y','S','W','K','M','B','D','H','V','N','.','-')

foreach ($fasta as $index){
    if (array_intersect($requirements, $index)){
        //if all reuirements are met for a header

        $array = str_split($index);
        foreach ($array as $char) {
    elseif(in_array($index, $requirements)){
        //if some but not all reuirements are met for a header
    }
    elseif{!str_contrains(strtoupper($index), $headerrequirements)
        //if nucleotides and ambuiguity requirements are met for sequence. 
    }
        
    }


}

$fasta= 
}  

?>