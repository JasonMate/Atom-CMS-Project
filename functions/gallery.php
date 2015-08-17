<?php  //ajax
include('../config/connection.php');
$limit = $_GET['limit'];
$start = $_GET['start'];

function setting_value($dbc, $id){
	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
	return $data['value'];	
}
$site_url = setting_value($dbc, 'site-url');

$q = "SELECT * FROM images WHERE status = 1 ORDER BY id DESC LIMIT $start,$limit";
$r = mysqli_query($dbc, $q);
?>
<?php while($images = mysqli_fetch_assoc($r)){ ?>
    <div class="gal-tile">                
       <a class="fancybox" rel="group" href="<?php echo $images['path']; ?>"><img class="tile-img" src="<?php echo $images['path']; ?>" alt="<?php echo stripslashes($images['alt']); ?>" /></a>   
    </div>
<?php } ?>