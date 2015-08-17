<?php
include('functions/message.php');
$table_name = 'pages';
$page_name = 'pages';
$page_rows = 13;
include('./functions/pagination.php');
?>
<h1><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Page Manager</h1>
<aside class="content-side">
  <div id="pagination_wrap">
    <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
  </div>
	<a href="?page=pages" class="new-page"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Page</a>	
  				
  <?php   
    while($list = mysqli_fetch_array($r, MYSQLI_ASSOC)){ ?>
  
    <div id="post_<?php echo $list['id']; ?>" class="page-item <?php selected($list['id'], $opened['id'], 'active'); ?>">
      <h4>
      <span>
        <a href="index.php?page=pages&id=<?php echo $list['id']; ?>" class="btn-default"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<?php echo stripslashes(substr($list['label'], 0, 17)); ?></a>        
        <button id="del_<?php echo $list['id']; ?>" class="del-post"><i class="fa fa-trash-o"></i></button>       
      </span>           
      </h4>
    </div>      
  <?php } ?>
</aside><!-- content-side -->
<section class="inner-content">		
  <form class="pages-form" action="index.php?page=pages&id=<?php echo $opened['id']; ?>" method="post" role="form"> 
    <fieldset>
      <table>
        <tr>
          <th><label for="header">Title:</label></th>
          <th><label for="slug">Slug:</label></th>
          <th><label for="user">Author:</label></th>
          <th><label for="slider">Slider:</label></th>
          <th><label for="slider">Page Type:</label></th>
        </tr>
        <tr>
          <td><input class="form-input" type="text" name="header" id="header" value="<?php echo stripslashes($opened['header']); ?>" placeholder="Page Title" tabindex="1"></td>
          <td><input class="form-input" type="text" name="slug" id="slug" value="<?php echo $opened['slug']; ?>" placeholder="Page Slug" tabindex="2"></td>
          <td>
            <select class="form-input" name="user" id="user" tabindex="3">					
              <option value="0">No user</option>					
              <?php
                $q = "SELECT id FROM users ORDER BY first ASC";
                $r = mysqli_query($dbc, $q);
        
                while($user_list = mysqli_fetch_assoc($r)) { 
                  $user_data = data_user($dbc, $user_list['id']);?>
                <option value="<?php echo $user_data['id']; ?>" 
                  <?php 
                    if(isset($_GET['id'])){ selected($user_data['id'], $opened['user'], 'selected');} 
                    else { selected($user_data['id'], $user['id'], 'selected'); }	?>>
                  <?php echo $user_data['fullname']; ?>
                </option>					
              <?php } ?>					
            </select>
          </td>
          <td>     
            <select class="slider-input" name="slider" id="slider" tabindex="4">

            	<?php $section = $opened['slider']; $selected_slider = data_slider($dbc, $section);	?>	
              <?php if($opened['slider'] == 0){ echo "<option value='0' >No Slider</option>"; } else { ?>
              <option value="<?php echo $opened['slider']; ?>"><?php echo $selected_slider['label']; ?></option>
              <?php } ?>					
              <?php if($opened['slider'] != 0){ ?><option value="0" >No Slider</option><?php } ?>	
					    <?php if($opened['slider'] != 1){ ?><option value="1" >Slider 1</option><?php } ?>	
              <?php if($opened['slider'] != 2){ ?><option value="2" >Slider 2</option><?php } ?>	
              <?php if($opened['slider'] != 3){ ?><option value="3" >Slider 3</option><?php } ?>	
            </select>
          </td>
          <td>
            <select class="form-input" name="type" id="type" tabindex="5">
              
              <?php 
              $id = $opened['type']; 
              $selected_type = data_page_type($dbc, $id);	
              
              if($id != ""){ ?>
              
              <option value="<?php echo $opened['type']; ?>"><?php echo $selected_type['label']; ?></option>
              
              <?php } else { ?>
              
              <option value="1">Required</option>
              
              <?php
               }
                $q = "SELECT * FROM page_types ORDER BY id ASC";
                $r = mysqli_query($dbc, $q);
        
                while($page_type = mysqli_fetch_assoc($r)) { ?>
                                  
                <?php if($opened['type'] != $page_type['id']){ ?><option value="<?php echo $page_type['id']; ?>"><?php echo $page_type['label']; ?></option><?php } ?>
                				
              <?php } ?>					
            </select>
          </td>
        </tr>
      </table>
    </fieldset>    
    <textarea class="editor" name="body" id="page_body" rows="8" placeholder="Page Body" tabindex="6"><?php echo stripslashes($opened['body']); ?></textarea>
    
    <button type="submit" class="submit">Save</button>
    
    <input type="hidden" name="submitted" value="1">
    <?php if(isset($opened['id'])) { ?>
      <input type="hidden" name="id" value="<?php echo $opened['id']; ?>">
    <?php } ?>
    			
  </form>
  
  <div class="content-wrap">
    <ul style="font-size:12px;">
      <li><strong>Image Classes:</strong> .small .medium .large</li>
      <li><strong>Fancy Box:</strong> &lt;a class="fancybox" href=""&gt;&lt;img src="" alt=""/&gt;&lt;/a&gt;</li>
    </ul>
  </div>
</section>

<script>
// *****************************************************************************************
// Delete page - delete_page.php		
$(".del-post").on("click", function() {
  
  var selected = $(this).attr("id");
  var pageid = selected.split("del_").join("");
  
  var confirmed = confirm("Are you sure you want to delete this page?");
  
    if(confirmed == true) {      
      $.get("functions/delete_page.php?id="+pageid);      
      $("#post_"+pageid).remove();				      
    }
    
});
// *****************************************************************************************
</script>