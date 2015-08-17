<?php
	switch ($page) {

		case 'dashboard':

		break;

		case 'pages':

			if(isset($_POST['submitted']) == 1) {
        
				$header = mysqli_real_escape_string($dbc, $_POST['header']);
				$body = mysqli_real_escape_string($dbc, $_POST['body']);
        $slider = $_POST['slider'];
        $type = $_POST['type'];

				if(isset($_POST['id']) != '') {
          
					$action = 'updated';
          if($_POST['slug'] != ''){
            
					  $q = "UPDATE pages SET user = $_POST[user], slug = '$_POST[slug]', title = '$header', label = '$header', header = '$header', body = '$body', slider = '$slider', type = '$type' WHERE id = $_GET[id]";
            
          } else {
            
            $reason = 'You didn\'t include a slug';
            
          }
          
				} else {
          
          if($_POST['slug'] != ''){
            
            if($_POST['type'] != ''){
              
              $action = 'added';							
              $q = "INSERT INTO pages (user, slug, title, label, header, body, slider, type) VALUES ($_POST[user], '$_POST[slug]', '$header', '$header', '$header', '$body', '$slider', '$type')";
              
            } else {
              
              $action = 'added';
              $reason = 'You didn\'t include a page type';
              
            }
            
          } else {
            
            $action = 'added';
            $reason = 'You didn\'t include a slug';
            
          }
          
				}

				$r = mysqli_query($dbc, $q);

				if($r){

					$message = '<p class="alert alert-success">Page was '.$action.'</p>';

				} else {

					$message = '<p class="alert alert-danger">Page could not be '.$action.' because: '.$reason.'!</p>';

				}

			}

			if(isset($_GET['id'])) { $opened = data_page($dbc, $_GET['id']); }

		break;

		case 'posts':

			if(isset($_POST['submitted']) == 2) {
        
				$header = mysqli_real_escape_string($dbc, $_POST['header']);
				$body = mysqli_real_escape_string($dbc, $_POST['body']);
        $date = $_POST['date'];        
        $filter1 = $_POST['filter1'];        
        $filter2 = $_POST['filter2'];
        $filter3 = $_POST['filter3'];
        $url = $_POST['url'];
        $tags = mysqli_real_escape_string($dbc, $_POST['tags']);
        
        if ($date == '') { $date = date('Y-m-d H:i:s'); }
				if(isset($_POST['id']) != '') {
          
					$action = 'updated';
          if($_POST['slug'] != ''){
            
					  $q = "UPDATE posts SET user = $_POST[user], slug = '$_POST[slug]', thumbnail = '$_POST[thumbnail]', title = '$header', label = '$header', header = '$header', body = '$body', date = '$date', filter1 = '$filter1', filter2 = '$filter2', filter3 = '$filter3', tags = '$tags', status = $_POST[status] WHERE id = $_GET[id]";
            
          } else {
            
            $reason = 'You didn\'t include a slug';
            
          }
          
				} else {
          
          if($_POST['slug'] != ''){
              
              $action = 'added';							
              $q = "INSERT INTO posts (user, slug, thumbnail, title, label, header, body, date, filter1, filter2, filter3, tags, status) VALUES ($_POST[user], '$_POST[slug]', '$_POST[thumbnail]', '$header', '$header', '$header', '$body', '$date', '$filter1', '$filter2', '$filter3', '$tags', $_POST[status])";
                         
          } else {
            
            $action = 'added';
            $reason = 'You didn\'t include a slug';
            
          }
          
				}

				$r = mysqli_query($dbc, $q);

				if($r){

					$message = '<p class="alert alert-success">Post was '.$action.'</p>';

				} else {

					$message = '<p class="alert alert-danger">Post could not be '.$action.' because: '.$reason.'!</p>';

				}

			}

			if(isset($_GET['id'])) { $opened = data_post($dbc, $_GET['id']); }

		break;
    
		case 'comments':

			if(isset($_POST['submitted']) == 1) {
        
        $name = mysqli_real_escape_string($dbc, $_POST['name']);
        $email = $_POST['email'];
        $message = mysqli_real_escape_string($dbc, $_POST['message']);
        $status = $_POST['status'];
        $postId = $_POST['post_id'];
        $date = $_POST['date'];
        
				if(isset($_POST['id']) != '') {

				  $action = 'updated';
					$q = "UPDATE comments SET name = '$name', email = '$email', message = '$message', status = '$status', post_id = '$postId', date = '$date' WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);

				} 

				if($r){

					$message = '<p class="alert alert-success">Comment was '.$action.'</p>';
          
				} else {

					$message = '<p class="alert alert-danger">Comment could not be '.$action.'!</p>';

				}

			}

		break;

		case 'users':

			if(isset($_POST['submitted']) == 1) {

				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);
        $bio = mysqli_real_escape_string($dbc, $_POST['bio']);

				if($_POST['password'] != '') {

					if($_POST['password'] == $_POST['password']) {

						$password = " password = SHA1('$_POST[password]'),";
						$verify = true;

					} else {

						$verify = false;

					}					

				} else {

					$verify = false;	

				}

				if(isset($_POST['id']) != '') {

					
          if($_POST['first'] != '' && $_POST['email'] != '') {
            
            $action = 'updated';
            $q = "UPDATE users SET first = '$first', 
                                   last = '$last', 
                                   email = '$_POST[email]', 
                                   $password 
                                   authg = '$_POST[authg]', 
                                   autht = '$_POST[autht]', 
                                   authl = '$_POST[authl]',
                                   bio = '$bio', 
                                   status = $_POST[status] WHERE id = $_GET[id]";
                                   
            $r = mysqli_query($dbc, $q);
          
          } else {
            
            $action = 'updated';
            $reason = 'You must include your name';
            
          }

				} else {
          
          if($_POST['first'] != '' && $_POST['email'] != '') {
            
            $action = 'added';
            $q = "INSERT INTO users (first, last, email, password, authg, autht, authl, bio, status) VALUES ('$first', '$last', '$_POST[email]', SHA1('$_POST[password]'), '$_POST[authg]', '$_POST[autht]', '$_POST[authl]', '$bio', '$_POST[status]')";
  
            if($verify == true) {
              
              $r = mysqli_query($dbc, $q);
              
            }
            
          } else {
            
            $action = 'added';
            $reason = 'You must include your name';  
                      
          }
          
				}

				if($r){

					$message = '<p class="alert alert-success">User was '.$action.'</p>';

				} else {

					$message = '<p class="alert alert-danger">User could not be '.$action.' because: '.$reason.'!</p>';
          
					if($verify == false) {
            
					  $message .= '<p class="alert alert-danger">Password fields empty and/or do not match!</p>';
            
					}

				}

			}

			if(isset($_GET['id'])) { $opened = data_user($dbc, $_GET['id']); }

		break;    

		case 'widgets':

			if(isset($_POST['submitted']) == 1) {
        
        $label = mysqli_real_escape_string($dbc, $_POST['label']);
        $value = mysqli_real_escape_string($dbc, $_POST['value']);
				if(isset($_POST['id']) != '') {

				  $action = 'updated';
					$q = "UPDATE widgets SET label = '$label', value = '$value' WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);

				} 

				if($r){

					$message = '<p class="alert alert-success">Widget was '.$action.'</p>';
          
				} else {

					$message = '<p class="alert alert-danger">Widget could not be '.$action.'!</p>';

				}

			}

		break;
    
		case 'sliders':

			if(isset($_POST['submitted']) == 1) {
        
        $label = $_POST['label'];
        $value = $_POST['value'];
        $alt = $_POST['alt'];
        $url = $_POST['url'];
				if(isset($_POST['id']) != '') {
          
            $action = 'updated';
            $q = "UPDATE sliders SET label = '$label', value = '$value', alt = '$alt', url = '$url' WHERE id = '$_POST[openedid]'";
            $r = mysqli_query($dbc, $q);
            

				} 

				if($r){

					$message = '<p class="alert alert-success">Slider was '.$action.'</p>';
          
				} else {

					$message = '<p class="alert alert-danger">Slider could not be '.$action.' because: '.$reason.'!</p>';

				}

			}

		break;

		case 'navigation':
    
      if($_POST['label'] != '' && $_POST['url'] != ''){
        if(isset($_POST['submitted']) == 2) {
          $label = mysqli_real_escape_string($dbc, $_POST['label']);
          $url = mysqli_real_escape_string($dbc, $_POST['url']);
          $position = mysqli_real_escape_string($dbc, $_POST['position']);
          $status = 1;
          $action = 'added';							
          $q = "INSERT INTO navigation (id, label, url, icon, position, sub, status) VALUES ('$_POST[id]', '$label', '$url', '$_POST[icon]', '$_POST[position]', '$_POST[sub]', $status)";
          $r = mysqli_query($dbc, $q);
          
        }
        
      }

			if(isset($_POST['submitted']) == 1) {

				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$url = mysqli_real_escape_string($dbc, $_POST['url']);
        $sub = mysqli_real_escape_string($dbc, $_POST['sub']);
				if(isset($_POST['id']) != '') {

					$action = 'updated';
					$q = "UPDATE navigation SET id = '$_POST[id]', label = '$label', url = '$url', icon = '$_POST[icon]', position = $_POST[position], sub = '$sub', status = $status WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);
          
				} 
          
				if($r){

					$message = '<p class="alert alert-success">Navigation was '.$action.'</p>';

				} else {

					$message = '<p class="alert alert-danger">Navigation could not be '.$action.'!</p>';

				}

			}

		break;
    
		case 'filters':
    
      if($_POST['label'] != ''){
        if(isset($_POST['submitted']) == 2) {
                    
          $label = preg_replace('/\'/', 'xescapequotex', $_POST['label']);
          $type = mysqli_real_escape_string($dbc, $_POST['type']);
          $position = mysqli_real_escape_string($dbc, $_POST['position']);
          $status = 1;
          $action = 'added';							
          $q = "INSERT INTO filters (id, label, type, position, status) VALUES ('$_POST[id]', '$label', '$_POST[type]', '$_POST[position]', $status)";
          $r = mysqli_query($dbc, $q);
          
        }
        
      }

			if(isset($_POST['submitted']) == 1) {

        $label = preg_replace('/\'/', 'xescapequotex', $_POST['label']);
        $type = mysqli_real_escape_string($dbc, $_POST['type']);
        $position = mysqli_real_escape_string($dbc, $_POST['position']);
        $status = mysqli_real_escape_string($dbc, $_POST['status']);
				if(isset($_POST['id']) != '') {

					$action = 'updated';
					$q = "UPDATE filters SET id = '$_POST[id]', label = '$label', type = '$type', position = $_POST[position], status = '$status' WHERE id = '$_POST[openedid]'";
					$r = mysqli_query($dbc, $q);
          
				} 
          
				if($r){

					$message = '<p class="alert alert-success">Filter was '.$action.'</p>';

				} else {

					$message = '<p class="alert alert-danger">Filter could not be '.$action.'!</p>';

				}

			}

		break;
    
    		case 'theme':

			if(isset($_POST['submitted']) == 1) {

        $label = $_POST['label'];
        $value = mysqli_real_escape_string($dbc, $_POST['value']);
				if(isset($_POST['id']) != '') {
          
          if(isset($site_theme)) {   
            $action = 'updated';
            $q = "UPDATE settings SET id = '$_POST[id]', label = '$label', value = '$value' WHERE id = '$_POST[openedid]'";
            $r = mysqli_query($dbc, $q);
       
          } else {
            $action = 'updated';
            $reason = 'You must include the theme folder name';
            
          }

				} 

				if($r){

					$message = '<p class="alert alert-success">Theme was '.$action.'</p>';
				} else {

					$message = '<p class="alert alert-danger">Theme could not be '.$action.' because: '.$reason.'!</p>';
				}

			}

		break;
    
		default:

		break;
	}

?>