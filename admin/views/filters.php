<?php include('functions/message.php'); ?>
<h1><i class="fa fa-filter"></i>&nbsp;&nbsp;Post Filters</h1>
<h3 class="settings-title">Add New Filter</h3>
<section class="content-wrap">
<form class="nav-form add-nav" action="index.php?page=filters" method="post" role="form">
  <table>
    <tr>
      <td>
        <p><strong>Label:</strong></p>
      </td>
      <td>
        <input class="form-input" type="text" name="label" placeholder="Label for link" autocomplete="off">
      </td>
      <td>
        <p>* Include label for new search filter item.</p>
      </td>
    </tr>
          
    <tr>
      <td>
        <p><strong>Filter:</strong></p>
      </td>
      <td>
        <select class="form-input" name="type" style="width: 99%;">
        <?php if($filter1_name != ""){?><option value="1"><?php echo $filter1_name; ?></option><?php } ?>
        <?php if($filter2_name != ""){?><option value="2"><?php echo $filter2_name; ?></option><?php } ?>
        <?php if($filter3_name != ""){?><option value="3"><?php echo $filter3_name; ?></option><?php } ?>
        </select>
      </td>
      <td>
        <p>* Choose one of the three filter types. (1, 2, 3)</p>
      </td>
    </tr>      
          
    <tr>
      <td>
        <p><strong>Position:</strong></p>
      </td>
      <td>
        <input class="form-input" type="text" name="position" placeholder="Position of link" autocomplete="off">
      </td>
      <td>
        <p>* Search filter items are sorted by position. (#)</p>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <button type="submit" name="submit" class="submit">+ Add Search Filter</button>
        <input type="hidden" name="submitted" value="2">        
      </td>
      <td></td>
    </tr>
  </table>
</form>
</section><!-- .content-wrap -->
  
<?php if($filter1_name != '') { ?>    
  <h3 class="settings-title">Filter 1<?php echo " - ".$filter1_name; ?></h3>
  <section class="content-wrap">		
<?php 
  $q = "SELECT * FROM filters WHERE type = 1 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);    
  while($opened = mysqli_fetch_assoc($r)) { 
  // create label for select
  if($opened['type'] == '1'){
   $filter_label = $filter1_name; 
  } else if($opened['type'] == '2'){
    $filter_label = $filter2_name; 
  } else if($opened['type'] == '3'){
    $filter_label = $filter3_name; 
  } else {
    $filter_label = ''; 
  }  
?>    
  <form id="fil_<?php echo $opened['id']; ?>" class="nav-form edit-nav" action="index.php?page=filters&id=<?php echo $opened['id']; ?>" method="post" role="form">
    <table class="nav-table">
      <tr> 
        <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
        <td>
        <label for="label">Label:</label>
        </td>
        <td>
        
        <input class="form-input" type="text" name="label" id="label" value="<?php echo preg_replace('/xescapequotex/', '\'', $opened['label']); ?>" placeholder="Label" autocomplete="off">
        </td>        
        <td>
        <label for="type">Filter:</label>
        </td>
        <td>
          <select class="form-input" name="type">
          <option value="<?php echo $opened['type']; ?>"><?php echo $filter_label; ?></option>
          <?php if($filter_label != $filter1_name){ if($filter1_name != ""){?><option value="1"><?php echo $filter1_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter2_name){ if($filter2_name != ""){?><option value="2"><?php echo $filter2_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter3_name){ if($filter3_name != ""){?><option value="3"><?php echo $filter3_name; ?></option><?php } } ?>
          </select>
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
        <button id="del_<?php echo $opened['id']; ?>" class="btn-delete-filter delete-img"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
    </table>
 </form>    
<?php } ?>
</section><!-- .content-wrap -->
<?php } ?>

<?php if($filter2_name != '') { ?>
<h3 class="settings-title">Filter 2<?php echo " - ".$filter2_name; ?></h3>
<section class="content-wrap">		
<?php 
  $q = "SELECT * FROM filters WHERE type = 2 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);    
  while($opened = mysqli_fetch_assoc($r)) { 
  // create label for select
  if($opened['type'] == '1'){
   $filter_label = $filter1_name; 
  } else if($opened['type'] == '2'){
    $filter_label = $filter2_name; 
  } else if($opened['type'] == '3'){
    $filter_label = $filter3_name; 
  } else {
    $filter_label = ''; 
  }
?>
    
  <form id="fil_<?php echo $opened['id']; ?>" class="nav-form edit-nav" action="index.php?page=filters&id=<?php echo $opened['id']; ?>" method="post" role="form">
    <table class="nav-table">
      <tr> 
        <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
        <td>
        <label for="label">Label:</label>
        </td>
        <td>
        <input class="form-input" type="text" name="label" id="label" value="<?php echo preg_replace('/xescapequotex/', '\'', $opened['label']); ?>" placeholder="Label" autocomplete="off">
        </td>        
        <td>
        <label for="type">Filter:</label>
        </td>
        <td>
          <select class="form-input" name="type">
          <option value="<?php echo $opened['type']; ?>"><?php echo $filter_label; ?></option>
          <?php if($filter_label != $filter1_name){ if($filter1_name != ""){?><option value="1"><?php echo $filter1_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter2_name){ if($filter2_name != ""){?><option value="2"><?php echo $filter2_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter3_name){ if($filter3_name != ""){?><option value="3"><?php echo $filter3_name; ?></option><?php } } ?>
          </select>        
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
        <button id="del_<?php echo $opened['id']; ?>" class="btn-delete-filter delete-img"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
    </table>
 </form>    
<?php } ?>
</section><!-- .content-wrap -->
<?php } ?>

<?php if($filter3_name != '') { ?>
<h3 class="settings-title">Filter 3<?php echo " - ".$filter3_name; ?></h3>
<section class="content-wrap">		
<?php 
  $q = "SELECT * FROM filters WHERE type = 3 ORDER BY position ASC";
  $r = mysqli_query($dbc, $q);    
  while($opened = mysqli_fetch_assoc($r)) { 
  // create label for select
  if($opened['type'] == '1'){
   $filter_label = $filter1_name; 
  } else if($opened['type'] == '2'){
    $filter_label = $filter2_name; 
  } else if($opened['type'] == '3'){
    $filter_label = $filter3_name; 
  } else {
    $filter_label = ''; 
  }  
?>
    
  <form id="fil_<?php echo $opened['id']; ?>" class="nav-form edit-nav" action="index.php?page=filters&id=<?php echo $opened['id']; ?>" method="post" role="form">
    <table class="nav-table">
      <tr> 
        <input class="form-input-hidden" type="text" name="id" id="id" value="<?php echo $opened['id']; ?>" autocomplete="off">
        <td>
        <label for="label">Label:</label>
        </td>
        <td>
        <input class="form-input" type="text" name="label" id="label" value="<?php echo preg_replace('/xescapequotex/', '\'', $opened['label']); ?>" placeholder="Label" autocomplete="off">
        </td>        
        <td>
        <label for="type">Filter:</label>
        </td>
        <td>
          <select class="form-input" name="type">
          <option value="<?php echo $opened['type']; ?>"><?php echo $filter_label; ?></option>
          <?php if($filter_label != $filter1_name){ if($filter1_name != ""){?><option value="1"><?php echo $filter1_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter2_name){ if($filter2_name != ""){?><option value="2"><?php echo $filter2_name; ?></option><?php } } ?>
          <?php if($filter_label != $filter3_name){ if($filter3_name != ""){?><option value="3"><?php echo $filter3_name; ?></option><?php } } ?>
          </select>       
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
        <button id="del_<?php echo $opened['id']; ?>" class="btn-delete-filter delete-img"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
    </table>
 </form>    
<?php } ?>
</section><!-- .content-wrap -->
<?php } ?>
<script type="text/javascript">
// *****************************************************************************************
// Delete navigation - delete_nav.php
$(document).ready(function() {
  $(".btn-delete-filter").on("click", function() {
  
    var selected = $(this).attr("id");
    var filterid = selected.split("del_").join("");
    var confirmed = confirm("Are you sure you want to delete this post filter?");
    
    if(confirmed == true) {
      
      $.get("functions/delete_filter.php?id="+filterid);
      
      $("#fil_"+filterid).remove();				
      
    }
    
  });
});
// *****************************************************************************************
</script>
