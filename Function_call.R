##Necessary packages
if (!require("devtools", quietly = TRUE)){
  install.packages("devtools")
}
library("devtools")

if (!require("simjoly/pofadinr", quietly = TRUE)){
  install_github("simjoly/pofadinr")
}
library("pofadinr")  

if (!require("BiocManager", quietly = TRUE)){
  install.packages("BiocManager")
}
BiocManager::install("Biostrings")

library("Biostrings")

require(ape)

source("Proj_functions.R")

fasta1 <- "IUPAC_test1.fasta"
fasta2 <- "IUPAC_test2.fasta"

Genpofad(fasta1, fasta2)


