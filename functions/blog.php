<?php  //ajax
include('../config/connection.php');
date_default_timezone_set('America/Boise');
$limit = $_GET['limit'];
$start = $_GET['start'];


function setting_value($dbc, $id){
	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
	return $data['value'];	
}
$site_url = setting_value($dbc, 'site-url');

function data_user($dbc, $id) {
	$q = "SELECT * FROM users WHERE id = '$id'";	
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);	
	$data['fullname'] = $data['first'].' '.$data['last'];  
	return $data;
}

$q = "SELECT * FROM posts ORDER BY id DESC LIMIT $start,$limit";
$r = mysqli_query($dbc, $q);
?>
<?php while($post = mysqli_fetch_assoc($r)){  $user = data_user($dbc, $post['user']); ?>
    <div class="post-excerpt">
    <a  class="post-title" href="<?php echo $site_url . "/" . $post['slug']; ?>">
    <h2><?php echo stripslashes($post['header']); ?></h2>
    </a>   
    <!-- <span class="post-date"><?php //echo "Posted by: ".$post['user']." | ".date('F j, Y',strtotime($post['date'])); ?></span>-->

    <?php if($post['user'] == '0'){ ?>             
     <span class="post-date">Posted On: <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
    <?php } else { ?>           
    <span class="post-date">Posted by: <a href="<?php echo $site_url.'/profile?id='.$post['user']; ?>"><?php echo stripslashes($user['fullname']); ?></a> | <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
    <?php } ?>   
   
    <?php if($post['thumbnail'] != '') { ?>
    <a href="<?php echo $site_url . "/" . $post['slug']; ?>">
    <div class="post-image" style="background-image: url(<?php echo $post['thumbnail'] ?>);"></div>
    </a>
    <?php } ?>
    <p><?php echo strip_tags(stripslashes(substr($post['body'], 0, 200))); ?>...</p>
    <a class="post-link" href="<?php echo $site_url . "/" . $post['slug']; ?>">Read More</a>
    </div>
<?php } ?>