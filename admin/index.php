<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
}
?>
<?php include('config/setup.php'); ?>
<!DOCTYPE html>
<html>	
<head>
  <meta charset="utf-8"/>
	<title><?php echo stripslashes($page['title']).' | '.stripslashes(preg_replace('/xescapequotex/', '\'', $site_title)); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include('config/css.php'); ?>	
	<?php include('config/js.php'); ?>
</head>	
<body>
	
	<div id="bg">					
		<?php include(D_TEMPLATE.'/header.php'); ?>
    <?php include(D_TEMPLATE.'/sidebar.php'); ?>
    <main id="admin-content">
      <?php include('views/'.$page.'.php'); ?>
    </main> 
  
	</div><!-- #bg -->		
	<?php if($debug == 1) { include('../plugins/debug.php'); } ?>	
</body>
</html>