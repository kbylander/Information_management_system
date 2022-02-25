library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("Proj_functions.R")


# Load the output results
fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Fasta1.fasta"
fastaFile1 <- readDNAStringSet(fasta1)
seq_name1 = names(fastaFile1)


# Gendistvalues
measurements <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/output.php"
meas_vec <- vector()
fileName1 <- measurements
conn1 <- file(fileName1,open="r")
linn1 <-readLines(conn1)
for (i in 1:length(linn1)){
  meas_vec <- append(meas_vec, linn1[i])
}
close(conn1)

# Sequence names
sequence_name <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/seqname.php"
seq_vec <- vector()
fileName2 <- sequence_name
conn2 <- file(fileName2,open="r")
linn2 <-readLines(conn2)
for (i in 1:length(linn2)){
  seq_vec <- append(seq_vec, linn2[i])
}
close(conn2)

#view table 
sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/table.php")
test <- matrix(meas_vec,ncol=1,byrow=TRUE)
colnames(test) <- c(seq_name1)
rownames(test) <- c(seq_vec)
test <- as.table(test)
test
sink()

