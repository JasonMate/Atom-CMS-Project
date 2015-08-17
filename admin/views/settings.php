<h1><i class="fa fa-wrench"></i>&nbsp;&nbsp;Site Settings</h1>
<?php include('functions/message.php'); ?>
  
<h3 class="settings-title">General Settings</h3> 
<section class="content-wrap">       		
<?php 
  $q = "SELECT * FROM settings WHERE section = 1 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>        
  <div class="settings-form">
    <table>
      <tr>  
        <td class="label-table">
          <label><?php echo $opened['label']; ?>:</label>
        </td>  
        <td>
          <input class="form-input setting-value" data-id="<?php echo $opened['id']; ?>" type="text" name="value" value="<?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $opened['value'])); ?>" autocomplete="off">			
        </td>
        <td>
          <button type="submit" class="submit">Save</button>
        </td>
        <td>
          <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>
        </td>                
      </tr>
    </table> 
  </div>        
<?php } ?>  
</section><!-- .content-wrap -->
    
<h3 class="settings-title">SEO Settings</h3>
<section class="content-wrap">      		
<?php 
  $q = "SELECT * FROM settings WHERE section = 2 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>    
  <div class="settings-form">
    <table>
      <tr>  
        <td class="label-table">
          <label><?php echo $opened['label']; ?>:</label>
        </td>  
        <td>
          <input class="form-input setting-value" data-id="<?php echo $opened['id']; ?>" type="text" name="value" value="<?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $opened['value'])); ?>" autocomplete="off">			
        </td>
        <td>
          <button type="submit" class="submit">Save</button>
        </td>
        <td>
          <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>
        </td>                
      </tr>
    </table> 
  </div>     
<?php } ?>
</section><!-- .content-wrap -->
 
<h3 class="settings-title">Social Settings</h3>
<section class="content-wrap">      		
<?php 
  $q = "SELECT * FROM settings WHERE section = 3 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>    
  <div class="settings-form">
    <table>
      <tr>  
        <td class="label-table">
          <label><?php echo $opened['label']; ?>:</label>
        </td>  
        <td>
          <input class="form-input setting-value" data-id="<?php echo $opened['id']; ?>" type="text" name="value" value="<?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $opened['value'])); ?>" autocomplete="off">			
        </td>
        <td>
          <button type="submit" class="submit">Save</button>
        </td>
        <td>
          <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>
        </td>                
      </tr>
    </table> 
  </div>     
<?php } ?>
</section><!-- .content-wrap --> 
  
<h3 class="settings-title">Post Filters</h3>
<section class="content-wrap">     		
<?php 
  $q = "SELECT * FROM settings WHERE section = 4 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>    
  <div class="settings-form">
    <table>
      <tr>  
        <td class="label-table">
          <label><?php echo $opened['label']; ?>:</label>
        </td>  
        <td>
          <input class="form-input setting-value" data-id="<?php echo $opened['id']; ?>" type="text" name="value" value="<?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $opened['value'])); ?>" autocomplete="off">			
        </td>
        <td>
          <button type="submit" class="submit">Save</button>
        </td>
        <td>
          <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>
        </td>                
      </tr>
    </table> 
  </div>    
<?php } ?> 
</section><!-- .content-wrap --> 
<script type="text/javascript">
// *****************************************************************************************
$(document).ready(function() {   
  $(".form-input").blur(function(){
     var id = $(this).attr('data-id');
     var value = $(this).val();
     value.replace("\'", "xescapequotex");
     $.post('functions/settings.php', {id: id, value: value}, function(result) {});       
  });         
}); 
// *****************************************************************************************   
</script>