<?php 
include('functions/message.php');
$table_name = 'comments';
$page_name = 'comments';
$page_rows = 36;
include('./functions/pagination.php');
?>  
<h1><i class="fa fa-comments"></i> Comments Manager</h1>
<section class="content-wrap">

  <?php while($opened = mysqli_fetch_assoc($r)) { ?>

  <form class="comments-form" action="index.php?page=comments&id=<?php echo $opened['id']; ?>" method="post" role="form">
  <fieldset>
  <!--  hidden fields that need to be present for the update query -->
  <input class="form-input-hidden" type="text" name="id" id="id" value="<?php //echo $opened['id']; ?>" autocomplete="off">
  <input class="form-input-hidden" type="email" name="email" id="email" value="<?php echo $opened['email']; ?>" autocomplete="off">
  <input class="form-input-hidden" type="text" name="post_id" id="postId" value="<?php echo $opened['post_id']; ?>" autocomplete="off">
  <input class="form-input-hidden" type="text" name="date" id="date" value="<?php echo $opened['date']; ?>" autocomplete="off">
  
  <!-- show in form -->
  <?php if($opened['status'] == 1) { ?>
      <i class="fa fa-thumbs-up"></i><label> Comment is Approved</label><br/>
  <?php  } else { ?>
      <i class="fa fa-thumbs-down"></i><label> Comment not Approved</label><br/>
  <?php } ?>
  
  <label>Approve: </label>
  <input type="radio" name="status" value="1"><label>Yes</label>
  <input type="radio" name="status" value="0"><label>No</label><br/>
  
  <label>Date: </label><label><?php echo $opened['date']; ?></label><br/>
  
  <?php // query posts for title based on post id
  $query = "SELECT header FROM posts WHERE id = $opened[post_id]";
  $result = mysqli_query($dbc, $query);
  $title = mysqli_fetch_assoc($result);
  ?>
  <label>Post: </label><label><?php echo stripslashes($title['header']); ?></label><br/>
  
  <label>Email: </label><label><?php echo $opened['email']; ?></label><br/>
  
  <label for="commentName">Name: </label>
  <input id="commentName" type="text" name="name" value="<?php echo stripslashes($opened['name']); ?>"><br/>
      
  <label for="commentMessage">Comment:</label><br/>	
  <textarea rows="8" cols="30" name="message" id="commentMessage"><?php echo stripslashes($opened['message']); ?></textarea><br/>		
  
  </fieldset>
  <button type="submit" class="submit">Save</button>  
  <input type="hidden" name="submitted" value="1">      
  <input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>">
  <button id="del_<?php echo $opened['id']; ?>" class="delete-comment"><i class="fa fa-trash-o"></i></button>
  </form> 
<?php } ?>

</section><!-- .content-wrap -->
<div id="pagination_wrap" style="border-color: transparent;">
  <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
</div>

<script type="text/javascript">
// *****************************************************************************************
// Delete Comment
$(document).ready(function() {
  $(".delete-comment").on("click", function() {
    
    var here = $(this).parent();     
    var selected = $(this).attr("id");
    var comid = selected.split("del_").join("");       
    var status = confirm('Are you sure you want to delete this comment?');
    
    if (status == true) {      
      $.get("functions/delete_comment.php?id="+comid);
      here.remove();
    };
    
    return false;
    
  });
});
// *****************************************************************************************
</script>