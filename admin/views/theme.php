<h1><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Theme Settings</h1>
<?php include('functions/message.php'); ?>
  
<h3 class="settings-title">Site Theme</h3>
<section class="content-wrap">      		
<?php 
  $q = "SELECT * FROM settings WHERE section = 6 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>
  <form class="settings-form" action="index.php?page=theme&id=<?php echo $opened['id']; ?>" method="post" role="form">
    <table>
      <tr>          
        <td>	
        <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
        <input class="form-input-hidden" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" autocomplete="off">            
        </td>  
        <td class="label-table">
          <label for="value"><?php echo $opened['label']; ?>:</label>
        </td>  
        <td>
          <input class="form-input" type="text" name="value" id="value" value="<?php echo stripslashes($opened['value']); ?>" autocomplete="off">			
        </td>
        <td>
          <button type="submit" class="submit">Save</button>
        </td>
        <td>
          <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>
        </td>        
      </tr>
    </table>
    <input type="hidden" name="submitted" value="1">      
    <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"> 
  </form> 
<?php } ?>
</section><!-- .content-wrap -->

<h3 class="settings-title">Embedded CSS</h3>
<section class="content-wrap">      		
<?php 
  $q = "SELECT * FROM settings WHERE section = 8 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>
  
    <form class="settings-form" action="index.php?page=theme&id=<?php echo $opened['id']; ?>" method="post" role="form">

      <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
      <input class="form-input-hidden" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" autocomplete="off">            
      <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>

      <textarea class="child-css" name="value" id="value"><?php echo stripslashes($opened['value']); ?></textarea><br/>		

      <button type="submit" class="submit submit-css">Save</button>

      <input type="hidden" name="submitted" value="1">      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"> 
    
    </form> 
<?php } ?>
</section><!-- .content-wrap --> 
  
<h3 class="settings-title">Embedded Javascript</h3>
<section class="content-wrap">      		
<?php 
  $q = "SELECT * FROM settings WHERE section = 9 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);
  while($opened = mysqli_fetch_assoc($r)) { ?>
  
    <form class="settings-form" action="index.php?page=theme&id=<?php echo $opened['id']; ?>" method="post" role="form">

      <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
      <input class="form-input-hidden" type="text" name="label" id="label" value="<?php echo $opened['label']; ?>" autocomplete="off">            
      <p>&nbsp;&nbsp;*&nbsp;<?php echo $opened['description']; ?></p>

      <textarea class="child-css" name="value" id="value"><?php echo stripslashes($opened['value']); ?></textarea><br/>		

      <button type="submit" class="submit submit-css">Save</button>

      <input type="hidden" name="submitted" value="1">      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"> 
    
    </form> 
<?php } ?>
</section><!-- .content-wrap -->