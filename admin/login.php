<?php 
session_start();
include('../config/connection.php');
DEFINE('D_TEMPLATE', 'themes/default');
# get logo
$q ="SELECT * FROM settings WHERE id = 'site-logo'";
$r = mysqli_query($dbc, $q);
$data = mysqli_fetch_assoc($r);
$site_logo = $data['value'];
# get URL
$q ="SELECT * FROM settings WHERE id = 'site-url'";
$r = mysqli_query($dbc, $q);
$data = mysqli_fetch_assoc($r);
$site_url = $data['value'];
# get title
$q ="SELECT * FROM settings WHERE id = 'site-title'";
$r = mysqli_query($dbc, $q);
$data = mysqli_fetch_assoc($r);
$site_title = $data['value'];

# check for bots and compare password
if($_POST) {
  if(empty($_POST['lname'])){ // botstomper
  
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $q = "SELECT * FROM users WHERE email = '$email' AND password = SHA1('$password')";
    $r = mysqli_query($dbc, $q);
  
    if(mysqli_num_rows($r) == 1) {
      $_SESSION['username'] = $email;
      header('Location: index.php');
    }
  }
  else{
    $errors .= "\n Error: and another bot bites the dust...";
    die();
  }  
}
?>
<!DOCTYPE html>
<html>	
<head>
  <meta charset="utf-8"/>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../<?php echo D_TEMPLATE.'/styles.css'; ?>">
</head>	
<body>	
	<div id="bg">
    <div class="center-wrap">
      <div id="login-box">
        <?php if($site_logo != ""){ ?>
        <div class="logo-wrap">
          <a href="<?php echo $site_url ?>">
            <img class="login-logo" src="<?php echo $site_logo ?>" alt="site-logo"/>
          </a>
        </div>
        <?php } else { ?>
        <h2 class="login-title"><?php echo stripslashes(preg_replace('/xescapequotex/', '\'', $site_title)); ?></h2>
        <?php } ?>
        <form action="login.php" method="post" role="form">
        <p>
          <input id="botstomper" type="text" name="lname" autocomplete="off"/>
          <label for="email"><strong>Email Address:</strong></label><br/>
          <input type="email" id="email" name="email" placeholder="Enter email">
        </p>
        <p>
          <label for="password"><strong>Password:</strong></label><br/>
          <input type="password" id="password" name="password" placeholder="Password">
        </p>
          <button class="submit" type="submit">Login</button>
        </form>               
      </div><!-- #login-box -->         
    </div><!-- #center-wrap -->
	</div><!-- #bg -->		
</body>
</html>