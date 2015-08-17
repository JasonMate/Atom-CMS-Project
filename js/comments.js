$(document).ready(function() { 
	$("#msgSubmit").on('click', function(e) {
		e.preventDefault();
		var lname = $('#botstomper').val();
		var name = $('#msgName').val();
		var email = $('#msgEmail').val();
    var message = $('#msgMessage').val();
    var post_id = $('#postId').val();
				
		$.post('functions/comments.php', {lname: lname, msgName: name, msgEmail: email, msgMessage: message, postId: post_id}, function(result) {
       $('#status-message').html(result);
       $("#msgForm")[0].reset();      
       $('#status-message').css('display', 'block');   
       $('#status-message').delay(3000).fadeOut('fast');
    });
  });
});