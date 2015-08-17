<?php // FRONT CSS Files: ?>
<!-- jQuery UI -->
<!--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />-->
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="./plugins/fa/font-awesome.css">
<!-- ************** FANCY BOX *************** -->
<!-- Add fancyBox -->
<link rel="stylesheet" href="./plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="./plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<!-- ************** MAIN CSS *************** -->
<link rel="stylesheet" type="text/css" href="<?php echo D_TEMPLATE.'/styles.css'; ?>">
<?php if($child_css != ""){ ?>
<!-- ************** Child CSS ************** -->
<style type="text/css">
<?php echo stripslashes($child_css); ?>
</style>
<?php } ?>