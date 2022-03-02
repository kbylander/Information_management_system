<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="upload.php" method="POST" >
    <textarea name="fastasequence1" cols="50" rows="5" 
    placeholder ="Enter nucleotide sequence in FASTA format here"></textarea>
    <textarea name="fastasequence2" cols="50" rows="5" 
    placeholder ="Enter nucleotide sequences, in FASTA format, you wish to compare"></textarea>
    <select name="Method" id="Method">
	    <option value="">--- Choose a Genetic distance measurement ---</option>
	    <option value="Genpofad">Genpofad</option>
	    <option value="Matchstates">Matchstates</option>
	    <option value="Daredevil">Daredevil</option>
        <option value="Consensus">Consensus score</option>
    </select>
    <input type="submit" name="submit">
</form>
</body>
</html

