<?php 
include('../../config/connection.php');
$value = mysqli_real_escape_string($dbc, $_POST['value']);
$id = mysqli_real_escape_string($dbc, $_POST['id']); 
$q = "UPDATE settings SET value = '$value' WHERE id = '$id'";
mysqli_query($dbc, $q); 
?>