<?php
include('functions/message.php');
$table_name = 'users';
$page_name = 'users';
$page_rows = 13;
include('./functions/pagination.php');
?>

<?php if(isset($opened['id'])) { ?>
	<script>		
		$(document).ready(function() {			
			Dropzone.autoDiscover = false;			
			var myDropzone = new Dropzone("#avatar-dropzone");
      			
			myDropzone.on("success", function(file){				
				$("#avatar").load("functions/avatar.php?id=<?php echo $opened['id']; ?>");				
			});	
		});	
	</script>
<?php } ?>
<h1><i class="fa fa-users"></i>&nbsp;&nbsp;User Manager</h1>
<?php  ?>

<aside class="content-side"> 
  <div id="pagination_wrap">
    <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
  </div> 
  <div class="">  
    <a class="users-new" href="?page=users"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New User</a>
             
    <?php
      while($list = mysqli_fetch_array($r, MYSQLI_ASSOC)){  
        $list = data_user($dbc, $list['id']); 
      ?>
      <div id="user_<?php echo $list['id']; ?>" class="page-item <?php selected($list['id'], $opened['id'], 'active'); ?>">
        <h4>
          <span>
            <a class="<?php selected($list['id'], $opened['id'], 'active'); ?>" href="index.php?page=users&id=<?php echo $list['id']; ?>">            
              <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo substr(stripslashes($list['fullname_reverse']), 0, 17); ?>        
            </a>     
            <button id="del_<?php echo $list['id']; ?>" class="del-post"><i class="fa fa-trash-o"></i></button>
          </span>
        </h4>
      </div>
    <?php } ?>
  </div>
</aside><!-- content-side -->

<?php if(isset($opened['id'])) { ?>			
<form action="functions/uploads.php?id=<?php echo $opened['id']; ?>" class="dropzone" id="avatar-dropzone">			
  <input type="file" name="file">		
</form>	
<?php } ?>

<?php if(!isset($opened['id'])) { ?>
<h3 class="settings-title">Add New Member</h3>
<?php } ?>

<form class="users-form" action="index.php?page=users&id=<?php echo $opened['id']; ?>" method="post" role="form">

  <fieldset>       
    <label for="first">First Name:</label><br/>
    <input class="form-input" type="text" name="first" id="first" value="<?php echo stripslashes($opened['first']); ?>" placeholder="First Name" autocomplete="off" tabindex="1">
    
    <label for="last">Last Name:</label><br/>
    <input class="form-input" type="text" name="last" id="last" value="<?php echo stripslashes($opened['last']); ?>" placeholder="Last Name" autocomplete="off" tabindex="2">
    
    <label for="email">Email Address:</label><br/>
    <input class="form-input" type="text" name="email" id="email" value="<?php echo $opened['email']; ?>" placeholder="Email Address" autocomplete="off" tabindex="3">
  </fieldset>
  
  <fieldset> 
    <label for="status">Profile Status:</label><br/>
    <select class="form-input" name="status" id="status"  tabindex="4">					
      <option value="0" <?php if(isset($_GET['id'])){ selected('0', $opened['status'], 'selected'); } ?>>Inactive</option>
      <option value="1" <?php if(isset($_GET['id'])){ selected('1', $opened['status'], 'selected'); } ?>>Active</option>										
    </select>
    
    <label for="password">Password:</label><br/>
    <input class="form-input" type="password" name="password" id="password" value="" placeholder="Password" autocomplete="off" tabindex="5">
    
    <label for="password2">Verify Password:</label><br/>
    <input class="form-input" type="password" name="password" id="password2" value="" placeholder="Type Password Again" autocomplete="off" tabindex="6">
  </fieldset>
  
  <fieldset>   
    <label for="authg">Google:</label><br/>
    <input class="form-input" type="text" name="authg" id="authg" value="<?php echo $opened['authg']; ?>" placeholder="Google Profile" autocomplete="off"  tabindex="7">   
   
    <label for="autht">Twitter:</label><br/>
    <input class="form-input" type="text" name="autht" id="autht" value="<?php echo $opened['autht']; ?>" placeholder="Twitter Profile" autocomplete="off" tabindex="8"> 
    
    <label for="authl">Linked-In:</label><br/>
    <input class="form-input" type="text" name="authl" id="authl" value="<?php echo $opened['authl']; ?>" placeholder="Linked-In Profile" autocomplete="off" tabindex="9">        
  </fieldset> 
  
     <div id="avatar">
    <?php if($opened['avatar'] != ''){ ?>	
      <div class="avatar-container" style="background-image: url('uploads/<?php echo $opened['avatar']; ?>')"></div>	
    <?php } ?>
    </div><!-- #avatar --> 
    
    <div id="profile-info">
    <label for="user-bio">Profile Information:</label><br/>
    <textarea class="form-input" name="bio" id="user-bio" rows="8" placeholder="Profile Bio"  tabindex="10"><?php echo stripslashes($opened['bio']); ?></textarea>   
    <button type="submit" class="submit">Save</button>
    </div>    
    
    <input type="hidden" name="submitted" value="1">
    <?php if(isset($opened['id'])) { ?>
      <input type="hidden" name="id" value="<?php echo $opened['id']; ?>">
    <?php } ?>
     
</form>
<script type="text/javascript">
// *****************************************************************************************
// Delete user - delete_page.php	
$(".del-post").on("click", function() {
  
  var selected = $(this).attr("id");
  var userid = selected.split("del_").join("");
  var confirmed = confirm("Are you sure you want to delete this User?");
  
    if(confirmed == true && userid != 26) {      
      $.get("functions/delete_user.php?id="+userid);      
      $("#user_"+userid).remove();				      
    } else {
      alert("You cannot delete the Master Admin!");
    }
    
});
// *****************************************************************************************
</script>