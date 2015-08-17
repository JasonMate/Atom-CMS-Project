<header id="admin-header">
  <div class="inner-wrap">
    <nav id="user-nav">
      <ul>
        <li>
          <?php if($debug == 1) { ?>
            <button type="button" id="btn-debug"><i class="fa fa-bug"></i></button>
          <?php } ?>				
        </li>	    
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-check-square"></i>&nbsp;&nbsp;<?php echo stripslashes($user['fullname']); ?>&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="functions/logout.php"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  
    <p id="admin-logo"><a href="<?php echo $site_url; ?>"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $site_title)); ?></a> - Admin Panel</p>
  </div><!-- .inner-wrap -->
</header>