<?php
include('../../config/connection.php');
$id = $_GET['id'];
if($id != 26){
  $q = "DELETE FROM users WHERE id = $id";
  $r = mysqli_query($dbc,$q);
}
?>