<?php
if(isset($_POST['submit_users'])){
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $selected_count = count($selected);
    echo $selected_count;

    include '../connectDB.php';
    for($i=0;$i<$selected_count;$i++) {
      $query = "UPDATE users SET active = CASE WHEN active = 0 THEN 1 WHEN active = 1 THEN 0 END WHERE username LIKE '$selected[$i]'";
      mysqli_query($link, $query);
    }
    include '../disconnectDB.php';
  }
  header('Location: admin.php');
}
elseif(isset($_POST['submit_users_admin'])){
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $selected_count = count($selected);

    include '../connectDB.php';
    for($i=0;$i<$selected_count;$i++) {
      $query = "UPDATE users SET admin = CASE WHEN admin = 0 THEN 1 WHEN admin = 1 THEN 0 END WHERE username LIKE '$selected[$i]'";
      mysqli_query($link, $query);
    }
    include '../disconnectDB.php';
  }
  header('Location: admin.php');
}
elseif(isset($_POST['submit_seq'])){
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $selected_count = count($selected);


    include '../connectDB.php';
    for($i=0;$i<$selected_count;$i++) {
      $query = "DELETE FROM sequence WHERE seqID LIKE '$selected[$i]'";
      mysqli_query($link, $query);
    }
    include '../disconnectDB.php';
  }
  header('Location: admin.php');
}
elseif(isset($_POST['submit_individuals'])){
  if(isset($_POST['selected'])){
    $selected = $_POST['selected'];
    $selected_count = count($selected);
    echo $selected_count;

    include '../connectDB.php';
    for($i=0;$i<$selected_count;$i++) {
      echo $selected[$i];
      $query = "DELETE FROM sequence WHERE entryID LIKE '$selected[$i]'";
      mysqli_query($link, $query);
      $query = "DELETE FROM entries WHERE entryID LIKE '$selected[$i]'";
      mysqli_query($link, $query);
    }
    include '../disconnectDB.php';
  }
  header('Location: admin.php');
}
else{
  //header('Location: admin.php');
}
?>
