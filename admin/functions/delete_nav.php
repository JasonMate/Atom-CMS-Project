<?php
include('../../config/connection.php');
$id = $_GET['id'];	
$q = "DELETE FROM navigation WHERE id = $id";
$r = mysqli_query($dbc,$q);
?>