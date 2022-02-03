<!DOCTYPE html>
<html>
<head>
    <meta charset="uft-8" />

    <title>Integrating PHP & R</title>


</head>
<body>
    <form method="POST" ACTION="">
        <input type = "file" name="fastafile1">
        <input type = "file" name="fastafile2">
        <input type = "submit" name="submit">
    </form>

    <?php
        $fasta1 = $_POST['fastafile1'];
        $fasta2 = $_POST['fastafile2'];

        echo shell_exec("C:\Program Files\R\R-4.1.2\bin\Rscript C:\Users\calle\OneDrive\Dokument\R\Project\Algorithms.R $fasta1 $fasta2");
    ?>


</body>
</html>