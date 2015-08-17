<h1><i class="fa fa-retweet"></i>&nbsp;&nbsp;Slider Settings</h1>
<?php include('functions/message.php'); ?> 
  <h3 class="settings-title">Slider 1</h3>
  <section class="content-wrap">    		
  <?php 
    $q = "SELECT * FROM sliders WHERE section = 1 ORDER BY position ASC";
    $r = mysqli_query($dbc, $q);
    while($opened = mysqli_fetch_assoc($r)) { ?>
    <form class="settings-form" action="index.php?page=sliders&id=<?php echo $opened['id']; ?>" method="post" role="form">
      <table>
        <tr>          
          <td>	
          <input class="form-input-hidden" type="text" name="id" value="<?php echo $opened['id']; ?>" autocomplete="off"/>
          <input class="form-input-hidden" type="text" name="label" value="<?php echo $opened['label']; ?>" autocomplete="off"/>            
          </td>  
          <td class="label-table">
            <label>Image:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="value" value="<?php echo $opened['value']; ?>" autocomplete="off" placeholder="Image Path..."/>			
          </td>
          <td class="label-table2">
            <label>Alt:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="alt" value="<?php echo $opened['alt']; ?>" autocomplete="off" placeholder="Image Description..."/>		
          </td>
          <td class="label-table2">
            <label>Link:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="url" value="<?php echo $opened['url']; ?>" autocomplete="off" placeholder="Image Link..."/>		
          </td>
          <td>
            <button type="submit" class="submit">Save</button>
          </td>        
        </tr>
      </table>
      <input type="hidden" name="submitted" value="1"/>      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"/> 
    </form> 
  <?php } ?>
    <p>* Image dimensions for a Default page are 640X200 px</p> 
    <p>* Image dimensions for a Full Width page are 1024X275 px</p> 
  </section><!-- .content-wrap -->

  <h3 class="settings-title">Slider 2</h3>
  <section class="content-wrap">     		
  <?php 
    $q = "SELECT * FROM sliders WHERE section = 2 ORDER BY position ASC";
    $r = mysqli_query($dbc, $q);
    while($opened = mysqli_fetch_assoc($r)) { ?>
    <form class="settings-form" action="index.php?page=sliders&id=<?php echo $opened['id']; ?>" method="post" role="form">
      <table>
        <tr>          
          <td>	
          <input class="form-input-hidden" type="text" name="id" value="<?php echo $opened['id']; ?>" autocomplete="off"/>
          <input class="form-input-hidden" type="text" name="label" value="<?php echo $opened['label']; ?>" autocomplete="off"/>            
          </td>  
          <td class="label-table">
            <label>Image:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="value" value="<?php echo $opened['value']; ?>" autocomplete="off" placeholder="Image Path..."/>			
          </td>
          <td class="label-table2">
            <label>Alt:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="alt" value="<?php echo $opened['alt']; ?>" autocomplete="off" placeholder="Image Description..."/>		
          </td>
          <td class="label-table2">
            <label>Link:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="url" value="<?php echo $opened['url']; ?>" autocomplete="off" placeholder="Image Link..."/>		
          </td>
          <td>
            <button type="submit" class="submit">Save</button>
          </td>        
        </tr>
      </table>
      <input type="hidden" name="submitted" value="1"/>      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"/> 
    </form> 
  <?php } ?>
    <p>* Image dimensions for a Default page are 640X200 px</p> 
    <p>* Image dimensions for a Full Width page are 1024X275 px</p> 
  </section><!-- .content-wrap -->
  
  <h3 class="settings-title">Slider 3</h3>
  <section class="content-wrap">      		
  <?php 
    $q = "SELECT * FROM sliders WHERE section = 3 ORDER BY position ASC";
    $r = mysqli_query($dbc, $q);
    while($opened = mysqli_fetch_assoc($r)) { ?>
    <form class="settings-form" action="index.php?page=sliders&id=<?php echo $opened['id']; ?>" method="post" role="form">
      <table>
        <tr>          
          <td>	
          <input class="form-input-hidden" type="text" name="id" value="<?php echo $opened['id']; ?>" autocomplete="off"/>
          <input class="form-input-hidden" type="text" name="label" value="<?php echo $opened['label']; ?>" autocomplete="off"/>            
          </td>  
          <td class="label-table">
            <label>Image:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="value" value="<?php echo $opened['value']; ?>" autocomplete="off" placeholder="Image Path..."/>			
          </td>
          <td class="label-table2">
            <label>Alt:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="alt" value="<?php echo $opened['alt']; ?>" autocomplete="off" placeholder="Image Description..."/>		
          </td>
          <td class="label-table2">
            <label>Link:</label>
          </td>  
          <td>
            <input class="form-input" type="text" name="url" value="<?php echo $opened['url']; ?>" autocomplete="off" placeholder="Image Link..."/>		
          </td>
          <td>
            <button type="submit" class="submit">Save</button>
          </td>        
        </tr>
      </table>
      <input type="hidden" name="submitted" value="1"/>      
      <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>"/> 
    </form> 
  <?php } ?>
    <p>* Image dimensions for a Default page are 640X200 px</p> 
    <p>* Image dimensions for a Full Width page are 1024X275 px</p>
  </section><!-- .content-wrap -->