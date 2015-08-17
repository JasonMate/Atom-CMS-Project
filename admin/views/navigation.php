<h1><i class="fa fa-globe"></i>&nbsp;&nbsp;Navigation</h1>
<?php include('functions/message.php'); ?>
  <h3 class="settings-title">Add New</h3>
  <section class="content-wrap">
  <form class="nav-form add-nav" action="index.php?page=navigation" method="post" role="form">
    <table>
      <tr>
        <td>
          <p><strong>Label:</strong></p>
        </td>
        <td>
          <input class="form-input" type="text" name="label" placeholder="Label for link..." autocomplete="off">
        </td>
        <td>
          <p>* Include label for menu link.</p>
        </td>
      </tr>
      <tr>
        <td>
          <p><strong>Url:</strong></p>
        </td>
        <td>
          <input class="form-input" type="text" name="url" placeholder="Link path..." autocomplete="off">
        </td>
        <td>
          <p>* Include page URL for menu link.</p>
        </td>          
      </tr>
      <tr>
        <td>
          <p><strong>Icon:</strong></p>
        </td>
        <td>
          <input class="form-input" type="text" name="Icon" placeholder="Font Awesome icon..." autocomplete="off">
        </td>
        <td>
          <p>* Include icon for menu link. (<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="new">Font Awesome</a>)</p>
        </td>          
      </tr>
      <tr>
        <td>
          <p><strong>Sub:</strong></p>
        </td>
        <td>
          <input class="form-input" type="text" name="sub" placeholder="Sub-menu item?" autocomplete="off">
        </td>
        <td>
          <p>* Include position for submenu to appear.</p>
        </td>
      </tr>
      <tr>
        <td>
          <p><strong>Position:</strong></p>
        </td>
        <td>
          <input class="form-input" type="text" name="position" placeholder="Position of link..." autocomplete="off">
        </td>
        <td>
          <p>* Menu items are sorted by position.</p>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button type="submit" name="submit" class="submit" style="width:98%;">+ Add to Menu</button>
          <input type="hidden" name="submitted" value="2">        
        </td>
        <td></td>
      </tr>
    </table>
  </form>
  </section><!-- .content-wrap -->  
  <h3 class="settings-title">Main Navigation</h3>	
  <section class="content-wrap">		
<?php 
  $q = "SELECT * FROM navigation ORDER BY sub, position ASC";
  $r = mysqli_query($dbc, $q);    
  while($opened = mysqli_fetch_assoc($r)) { ?>
    
  <form id="nav_<?php echo $opened['id']; ?>" class="nav-form edit-nav" action="index.php?page=navigation&id=<?php echo $opened['id']; ?>" method="post" role="form">
    <table class="nav-table">
      <tr> 
        <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
        <td>
        <label for="label">Label:</label>
        </td>
        <td>
        <input class="form-input" type="text" name="label" id="label" value="<?php echo stripslashes($opened['label']); ?>" placeholder="Label" autocomplete="off">
        </td>
        <td>
        <label for="url">Url:</label>
        </td>
        <td>
        <input class="form-input" type="text" name="url" id="url" value="<?php echo $opened['url']; ?>" placeholder="Url" autocomplete="off">
        </td>
        <td>
        <label for="icon">Icon:</label>
        </td>
        <td>
        <input class="form-input" type="text" name="icon" id="icon" value="<?php echo htmlentities($opened['icon']); ?>" placeholder="Icon" autocomplete="off">
        </td>
        <td>
        <label for="sub">Sub:</label>
        </td>
        <td>
        <input class="form-input" type="number" name="sub" id="sub" value="<?php echo $opened['sub']; ?>" min="0" max="20" step="1" autocomplete="off">
        </td>
        <td>
        <label for="position">Position:</label>
        </td>
        <td>
        <input class="form-input" type="number" name="position" id="position" value="<?php echo $opened['position']; ?>" min="0" max="20" step="1" autocomplete="off">
        </td>
        <td>
        <button type="submit" class="submit">Update</button>
        <input type="hidden" name="submitted" value="1">
        
        <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>">
        </td>
        <td>
        <button id="del_<?php echo $opened['id']; ?>" class="btn-delete-nav delete-img"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
    </table>
 </form>    
<?php } ?>
</section><!-- .content-wrap -->
<script type="text/javascript">
// *****************************************************************************************
// Delete navigation - delete_nav.php
$(document).ready(function() {
  $(".btn-delete-nav").on("click", function() {
  
    var selected = $(this).attr("id");
    var navid = selected.split("del_").join("");
    var confirmed = confirm("Are you sure you want to delete this link from menu?");
    
    if(confirmed == true) {      
      $.get("functions/delete_nav.php?id="+navid);      
      $("#nav_"+navid).remove();				      
    } 
       
  });
});
// *****************************************************************************************
</script>