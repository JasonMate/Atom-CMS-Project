<?php 
// db connection
include('../config/connection.php');

$errors = '';
// check all required fields and also check if botstomper has been filled out
if($_POST['msgName'] != '' && $_POST['msgEmail'] != '' && $_POST['msgMessage'] != '' && $_POST['lname'] == ''){
    // get comment date 
    $msg_date = @date("m-d-Y");
   
    // set status to be sent to admin panel for approval
    $status = 0;
    
    // get data
    $msg_name = mysqli_real_escape_string($dbc, $_POST['msgName']);
    $msg_email = filter_var($_POST["msgEmail"], FILTER_SANITIZE_EMAIL);
    $msg_body = mysqli_real_escape_string($dbc, $_POST['msgMessage']);
    $postId = $_POST['postId'];  

    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $msg_email)) {
      $errors = "<h4 class='error'>Error: Invalid email address.</h4>";
      echo $errors;
    }
    
    if(empty($errors)) {
      // query db
      $q = "INSERT INTO comments (name, email, message, status, post_id, date) VALUES ('$msg_name', '$msg_email', '$msg_body', '$status', '$postId', '$msg_date')";
      $r = mysqli_query($dbc, $q);    
      // error handeling
      if($r){        
        echo "<h4 class='success'>Thank you, I have received your comment.</h4>";          
      } else {        
        $errors = "<h4 class='error'>Error: There was a problem receiving your comment.</h4>"; 
        echo $errors;
      }
    }
         
} else {  
    $errors = "<h4 class='error'>Error: All fields are required.</h4>";
    echo $errors;  
}
?>