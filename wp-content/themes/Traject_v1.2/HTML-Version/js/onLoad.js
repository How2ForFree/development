/*
/*	Dynamic design functions and onLoad events
/*	----------------------------------------------------------------------
/* 	Creates added dynamic functions and initializes loading.
*/


// ======================================================================
//
//	On document ready functions
//
// ======================================================================

jQuery(document).ready(function($) {
	
	
	// Show/Hide slide show buttons
	// -------------------------------------------------------------------
	// This will show/hide the slide show buttons for Next and Previous
	// on the jQuery Cycle plugin slide show.
	
	if ($('#CyclePlugin #Slides').length > 0) {
		// on mouse over/out functions
		if (typeof $.fn.hoverIntent == 'function') {
			$('#SlideShow').hoverIntent(function() {showSlideNav(jQuery)}, function() {hideSlideNav(jQuery)});
		} else {
			$('#SlideShow').hover(function() {showSlideNav(jQuery)}, function() {hideSlideNav(jQuery)});
		}
		// Hide on page load...
		if ($('#SlideShow-Controls')) {
			var initHideSlideNav = setTimeout("hideSlideNav(jQuery)", 1000);	// delay in milliseconds
		}
	}


	// initialize modal (fancybox)
	// -------------------------------------------------------------------
	
	// Quickly setup some special references
	// fancybox doesn't like #name references at the end of links so we find
	// them and modify the link to use a class and remove the #name.
	$('a[href$="#popup"]').addClass('zoom iframe').each( function() {
		$(this).attr('href', this.href.replace('#popup',''));
	});
	
	// setup fancybox for YouTube
	$("a.zoom[href*='http://www.youtube.com/watch?']").each( function() {
		$(this).addClass('fancyYouTube').removeClass('zoom');
	});

	// setup fancybox for Vimeo
	$("a.zoom[href*='http://www.vimeo.com/']").each( function() {
		$(this).addClass('fancyVimeo').removeClass('zoom');
	});
	

	var overlayColor = '#2c2c2c';
	
	// fancybox - default
	$('a.zoom').fancybox({
		'padding': 1,
		'overlayOpacity': 0.2,
		'overlayColor': overlayColor, 
		'onComplete': modalStart
	});
	
	// fancybox - YouTube
	$('a.fancyYouTube').click(function() {
		jQuery.fancybox({
			'padding': 1,
			'overlayOpacity': 0.2,
			'overlayColor': overlayColor, 
			'onComplete': modalStart,
			'title': this.title,
			'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type': 'swf',
			'swf': {
				'wmode': 'transparent',
				'allowfullscreen'	: 'true'} // <-- flashvars
		});
		return false;
	});

	// fancybox - Vimeo	
	$("a.fancyVimeo").click(function() {
		$.fancybox({
			'padding': 1,
			'overlayOpacity': 0.2,
			'overlayColor': overlayColor, 
			'onComplete': modalStart,
			'title': this.title,
			'href': this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
			'type': 'swf'
		});
		return false;
	});


	// Text and password input styling
	// -------------------------------------------------------------------
	
	// This should be in the CSS file but IE 6 will ignore it.
	// If you have an input you don't want styles, add the class "noStyle"

	$("input[type='text']:not(.noStyle), input[type='password']:not(.noStyle)").each(function(){
		$(this).addClass('textInput');
	});
	// Focus and blur style changing
	$('.textInput').blur( function() {
		$(this).removeClass('inputFocus');
	}).focus( function() {
		$(this).addClass('inputFocus');
	});
	
	
	// portfolio item height test (prevents long titles from causing gaps)
	// -------------------------------------------------------------------
	if ($('.portfolioDescription:not(.portfolioStyle-2 .portfolioDescription)').length > 0 ) {
		var pi = $('.portfolioDescription:not(.portfolioStyle-2 .portfolioDescription)');
		pi.each( function(i, val) {
			//if ($(pi[i]).parents('.portfolioStyle-2').length <= 0) {
				if (pi[i].scrollHeight > 120) {
					pi.css('height',pi[i].scrollHeight+'px');
					return false;
				}
			//}
		});
	}


	// FAQ's functionality
	// -------------------------------------------------------------------
	if ($('.faqs li').length > 0 ) {
		var faqs = $('.faqs li');
		faqs.each( function() {
			var q = $(this);
			q.children('.question').click( function() {
				q.children('div').slideToggle('fast', function() {
					// Animation complete...
				});
			});
		});
	}


	// input lable replacement
	// -------------------------------------------------------------------
	$("label.overlabel").overlabel();

	// apply custom search input functions
	// -------------------------------------------------------------------
	searchInputEffect();
	
	// apply image icon overlays
	// -------------------------------------------------------------------
	imgIconOverlay(jQuery);

	// apply custom button styles
	// -------------------------------------------------------------------
	buttonStyles(jQuery);

});




// ======================================================================
//
//	Design functions
//
// ======================================================================


	
// Search input - custom effects for mouse over and focus.
// -------------------------------------------------------------------

