	<div id="bg">					
		<?php include(D_TEMPLATE.'/header.php'); ?>
    
    <div class="center-wrap"> 
      <div class="body-wrap"> 
        <?php include(D_TEMPLATE.'/sidebar.php'); ?>      
        <main id="main-content">   
          <?php     
          if($page['slider'] !== 0){
            if($page['slider'] == 1){ include('plugins/sliders/slider1.php'); }
            if($page['slider'] == 2){ include('plugins/sliders/slider2.php'); }
            if($page['slider'] == 3){ include('plugins/sliders/slider3.php'); }
          }?> 
                       		
          <h1><?php echo stripslashes($page['header']); ?></h1>	
          <?php echo stripslashes($page['body_formatted']); ?>
          	
        </main> 
      </div><!-- .body-wrap -->     
    </div><!-- #center-wrap -->		
	<?php include(D_TEMPLATE.'/footer.php'); ?>			
  </div><!-- #bg -->
