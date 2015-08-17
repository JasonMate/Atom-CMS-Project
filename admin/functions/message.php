<?php if(isset($message)) {?>
<script type="text/javascript">
$(document).ready(function () {
  $('#message').css('display', 'block');   
  $('#message').delay(3000).fadeOut('fast');
});  
</script>
<style type="text/css">
/* MESSAGE CONTROL STYLES*/
#message {
  display: none;
  position: absolute;
  top: 10px;
  left: 45%;
  border-radius: 17px;
}

#message p.alert {
  font-size: 18px;
  font-weight:bold;
  padding: 5px 15px;     
}

#message p.alert-success {
  background-color:#44B090;
  color:#fff;
  display: block;
}

#message p.alert-warning, .alert-danger {
  background-color:#D43033;
  color:#fff;
  display: block;
}

</style>
<?php } ?>
<div id="message"><?php if(isset($message)) {echo $message;} ?></div>