function searchInputEffect() {
	$ = jQuery;
	var	searchFocus = false,
		searchHover = false,
		searchCtnr = $('#Search'),
		searchInput = $('#SearchInput'),
		searchSubmit = $('#SearchSubmit');
	// Search input - mouse events
	if (searchCtnr.length > 0) {
		searchCtnr.hover(
			function () {	// mouseover
				if (!searchFocus) $(this).addClass('searchHover');
				searchHover = true; }, 
			function () {	// mouseout
				if (!searchFocus) $(this).removeClass('searchHover');
				searchHover = false;
		}).mousedown( function() {
			if (!searchFocus) $(this).removeClass('searchHover').addClass('searchActive');
		}).mouseup( function() {
			searchInput.focus();
			searchSubmit.show();
			searchFocus = true;
		});
		// set focus/blur events
		searchInput.blur( function() {
			if (!searchHover && searchInput.val().replace(/ /gi, '') == '') {
				searchCtnr.removeClass('searchActive');
				searchSubmit.hide();
				searchFocus = false;
			}
		});
	}
}


// Functions to show and hide slide navigation controls (for cycle SS)
// -------------------------------------------------------------------

	// show slide navigation
	function showSlideNav($) {
		if ($('#SlideShow-Controls').length > 0) {
			$('#SlideShow-Controls').slideDown('fast');
		}		
	}
	// hide slide navigation
	function hideSlideNav($) {
		if ($('#SlideShow-Controls').length > 0) {
			$('#SlideShow-Controls').slideUp('fast');
		}
	}



// button styling function
// -------------------------------------------------------------------

function buttonStyles($) {
	// Button styles
	
	// This will style buttons to match the theme. If you don't want a button
	// styled, give it the class "noStyle" and it will be skipped.
	$("button:not(:has(span),.noStyle), input[type='submit']:not(.noStyle), input[type='button']:not(.noStyle)").each(function(){
		var	b = $(this),
			tt = b.html() || b.val();
		
		// convert submit inputs into buttons
		if (!b.html()) {
			b = ($(this).attr('type') == 'submit') ? $('<button type="submit">') : $('<button>');
			b.insertAfter(this).addClass(this.className).attr('id',this.id);
			$(this).remove();	// remove input
		}
		b.text('').addClass('btn').append($('<span>').html(tt));	// rebuilds the button
	});
	
	// Get all styled buttons
	var styledButtons = $('.btn');
	
	// Fix minor problem with Mozilla and WebKit rendering (can also be done adding this to CSS, 
	// button::-moz-focus-inner {border: none;}
	// @media screen and (-webkit-min-device-pixel-ratio:0) { button span {margin-top: -1px;} }
	if (jQuery.browser.mozilla || jQuery.browser.webkit) {
		styledButtons.children("span").css("margin-top", "-1px");
	}
	
	// Button hover class (IE 6 needs this)
	styledButtons.hover(
		function(){ $(this).addClass('submitBtnHover'); },		// mouseover
		function(){ $(this).removeClass('submitBtnHover'); }	// mouseout
	);
}


// Image icon overlay (hover shows icon - zoom, play, etc...)
// -------------------------------------------------------------------

function imgIconOverlay($) {

	if (jQuery.browser.msie && parseInt(jQuery.browser.version, 10) < 7) {
		// IE 6 sucks so the effect doesn't work at all and that's why we skip it here
		// we coluld do something different for IE 6 in this area if we wanted 
	} else {
		// This will select the items which should include the image overlays
		$("a.imgSmall:not(.noIcon), a.imgMedium:not(.noIcon), a.imgLarge:not(.noIcon), a.imgTall:not(.noIcon)").each(function(){
			var	ctnr = $(this);
			// insert the overlay image
			if (ctnr.children('img')) {
				if (ctnr.hasClass('iconPlay')) {
					ctnr.children('img').after($('<div class="imgOverlay symbolPlay"></div>'));
				} else if  (ctnr.hasClass('iconDoc')) {
					ctnr.children('img').after($('<div class="imgOverlay symbolDoc"></div>'));
				} else {
					ctnr.children('img').after($('<div class="imgOverlay symbolZoom"></div>'));
				} 
			}
			
			var overImg = ctnr.children('.imgOverlay'); 
			
			if (jQuery.browser.msie && parseInt(jQuery.browser.version, 10) < 9) {
				// IE sucks at fading PNG's with gradients so just use show hide
				overImg.css('visibility','hidden'); // not visible to start 
				
				ctnr.hoverIntent(
					function(){ overImg.css('visibility','visible'); },		// mouseover
					function(){ overImg.css('visibility','hidden'); }		// mouseout
				);
			} else {
				// make sure it's not visible to start 
				overImg.css('opacity',0);
				
				ctnr.hoverIntent(
					function(){ overImg.animate({'opacity':'1'},'fast'); },		// mouseover
					function(){ overImg.animate({'opacity':'0'},'fast'); }		// mouseout
				);
			}
		});
	}
	
}


// Modal after load functions
// -------------------------------------------------------------------

function modalStart() {
	// apply font replacement
	Cufon.replace('#fancybox-title-main', { fontFamily: 'Vegur' });
}


// Apply font replacement (cufon)
// -------------------------------------------------------------------
Cufon.replace('h1, h2, h3, h4, h5, h6, #fancybox-title-main', { fontFamily: 'Vegur' });
Cufon.replace('.pageTitle, #Showcase h1, #Showcase h2, #Showcase h3, #Showcase h4, #Showcase h5, #Showcase h6', { fontFamily: 'Vegur Light' });
