<?php
// Setup File:
error_reporting(0);
// Database Connection:
include('../config/connection.php');
// Constants:
DEFINE('D_TEMPLATE', 'template');
// Functions:
include('functions/data.php');
// Site Setup:
$debug = data_setting_value($dbc, 'debug-status');
$site_title = data_setting_value($dbc, 'site-title');
$site_url = data_setting_value($dbc, 'site-url');
$site_theme = data_setting_value($dbc, 'site-theme');
$allow_comments = data_setting_value($dbc, 'allow-comments');
$site_email = data_setting_value($dbc, 'site-email');
$filter1_name = data_setting_value($dbc, 'filter1-name'); 
$filter2_name = data_setting_value($dbc, 'filter2-name');
$filter3_name = data_setting_value($dbc, 'filter3-name');

if(isset($_GET['page'])) {
  
	$page = $_GET['page']; 
  
} else {
  // Set landing page for Admin Panel.
	$page = 'dashboard'; 
}
// Page Setup:
include('config/queries.php');
// User Setup:
$user = data_user($dbc, $_SESSION['username']);
?>