<?php
$gal_limit = 18;
$gal_start = 0;
$header = $page['header'];
$q = "SELECT COUNT(id) FROM images WHERE gallery = '$header'";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
$rows = $row[0];

$q = "SELECT * FROM images WHERE gallery = '$header' ORDER BY id DESC LIMIT $gal_limit";
$r = mysqli_query($dbc, $q);
?>

<div id="bg">					
  <?php include(D_TEMPLATE.'/header.php'); ?>
  <div class="center-wrap"> 
    <div class="body-wrap full-width">  
                 
      <?php     
      if($page['slider'] !== 0){
        if($page['slider'] == 1){ include('plugins/sliders/slider1.php'); }
        if($page['slider'] == 2){ include('plugins/sliders/slider2.php'); }
        if($page['slider'] == 3){ include('plugins/sliders/slider3.php'); }
      }?> 
       
      <h1><?php echo stripslashes($page['header']); ?></h1>
      <div id="gallery-grid">
      
        <?php while($img = mysqli_fetch_assoc($r)){ ?>        
        <div class="gal-tile">                
           <a class="fancybox" rel="group" href="<?php echo $img['path']; ?>"><img class="tile-img" src="<?php echo $img['path']; ?>" alt="<?php echo $img['alt']; ?>" /></a>   
        </div>                
        <?php } ?> 
                      
      </div><!-- #gallery-grid -->
      <input type="hidden" name="gal_count" id="gal_count" value="<?php echo $gal_start; ?>">
      <?php if($rows >= $gal_limit) { ?>
      <button id="load_gal" class="submit">Load More Images</button>  
      <?php } ?>
    </div><!-- .body-wrap -->     
  </div><!-- #center-wrap -->		
<?php include(D_TEMPLATE.'/footer.php'); ?>		
</div><!-- #bg -->