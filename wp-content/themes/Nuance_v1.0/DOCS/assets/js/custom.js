// Lightbox for images
$(document).ready(function() {
	$("a.fancy").fancybox({
		'titlePosition'			: 'over',
		'titleShow'				: false
});


// IMAGE GALLERY FADE OPACITY WHEN HOVER
$(document).ready(function() {

	$(function() {
	
		$(".gallery img, .fadeOutIn").css("opacity", "1");
			
		// ON MOUSE OVER
		$(".gallery img, .fadeOutIn").hover(function () {

			// SET OPACITY TO 100%
			$(this).stop().animate({
			opacity: 0.6
			}, "fast");
		},

		// ON MOUSE OUT
		function () {

			// SET OPACITY BACK TO 100%
			$(this).stop().animate({
			opacity: 1
			}, "fast");
		});	
	
	});


});

});