<?php
function get_path(){
  $path=array();
  if(isset($_SERVER['REQUEST_URI'])){
    $request_path = explode('?',$_SERVER['REQUEST_URI']);
    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    
    if($path['call'] == basename($_SERVER['PHP_SELF'])){
        $path['call'] = '';
    }
    
    $path['call_parts'] = explode('/', $path['call']);
    
    if(array_key_exists(1, $request_path)){
      $path['query_utf8'] = urldecode($request_path[1]);
      $path['query'] = utf8_decode(urldecode($request_path[1]));
      $vars = explode('&', $path['query']);
      
      foreach($vars as $var){
        $t = explode('=', $var);
        
        if(array_key_exists(1, $t)){
           $path['query_vars'][$t[0]] = $t[1];
        }        
      }
    }
  }
return $path;
}

function get_slug($dbc, $url) {
    $pos = strrpos($url, '/');
    $slug = substr($url, $pos + 1);
    return $slug;  
}


function selected($value1, $value2, $return) {

	if($value1 == $value2) {
		echo $return;
	}
}

// ==================== PAGES ===========================
function data_page_type($dbc, $id){
	$q = "SELECT * FROM page_types WHERE id = $id";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  return $data;  
}

function data_page($dbc, $id) {
	if(is_numeric($id)) {
		$cond = "WHERE id = $id";
	} 
  else {
		$cond = "WHERE slug = '$id'";
	}

	$q = "SELECT * FROM pages $cond";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);	
	$data['body_nohtml'] = strip_tags($data['body']);

	if($data['body'] == $data['body_nohtml']) {
		$data['body_formatted'] = '<p>'.$data['body'].'</p>';
	} 
  else {
		$data['body_formatted'] = $data['body'];
	}
	return $data;
}

// ==================== POSTS ============================
function data_post($dbc, $id) {

	if(is_numeric($id)) {
		$cond = "WHERE id = $id";
	} 
  else {
		$cond = "WHERE slug = '$id'";
	}

	$q = "SELECT * FROM posts $cond";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);	
	$data['body_formatted'] = $data['body'];
	
	return $data;
}

// ==================== USERS ===========================
function data_user($dbc, $id) {

	$q = "SELECT * FROM users WHERE id = '$id'";	
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);	
	$data['fullname'] = $data['first'].' '.$data['last'];
  
	return $data;
}

// ==================== SETTINGS ========================
function setting_value($dbc, $id){
	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);

	return $data['value'];	
}

// ==================== WIDGETS =========================
function widget_value($dbc, $id){
	$q = "SELECT * FROM widgets WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  
	return $data['value'];	
}

// ==================== NAVIGATION ======================
function nav_main($dbc, $path) {

	$q = "SELECT * FROM navigation WHERE status = 1 ORDER BY position ASC";
	$r = mysqli_query($dbc, $q);

	while($nav = mysqli_fetch_assoc($r)) { 
    $nav['slug'] = get_slug($dbc, $nav['url']); ?>	   
      <li<?php selected($path['call_parts'][0], $nav['slug'], ' class="active"') ?>><a href="<?php echo $nav['url']; ?>"><?php echo $nav['label']; ?></a></li>  
    <?php 
    }
}
?>