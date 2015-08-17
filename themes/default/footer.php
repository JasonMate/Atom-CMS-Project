<!-- *********************** FOOTER *********************** -->   
<footer id="footer">
  
  <div class="center-wrap"> 
    <!-- SOCIAL BUTTONS -->  
    <div class="social-box">
    
       <?php if($behance != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $behance; ?>" title="Follow me on Behance"><i class="fa fa-behance"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
    
       <?php if($github != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $github; ?>" title="Follow me on GitHub"><i class="fa fa-github"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>    
      
       <?php if($pinterest != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $pinterest; ?>" title="Follow me on Pinterest"><i class="fa fa-pinterest"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
      <?php if($linkedin != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $linkedin; ?>" title="Follow me on LinkedIn"><i class="fa fa-linkedin"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
      <?php if($youtube != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $youtube; ?>" title="Subscribe to my Youtube channel"><i class="fa fa-youtube"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
      <?php if($twitter != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $twitter; ?>" title="Follow me on Twitter"><i class="fa fa-twitter"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
      <?php if($google != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $google; ?>" title="Circle me on Google+"><i class="fa fa-google-plus"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
      <?php if($facebook != ""){ ?>
        <div class="social-widget">
          <a href="<?php echo $facebook; ?>" title="Like me on Facebook"><i class="fa fa-facebook"></i></a>
        </div><!-- .social-widget -->
      <?php } ?>
      
    </div><!-- .sociaL-box -->
            
    <?php if($copyright != ""){ ?>
      <!-- COPYRIGHT INFORMATION -->
      <p class="copyright"><strong><i class="fa fa-copyright"></i> <?php echo stripslashes($copyright); ?></strong></p>        
    <?php } ?>   
  </div><!-- .center-wrap -->
  
</footer>
