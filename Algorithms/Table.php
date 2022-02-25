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

<h1>Genetic distance</h1>

<table>
  <tr>
    <th>Sequence name</th>
    <th>Genetic distance</th>
  </tr>
  <?php
        $str_name = file_get_contents("output/seqname.php");
        $output_name = explode("\n",$str_name);
        $count_name = count($output_name);
        $str_dist = file_get_contents("output/output.php");
        $output_dist = explode("\n",$str_dist);
        $count_dist = count($output_dist);

        $output_array = array();
        for ($x = 0; $x <= $count_dist-1; $x++) {
            $output_array[$output_name[$x]] = $output_dist[$x];
        }
        asort($output_array);

        foreach($output_array as $key => $value) {
            echo '<tr>';
            echo '<td>';
                echo $key;
            echo '</td>';
            echo '<td>';
                echo $value;
            echo '</td>';
        echo '</tr>';
        }
            
        ?>
</table>

</body>
</html>
