<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="upload.php" method="POST" >
    <input type="file" name = "fastafile1" > 
    <input type="file" name = "fastafile2"> 
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

