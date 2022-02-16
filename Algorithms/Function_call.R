library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("Proj_functions.R")

fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Test1.fasta"
fasta2 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Test2.fasta"

# name of output file should be different for each loop. Remove the create table from here! 
# Store output in array, append after each iteration. 

sink("output/output.php")
result <- Genpofad(fasta1, fasta2)
fastaname1 <- names(readDNAStringSet(fasta1))
fastaname2 <- names(readDNAStringSet(fasta2))

#view table 
test <- matrix(c(result[1]),ncol=1,byrow=TRUE)
colnames(test) <- c(fastaname1)
rownames(test) <- c(fastaname2)
test <- as.table(test)
test
sink()


