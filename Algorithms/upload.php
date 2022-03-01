<?php
//Load files
$fasta1 = $_POST['fastafile1'];
$fasta2 = $_POST['fastafile2'];

//Load method of choice
$Method = $_POST['Method'];

//Comments on how to import/use the SQL query results //
    //Store sequences and headers seperately
    //All sequences should be stored into one txt file
    //Same with headers.. - See StackOverflow thread
    //Make sure that each header/sequence can be easily accessed
    //With indexing, so that the first header and sequence
    //can be accessed with the same index --> header[0] / sequence[0]
    //This may be done with explode (make sure that each header/sequence 
    //is seperated by a line...)
    //When this is done, go through all sequences/headers in your documents
    //and append them into a new file, should look like like the "Fasta_test/Morefastas.fasta".
    //If the explode worked, you can use count to see the amount of headers/sequences in the file (I think!?!?)
    //for (i in length(header.txt or sequence.txt)){
        //header = file_get_contents(headers.txt)
        //header = "sequence . PHP_EOL (or sequence . \r\n")
        //path = "input/xxx.fasta"
        //file_put_contents(path, header[i], FILE_APPEND)
        //sequence = file_get_contents(sequence.txt)
        //sequence = "sequence . PHP_EOL (or sequence . \r\n");
        //path = "input/xxx.fasta"
        //file_put_contents(path, sequence[i], FILE_APPEND)
    //}
    //Then if this works, nothing more needs to be changed (remove the below syntaxes)

$document1 = file_get_contents("Fasta_test/$fasta1");
$document2 = file_get_contents("Fasta_test/$fasta2");

$filename1 = "input/Fasta1.fasta";
$filename2 = "input/Fasta2.fasta";

file_put_contents($filename1, $document1);
file_put_contents($filename2, $document2);

//go through each file in a folder, and run the exe

if ($Method == "Genpofad") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Genpofad.R');
} 

if ($Method == "Matchstates") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Matchstates.R');
} 

if ($Method == "Daredevil") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Daredevil.R');
}

if ($Method == "Consensus") {
    exec('C:/MAMP/bin/R-4.1.2/bin/Rscript.exe Methods/Consensus.R');
}


include 'Table.php';

unlink('output/output.php');
unlink('output/seqname.php');
unlink('input/Fasta1.fasta');
unlink('input/Fasta2.fasta');
unlink('output_file/fastafile.php');

?>



    