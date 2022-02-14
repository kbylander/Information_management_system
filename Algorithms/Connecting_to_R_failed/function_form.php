<!DOCTYPE html>
<html>
<head>
    <meta charset="uft-8" />

    <title>Integrating PHP & R</title>


</head>
<body>
    <form method="GET" ACTION="function_form.php">
        <input type = "file" name="fastafile1">
        <input type = "file" name="fastafile2">
        <input type = "submit" name="submit">
    </form>
    <?php
        $fasta1 = $_GET['fastafile1'];
        $fasta2 = $_GET['fastafile2'];
        exec("Function_call.Rscript");
    ?> 


</body>
</html>