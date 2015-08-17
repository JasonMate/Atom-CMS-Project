<?php
include('../../config/connection.php');
$q = "SELECT * FROM settings WHERE id = 'site-url'";
$r = mysqli_query($dbc, $q);
$data = mysqli_fetch_assoc($r);
$site_url = $data['value'];
$ds = DIRECTORY_SEPARATOR;
$storeFolder = '../../images';
$time = time();
$name = $_FILES['file']['name'];

if(!empty($_FILES)) { 
  
  $tempFile = $_FILES['file']['tmp_name'];           
  $targetPath = dirname( __FILE__ ) . $ds . $storeFolder . $ds;   
  $targetFile =  $targetPath. $name; 
    
  $p = '../../images/'.$name; 
    
  $q = "SELECT path FROM images WHERE path = '$p'"; 
  $r = mysqli_query($dbc, $q);
   
  $alt = $_POST['alt'];
  $path = $_POST['path'];
 
  if(move_uploaded_file($tempFile,$targetFile)){ 
    
    if(mysqli_fetch_assoc($r) == false){
      $q = "INSERT INTO images (path, alt, status) VALUES ('$site_url/images/$name', '$alt', 0)";
      $r = mysqli_query($dbc, $q);
    }    
  }  
    
} 
?>