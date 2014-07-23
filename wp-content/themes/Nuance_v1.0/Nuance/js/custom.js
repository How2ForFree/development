function generate_lightbox(){
	/* Initialize */
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme:'light_square'
	});
	
	/* Hover */
	$("a[rel^='prettyPhoto']:not(.portfolio-popup-info-zoom, .display-none), a.lightbox-none").append('<span class="overlay"><span class="overlay-inner"></span></span>');
}

jQuery(document).ready(function($){

	/* --------------------------------------------------
		Image loading
	-------------------------------------------------- */
	if (!($.browser.msie)){
		$('.image-load-animate img').css({ opacity : 0 });
		$('.image-load-animate img').load(function(){
			$(this).animate({ opacity : 1 }, 1000);
		});
	}
	
	
	/* --------------------------------------------------
		Contact Form
	-------------------------------------------------- */
	$('.contactForm').submit(function(e){

		//prevent the normal processing
		e.preventDefault();

		//delete the errors (so we don't get duplicates)
		$(this).find('.LV_invalid_field').removeClass('LV_invalid_field');

		//declaring and setting vars
		var value, theID, error, emailReg;
		var submit_path = $(this).attr('action');
		error = false;
		emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;				

		//validating
		$(this).find('textarea, input[type=text]').each(function(){
			value = $(this).val();
			theID = $(this).attr('id');
			if(value == ''){
				$(this).addClass('LV_invalid_field');
				error = true;
			}
			if(theID == 'cemail' && (value == '' || value == 'Email' || !emailReg.test(value))){
				$(this).addClass('LV_invalid_field');
				error = true;
			}
		});

		//send email and loaded message
		if(error == false){
			$(this).load(submit_path, $(this).serialize());
		}

	});

	/* --------------------------------------------------
		Portfolio - Popup
	-------------------------------------------------- */
	if($('.portfolio-popup-info').length){
		$('.portfolio-popup-info').css({ opacity : 0 });
	}
	
	$('.portfolio-popup li').live('mouseenter', function(){
		if ($.browser.msie && $.browser.version.substr(0,1) < 8) {
			$(this).find('.portfolio-popup-info').stop().animate({ opacity : 1 }, 300);
		}else{
			$(this).find('.portfolio-popup-info').stop().animate({ opacity : 1 }, 300).parents('li').siblings('li').stop().animate({ opacity : 0.7 }, 300);
		}
		
	}).live('mouseleave', function(){
		
		if ($.browser.msie && $.browser.version.substr(0,1) < 8) {
			$(this).find('.portfolio-popup-info').stop().animate({ opacity : 0 }, 300);
		}else{
			$(this).find('.portfolio-popup-info').stop().animate({ opacity : 0 }, 300).parents('li').siblings('li').stop().animate({ opacity : 1 }, 300);
		}
		
	});
	
	/* --------------------------------------------------
		Testimonials - Scroller
	-------------------------------------------------- */
	$('ul.testimonials').cycle();
	$('ul.testimonials li').css({ 'background-color' : 'transparent' });
	
	/* --------------------------------------------------
		Tabs
	-------------------------------------------------- */
	
	/* Hide all tabs but first */
	$('.tabs-container').each(function(){
		$(this).find('.tab-content:not(:first)').hide();
		$(this).find('.tab-content:first').show();
		$(this).find('.tabs-nav li:first').addClass('active');
	});
	
	/* Change tab (click) */
	$('.tabs-nav li a').click(function(e){
		e.preventDefault();
		$(this).parents('li').addClass('active').siblings('li.active').removeClass('active');
		var tab_id = $(this).parents('li').index();
		$(this).parents('.tabs-container').find('.tab-content').eq(tab_id).show().siblings('.tab-content').hide();
	});
	
	/* --------------------------------------------------
		Toggle
	-------------------------------------------------- */
	
	/* Fix the issue with jumping when sliding up and down */
	$('.toggle-content').each(function(){ $(this).height($(this).height()); });
	
	/* Hide all the collapsed toggles */
	$('.toggle-container.collapsed .toggle-content').hide();
	
	/* Open toggle */
	$('.toggle-container.collapsed .toggle-action').live('click', function(e){
		e.preventDefault();
		var box = $(this).parents('.toggle-container');
		box.removeClass('collapsed').find('.toggle-content').slideDown(300);
	});
	
	/* Collapse toggle */
	$('.toggle-container:not(.collapsed) .toggle-action').live('click', function(e){
		e.preventDefault();
		var box = $(this).parents('.toggle-container');
		box.find('.toggle-content').slideUp(300, function(){
			box.addClass('collapsed');
		});
	});
	
	/* --------------------------------------------------
		PrettyPhoto
	-------------------------------------------------- */
	
	generate_lightbox();
	
	$("a[rel^='prettyPhoto']:not(.portfolio-popup-info-zoom, .display-none), a.lightbox-none").live('mouseenter', function(){
		$(this).find('.overlay').fadeIn(300);
	}).live('mouseleave', function(){
		$(this).find('.overlay').fadeOut(300);
	});
	
	/* --------------------------------------------------
		Portfolio - Filter - Quicksand
	-------------------------------------------------- */
	$('#portfolio-filter a').click(function(e) {
		e.preventDefault();  
		$.get( $(this).attr('href'), function(data) {
			$('.portfolio-listing').quicksand( $(data).find('li'), { adjustHeight: 'dynamic' }, function(){
				generate_lightbox();
			});
		});  
	});
	
	/* --------------------------------------------------
		Padding animations
	-------------------------------------------------- */
	$('#navigation li li').hover(function() { 
			$(this).stop().animate({ paddingLeft: '5px' }, 300);
		}, function() {
			$(this).stop().animate({ paddingLeft: 0 }, 300);
	});
	
	$('ul.posts-listing li a').hover(function() { 
			$(this).stop().animate({ paddingLeft: '10px' }, 300);
		}, function() {
			$(this).stop().animate({ paddingLeft: 0 }, 300);
	});

	/* --------------------------------------------------
		Active state mainmenu
	-------------------------------------------------- */	
	$("#navigation ul ul").hover(function () {
		$(this).parent().addClass("hover");
		},
		function() {
			$("#navigation ul li").removeClass("hover");
		});
	
	/* --------------------------------------------------
		Submenu animating
	-------------------------------------------------- */	
	$(" #navigation ul ul ").css({display: "none"});
	
	$(" #navigation li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(200);
		
		},function(){
		
			$(this).find('ul:first').css({visibility: "hidden"});
	});
	
	/* --------------------------------------------------
		Slider hide arrows if just one slide
	-------------------------------------------------- */
	if($('#slider-slides .slide').length < 2){
		$('#slider-prev, #slider-next').hide();
		if($('#slider-slides .slide-caption').length < 1){
			$('#slide-caption').hide();
			$('#slider-slides').css({ marginBottom : 0 });
		}
	}
	
	/* --------------------------------------------------
		Slider arrow animation
	-------------------------------------------------- */
	$('#slider').hover(function() { 
			$('#slider-prev').stop().animate({ left: -31, width: 30 }, 300);
			$('#slider-next').stop().animate({ right: -31, width: 30 }, 300);
		}, function() {
			$('#slider-next').stop().animate({ right: -19, width: 18 }, 300);
			$('#slider-prev').stop().animate({ left: -19, width: 18 }, 300);
	});
	
	
});

$(window).load(function(){
	
	$('.image-load-animate img').each(function(){
		$(this).animate({ opacity : 1 }, 1000);
	});
	
	/* --------------------------------------------------
		Slider Posts - Init
	-------------------------------------------------- */
	if($('.slides').length){
		$('.slides').cycle({
			timeout: 0
		});
		$('.slides li').css({ 'background-color' : 'transparent' });
	}
	
	$('.jw-slider-posts .next').click(function(e){
		e.preventDefault();
		$(this).parents('.jw-slider-posts').find('.slides').cycle('next');
	});
	
	$('.jw-slider-posts .previous').click(function(e){
		e.preventDefault();
		$(this).parents('.jw-slider-posts').find('.slides').cycle('prev');
	});

});