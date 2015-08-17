<?php
// Delete image
include('../../config/connection.php');  
$image = $_POST['image'];
$url = $_POST['url'];
$file_name = str_replace("../..", "", $image);

if(file_exists($image)) {   
  if(unlink($image)){         
    $q = "DELETE FROM images WHERE path = '$url'";
    $r = mysqli_query($dbc,$q);
    echo 'File '.$file_name.' has been deleted';
  }     
}  
?>