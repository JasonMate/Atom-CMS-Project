<?php
function nav_items($dbc, $path) {
	$q = "SELECT * FROM navigation WHERE status = 1 AND sub = 0 ORDER BY position ASC";
	$r = mysqli_query($dbc, $q);
	
  while($nav = mysqli_fetch_assoc($r)) {
    
    $position = $nav['position']; 
    $nav['slug'] = get_slug($dbc, $nav['url']); ?>
     
    <li <?php selected($path['call_parts'][0], $nav['slug'], ' class="active"') ?>><a href="<?php echo $nav['url']; ?>"><?php echo $nav['icon']; ?><?php echo stripslashes($nav['label']); ?></a>
    
    <?php 
	  $query = "SELECT `url`, `label`, `icon`, `sub` FROM navigation WHERE `sub` = '$position' AND `status` = '1'";
    $result = mysqli_query($dbc, $query);

    if(mysqli_num_rows($result) >= 1) {
  
      echo "<i class='fa fa-sort-desc menu-caret'></i>";
      echo "<ul class='sub-menu'>";  
      
      while ($numrows = mysqli_fetch_assoc($result)) {
        
        if ($numrows['sub'] == $position) {              
            echo "<li class='sub-item'><a href='".$numrows['url']."'>".$numrows['icon']."".stripslashes($numrows['label'])."</a></li>";        
        }
        
      }
      
      echo "</ul>";      
    } ?>          
    </li>  
<?php }} // end nav_items() ?>
<!-- ********************* NAVIGATION ********************* -->
<nav id="navigation">
  <?php if($debug == 1) { ?>
		<button id="btn-debug" class="btn btn-default"><i class="fa fa-bug"></i></button>
	<?php } ?>
	<div class="center-wrap">
    <div class="nav-items">			
      <ul>			
        <?php nav_items($dbc, $path); ?>
      </ul>		
    </div><!-- .nav-items -->
  </div><!-- .center-wrap -->
</nav>