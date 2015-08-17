<?php
  @$user_id = $_POST['user_id']; 
	$q = "SELECT * FROM users WHERE id = $user_id";	
	$r = mysqli_query($dbc, $q);

	@$data = mysqli_fetch_assoc($r);	  
	@$data['fullname'] = $data['first'].' '.$data['last'];
  @$status = $data['status'];
  @$pic = $data['avatar'];
  @$bio = stripslashes($data['bio']);
  
  @$authg = $data['authg'];
  @$autht = $data['autht'];
  @$authl = $data['authl'];
?> 
  <div id="bg">					
    <?php include(D_TEMPLATE.'/header.php'); ?>
    <div class="center-wrap"> 
      <div class="body-wrap"> 
        <?php include(D_TEMPLATE.'/sidebar.php'); ?>      
        <main id="main-content">
             
          <?php if($status == 0) { ?> 
            <h1>This profile is private.</h1>                    
          <?php } else { ?> 
          
            <h1><?php echo stripslashes($data['first']).' '.stripslashes($data['last']); ?></h1>	
            
            <?php if($pic != "") { ?>
            <img src="<?php echo $site_url.'/admin/uploads/'.$data['avatar'] ?>" class="profile-pic" alt="<?php echo stripslashes($data['first']).' '.stripslashes($data['last']); ?>'s profile picture."/>
            <?php } ?>
            
            <?php if($bio != ""){ ?>
              <?php echo $bio; ?>
            <?php } ?>
            
            <?php if($authg != "" || $autht != "" || $authl != "") { ?>           
              <div class="social-profiles">
                <?php if($authg != ""){ ?>
                  <div><a href="<?php echo $authg; ?>" title="Circle me on Google+"><i class="fa fa-google-plus fa-4x"></i></a></div>
                <?php } ?>
                <?php if($authl != ""){ ?>
                  <div><a href="<?php echo $authl; ?>" title="Follow me on LinkedIn"><i class="fa fa-linkedin fa-5x"></i></a></div>
                <?php } ?>
                <?php if($autht != ""){ ?>
                  <div><a href="<?php echo $autht; ?>" title="Follow me on Twitter"><i class="fa fa-twitter fa-5x"></i></a></div>
                <?php } ?>
              </div><!-- .social-profiles -->              
            <?php } ?>
                        
          <?php } ?> 
        </main> 
      </div><!-- .body-wrap -->     
    </div><!-- #center-wrap -->		
  <?php include(D_TEMPLATE.'/footer.php'); ?>
  </div><!-- #bg -->