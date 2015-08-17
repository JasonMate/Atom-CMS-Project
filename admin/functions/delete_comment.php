<?php
include('../../config/connection.php');
$id = $_GET['id'];	
$q = "DELETE FROM comments WHERE id = $id";
$r = mysqli_query($dbc,$q);
?>