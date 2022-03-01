<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
  header("location:../index.php");
}
?>
