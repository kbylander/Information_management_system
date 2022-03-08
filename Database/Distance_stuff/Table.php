<!DOCTYPE html>
<html>
<head>
<style> 
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  font-family: 'Open Sans', sans-serif;

}
*{
    margin: 0px;
    padding: 0px;
    font-family: sans-serif;
}

.banner{
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(../natur.jpg) no-repeat center center fixed;
    background-size: cover;
    background-position: center;
}
.navbar{
    width: 85%;
    margin: auto;
    padding: 35px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo{
    width: 120px;
    cursor: pointer;
}

.navbar ul li{
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;
}

.navbar ul li a{
    font-family: 'Open Sans', sans-serif;
    text-decoration: none;
    color: #fff;
    text-transform: uppercase;
}
.navbar ul li::after{
    content:'';
    height: 3px;
    width: 0;
    background: #BAD2FF;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;
}

.navbar ul li:hover::after{
    width: 100%;
}


.context{
    text-align: justify;
    width:100%;
    height: auto;
    font-size: 20px;
    background: linear-gradient(120deg,  #def4dd, #B0D8FF, #BAD2FF, #CEC5FF, #E2B8FF );
    background-size: cover;
    padding-top: 3%;
    padding-bottom: 10%;
}

.context h1{
    padding-top: 2%;
    padding-bottom: 0.5%;
    font-size: 30px;
    text-align: center;
    font-family: 'Bebas Neue', sans-serif;
    text-transform: uppercase;
}

.box{
    text-align: left;
    width: 600px;
    border: 4px solid white;
    padding: 40px;
    margin: auto;
    border-radius: 25px;
    background: #CEC5FF;
}

.box p1{
    padding-top: 0.5%;
    padding-bottom: 0.5%;
    font-size: 12px;
    text-align: left;
    font-weight: bolder;
    font-family: 'Open Sans', sans-serif;
}

.box p{
    padding-top: 0.5%;
    padding-bottom: 0.5%;
    font-size: 12px;
    text-align: left;
    font-family: 'Open Sans', sans-serif;
}

.content{
    text-align: center;
    padding-top: 0%;
}

button{
    font-family: 'Open Sans', sans-serif;
    width: 200px;
    padding: 15px 0;
    text-align: center;
    margin: 20px 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 4px solid white ;
    background: transparent;
    color: black ;
    cursor: pointer;
    position: center;
    overflow: hidden;
}

span{
    font-family: 'Open Sans', sans-serif;
    background: #CEC5FF ;
    height: 100%;
    width: 0;
    border-radius: 25px;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
    transition: 0.5s;
}

button:hover{
  font-family: 'Open Sans', sans-serif;
  width: 200px;
  padding: 15px 0;
  text-align: center;
  margin: 20px 10px;
  border-radius: 25px;
  font-weight: bold;
  border: 4px solid transparent;
  background: transparent;
  color: black ;
  cursor: pointer;
  position: center;
  overflow: hidden;
}

</style>
</head>
<body>
<div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="databasemenu.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                </ul>
            </div>
  </div>
<div class = "context">
<?php 
//Header of focal sequence
$Fasta1 = file_get_contents("TempFastaFiles/singlefasta_fasta.fasta");
$ExplodeFasta1 = explode("\n",$Fasta1);
$header_fasta1 = $ExplodeFasta1[0];

echo "<h1>Genetic distance</h1>";
?>
<div class="box">
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
        $str_name = file_get_contents("Distance_stuff/output/seqname.php");
        $output_name = explode("\n",$str_name);
        $count_name = count($output_name);
        //Genetic distance
        $str_dist = file_get_contents("Distance_stuff/output/output.php");
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
</div>

<div class="content">
  <div>
        <button id = "b7" onclick="location.href = '../Database/Calculate.php';" type="button">Go back</button>
  </div>
</div>
</div>
</body>
</html>
