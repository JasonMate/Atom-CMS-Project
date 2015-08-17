<?php 
include('../../config/connection.php');
$gallery = $_POST['gallery'];
$id = $_POST['id']; 
$q = "UPDATE images SET gallery = '$gallery' WHERE id = $id";
mysqli_query($dbc, $q); 
?>