<?php // Javascript Files: ?>
<!-- ************** jQuery Library *************** -->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- jQuery UI -->
<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>-->
<!-- Add fancyBox -->
<script type="text/javascript" src="./plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="./plugins/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<!-- **************************************** -->
<!-- Sliders -->
<script src="plugins/sliders/slider.js" type="text/javascript"></script>
<script src="js/gotop.js" type="text/javascript"></script>
<?php if($analytics != ""){include("js/analytics.php");} ?>

<?php
// ***************** Page Types *****************
# default = 1
# gallery = 2
# contact = 3
# full-width = 4
# blog = 5
?>

<?php if(isset($page['type']) && $page['type'] == 3){ ?>
<script src="js/contact.js" type="text/javascript"></script>        
<?php } ?>

<?php if(isset($post['id']) && $allow_comments == 1){ ?>
<script src="js/comments.js" type="text/javascript"></script>
<?php } ?>
 
<?php if(isset($page['type']) && $page['type'] == 2){ ?>
<!-- Gallery Page -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
// **********************LOAD GALLERY***************************     
  $('#load_gal').on('click', function(){

    var rows = <?php echo $rows; ?>;
    var inc = <?php echo $gal_limit; ?>;
    var gal_count = Number($('#gal_count').val()) + inc;
    $('#gal_count').val(gal_count);

    $.ajax({
      url: 'functions/gallery.php?start='+gal_count+'&limit='+inc,
      beforeSend: function( xhr ) {
        xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
      }
    })
    .done(function( data ) {
      $('#gallery-grid').append(data);
    });

    if((gal_count + inc) >= rows){
     $('#load_gal').hide(); 
    }
  });
    
	});
</script>
<?php } ?>

<?php if(isset($page['type']) && $page['type'] == 5){ ?>
<script type="text/javascript">	
$(document).on('ready', function(){
  
// ***********************LOAD BLOG*****************************    
  $('#load_blog').on('click', function(){

    var rows = <?php echo $rows; ?>;
    var inc = <?php echo $blog_limit; ?>;
    var blog_count = Number($('#post_count').val()) + inc;
    $('#post_count').val(blog_count);

    $.ajax({
      url: 'functions/blog.php?start='+blog_count+'&limit='+inc,
      beforeSend: function( xhr ) {
        xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
      }
    })
    .done(function( data ) {
      $('#blog').append(data);
    });
    
    if((blog_count + inc) >= rows){
     $('#load_blog').hide(); 
    }
    
  }); // end load blog   
     
}); // end ready 
</script>
<?php } ?>

<?php if($filter1_name !== '' || $filter2_name !== '' || $filter3_name !== ''){ ?>
<script type="text/javascript">	
$(document).on('ready', function(){
// **********************SORT FILTERS****************************   
  $('.filter-select').change(function(){
    var filter1 = $('#filter1').val();  
    var filter2 = $('#filter2').val();
    var filter3 = $('#filter3').val(); 
       
    var site_url = '<?php echo $site_url; ?>';
    var filter1_name = '<?php echo $filter1_name; ?>';
    var filter2_name = '<?php echo $filter2_name; ?>';
    var filter3_name = '<?php echo $filter3_name; ?>';
          
    if(filter1 !== 0 || filter2 !== 0 || filter3 !== 0){

        $.ajax({
          url: 'functions/filters.php?filter1='+filter1+'&filter2='+filter2+'&filter3='+filter3+'&site_url='+site_url+'&filter1_name='+filter1_name+'&filter2_name='+filter2_name+'&filter3_name='+filter3_name,
          beforeSend: function( xhr ) {
            xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
          }
        })
        .done(function( data ) {
          $('#blog').empty();
          $('#blog').append(data);
        });
                
        $('#load_blog').hide();
    
    } else {
       window.location.reload();
    }

    // 1 and 2 selected
    if(filter1_name !== '' && filter2_name !== '' && filter3_name === ''){ if(filter1 == 0 && filter2 == 0){ window.location.reload(); }}     
    // 1 and 3 selected 
    else if(filter1_name !== '' && filter2_name === '' && filter3_name !== ''){ if(filter1 == 0 && filter3 == 0){ window.location.reload(); }}      
    // 2 and 3 selected  
    else if(filter1_name === '' && filter2_name !== '' && filter3_name !== ''){ if(filter2 == 0 && filter3 == 0){ window.location.reload(); }}    
    // 3 selected   
    else if(filter1_name === '' && filter2_name === '' && filter3_name !== ''){ if(filter3 == 0){ window.location.reload(); }}    
    // 2 selected   
    else if(filter1_name === '' && filter2_name !== '' && filter3_name === ''){ if(filter2 == 0){ window.location.reload(); }}    
    // 1 selected   
    else if(filter1_name !== '' && filter2_name === '' && filter3_name === ''){ if(filter1 == 0){ window.location.reload(); }} 
    // 1 and 2 and 3 selected    
    else { if(filter1 == 0 && filter2 == 0 && filter3 == 0){ window.location.reload(); }}
  
  }); // end sort filters
}); // end ready
</script>
<?php } ?>
<?php if($child_js != ""){ ?>
<script type="text/javascript">
  <?php echo stripslashes($child_js); ?>
</script>
<?php } ?>

<?php if($debug == 1){ ?>
<script src="js/debug.js" type="text/javascript"></script>
<?php } ?>