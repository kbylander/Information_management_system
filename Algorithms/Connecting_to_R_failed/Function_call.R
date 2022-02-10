##Necessary packages
##if (!require("devtools", quietly = TRUE)) {
##  install.packages("devtools")
##}
##if (!require("simjoly/pofadinr", quietly = TRUE)) {
##  install_github("simjoly/pofadinr")
##}
##if (!require("BiocManager", quietly = TRUE)) {
##  install.packages("BiocManager")
##}
##BiocManager::install("Biostrings")


library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("Algorithms/Proj_functions.R")


#args <- commandArgs(TRUE)

#fasta1 <- args[1]
#fasta2 <- args[2]

fasta1 <- "Algorithms/IUPAC_test1.fasta"
fasta2 <- "Algorithms/IUPAC_test2.fasta"

sink(file = "Algorithms/Output/Gendist_output2.txt")
Genpofad(fasta1, fasta2)
print("hello")
sink(file = NULL)