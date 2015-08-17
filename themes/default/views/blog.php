<?php
date_default_timezone_set('America/Chicago');
//$blog_limit = 12;
$blog_limit = 6;
$blog_start = 0;

$q = "SELECT COUNT(id) FROM posts";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$rows = $row[0];

$q = "SELECT * FROM posts ORDER BY id DESC LIMIT $blog_limit";
$r = mysqli_query($dbc, $q);

/* variables for google style pagination 
$table_name = 'posts';
$page_name = 'blog';
$page_rows = 8;
include('functions/pagination.php');
*/
?>
<div id="bg">					
  <?php include(D_TEMPLATE.'/header.php'); ?>
  <div class="center-wrap"> 
    <div class="body-wrap"> 
      <?php include(D_TEMPLATE.'/sidebar.php'); ?>      
      <main id="main-content">
        <h1><?php echo stripslashes($page['header']); ?></h1>
        <!-- ******************************************************** FILTERS ************************************************************ -->
        <div class="filters">
          <?php if($filter1_name != ''){ ?>
          <select id="filter1" class="filter-select" name="filter1">
            <option value="0"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $filter1_name)); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 1 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);        
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?></option>
             <?php } ?>
          </select> 
          <?php } ?>
                        
          <?php if($filter2_name != ''){ ?>
          <select id="filter2" class="filter-select" name="filter2">
            <option value="0"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $filter2_name)); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 2 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?></option>
             <?php } ?>
          </select>    
          <?php } ?>
                     
          <?php if($filter3_name != ''){ ?>
          <select id="filter3" class="filter-select" name="filter3">
            <option value="0"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $filter3_name)); ?></option>
            <?php
            $query = "SELECT * FROM filters WHERE type = 3 ORDER BY position ASC";
            $result = mysqli_query($dbc, $query);
    
            while($filter_label = mysqli_fetch_assoc($result)) { ?>
          
            <option value="<?php echo $filter_label['label']; ?>"><?php echo preg_replace('/xescapequotex/', '\'', $filter_label['label']); ?></option>
             <?php } ?>
          </select>    
          <?php } ?>        
        </div><!-- .filters -->
        <!-- *************************************************************************************************************************** --> 
    	  <div id="blog">         
        	
        <?php echo stripslashes($page['body_formatted']); ?>
                
        <?php while($post = mysqli_fetch_assoc($r)){  $user = data_user($dbc, $post['user']); ?>
             
            <div class="post-excerpt">
            <a class="post-title" href="<?php echo $site_url . "/" . $post['slug']; ?>">
            <h2><?php echo stripslashes($post['header']); ?></h2>
            </a>
            
            <?php if($post['user'] == '0'){ ?>             
             <span class="post-date">Posted On: <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
            <?php } else { ?>           
            <span class="post-date">Posted by: 
            <form action="<?php echo $site_url.'/profile'; ?>" method="post">            
            <input type="hidden" name="user_id" value="<?php echo $post['user']; ?>">
            <input type="submit" class="name-link" value="<?php echo stripslashes($user['fullname']); ?>">
            </form> | <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
            <?php } ?>
            
            <?php if($post['thumbnail'] != '') { ?>
            <a href="<?php echo $site_url . "/" . $post['slug']; ?>">
            <div class="post-image" style="background-image: url(<?php echo $post['thumbnail'] ?>);"></div>
            </a>
            <?php } ?>
            <p><?php echo strip_tags(stripslashes(substr($post['body'], 0, 200))); ?>...</p>                       
            <a class="post-link" href="<?php echo $site_url . "/" . $post['slug']; ?>">Read More</a>
            </div>
        <?php } ?>        
        </div><!-- #blog -->
        
        <!--<div class="media_pagination_wrap"><div id="pagination_controls"><?php //echo $paginationCtrls; ?></div></div>-->

        <input type="hidden" name="post_count" id="post_count" value="<?php echo $blog_start; ?>">
        <?php if($rows >= $blog_limit) { ?>
        <button id="load_blog" class="submit">Load More Posts</button>
        <?php } ?>

      </main> 
  
    </div><!-- .body-wrap -->     
  </div><!-- #center-wrap -->		
<?php include(D_TEMPLATE.'/footer.php'); ?>			
</div><!-- #bg -->