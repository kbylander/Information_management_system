library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("Proj_functions.R")

fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/input1.fasta"
fasta2 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/input2.fasta"

sink("output/output.php")
#Genpofad(fasta1, fasta2)
Daredevil(fasta1, fasta2)
sink()

