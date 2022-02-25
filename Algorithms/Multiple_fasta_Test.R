library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/Proj_functions.R")


fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Test1.fasta"
fasta2 <- readDNAStringSet("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/input/Multi.fasta")

length <- length(fasta2) 


for (i in length)
{
  # Create file with 1 fasta sequence
  sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/Test/rand.php")
  name <- names(fasta2)[i]
  cat(paste0(">",name))
  cat("\n")
  seq <- paste(fasta2)[i]
  cat(seq)
  sink()
  fasta2 <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/Test/rand.php"
  
  # Store output in array, append after each iteration. 
  sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/output.php", append = TRUE)
  result <- Genpofad(fasta1, fasta2)
  cat(result)
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/output.php", append = TRUE)
  cat("\n")
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/seqname.php", append = TRUE)
  fastaFile2 <- readDNAStringSet(fasta2)
  seq_name2 = names(fastaFile2)
  cat(seq_name2)
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/seqname.php", append = TRUE)
  cat("\n")
  sink()
  
}




