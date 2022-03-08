library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/Proj_functions.R")


fasta1 <- readDNAStringSet("C:/MAMP/htdocs/IMS-Daredevil/Database/TempFastaFiles/singlefasta_fasta.fasta")
fasta2 <- readDNAStringSet("C:/MAMP/htdocs/IMS-Daredevil/Database/TempFastaFiles/multiplefasta_am_fasta.fasta")

sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output_file/focalfastafile.php")
name1 <- names(fasta1)
name1 <- gsub(" ", "", name1)
cat(paste0(">",name1))
cat("\n")
seq1 <- paste(fasta1)
seq1 <- gsub(" ","", seq1)
cat(seq1)
sink()
fasta1 <- "C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output_file/focalfastafile.php"

length <- length(fasta2) 


for (i in 1:length)
{
 # Create file with 1 fasta sequence
  sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output_file/fastafile.php")
  name <- names(fasta2)[i]
  name <- gsub(" ", "", name)
  cat(paste0(">",name))
  cat("\n")
  seq <- paste(fasta2)[i]
  seq <- gsub(" ", "", seq)
  cat(seq)
  sink()
  fasta3 <- "C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output_file/fastafile.php"
  
  # Store output in array, append after each iteration. 
  sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output/output.php", append = TRUE)
  result <- Daredevil(fasta1, fasta3)
  cat(result)
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output/output.php", append = TRUE)
  cat("\n")
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output/seqname.php", append = TRUE)
  fastaFile2 <- readDNAStringSet(fasta3)
  seq_name2 = names(fastaFile2)
  cat(seq_name2)
  sink()
  
  sink("C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output/seqname.php", append = TRUE)
  cat("\n")
  sink()
  
}



