<?php
// ==================== SETTINGS ========================
function data_setting_value($dbc, $id){

	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);

	return $data['value'];	
}

// ===================== WIDGETS =========================
function widget_value($dbc, $id){

	$q = "SELECT * FROM widgets WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);

	return $data['value'];	
}

// ==================== USERS ===========================
function data_user($dbc, $id) {

	if(is_numeric($id)) {
		$cond = "WHERE id = '$id'";
	} else {
		$cond = "WHERE email = '$id'";
	}

	$q = "SELECT * FROM users $cond";	
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);	
	$data['fullname'] = $data['first'].' '.$data['last'];
	$data['fullname_reverse'] = $data['last'].', '.$data['first'];
  
	return $data;
}

// ==================== PAGES ===========================
function data_page_type($dbc, $id){
	$q = "SELECT * FROM page_types WHERE id = $id";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);
  return $data;  
}

function data_page($dbc, $id) {

	$q = "SELECT * FROM pages WHERE id = $id";
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

// ==================== POSTS ===========================
function data_post($dbc, $id) {

	$q = "SELECT * FROM posts WHERE id = $id";
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

// ==================== SLIDER ==========================
function data_slider($dbc, $section){

	$q = "SELECT * FROM sliders WHERE section = '$section'";
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);

	return $data;
}

// ==================== NAVIGATION ======================
function nav_main($dbc, $pageid) {

	$q = "SELECT * FROM pages";
	$r = mysqli_query($dbc, $q);

	while($nav = mysqli_fetch_assoc($r)) { ?>	

		<li<?php if($pageid == $nav['id']) { echo ' class="active"'; } ?>><a href="?page=<?php echo $nav['id']; ?>"><?php echo $nav['label']; ?></a></li>

	<?php 
  }
}

// ====================== SANDBOX =======================
function selected($value1, $value2, $return) {
	if($value1 == $value2) {
		echo $return;
	}
}
?>