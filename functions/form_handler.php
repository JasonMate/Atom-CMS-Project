<?php 
include('../config/connection.php');
// Get site-email and site-url
function setting_value($dbc, $id){
	$q = "SELECT * FROM settings WHERE id = '$id'";
	$r = mysqli_query($dbc, $q);
	$data = mysqli_fetch_assoc($r);

	return $data['value'];	
}

$errors = '';
$site_email = setting_value($dbc, 'site-email');
$site_title = setting_value($dbc, 'site-title');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  // Process form if lname is empty
  if(empty($_POST['lname'])) {
    if(empty($_POST['name'])  || 
       empty($_POST['email']) || 
       empty($_POST['message'])) {
       $errors .= "<h3 class='error'>Error: All fields are required...</h3>";
       echo $errors;
    }
    // get data
    $name = strip_tags(trim($_POST['name']));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email_address = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL); 
    $email_message = trim($_POST["message"]);
     
    // validate email
    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
      $errors = "<h3 class='error'>Error: Invalid email address...</h3>";
      echo $errors;
    }
              
  }
  else {
    $errors = "<h3 class='error'>Error: and another bot bites the dust...</h3>";
    die();
  }
 
  // if no errors email $site_email
  if(empty($errors)) {
    $to = $site_email; 
    $email_subject = "Contact form submission from: $name";
    $email_body = "You have received a new message at $site_title. \n".
    " Here are the details:\n Name: $name \n Email: $email_address \n Message: \n $email_message";
    
    $headers = "From: $site_email\n"; 
    $headers .= "Reply-To: $email_address";
    
    mail($to,$email_subject,$email_body,$headers);
    echo "<h3 class='success'>Thank you for contacting me. I will be in touch soon.</h3>";
  }
}

else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    $errors = "<h3 class='error'>Error: There was a problem with your submission, please try again...</h3>";
    echo $errors;
}
?>