<div id="bg">					
  <?php include(D_TEMPLATE.'/header.php'); ?>
  <div class="center-wrap">
    <div class="body-wrap">    
      <?php include(D_TEMPLATE.'/sidebar.php'); ?>      
      <main id="main-content">	
          
        <h1><?php echo stripslashes($page['header']); ?></h1>
        
        <?php echo stripslashes($page['body_formatted']); ?>

        <form id="contact-form" method="POST">
        <p>
        <label for="name">Your Name:</label><br>
        <input id="name" type="text" name="name" required="required">       
        <input id="botstomper" type="text" name="lname" autocomplete="off"/>
        </p>
        <p>
        <label for="email">Email Address:</label><br>
        <input id="email" type="email" name="email"  required="required"><br>
        </p>
        <p>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"  required="required"></textarea>
        </p>         
        <input id="contact_submit" class="submit" type="submit" value="Submit">
        </form>
        <div class="blab-box"><div id="status-message"></div></div>
        <?php if($contact_w1 != ""){ ?>
          <!-- WIDGET 1 -->
          <div class="contact-body">
            <?php echo stripslashes($contact_w1); ?>
          </div><!-- .contact-body -->
        <?php } ?>  
        
        <?php if($contact_w2 != ""){ ?>
          <!-- WIDGET 2 -->
          <div class="contact-body">
            <?php echo stripslashes($contact_w2); ?>
          </div><!-- .contact-body -->
        <?php } ?>
                    
      </main>
    </div><!-- #center-wrap -->      
  </div><!-- #center-wrap -->		
  <?php include(D_TEMPLATE.'/footer.php'); ?>
</div><!-- #bg -->