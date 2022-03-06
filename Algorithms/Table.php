<!DOCTYPE html>
<html>
<head>
<style> 
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

<?php 
//Header of focal sequence
$Fasta1 = file_get_contents("../Database/TempFastaFiles/singlefasta_fasta.fasta");
$ExplodeFasta1 = explode("\n",$Fasta1);
$header_fasta1 = $ExplodeFasta1[0];

echo "<h1>Genetic distance</h1>";
?>
<table>
  <tr>
    <th>Focal sequence</th>
    <th>Method</th>
  </tr>
  <?php
  echo '<tr>';
    echo '<td>';
      echo "<i>$header_fasta1</i>";
    echo '</td>';
    echo '<td>';
      echo "$Method";
    echo '</td>';
  ?>
</table>

<table>
  <tr>
    <th>Sequence name</th>
    <th>Genetic distance</th>
  </tr>
  <?php

        //Headers
        $str_name = file_get_contents("output/seqname.php");
        $output_name = explode("\n",$str_name);
        $count_name = count($output_name);
        //Genetic distance
        $str_dist = file_get_contents("output/output.php");
        $output_dist = explode("\n",$str_dist);
        $count_dist = count($output_dist);
        
        //Create array with headers + distances
        $output_array = array();
        for ($x = 0; $x <= $count_dist-1; $x++) {
            $output_array[$output_name[$x]] = $output_dist[$x];
        }
        arsort($output_array);
        
        //display output + header in table
        $counter = 0;
        foreach($output_array as $key => $value) {
            $counter++;
            if ($counter == 1) {
              $backgroundcolor = "MediumSeaGreen";
            }elseif ($value >=0.5) {
              $backgroundcolor = "Orange";
            }else {
              $backgroundcolor = "Red";
            }
            echo "<tr bgcolor=$backgroundcolor>";
            echo '<td>';
                echo "<i>$key</i>";
            echo '</td>';
            echo '<td>';
                echo $value;
            echo '</td>';
        echo '</tr>';
        }
        ?>
</table>

<div class = "buton">
        <button id = "b7" onclick="location.href = '../Database/Calculate.php';" type="button">Go back</button>
</div>
</body>
</html>
