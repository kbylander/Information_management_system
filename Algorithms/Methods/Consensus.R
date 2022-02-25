library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("Proj_functions.R")

fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Test1.fasta"
fasta2 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Test2.fasta"


# name of output file should be different for each loop. Remove the create table from here! 
# Store output in array, append after each iteration. 

sink("output/output.php", append = TRUE)
result <- mean_dist(fasta1, fasta2)
cat(result)
sink()

sink("output/output.php", append = TRUE)
cat("\n")
sink()

sink("output/seqname.php", append = TRUE)
fastaFile2 <- readDNAStringSet(fasta2)
seq_name2 = names(fastaFile2)
cat(seq_name2)
sink()

sink("output/seqname.php", append = TRUE)
cat("\n")
sink()


