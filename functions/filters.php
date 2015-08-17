<?php
include('../config/connection.php');  
date_default_timezone_set('America/Chicago');
function data_user($dbc, $id) {
	$q = "SELECT * FROM users WHERE id = '$id'";	
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);	
	$data['fullname'] = $data['first'].' '.$data['last'];  
	return $data;
}

$filter1 = $_GET['filter1'];
$filter2 = $_GET['filter2'];
$filter3 = $_GET['filter3'];
$site_url = $_GET['site_url'];
$filter1_name = $_GET['filter1_name'];
$filter2_name = $_GET['filter2_name'];
$filter3_name = $_GET['filter3_name'];
  
if($filter1_name !== '' && $filter2_name !== '' && $filter3_name !== '') { 
      
  /* *********************************** THREE FILTERS ************************************** */ 
  if($filter1 || $filter2 || $filter3) {
    $q = 'SELECT * FROM posts WHERE';
    switch (true) {
         
      // filter 1 and 2 and 3 selected
      case !empty($filter1) && !empty($filter2) && !empty($filter3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" AND filter2 LIKE "%' . $filter2 . '%" AND filter3 LIKE "%'. $filter3 .'%" ORDER BY id DESC';
        break;
      // filter 1 and 3 selected
      case !empty($filter1) && empty($filter2) && !empty($filter3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" AND filter3 LIKE "%'. $filter3 .'%" ORDER BY id DESC';
        break;
  
      // filter 1 selected
      case !empty($filter1) && empty($filter2) && empty($fitler3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" ORDER BY id DESC';
        break; 
  
      // filter 1 and 2 selected
      case !empty($filter1) && !empty($filter2) && empty($fitler3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" AND filter2 LIKE "%' . $filter2 .'%" ORDER BY id DESC';
        break;
      // filter 2 and 3 selected
      case empty($filter1) && !empty($filter2) && !empty($filter3):
        $q .= ' filter2 LIKE "%'.$filter2.'%" AND filter3 LIKE "%'. $filter3 .'%" ORDER BY id DESC';
        break;
      // filter 3 selected
      case empty($filter1) && empty($filter2) && !empty($filter3):
        $q .= ' filter3 LIKE "%'.$filter3.'%" ORDER BY id DESC';
      break;
      // filter 2 selected
      case empty($filter1) && !empty($filter2) && empty($filter3):
        $q .= ' filter2 LIKE "%'.$filter2.'%" ORDER BY id DESC';
        break;
  
      default:
        $q = "SELECT * FROM posts ORDER BY id DESC";
        break;
    } 
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }
  
} else if($filter1_name !== '' && $filter2_name === '' && $filter3_name !== '') {
  /* ***************************** TWO FILTERS ( 1 and 3 )********************************* */ 
  if($filter1 || $filter3) {
    $q = 'SELECT * FROM posts WHERE';
    switch (true) {
         
      // filter 1 and 3 selected
      case !empty($filter1) && !empty($filter3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" AND filter3 LIKE "%'. $filter3 .'%" ORDER BY id DESC';
        break;
  
      // filter 1 selected
      case !empty($filter1) && empty($fitler3):
        $q .= ' filter1 LIKE "%'.$filter1.'%" ORDER BY id DESC';
        break; 
  
      // filter 3 selected
      case empty($filter1) && !empty($filter3):
        $q .= ' filter3 LIKE "%'.$filter3.'%" ORDER BY id DESC';
      break;
  
      default:
        $q = "SELECT * FROM posts ORDER BY id DESC";
        break;
    }
    
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }
  
} else if($filter1_name === '' && $filter2_name !== '' && $filter3_name !== '') {
  /* ***************************** TWO FILTERS ( 2 and 3 )********************************* */ 
  if($filter2 || $filter3) {
    $q = 'SELECT * FROM posts WHERE';
    switch (true) {
         
      // filter 2 and 3 selected
      case !empty($filter2) && !empty($filter3):
        $q .= ' filter2 LIKE "%'.$filter2.'%" AND filter3 LIKE "%'. $filter3 .'%" ORDER BY id DESC';
        break;
  
      // filter 2 selected
      case !empty($filter2) && empty($fitler3):
        $q .= ' filter2 LIKE "%'.$filter2.'%" ORDER BY id DESC';
        break; 
  
      // filter 3 selected
      case empty($filter2) && !empty($filter3):
        $q .= ' filter3 LIKE "%'.$filter3.'%" ORDER BY id DESC';
      break;
  
      default:
        $q = "SELECT * FROM posts ORDER BY id DESC";
        break;
    }
    
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }
  
} else if($filter1_name !== '' && $filter2_name !== '' && $filter3_name === '') {
  /* ***************************** TWO FILTERS ( 1 and 2 )********************************* */ 
  if($filter1 || $filter2) {
    $q = 'SELECT * FROM posts WHERE';
    switch (true) {
         
      // filter 1 and 2 selected
      case !empty($filter1) && !empty($filter2):
        $q .= ' filter1 LIKE "%'.$filter1.'%" AND filter2 LIKE "%'. $filter2 .'%" ORDER BY id DESC';
        break;
  
      // filter 1 selected
      case !empty($filter1) && empty($fitler2):
        $q .= ' filter1 LIKE "%'.$filter1.'%" ORDER BY id DESC';
        break; 
  
      // filter 2 selected
      case empty($filter1) && !empty($filter2):
        $q .= ' filter2 LIKE "%'.$filter2.'%" ORDER BY id DESC';
      break;
  
      default:
        $q = "SELECT * FROM posts ORDER BY id DESC";
        break;
    } 
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }
     
} else if($filter1_name !== '' && $filter2_name === '' && $filter3_name === '') {
/* ********************************** ONE FILTER ( 1 )************************************* */
  if($filter1) {
    $q = 'SELECT * FROM posts WHERE';
    $q .= ' filter1 LIKE "%'.$filter1.'%" ORDER BY id DESC';
    
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }

} else if($filter1_name === '' && $filter2_name !== '' && $filter3_name === '') {
/* ********************************** ONE FILTER ( 2 )************************************* */
  if($filter2) {
    $q = 'SELECT * FROM posts WHERE';
    $q .= ' filter2 LIKE "%'.$filter2.'%" ORDER BY id DESC'; 
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }

} else  {
/* ********************************** ONE FILTER ( 3 )************************************* */
  if($filter3) {
    $q = 'SELECT * FROM posts WHERE';
    $q .= ' filter3 LIKE "%'.$filter3.'%" ORDER BY id DESC';
  } else {
    $q = "SELECT * FROM posts ORDER BY id DESC";
  }
  
}

/* **************************************************************************************** */
$r = mysqli_query($dbc, $q) or die('There was a problem getting the page. Please refresh.');
$rows = mysqli_num_rows($r);
/* **************************************************************************************** */
?>
<?php if($rows > 0){ ?>

    <?php while($post = mysqli_fetch_assoc($r)){ $user = data_user($dbc, $post['user']); ?>
        <div class="post-excerpt">
        <a  class="post-title" href="<?php echo $site_url . "/" . $post['slug']; ?>">
        <h2><?php echo stripslashes($post['header']); ?></h2>
        </a>   
        <!--<span class="post-date">Posted by: <a href="<?php //echo $site_url.'/profile?id='.$post['user']; ?>"><?php //echo $user['fullname']; ?></a> | <?php //echo date('F j, Y',strtotime($post['date'])); ?></span>-->
        <?php if($post['user'] == '0'){ ?>             
         <span class="post-date">Posted On: <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
        <?php } else { ?>           
        <span class="post-date">Posted by: <a href="<?php echo $site_url.'/profile?id='.$post['user']; ?>"><?php echo stripslashes($user['fullname']); ?></a> | <?php echo date('F j, Y',strtotime($post['date'])); ?></span>
        <?php } ?>
                    
        <?php if($post['thumbnail'] != '') { ?>
        <a href="<?php echo $site_url . "/" . $post['slug']; ?>">
        <div class="post-image" style="background-image: url(<?php echo $post['thumbnail'] ?>);"></div>
        </a>
        <?php } ?>
        <p><?php echo strip_tags(stripslashes(substr($post['body'], 0, 200))); ?>...</p>       
<!-- *********************************** Test Filters *********************************** --> 
<!--<div style="background: #f00; color:#fff; padding: 5px;"><h3>echo variables</h3><p><?php //echo 'filter1: '.$post['filter1'] ?></p><p><?php //echo 'filter2: '.$post['filter2'] ?></p><p><?php //echo 'filter3: '.$post['filter3'] ?></p></div>-->       
        <a class="post-link" href="<?php echo $site_url . "/" . $post['slug']; ?>">Read More</a>
        </div>
    <?php } ?>

<?php } else { ?>
    <h2>No data matches the filter criteria</h2>
    <!-- MORE CODE HERE FOR EMPTY RESULTS -->
<?php } ?>