<?php
date_default_timezone_set('America/Boise');
$date = date('F j, Y',strtotime($post['date']));
$user = data_user($dbc, $post['user']);

if($allow_comments == '1'){
  // get post id
  $post_id = $post['id'];  
  // get comments based on post id
  $comments = '';  
  $q = "SELECT * FROM comments WHERE post_id = $post_id AND status = 1 ORDER BY id ASC LIMIT 20";
  $r = mysqli_query($dbc, $q);
  
  // get row count
  $comment_count = mysqli_num_rows($r);  
  // if comments exist, get data
  if($comment_count > 0){
    while($row = mysqli_fetch_assoc($r)){
      $comment_name = stripslashes($row['name']);
      $comment_body = stripslashes($row['message']);
      $comment_date = $row['date'];     
      // build comments //strip_tags(substr($comment_name, 0, 40)) - htmlspecialchars($comment_name)
      $comments .= "<div class='post-comment'><p><i class='fa fa-user'></i>&nbsp;&nbsp;".strip_tags(substr($comment_name, 0, 16))." - <span>$comment_date</span></p><div class='comment-body'><div class='chat-arrow'></div><pre class='com-pre'>".htmlspecialchars($comment_body)."</pre></div></div>\n";
    }
  }
}
?>
<div id="bg">					
  <?php include(D_TEMPLATE.'/header.php'); ?>
  <div class="center-wrap"> 
    <div class="body-wrap"> 
      <?php include(D_TEMPLATE.'/sidebar.php'); ?>     
      <main id="main-content" class="post-content">
                        
        <h1><?php echo stripslashes($post['header']); ?></h1>
         
        <?php if($post['user'] == '0'){ ?>             
         <span class="post-date">Posted On: <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
        <?php } else { ?>           
        <span class="post-date">Posted by: 
        <form action="<?php echo $site_url.'/profile'; ?>" method="post">            
        <input type="hidden" name="user_id" value="<?php echo $post['user']; ?>">
        <input type="submit" class="name-link" value="<?php echo stripslashes($user['fullname']); ?>">
        </form> | <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
        <?php } ?>
                   
        <?php echo stripslashes($post['body_formatted']); ?>
        
        <?php 
        if($allow_comments == '1'){
          if($comment_count > 0){ 
            if($comment_count == 1){
              echo "<br/><br/><h3><i class='fa fa-comments'></i> ".$comment_count." Comment:</h3><hr/>" . $comments; 
            } else {
              echo "<br/><br/><h3><i class='fa fa-comments'></i> ".$comment_count." Comments:</h3><hr/>" . $comments;
            }         
          }        
        } ?> 
        
        <?php if($allow_comments == '1'){ ?>        
        <form id="msgForm" method="post">
          <input id="botstomper" type="text" name="lname" autocomplete="off"/><br/>
          <h3><i class="fa fa-comments"></i> Leave a Comment:</h3><hr/> 
          <label for="msgName">Name: (Required)</label><br/>
          <input id="msgName" type="text" name="msgName" required><br>
          
          <label for="msgEmail">Email: (Required) (Will not be published)</label><br/>
          <input id="msgEmail" type="email" name="msgEmail" required><br>
          
          <label for="msgMessage">Comment: (Required)</label><br/>
          <textarea id="msgMessage" name="msgMessage" required></textarea>
          <input id="postId" type="hidden" name="postId" value="<?php echo $post_id; ?>">
          <input id="msgSubmit" class="submit" type="submit" value="Submit">     
        </form>
        
        <div class="blab-box"><div id="status-message"></div></div>
        <?php } ?>  
      </main> 
    </div><!-- .body-wrap -->     
  </div><!-- #center-wrap -->		
<?php include(D_TEMPLATE.'/footer.php'); ?>			
</div><!-- #bg -->