<nav id="admin-navigation" role="navigation">
  <ul>
    <li><a href="?page=dashboard" class="btn-default"><i class="fa fa-star"></i>&nbsp;&nbsp;Dashboard</a></li>
    
    <li><a href="?page=pages"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Pages</a></li>
    
    <li><a href="?page=posts"><i class="fa fa-file-word-o"></i>&nbsp;&nbsp;Posts</a></li>  
    
    <li><a href="?page=media"><i class="fa fa-file-image-o"></i>&nbsp;&nbsp;Media</a></li>
    
    <li><a href="?page=navigation"><i class="fa fa-globe"></i>&nbsp;&nbsp;Navigation</a></li>
    
    <li><a href="?page=widgets"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Widgets</a></li> 
    
    <li><a href="?page=sliders"><i class="fa fa-retweet"></i>&nbsp;&nbsp;Sliders</a></li>  
    
    <li><a href="?page=users"><i class="fa fa-users"></i>&nbsp;&nbsp;Users</a></li>
    
    <?php if($allow_comments == '1') { ?>    
    <li><a href="?page=comments"><i class="fa fa-comments"></i>&nbsp;&nbsp;Comments</a></li>
    <?php } ?>
    <?php if($filter1_name != '' || $filter2_name != '' || $filter3_name != '') { ?>
    <li><a href="?page=filters"><i class="fa fa-filter"></i>&nbsp;&nbsp;Post Filters</a></li>
    <?php } ?>
    <li><a href="?page=settings"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Settings</a></li>
    
    <li><a href="?page=theme"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Theme</a></li>
    
  </ul>	
</nav>