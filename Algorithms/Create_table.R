# Load the output results
measurements <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/output.php"
seqname <- "C:/MAMP/htdocs/IMS-Daredevil/Algorithms/output/seqname.php"

fileName <- measurements
conn <- file(fileName,open="r")
linn <-readLines(conn)
measurements <- vector()
for (i in 1:length(linn)){
  print(linn[i])
  measurements <- append(mm, linn[i])
}
close(conn)







fastaname1 <- names(readDNAStringSet(fasta1))
fastaname2 <- names(readDNAStringSet(fasta2))

#view table 
test <- matrix(c(result[1]),ncol=1,byrow=TRUE)
colnames(test) <- c(fastaname1)
rownames(test) <- c(fastaname2)
test <- as.table(test)
test