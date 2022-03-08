library("pofadinr")
library("devtools")
library("Biostrings")
require(ape)
source("C:/MAMP/htdocs/IMS-Daredevil/Algorithms/Proj_functions.R")


Args <- commandArgs(trailingOnly = TRUE)
first1 <- Args[1]
second2 <- Args[2]

filepath <- "C:/MAMP/htdocs/IMS-Daredevil/Database/TempFastaFiles/"

fasta1path <- paste(filepath,first1)
fasta1path <- gsub(" ","",fasta1path)
fasta1 <- readDNAStringSet(fasta1path)


fasta2path <- paste(filepath,second2)
fasta2path <- gsub(" ","",fasta2path)
fasta2 <- readDNAStringSet(fasta2path)


outputpath <- "C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output_file/"
opfile <- paste(outputpath,first1)
opfile <- gsub(" ","",opfile)

sink(opfile)
name1 <- names(fasta1)
name1 <- gsub(" ", "", name1)
cat(paste0(">",name1))
cat("\n")
seq1 <- paste(fasta1)
seq1 <- gsub(" ","", seq1)
cat(seq1)
sink()

fasta1 <- opfile

ffile <- paste(outputpath,"tempfile",first1)
ffile <- gsub(" ","",ffile)

DSoppath <- "C:/MAMP/htdocs/IMS-Daredevil/Database/Distance_stuff/output/"

ofile <- paste(DSoppath,"output",first1)
ofile <- gsub(" ","",ofile)

sfile <- paste(DSoppath,"seqname",first1)
sfile <- gsub(" ","",sfile)

length <- length(fasta2) 
for (i in 1:length)
{
  # Create file with 1 fasta sequence
  sink(ffile)
  name <- names(fasta2)[i]
  name <- gsub(" ", "", name)
  cat(paste0(">",name))
  cat("\n")
  seq <- paste(fasta2)[i]
  seq <- gsub(" ", "", seq)
  cat(seq)
  sink()
  fasta3 <- ffile
  # Store output in array, append after each iteration. 
  sink(ofile, append = TRUE)
  result <- Daredevil(fasta1, fasta3)
  cat(result)
  sink()
  
  sink(ofile, append = TRUE)
  cat("\n")
  sink()
  
  sink(sfile, append = TRUE)
  fastaFile2 <- readDNAStringSet(fasta3)
  seq_name2 = names(fastaFile2)
  cat(seq_name2)
  sink()
  
  sink(sfile, append = TRUE)
  cat("\n")
  sink()
  
}



