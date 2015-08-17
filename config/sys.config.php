<?php
/*
**************** FILE INFORMATION ****************
* File Name: sys.config.php (Setup file for raw.cms)
* This file is for installing the tables and data required to run this version of raw.cms
* This file is designed to run once and unlink it self after installation is complete
*   
* Author: Jason Mate
* Date: 2/16/2015
* Email: jason.mate@my.eitc.edu
* Class: OFP-230 (Final PHP Project) 
* Instructor: Julie Anderson
*
*/

$alert = "";
$errors = "";

if(isset($_POST['submit'])){
  
    // get db information
    $db_host = $_POST['dbHost'];
    $db_user = $_POST['dbUser'];
    $db_pass = $_POST['dbPass'];
    $db_name = $_POST['dbName'];
    
    // get admin information
    $ad_first = $_POST['adFirst'];
    $ad_last = $_POST['adLast'];
    $ad_email = $_POST['adEmail'];
    $ad_pass = $_POST['adPass']; // passwords must be encrypted 
     
    // make sure variables have values
    if($db_host != "" && $db_user != "" && $db_name != "" && $ad_email != "" && $ad_pass != "" && $ad_first != "" && $ad_last != ""){ 
    
      // temporary connection to db
      $dbc = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      
      // if connection fails set alert and exit script
      if(mysqli_connect_errno()){ 
        $errors = "<h3 id='errors'>Could not connect because:<br/>".mysqli_connect_error().".</h3>";
        
      } else {
        
        $alert = "<h3 id='alert'>Database connection established...</h3>\n";
              
        // ******************************************************
        // create tables and insert queries
        $tbl_images = "CREATE TABLE IF NOT EXISTS images (
                       id smallint(6) NOT NULL AUTO_INCREMENT,
                       path varchar(250) NOT NULL,
                       alt varchar(150) NOT NULL,
                       gallery varchar(250) NOT NULL DEFAULT 'No Gallery',
                       status tinyint(1) NOT NULL,
                       PRIMARY KEY (id) ) 
                       ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113";
                     
        if(mysqli_query($dbc, $tbl_images) === TRUE){
          
          $alert .= "<h3 id='alert'>Created images table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create images table...</h3>\n";
        }
                
        // ******************************************************

        $tbl_comments = "CREATE TABLE IF NOT EXISTS comments (
                           id int(11) NOT NULL AUTO_INCREMENT,
                           name varchar(200) NOT NULL,
                           email varchar(200) NOT NULL,
                           message varchar(3000) NOT NULL,
                           status int(1) NOT NULL DEFAULT '0',
                           post_id int(11) NOT NULL,
                           date varchar(200) NOT NULL,                           
                           PRIMARY KEY (id))
                           ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3";                          
                     
        if(mysqli_query($dbc, $tbl_comments) === TRUE){        
                    
          $alert .= "<h3 id='alert'>Created comments table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create comments table...</h3>\n";
        }
        
        // ******************************************************
        
        $tbl_filters = "CREATE TABLE IF NOT EXISTS filters (
                         id int(11) NOT NULL AUTO_INCREMENT,
                         label varchar(60) NOT NULL,
                         type enum('1','2','3') NOT NULL,
                         position tinyint(4) NOT NULL,
                         status tinyint(1) NOT NULL DEFAULT '1',
                         PRIMARY KEY (id) )
                         ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23";
                         
        if(mysqli_query($dbc, $tbl_filters) === TRUE){
         
          $alert .= "<h3 id='alert'>Created filters table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create filters table...</h3>\n";
        }                         

        // ****************************************************** 
                                   
        $tbl_navigation = "CREATE TABLE IF NOT EXISTS navigation (
                           id mediumint(9) NOT NULL AUTO_INCREMENT,
                           label varchar(255) NOT NULL,
                           url varchar(255) NOT NULL,
                           icon varchar(255) NOT NULL,
                           target varchar(30) NOT NULL,
                           sub tinyint(4) NOT NULL DEFAULT '0',
                           position int(3) NOT NULL DEFAULT '1',
                           status int(1) NOT NULL DEFAULT '1',
                           PRIMARY KEY (id) )
                           ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31";                          
                     
        if(mysqli_query($dbc, $tbl_navigation) === TRUE){        
          
          $q = "INSERT INTO navigation (id, label, url, icon, target, sub, position, status) VALUES (1, 'Home', 'index.php', '', '', 0, 1, 1)";
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created navigation table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create navigation table...</h3>\n";
        }
                
        // ******************************************************                          
                          
        $tbl_pages = "CREATE TABLE IF NOT EXISTS pages (
                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                      user mediumint(9) NOT NULL,
                      slug varchar(255) NOT NULL,
                      label varchar(100) NOT NULL,
                      title varchar(255) NOT NULL,
                      header varchar(255) NOT NULL,
                      body mediumtext NOT NULL,
                      type tinyint(4) NOT NULL DEFAULT '1',
                      slider tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (id),
                      KEY user (user) )
                      ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39"; 
                     
        if(mysqli_query($dbc, $tbl_pages) === TRUE){
         
          $q = "INSERT INTO pages (id, user, slug, label, title, header, body, type, slider) VALUES 
               (36, 0, 'home', 'Home Page', 'Home Page', 'Home Page', '<p>Please login to edit this page and website settings.</p>', 1, 0),
               (37, 0, 'profile', 'Profile Page', 'Profile Page', 'Profile Page', '&nbsp;', 6, 0),
               (38, 0, 'search', 'Search', 'Search', 'Search', '&nbsp;', 7, 0)";
               
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created pages table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create pages table...</h3>\n";
        }
                
        // ******************************************************                                          
                     
        $tbl_page_types = "CREATE TABLE IF NOT EXISTS page_types (
                           id int(11) NOT NULL AUTO_INCREMENT,
                           label varchar(150) NOT NULL,
                           name varchar(150) NOT NULL,
                           status int(1) NOT NULL DEFAULT '1',
                           PRIMARY KEY (id) )
                           ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7";
                     
        if(mysqli_query($dbc, $tbl_page_types) === TRUE){          
          
          $q = "INSERT INTO page_types (id, label, name, status) VALUES
               (1, 'Default Page', 'default', 1),
               (2, 'Gallery Page', 'gallery', 1),
               (3, 'Contact Page', 'contact', 1),
               (4, 'Full Width Page', 'full-width', 1),
               (5, 'Blog Page', 'blog', 1),
               (6, 'Profile Page', 'profile', 1),
               (7, 'Search Page', 'search', 1)";
               
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created page_types table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create page_types table...</h3>\n";
        }
                
        // ******************************************************                                                    
                          
        $tbl_posts = "CREATE TABLE IF NOT EXISTS posts (
                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                      user int(11) NOT NULL,
                      slug varchar(255) NOT NULL,
                      thumbnail varchar(255) NOT NULL,
                      label varchar(100) NOT NULL,
                      title varchar(255) NOT NULL,
                      header varchar(255) NOT NULL,
                      body mediumtext NOT NULL,
                      filter1 varchar(255) NOT NULL,
                      filter2 varchar(255) NOT NULL,
                      filter3 varchar(255) NOT NULL,
                      tags text NOT NULL,                      
                      date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      status tinyint(4) NOT NULL DEFAULT '1',
                      PRIMARY KEY (id) )
                      ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7";
                     
        if(mysqli_query($dbc, $tbl_posts) === TRUE){
         
          $alert .= "<h3 id='alert'>Created posts table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create posts table...</h3>\n";
        }
                
        // ******************************************************
                             
        $tbl_settings = "CREATE TABLE IF NOT EXISTS settings (
                         id varchar(200) NOT NULL,
                         label varchar(200) NOT NULL,
                         value mediumtext NOT NULL,
                         description varchar(255) NOT NULL,
                         position smallint(6) NOT NULL,
                         section tinyint(4) NOT NULL,
                         PRIMARY KEY (id) )
                         ENGINE=MyISAM DEFAULT CHARSET=latin1";
                     
        if(mysqli_query($dbc, $tbl_settings) === TRUE){
          
          $q = "INSERT INTO settings (id, label, value, description, position, section) VALUES
               ('filter1-name', 'Filter 1', '', 'Name of new post filter.', 1, 4),
               ('behance-info', 'Behance', '', 'Include Behance profile URL here.', 7, 3),
               ('child-css', 'Custom Style Sheet', '', 'Insert your custom CSS here.', 1, 8),
               ('child-js', 'Embedded Custom Javascript', '', 'Insert your custom Javascript here.', 1, 9),
               ('copyright-info', 'Copyright Info', '', 'Set website copyright information.', 6, 1),
               ('debug-status', 'Debug Tool', '0', 'Check queries on pages. &#40;1=ON&nbsp;&nbsp;&nbsp;0=OFF&#41;', 9, 1),
               ('allow-comments', 'Allow Comments', '0', 'Allow users to comment on posts. &#40;1=ON&nbsp;&nbsp;&nbsp;0=OFF&#41', 8, 1),
               ('facebook-info', 'Facebook', '', 'Include Facebook page URL here.', 1, 3),
               ('filter2-name', 'Filter 2', '', 'Name of new post filter.', 2, 4),
               ('github-info', 'GitHub', '', 'Include GitHub profile URL here.', 6, 3),
               ('google-info', 'Google', '', 'Include Google+ page URL here.', 2, 3),
               ('home-page', 'Home Page', 'home', 'Insert slug for website''s home page.', 3, 1),
               ('linkedin-info', 'Linked-In', '', 'Include Linked-In profile URL here.', 4, 3),
               ('filter3-name', 'Filter 3', '', 'Name of new post filter.', 3, 4),
               ('pinterest-info', 'Pinterest', '', 'Include Pinterest profile URL here.', 5, 3),
               ('site-analytics', 'Site Analytics', '', 'Set tracking ID for Google Analytics.', 4, 2),
               ('site-author', 'Site Author', '', 'Set content author. (meta tag)', 1, 2),
               ('site-description', 'Site Description', '', 'Set Website description. (meta tag)', 2, 2),
               ('site-email', 'Site Email', '', 'Set email address for contact page.', 5, 1),
               ('site-keywords', 'Site Keywords', '', 'Include keywords separated by commas. ', 3, 2),
               ('site-logo', 'Site Logo', '', 'Insert path to image file. &#40;50X200&#41;', 4, 1),
               ('site-theme', 'Theme Folder', 'default', 'Set theme''s folder name. (default)', 1, 6),
               ('site-title', 'Site Title', 'Site Title', 'Set website name on title tag.', 2, 1),
               ('site-url', 'Site URL', '', 'Insert website address. &#40URL&#41', 1, 1),
               ('twitter-info', 'Twitter', '', 'Include Twitter page URL here.', 3, 3),
               ('youtube-info', 'Youtube', '', 'Include Youtube page URL here.', 8, 3)";
               
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created settings table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create settings table...</h3>\n";
        }
                
        // ******************************************************
                                
        $tbl_sliders = "CREATE TABLE IF NOT EXISTS sliders (
                        id varchar(200) NOT NULL,
                        label varchar(255) NOT NULL,
                        value text NOT NULL,
                        alt varchar(200) NOT NULL,
                        url varchar(255) NOT NULL,
                        section tinyint(4) NOT NULL,
                        position tinyint(4) NOT NULL,
                        PRIMARY KEY (id) )
                        ENGINE=MyISAM DEFAULT CHARSET=latin1";
                     
        if(mysqli_query($dbc, $tbl_sliders) === TRUE){
         
          $q = "INSERT INTO sliders (id, label, value, alt, url, section, position) VALUES
               ('f1-s1', 'Slider 1', '', '', '', 1, 1),
               ('f1-s2', 'Slider 1', '', '', '', 1, 2),
               ('f1-s3', 'Slider 1', '', '', '', 1, 3),
               ('f1-s4', 'Slider 1', '', '', '', 1, 4),
               ('f1-s5', 'Slider 1', '', '', '', 1, 5),
               ('f1-s6', 'Slider 1', '', '', '', 1, 6),
               ('f2-s1', 'Slider 2', '', '', '', 2, 1),
               ('f2-s2', 'Slider 2', '', '', '', 2, 2),
               ('f2-s3', 'Slider 2', '', '', '', 2, 3),
               ('f2-s4', 'Slider 2', '', '', '', 2, 4),
               ('f2-s5', 'Slider 2', '', '', '', 2, 5),
               ('f2-s6', 'Slider 2', '', '', '', 2, 6),
               ('f3-s1', 'Slider 3', '', '', '', 3, 1),
               ('f3-s2', 'Slider 3', '', '', '', 3, 2),
               ('f3-s3', 'Slider 3', '', '', '', 3, 3),
               ('f3-s4', 'Slider 3', '', '', '', 3, 4),
               ('f3-s5', 'Slider 3', '', '', '', 3, 5),
               ('f3-s6', 'Slider 3', '', '', '', 3, 6)";
          
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created sliders table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create sliders table...</h3>\n";
        }
                
        // ******************************************************
                               
        $tbl_users = "CREATE TABLE IF NOT EXISTS users (
                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                      avatar varchar(100) NOT NULL,
                      first varchar(200) NOT NULL,
                      last varchar(200) NOT NULL,
                      email varchar(255) NOT NULL,
                      password varchar(200) NOT NULL,
                      authg varchar(250) NOT NULL,
                      autht varchar(250) NOT NULL,
                      authl varchar(250) NOT NULL,
                      bio text NOT NULL,
                      status int(1) NOT NULL DEFAULT '1',
                      PRIMARY KEY (id) )
                      ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";
                     
        if(mysqli_query($dbc, $tbl_users) === TRUE){
          
          $q = "INSERT INTO users (id, avatar, first, last, email, password, authg, autht, authl, bio, status) VALUES
               (26, '', '$ad_first', '$ad_last', '$ad_email', SHA1('$ad_pass'), '', '', '', '', 1)";
          
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created users table...</h3>\n";
          $alert .= "<h3 id='alert'>Administrator created...</h3>\n";  
        } else {
          $errors .= "<h3 id='errors'>Could not create users table...</h3>\n";
        }
                
        // ******************************************************
                             
        $tbl_widgets = "CREATE TABLE IF NOT EXISTS widgets (
                        id varchar(200) NOT NULL,
                        label varchar(255) NOT NULL,
                        value mediumtext NOT NULL,
                        section tinyint(4) NOT NULL,
                        position smallint(6) NOT NULL,
                        PRIMARY KEY (id) )
                        ENGINE=MyISAM DEFAULT CHARSET=latin1";
                     
        if(mysqli_query($dbc, $tbl_widgets) === TRUE){
          
          $q = "INSERT INTO widgets (id, label, value, section, position) VALUES
               ('contact-w1', 'Contact Page Top', '', 4, 1),
               ('contact-w2', 'Contact Page Bottom', '', 4, 2),
               ('header-w1', 'Header Widget', '', 1, 1),
               ('side-w1', 'Sidebar Widget 1', '', 2, 1),
               ('side-w2', 'Sidebar Widget 2', '', 2, 2),
               ('side-w3', 'Sidebar Widget 3', '', 2, 3),
               ('side-w4', 'Sidebar Widget 4', '', 2, 4),
               ('side-w5', 'Sidebar Widget 5', '', 2, 5),
               ('side-w6', 'Sidebar Widget 6', '', 2, 6)";
                
          $r = mysqli_query($dbc, $q);          
          $alert .= "<h3 id='alert'>Created widgets table...</h3>\n";
            
        } else {
          $errors .= "<h3 id='errors'>Could not create widgets table...</h3>\n";
        }
         
        // close temporary connection
        mysqli_close($dbc);
                       
        // ****************************************************** 
        // rewrite backup.php        
        $write = "";
        $bak_file = fopen("../admin/backup/backup.php","w");
        if(!$bak_file){
          $errors .= "<h3 id='errors'>Could create the backup.php file...</h3>\n";
        } else {
          
            $write .= fwrite($bak_file, '<?php session_start(); if(!isset($_SESSION["username"])){header("Location: ../login.php"); exit();}');
            $write .= fwrite($bak_file, '$dbhost = "'.$_POST["dbHost"].'"; $dbuser = "'.$_POST["dbUser"].'"; $dbpass = "'.$_POST["dbPass"].'"; $dbname = "'.$_POST["dbName"].'";');
            $write .= fwrite($bak_file, 'date_default_timezone_set("America/Denver");');
            $write .= fwrite($bak_file, '$backup_file = $dbname."-".date("Y-m-d")."-".date("H:i:s") . ".sql";');
            $write .= fwrite($bak_file, '$command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $backup_file";');
            
            $write .= fwrite($bak_file, 'if(system($command) !== FALSE) {$message = "<p class='.'\''.'alert alert-success'.'\''.'>Database backup complete!</p>"; header("Location: ../index.php?id=".$message."");}');
            $write .= fwrite($bak_file, 'else {$message = "<p class='.'\''.'alert alert-warning'.'\''.'>Database backup failed!</p>"; header("Location: ../index.php?id=".$message."");}?>');
                                     
                                     
            echo $write;                                      
            fclose($bak_file);        
            $alert .= "<h3 id='alert'>New backup.php file created...</h3>\n";
        
        }       
         
        // ******************************************************            
        // rewrite connection.php
        $conn_file = fopen("connection.php","w");
        if(!$conn_file){
          $errors .= "<h3 id='errors'>Could not create a connection file...</h3>\n";
        } else {
            echo fwrite($conn_file, '<?php $dbc = mysqli_connect('.'"'.$db_host.'"'.', '.'"'.$db_user.'"'.', '.'"'.$db_pass.'"'.', '.'"'.$db_name.'"'.') OR die('.'"Could not connect because: "'.'.mysqli_connect_error()); ?>');               
            fclose($conn_file);        
            $alert .= "<h3 id='alert'>New database connection file created...</h3>\n";
            $alert .= "<h3 id='alert'>System configuration complete...</h3>\n";
            $alert .= "<button type='submit' name='finish' id='finish' onClick=''>Finish Installation</button><br/><br/>";
        }
                 
      }
      
    } else {
      $errors = "<h3 id='errors'>All fields are required!</h3>";
    }
    
}

