<header id="header">
  <div class="center-wrap">
  
  <div class="header-widget">
    <?php echo stripslashes($header_w1); ?>
  </div><!-- .header-widget --> 
    
    <!-- LOGO -->
    <?php if($site_logo != ""){ ?>
      <a href="<?php echo $site_url; ?>"><img id="logo-img" src="<?php echo $site_logo; ?>" alt="<?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $site_title)); ?>"/></a>
    <?php }else{ ?>
      <a href="<?php echo $site_url; ?>" id="logo-link"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $site_title)); ?></a>
    <?php } ?>
    
  </div><!-- .center-wrap -->
  <?php include(D_TEMPLATE.'/main-nav.php'); ?>
</header>