<?php 
include('../../config/connection.php');
$status = $_POST['status'];
$id = $_POST['id'];
if($status == 1){
  $q = "UPDATE images SET status = 1 WHERE id = $id";
  mysqli_query($dbc, $q);
} else {
  $q = "UPDATE images SET status = 0 WHERE id = $id";
  mysqli_query($dbc, $q);   
} 
?>