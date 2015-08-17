<?php
/*
*********************************** DEBUG CONSOLE ***********************************
* Profile page needs fixed so it doesnt show the admin table and user id in the url
* Remove label and header columns from database (requires modifying all querys)
* System needs a regex for slugs
* Pagination for comments
* Gallery breaks if page name has a quote
* 404 page needs work

********* NEEDS TESTING ***********
* single quotes on Settings, Users, Sliders
* timestamps for load blog and filter results
* 
************ NOTES ****************
Page Types: $page['type']
* default = 1
* gallery = 2
* contact = 3
* full-width = 4
* blog = 5
* profile = 6
* search - 7
-----------------------------------
*/
?>
<div id="console-debug" style="display: none;">	
<h2 class="debug-title">Debug Panel</h2>
<!-- variables -->
<div>
<h2>Echo Variables:</h2>
<?php
echo "<p>View file is: ".$view['name'].".php</p><br/>";
echo "<p>PHP_SELF is: ".$_SERVER['PHP_SELF']."</p><br/>";
echo "<p>SERVER_NAME is: ".$_SERVER['SERVER_NAME']."</p><br/>";
echo "<p>REQUEST_URI is: ".$_SERVER['REQUEST_URI']."</p><br/>";

echo "<h2>User Info:</h2>";
echo "<p>REQUEST_URI is: ".$user['id']."</p><br/>";
print_r($_COOKIE);


echo "<p>filter1_name:".$filter1_name."</p>";
?>
</div>

<!-- all vars -->
<div>
<?php 
//$all_vars = get_defined_vars(); 
//print_r($all_vars); 
?>
</div>

<!-- conditions -->
<div>
<h2>Condition Testing:</h2>
<?php

if(isset($post['id']) != ''){
  
  echo "<p>Post id is set. ID: ".$post['id']."</p>";
  
} else if(isset($page['id']) != '') {
  
  echo "<p>Page id is set. ID: ".$page['id']."</p>";
  
} else {
  
  echo "<p>CONDITION FAILED</p>"; 
}

?>
</div>

<!-- arrays -->
<h2>Path Array:</h2>
<div><?php print_r($path); ?></div>
	
<h2>GET:</h2>
<div><?php print_r($_GET); ?></div>	
	
<h2>POST:</h2>
<div><?php print_r($_POST); ?></div>	

<h2>View Array:</h2>	
<div><?php print_r($view); ?></div>

<h2>Post Array:</h2>	
<div><?php print_r($post); ?></div>

<h2>Page Array:</h2>	
<div><?php print_r($page); ?></div>

</div><!-- #console-debug -->