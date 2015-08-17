<!-- Contact Page -->
$(document).ready(function() { 
	$("#contact_submit").on('click', function(e) {
		e.preventDefault();
		
		var name = $('#name').val();
		var email = $('#email').val();
		var message = $('#message').val();
		var lname = $('#botstomper').val();
    var answer = $('#bs-answer').val();
		
		$.post('functions/form_handler.php', { name: name, email: email, message: message, lname: lname, answer: answer}, function(result) {
      $('#status-message').html(result);
      $("#contact-form")[0].reset();
      $('#status-message').css('display', 'block');   
      $('#status-message').delay(3000).fadeOut('fast');
    });
  });
});
