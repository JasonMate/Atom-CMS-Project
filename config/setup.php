<?php
# Connect to database
include('config/connection.php');

# Functions:
include('functions/data.php');

# Theme folder:
$site_theme = setting_value($dbc, 'site-theme');

# Settings:
$site_title = setting_value($dbc, 'site-title');
$site_logo = setting_value($dbc, 'site-logo');
$home_page = setting_value($dbc, 'home-page');
$site_url = setting_value($dbc, 'site-url');
//$site_url = "http://" . $_SERVER['SERVER_NAME'];
$debug = setting_value($dbc, 'debug-status');
$site_email = setting_value($dbc, 'site-email');
$copyright = setting_value($dbc, 'copyright-info');

$allow_comments = setting_value($dbc, 'allow-comments');
$site_author = setting_value($dbc, 'site-author');
$site_description = setting_value($dbc, 'site-description');
$site_keywords = setting_value($dbc, 'site-keywords');
$analytics = setting_value($dbc, 'site-analytics'); 

$facebook = setting_value($dbc, 'facebook-info');
$google = setting_value($dbc, 'google-info');
$linkedin = setting_value($dbc, 'linkedin-info');
$twitter = setting_value($dbc, 'twitter-info');
$pinterest = setting_value($dbc, 'pinterest-info');
$github = setting_value($dbc, 'github-info');
$behance = setting_value($dbc, 'behance-info');
$youtube = setting_value($dbc, 'youtube-info');

$filter1_name = setting_value($dbc, 'filter1-name'); 
$filter2_name = setting_value($dbc, 'filter2-name');
$filter3_name = setting_value($dbc, 'filter3-name');

# Embedded CSS:
$child_css = setting_value($dbc, 'child-css');
# Embedded JS:
$child_js = setting_value($dbc, 'child-js');

# Widgets:
$header_w1 = widget_value($dbc, 'header-w1');
$side_w1 = widget_value($dbc, 'side-w1');
$side_w2 = widget_value($dbc, 'side-w2');
$side_w3 = widget_value($dbc, 'side-w3');
$side_w4 = widget_value($dbc, 'side-w4');
$side_w5 = widget_value($dbc, 'side-w5');
$side_w6 = widget_value($dbc, 'side-w6');
$contact_w1 = widget_value($dbc, 'contact-w1');
$contact_w2 = widget_value($dbc, 'contact-w2');

# If a path is not declared then set it to home page
$path = get_path();

if(!isset($path['call_parts'][0]) || $path['call_parts'][0] == '' ) {
	$path['call_parts'][0] = $home_page;
}

$pre_url = './';
//if(isset($path['call_parts'][1])) { $pre_url = './../'; }

# Constants:
DEFINE('D_TEMPLATE', $pre_url.'themes/'.$site_theme.'');

# Page Setup
$page = @data_page($dbc, $path['call_parts'][0]);
$post = @data_post($dbc, $path['call_parts'][0]);

if(isset($page['id']) != ''){ 
  $view = data_page_type($dbc, $page['type']); 
}

# Hit Counter
$visitors = "Visitor";
if(empty($_COOKIE['visits'])){  
  $counterFile = "config/hitcount.txt";
  if(file_exists($counterFile)){
    $hits = file_get_contents($counterFile);
    ++$hits;   
  } else {
    $hits = 1; 
  }  
  if(file_put_contents($counterFile, $hits)){
    setcookie("visits", $visitors, time()+3600);
  } 
}
?>