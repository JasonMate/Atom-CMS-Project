<?php
include('../../config/connection.php');
$ds = DIRECTORY_SEPARATOR;
$id = $_GET['id'];

$storeFolder = '../uploads';
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$newname = time();
$random = rand(100,999);
$name = $newname.$random.'.'.$ext;

$q = "SELECT avatar FROM users WHERE id = $id";
$r = mysqli_query($dbc, $q);
$old = mysqli_fetch_assoc($r);

$q = "UPDATE users SET avatar = '$name' WHERE id = $id";
$r = mysqli_query($dbc, $q);
 
echo $q.'<br>';
echo mysqli_error($dbc);
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                 
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;     
    $targetFile =  $targetPath. $name;
 
    move_uploaded_file($tempFile,$targetFile);       
    $deleteFile = $targetPath.$old['avatar'];

    if($old['avatar'] != '') {    	
      if(!is_dir($deleteFile)) {  
        unlink($deleteFile);  
      }
    }
  
}
?>