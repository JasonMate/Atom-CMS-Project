<h1><i class="fa fa-cogs"></i>&nbsp;&nbsp;Widget Manager</h1>
<?php include('functions/message.php'); ?>
<section class="content-wrap">
  
  <div class="widget-section">

    <?php 
      $q = "SELECT * FROM widgets WHERE section = 1 OR section = 4 ORDER BY position ASC";
      $r = mysqli_query($dbc, $q);
  
      while($opened = mysqli_fetch_assoc($r)) { ?>
      <form class="widgets-form" action="index.php?page=widgets&id=<?php echo $opened['id']; ?>" method="post" role="form">
      <fieldset>
      <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
      <input class="form-input-hidden" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" autocomplete="off">
      
      <label><?php echo $opened['label']; ?></label>            
      <textarea rows="8" cols="30" name="value" id="value" placeholder="HTML Code Here..."><?php echo stripslashes($opened['value']); ?></textarea><br/>			
  
      <button type="submit" class="submit">Save</button>
      
      <input type="hidden" name="submitted" value="1">      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>">
      </fieldset> 
      </form> 
    <?php } ?>
  </div><!-- .widget-section -->
  
  <div class="widget-section">

    <?php 
      $q = "SELECT * FROM widgets WHERE section = 2 ORDER BY position ASC";
      $r = mysqli_query($dbc, $q);
  
      while($opened = mysqli_fetch_assoc($r)) { ?>
      <form class="widgets-form" action="index.php?page=widgets&id=<?php echo $opened['id']; ?>" method="post" role="form">
      <fieldset>
      <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
      <input class="form-input-hidden" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" autocomplete="off">
      
      <label><?php echo $opened['label']; ?></label>
      <textarea rows="8" cols="30" name="value" id="value" placeholder="HTML Code Here..."><?php echo stripslashes($opened['value']); ?></textarea><br/>			
  
      <button type="submit" class="submit">Save</button>
      
      <input type="hidden" name="submitted" value="1">      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>">
      </fieldset> 
      </form> 
    <?php } ?> 
  </div><!-- .widget-section --> 
  
</section><!-- .content-wrap -->