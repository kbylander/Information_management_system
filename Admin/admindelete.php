<?php
if(isset($_POST['submit_users'])){
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $usernames = "('".join("','",$selected)."')";
    $query = "UPDATE users SET active = 0 WHERE username IN '$usernames'";
    include '../connectDB.php';
    $result = mysqli_query($link, $query);
    include '../disconnectDB.php';

    echo $selected;
    echo $usernames;
    //header('Location: admin.php');
  }
}
?>
