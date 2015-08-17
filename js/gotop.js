$(document).ready(function() { 
/*
  // header - add color
  $(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
     $('#header').css({'background': '#000', 'transition': '0.3s'});
     // $('#header').css({'background': 'linear-gradient(130deg, rgba(0,0,0,0.2), rgba(255,255,255,0.1), rgba(0,0,0,0.2)), #BAB293', 'transition': '0.3s'});    
      
    } else {
      $('#header').css({'background': 'transparent', 'transition': '0.3s'});
    }
  });
*/
  // Show or hide scroll top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
      $('.go-top').fadeIn(200);
    } else {
      $('.go-top').fadeOut(200);
    }
  });
  
  // Animate the scroll to top
  $('.go-top').click(function(event) {
    event.preventDefault();
    
    $('html, body').animate({ scrollTop: 0 }, 1500);
  });
     
}); 

// *************************************************************************************
// Next location anchor link    
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({ scrollTop: target.offset().top }, 1000);
        return false;
      }
    }
  });
});

// active anchor link
/*
$('#navigation li').click(function() {
   $(this).addClass('active').siblings('li').removeClass('active');
});
*/