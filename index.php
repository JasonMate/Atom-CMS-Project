<?php include('config/setup.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
	<title>
  <?php 
    if(isset($page['title']) != ''){ echo stripslashes($page['title']).' | '.stripslashes($site_title); } 
    else if(isset($post['title']) != ''){ echo stripslashes($post['title']).' | '.stripslashes($site_title); } 
    else { echo $site_title; }
  ?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php if($site_author != ""){ ?><meta name="author" content="<?php echo $site_author ?>"/><?php } ?>
  <?php if($site_description != ""){ ?><meta name="description" content="<?php echo $site_description ?>"/><?php } ?> 
  <?php if($site_keywords != ""){ ?><meta name="keywords" content="<?php echo $site_keywords ?>"/><?php } ?>	
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<?php include('config/css.php'); ?>
  <!--<script type="text/javascript" src="js/modernizr_custom.js"></script> for testing browsers-->
</head>	
<body>  
  <?php if(isset($page['id']) != '') { include(D_TEMPLATE.'/views/'.$view['name'].'.php'); ?> 
       
  <?php } else if(isset($post['id']) != '') { include(D_TEMPLATE.'/views/post.php'); ?>  
                   
  <?php } else { include(D_TEMPLATE.'/views/custom404.php'); } ?>
  
  <a href="#" class="go-top"><i class="fa fa-arrow-up"></i></a>
  <?php include('config/js.php'); ?>
  <?php if($debug == 1) { include('plugins/debug.php'); } ?>    
</body>
</html>