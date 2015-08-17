<?php
include_once('functions/message.php');
$folder = '../images/';
$filetype = '*.*';
$files = glob($folder.$filetype);
$count = count($files);

$sortedArray = array();
for($i = 0; $i < $count; $i++) {
  $sortedArray[filemtime($files[$i])] = $files[$i];
}

$table_name = 'images';
$page_name = 'media';
$page_rows = 36;
include('./functions/pagination.php');
?>
<h1><i class="fa fa-file-image-o"></i>&nbsp;&nbsp;Media Manager</h1>

<form action="functions/images.php" class="dropzone" id="imageDropzone" name="imageDropzone">  
  <input type="file" name="file">
  <input type="hidden" name="alt" value=""/>  
</form>

<section class="content-wrap">
  <div class="gallery">        
  <?php while($img = mysqli_fetch_array($r, MYSQLI_ASSOC)){ ?>  
   
    <div class="img-wrap">           
      <div>
        <p class="img-url"><?php echo $img['path']; ?></p>
        <a name="<?php echo $img['path']; ?>" href="<?php echo $img['path']; ?>"><img class="media-img" src="<?php echo $img['path']; ?>" /></a>
      </div>

      <?php $img_file = str_replace($site_url, "", $img['path']); ?>      
      <button data-file="<?php echo '../..'.$img_file; ?>" data-url="<?php echo $img['path']; ?>" class="delete-img"><i class="fa fa-trash-o"></i></button>

     <form class="slct_box" method="post">
     <span>Gallery:
     <select class="slct_gal" name="gallery">
       <?php if($img['gallery'] != 'No Gallery'){ ?>
       <option value="<?php echo $img['gallery']; ?>"><?php echo $img['gallery']; ?></option>
       <option value="No Gallery">No Gallery</option>
       <?php } else { ?>
       <option value="No Gallery">No Gallery</option>
       <?php } ?>
       <?php 
       $query = "SELECT label from pages WHERE type = '2'";
       $result = mysqli_query($dbc, $query);
       while($gallerys = mysqli_fetch_array($result)){ ?>
       <option value="<?php echo $gallerys['label']; ?>"><?php echo $gallerys['label']; ?></option>
       <?php } ?>
     </select>
     </span>
     <input type="hidden" class="img_id" name="path" value="<?php echo $img['id']; ?>">     
     </form>

    </div><!-- .img-wrap -->
       
  <?php } ?>            
  </div><!-- .gallery -->
  
</section>
<div class="media_pagination_wrap"><div id="pagination_controls"><?php echo $paginationCtrls; ?></div></div>
<script>
// *****************************************************************************************

// add image to folder and urls, alts in images table
$(document).ready(function() {			
  Dropzone.autoDiscover = false;  			
  var myDropzone = new Dropzone("#imageDropzone");
         
  myDropzone.on("complete", function(file){       
    var altTag = prompt("Please include an alt tag for the image:", "Image Description");        
    document.imageDropzone.alt.value = altTag;
    document.forms["imageDropzone"].submit();             
    window.location.reload(true);    		      	
 });		  
});
// *****************************************************************************************

// change status of image
$(document).ready(function() {
	$(".slct_gal").change(function() {
	
     var gallery = $(this).val();
     var id = $(this).closest('span').siblings('input').val();

		 $.post('functions/img_status.php', {gallery: gallery, id: id}, function(result) {        
				location.reload();
		 }); 

	});
});
// *****************************************************************************************

// Delete image
$(document).ready(function() {
  $(".delete-img").on("click", function() {
    var here = $(this).parent();
    var fileName = $(this).attr('data-file');
    var fileUrl = $(this).attr('data-url');
    //alert(fileName);    
    var status = confirm('Are you sure you want to delete this image?');
    if (status == true) {
      $.post('functions/delete_img.php', {image: fileName, url: fileUrl}, function(result) {
        here.remove();
      });
    };
    return false;
  });
});
// *****************************************************************************************	
</script>