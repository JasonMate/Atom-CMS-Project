<?php
// Database backup program
$folder = 'backup/';
$filetype = '*.sql';
$files = glob($folder.$filetype);
$count = count($files);
 
$sortedArray = array();
for($i = 0; $i < $count; $i++) {
    $sortedArray[filemtime($files[$i])] = $files[$i];
}
$message = $_GET['id'];

// get Visitor Count data
$counterFile = "../config/hitcount.txt";
if(file_exists($counterFile)){
  $hit_stats = file_get_contents($counterFile);  
}
// get Comments Not Approved data
$q = "SELECT COUNT(id) FROM comments WHERE status = 0";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$com_stats = $row[0];
// get Page Count data
$q = "SELECT COUNT(id) FROM pages";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$page_stats = $row[0];
// get Image Count data
$q = "SELECT COUNT(id) FROM images";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$image_stats = $row[0];
// get Post Count data
$q = "SELECT COUNT(id) FROM posts";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$post_stats = $row[0]; 
// get User Count data
$q = "SELECT COUNT(id) FROM users";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$user_stats = $row[0];

// check settings
$settings = array($debug, $site_title, $site_url, $site_email);
?>
<h1><i class="fa fa-star"></i>&nbsp;&nbsp;Dashboard</h1>
<?php include('functions/message.php'); ?>
<section class="content-wrap dashboard-wrap">

<?php
$config_error = 0;
foreach($settings as $setting){ if($setting === '' || $setting === 'Site Title' || $settings[0] === '1'){ $config_error++; } }

if($config_error > 0){ ?>
  <div class="db-manager">
    <h3 class="dash-title"><a href="index.php?page=settings" class="open-link">Configure Settings</a></h3>
        
    <?php if($debug === '1') { ?>
      <div class="config-settings"><p><?php echo "Debug Panel is turned on."; ?></p></div> 
    <?php } ?>
    
    <?php if($site_url === '') { ?>
      <div class="config-settings"><p><?php echo "Site URL needs to be added in Settings. Enter full website address WITHOUT a trailing slash."; ?></p></div> 
    <?php } ?>
    
    <?php if($site_title === 'Site Title' || $site_title === '') { ?>
      <div class="config-settings"><p><?php echo "Site Title should be edited in Settings."; ?></p></div> 
    <?php } ?>
    
    <?php if($site_email === '') { ?>
      <div class="config-settings"><p><?php echo "Site Email needs to be added in Settings."; ?></p></div> 
    <?php } ?>        
 
  </div>

<?php } ?> 
  
  <div class="db-manager">
    <h3 class="dash-title">Website Stats</h3>  
    <div><p>Visitor Count : <?php echo "$hit_stats"; ?></p></div>
    <div><p>New Comments : <?php echo "$com_stats"; ?></p></div>
    <div><p>Page Count : <?php echo "$page_stats"; ?></p></div>
    <div><p>Media Count : <?php echo "$image_stats"; ?></p></div>  
    <div><p>Post Count : <?php echo "$post_stats"; ?></p></div>   
    <div><p>User Count : <?php echo "$user_stats"; ?></p></div>  
  </div> 
  
  <?php
  $q = "SELECT * FROM posts WHERE status = 0 ORDER BY id DESC";
  $r = mysqli_query($dbc, $q);
  $post_count = mysqli_num_rows($r);
  $list = mysqli_fetch_assoc($r);  
  if($post_count > 0){ ?>
    <div class="db-manager">
      <h3 class="dash-title">Posts Not Approved</h3>
      <?php for($i = 0; $i < $post_count; $i++){ ?>  
        <div><p><a href="index.php?page=posts&id=<?php echo $list['id']; ?>" class="btn-default"><i class="fa fa-pencil"></i>&nbsp;&nbsp;<?php echo substr($list['header'], 0, 35); ?></a></p></div>
      <?php } ?>  
    </div>     
  <?php } ?>       

  <div class="db-manager">
    <h3 class="dash-title">Database Backups</h3>
    <!--Backup Database-->
    <button data-file="backup/backup.php" id="backup-btn"><i class="fa fa-database"></i><i class="fa fa-caret-right"></i><i class="fa fa-file-text"></i></button>

      <?php foreach ($sortedArray as &$filename) { ?>              
      <p><a href="<?php echo $site_url.'/admin/'.$filename ?>"><?php echo $site_url.'/admin/'.$filename ?></a></p>          
      <?php } ?>
  </div>
  
  <div class="db-manager">
  <h3 class="dash-title">Server Information</h3>  
    <div class="serverstats">
      <?php 
      $indicesServer = array(
      'PHP_SELF', 
      'GATEWAY_INTERFACE', 
      'SERVER_ADDR', 
      'SERVER_NAME', 
      'SERVER_SOFTWARE', 
      'SERVER_PROTOCOL', 
      'REQUEST_METHOD', 
      'REQUEST_TIME', 
      'REQUEST_TIME_FLOAT', 
      'QUERY_STRING', 
      'DOCUMENT_ROOT', 
      'HTTP_ACCEPT', 
      'HTTP_ACCEPT_CHARSET', 
      'HTTP_ACCEPT_ENCODING', 
      'HTTP_ACCEPT_LANGUAGE', 
      'HTTP_CONNECTION', 
      'HTTP_HOST', 
      'HTTP_REFERER', 
      'HTTP_USER_AGENT', 
      'HTTPS', 
      'REMOTE_ADDR', 
      'REMOTE_HOST', 
      'REMOTE_PORT', 
      'REMOTE_USER', 
      'REDIRECT_REMOTE_USER', 
      'SCRIPT_FILENAME', 
      'SERVER_ADMIN', 
      'SERVER_PORT', 
      'SERVER_SIGNATURE', 
      'PATH_TRANSLATED', 
      'SCRIPT_NAME', 
      'REQUEST_URI', 
      'PHP_AUTH_DIGEST', 
      'PHP_AUTH_USER', 
      'PHP_AUTH_PW', 
      'AUTH_TYPE', 
      'PATH_INFO', 
      'ORIG_PATH_INFO'
      ); 
      
      echo '<table cellpadding="10">' ; 
      foreach ($indicesServer as $arg) { 
          if (isset($_SERVER[$arg])) { 
              echo '<tr><td>'.$arg.'&nbsp;:&nbsp;&nbsp;&nbsp;' . $_SERVER[$arg] . '</td></tr>' ; 
          } 
          else { 
              echo '<tr><td>'.$arg.'&nbsp;:</td></tr>' ; 
          } 
      } 
      echo '</table>' ;
      ?>   
    </div>  
  </div>

</section><!-- .content-wrap -->
<script>
// *****************************************************************************************
$(document).ready(function() {
  $("#backup-btn").on("click", function() { $(location).attr('href','backup/backup.php'); }); 
});
// *****************************************************************************************
</script>