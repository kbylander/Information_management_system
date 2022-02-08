Genpofad <- function(fasta1, fasta2, pw = TRUE, conseq = FALSE) {
  
  # Read fasta-files
  fastaFile1 <- readDNAStringSet(fasta1)
  seq_name1 = names(fastaFile1)
  sequence1 = paste(fastaFile1)
  
  
  fastaFile2 <- readDNAStringSet(fasta2)
  seq_name2 = names(fastaFile2)
  sequence2 = paste(fastaFile2)
  
  #Format sequence
  
  mini <- min(nchar(sequence1), nchar(sequence2))
  
  sequence1 <- substr(sequence1,1, mini)
  sequence2 <- substr(sequence2, 1, mini)
  
  #concatenate sequences
  cat(paste(2, mini),
      paste(seq_name1, sequence1),
      paste(seq_name2, sequence2),
      file = "sequences.txt", sep = "\n")
  
  # Read the alignment
  SNP.sequences <- read.dna("sequences.txt", format = "sequential")
  
  # Compute GENPOFAD distance
  d <- dist.snp(SNP.sequences, model="GENPOFAD", pairwise.deletion = pw)
  
  # Consensus Seq
  if(conseq == TRUE){
    con <- consensus.dna(SNP.sequences)
    as.character(con)
  }
  return(d)
}

Matchstates <- function(fasta1, fasta2, pw = TRUE, conseq = FALSE) {
  
  # Read fasta-files
  fastaFile1 <- readDNAStringSet(fasta1)
  seq_name1 = names(fastaFile1)
  sequence1 = paste(fastaFile1)
  
  
  fastaFile2 <- readDNAStringSet(fasta2)
  seq_name2 = names(fastaFile2)
  sequence2 = paste(fastaFile2)
  
  #Format sequence
  
  mini <- min(nchar(sequence1), nchar(sequence2))
  
  sequence1 <- substr(sequence1,1, mini)
  sequence2 <- substr(sequence2, 1, mini)
  
  #concatenate sequences
  cat(paste(2, mini),
      paste(seq_name1, sequence1),
      paste(seq_name2, sequence2),
      file = "sequences.txt", sep = "\n")
  
  # Read the alignment
  SNP.sequences <- read.dna("sequences.txt", format = "sequential")
  
  # Compute MATCHSTATES distance
  d <- dist.snp(SNP.sequences, model="MATCHSTATES", pairwise.deletion = pw)
  
  # Consensus Seq
  if(conseq == TRUE){
    con <- consensus.dna(SNP.sequences)
    as.character(con)
  }
  return(d)
}

Hamming <- function(fasta1, fasta2){
  
  # Read fasta-files
  fastaFile1 <- readDNAStringSet(fasta1)
  seq_name1 = names(fastaFile1)
  sequence1 = paste(fastaFile1)
  
  
  fastaFile2 <- readDNAStringSet(fasta2)
  seq_name2 = names(fastaFile2)
  sequence2 = paste(fastaFile2)
  
  #Format sequence
  
  mini <- min(nchar(sequence1), nchar(sequence2))
  
  sequence1 <- substr(sequence1,1, mini)
  sequence2 <- substr(sequence2, 1, mini)
  
  count <- 0
  tot <- 0
  for (i in 1:mini) {
    if (substr(sequence1, i, i) != substr(sequence2, i, i)){
      count = count +1
    }
    tot <- tot + 1
  }
  
  gendist <- count/tot
  
  return(gendist)
}

mean_dist <- function(fasta1, fasta2){
  Gen <- Genpofad(fasta1, fasta2)
  Match <- Matchstates(fasta1, fasta2)
  Ham <- Hamming(fasta1, fasta2)
  
  tot <- sum(Ham,Gen,Match)
  mean <- tot/3
  
  return(mean)
}
