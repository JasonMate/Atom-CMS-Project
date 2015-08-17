<?php
include_once('functions/message.php');
$table_name = 'posts';
$page_name = 'posts';
$page_rows = 13;
include('./functions/pagination.php');
?>
<h1><i class="fa fa-file-word-o"></i>&nbsp;&nbsp;Post Manager</h1>
<aside class="content-side">
  <div id="pagination_wrap">
    <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
  </div>

  <a href="?page=posts" class="new-page"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Post</a>
      					
  <?php   
    while($list = mysqli_fetch_array($r, MYSQLI_ASSOC)){ ?>
  
    <div id="post_<?php echo $list['id']; ?>" class="page-item <?php selected($list['id'], $opened['id'], 'active'); ?>">
      <h4>
      <span>
        <a href="index.php?page=posts&id=<?php echo $list['id']; ?>" class="btn-default"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<?php echo stripslashes(substr($list['label'], 0, 17)); ?></a>        
        <button id="del_<?php echo $list['id']; ?>" class="del-post"><i class="fa fa-trash-o"></i></button>       
      </span>           
      </h4>
    </div>      
  <?php } ?>
  
</aside><!-- content-side -->
<section class="inner-content">		
  <form class="pages-form" action="index.php?page=posts&id=<?php echo $opened['id']; ?>" method="post" role="form"> 
    <fieldset>
      <table>
      
        <tr>        
          <th><label for="header">Title:</label></th>
          <th><label for="slug">Slug:</label></th>
          <th><label for="user">Author:</label></th>
          <th><label for="slider">Status:</label></th>
        </tr>
        
        <tr>
          <td><input class="form-input" type="text" name="header" id="header" value="<?php echo stripslashes($opened['header']); ?>" placeholder="Post Title" tabindex="1"></td>
          <td><input class="form-input" type="text" name="slug" id="slug" value="<?php echo $opened['slug']; ?>" placeholder="Post Slug" tabindex="2"></td>
          <td>
            <select class="form-input" name="user" id="user" tabindex="4">
            
              <?php if($opened['user'] == 0){ ?>            					
              <option value="0">No user</option>
              <?php } else { $user_data = data_user($dbc, $opened['user']);?>
              <option value="<?php echo $opened['user']; ?>"><?php echo $user_data['fullname']; ?></option>
              <?php } ?>	
              				
              <?php
                $q = "SELECT id FROM users ORDER BY first ASC";
                $r = mysqli_query($dbc, $q);
        
                while($user_list = mysqli_fetch_assoc($r)) { 
                  $user_data = data_user($dbc, $user_list['id']);?>
                  
                <option value="<?php echo $user_data['id']; ?>">
                
                  <?php 
                    if(isset($_GET['id'])){ 
                      //selected($user_data['id'], $opened['user'], 'selected');
                      $user_data['id'] == $opened['user'];
                    } else { 
                      //selected($user_data['id'], $user['id'], 'selected'); 
                      $user_data['id'] == $user['id'];
                    }	?>
                    
                  <?php echo $user_data['fullname']; ?>
                  
                </option>					
              <?php } ?>					
            </select>
          </td>
          <td><input class="form-input" type="number" name="status" id="status" value="<?php if($opened['status'] != ''){echo $opened['status'];}else{echo 1;} ?>" min="0" max="1" step="1" tabindex="5"></td>
        </tr>       
 
        <tr>
          <th><label for="thumbnail">Thumbnail:</label></th>
          <th><label for="tags">Tags:</label></th>
          <?php if($filter1_name != '') { ?><th><label for="filter1">Filter1:</label></th><?php } ?>
          <?php if($filter2_name != '') { ?><th><label for="filter2">Filter2:</label></th><?php } ?>          
          <?php if($filter3_name != '') { ?><th><label for="filter3">Filter3:</label></th><?php } ?>
        </tr> 
        
        <tr>
           <td><input class="form-input" type="text" name="thumbnail" id="thumbnail" value="<?php echo $opened['thumbnail']; ?>" placeholder="Post Image" tabindex="3"></td>
           <td><input class="form-input" type="text" name="tags" id="tags" value="<?php echo stripslashes($opened['tags']); ?>" placeholder="Comma Seperated Tags"></td>
           
           <?php if($filter1_name != '') { ?>
           <td><select class="form-input" name="filter1" id="filter1">
            <option value="<?php echo $opened['filter1']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $opened['filter1']); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 1 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?><?php //echo stripslashes($filter_label['label']); ?></option>
            <?php } ?>
            </select></td>  
            <?php } ?>
            
            <?php if($filter2_name != '') { ?>
            <td><select class="form-input" name="filter2" id="filter2">
            <option value="<?php echo $opened['filter2']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $opened['filter2']); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 2 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?></option>
            <?php } ?>
            </select></td>
            <?php } ?>
            
            <?php if($filter3_name != '') { ?>
            <td><select class="form-input" name="filter3" id="filter3">
            <option value="<?php echo $opened['filter3']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $opened['filter3']); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 3 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?></option>
            <?php } ?>
            </select></td> 
            <?php } ?>
        </tr>
                
      </table>
    </fieldset>    
    <textarea class="editor" name="body" id="body" rows="8" placeholder="Post Body" tabindex="6"><?php echo stripslashes($opened['body']); ?></textarea>
    
    <button type="submit" class="submit">Save</button>
    
    <input type="hidden" name="submitted" value="2">
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
// Delete post		
$(".del-post").on("click", function() {
  
  var selected = $(this).attr("id");
  var postid = selected.split("del_").join("");
  //alert(selected);
  var confirmed = confirm("Are you sure you want to delete this post?");
  
    if(confirmed == true) {      
      $.get("functions/delete_post.php?id="+postid);      
      $("#post_"+postid).remove();				      
    }         
  
});
// *****************************************************************************************
</script>