// unlink() sys.config.php  
if(isset($_POST['finish'])){
    $sys_file = "sys.config.php";
    if(unlink($sys_file)){
      header("Location: ../admin");
     } else {
        $errors = "<h3 id='errors'>!Important: For security reasons, sys.config.php should be deleted manually.<br/>File Path: /config/sys.config.php</h3>/n";
     }
}
 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>System Configuration</title>
<style type="text/css">
body { margin: 0; padding: 0; font-size: 18px; }
section { width: 600px; margin: 0 auto; }
h1 { text-align: center; font-size: 60px; line-height: 30px;}
h2 { text-align: center; }
#alert { font-weight: bold; color: #3D6E2E; width: 100%; line-height: 20px; }
#errors { font-weight: bold; color: #f00; width: 100%; line-height: 20px; }
fieldset { padding: 40px; margin-bottom:50px; }
fieldset label { font-weight: bold; }
fieldset input{ width: 94%; padding: 15px; font-size: 18px; }
fieldset .submit{ padding: 15px; font-size: 18px; }
#finish { padding: 15px; font-size: 18px; }
</style>
</head>

<body>
<section>
<h1>atom.cms</h1>
<h2>System Configuration File</h2>

<form action="sys.config.php" method="POST">

  <fieldset>
    <?php echo $errors; ?>
    <?php echo $alert; ?> 
         
    <div id="con-fields">
      <h2>Connect to Database</h2>
      
      <label for="dbHost">Database Hostname:</label><br/>
      <input id="dbHost" type="text" name="dbHost" autocomplete="off"/><br/><br/>
    
      <label for="dbUser">Database Username:</label><br/>
      <input id="dbUser" type="text" name="dbUser" autocomplete="off"/><br/><br/>
    
      <label for="dbPass">Database Password:</label><br/>
      <input id="dbPass" type="password" name="dbPass" autocomplete="off"/><br/><br/>
      
      <label for="dbName">Database Name:</label><br/>
      <input id="dbName" type="text" name="dbName" autocomplete="off"/><br/><br/>
  
      <h2>Administrator Information</h2>
      
      <label for="adFirst">First name:</label><br/>
      <input id="adFirst" type="text" name="adFirst" autocomplete="off"/><br/><br/>
      
      <label for="adLast">Last Name:</label><br/>
      <input id="adLast" type="text" name="adLast" autocomplete="off"/><br/><br/>
      
      <label for="adEmail">Email:</label><br/>
      <input id="adEmail" type="email" name="adEmail"/><br/><br/>
      
      <label for="adPass">Password:</label><br/>
      <input id="adPass" type="password" name="adPass" autocomplete="off"/><br/><br/>  
      
      <button type="submit" name="submit" class="submit">Check Connection</button>
    </div> 
     
  </fieldset>

</form>
</section>
<?php if(isset($_POST['submit']) && $errors == "") { ?> 
<script>
 var fields = document.getElementById("con-fields");
 fields.style.display = "none";
</script>
<?php } ?>
</body>
</html>