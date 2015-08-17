<?php
$search_output = "";

if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
  
	$searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']); 
  $q = "(SELECT slug, body, title AS title FROM pages WHERE title LIKE '%$searchquery%' OR body LIKE '%$searchquery%') 
  UNION (SELECT slug, body, title AS title FROM posts WHERE title LIKE '%$searchquery%' OR body LIKE '%$searchquery%')";
  
  $r = mysqli_query($dbc, $q) or die('problems');
	$count = mysqli_num_rows($r);
  
	if($count > 0){
    if($count == 1){
		  $search_output .= "<br/><hr/><p class='results-count'>$count result for \"<strong>$searchquery</strong>\"</p><hr/><br/>";
    } else {
      $search_output .= "<br/><hr/><p class='results-count'>$count results for \"<strong>$searchquery</strong>\"</p><hr/><br/>";
    }
    
		while($row = mysqli_fetch_array($r)){
	      $q_slug = $row["slug"];
		    $q_title = $row["title"];
        $q_body = strip_tags(substr($row['body'], 0, 200));
		    $search_output .= "<a href='$q_slug' class='results-title'><h4>$q_title</h4></a><p class='results-body'>$q_body</p><hr/><br/>";
    }
	} else {
		$search_output = "<br/><hr/><p class='results-count'>0 results for \"<strong>$searchquery</strong>\"</p><hr/><br/>";
	}
}
?>

<div id="bg">					
  <?php include(D_TEMPLATE.'/header.php'); ?>

  <div class="center-wrap"> 
    <div class="body-wrap"> 
      <?php include(D_TEMPLATE.'/sidebar.php'); ?>      
      <main id="main-content"> 
         <h1><?php echo stripslashes($page['header']); ?></h1>            		
         <?php echo stripslashes($page['body_formatted']); ?>
           
          <div class="search-box">
            <form action="./search" method="post">        
              <input class="search-input" type="text" name="searchquery" placeholder="Search Keywords..."/>
              <button class="search-submit" type="submit" name="search"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
            </form>
          </div>
        
         <div class="search-results">
           <?php echo stripslashes($search_output); ?>
         </div> 
                   
      </main> 
    </div><!-- .body-wrap -->     
  </div><!-- #center-wrap -->		
<?php include(D_TEMPLATE.'/footer.php'); ?>
</div><!-- #bg -->