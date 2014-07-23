jQuery(document).ready(function($){
	// portfolio
	function preloadPortfolio(){
		$('.portfolio-item a:has(img)').css({
			'background-image': 'url('+template_url+'/portfolio/images/ajax-loader-portfolio.gif)',
			'background-position': 'center center',
			'background-repeat': 'no-repeat'
		});
		$('.portfolio-item img.portfolio-item-image').each(function(){
			var image = this;
			var src = $(this).attr('src');
			if(!image.complete) {
				$(image).css('opacity', 0);
			}
			$('<img alt="">').load(function(){
				$(image).parents('.portfolio-item').find('a.image').css('background-image', 'none');
				$(image).animate({'opacity': 1}, 400);
			}).attr('src', src);
		});
	}
	preloadPortfolio();
	
	function setupFancybox(){
		if(typeof $.fancybox != 'function'){ return; }
		
		$('.portfolio-item:not(.no-lightbox) a').fancybox({
			titleShow: false
		});
	}
	setupFancybox();
	
	$('.terms-tag-main').click(function(e){
		$.get( $(this).attr('href'), function(data) {
			$('.portfolio').quicksand( $(data).find('.portfolio-item-wrapper'), {
				adjustHeight: 'dynamic',
				attribute: function(v) {
					return $(v).attr('id');
				}
			}, function() {
				preloadPortfolio();
				setupFancybox();
				switchToLayout($('.layout-switcher').data('current'));
			});
		});  
		e.preventDefault();
	});
	
	$('.portfolio-item a.image').live('mouseover', function(){
		$('a.image:not(:has(.portfolio-hover))', $(this).parents('.portfolio-item')).append('<span class="portfolio-hover"></span>');
		$('img', this).stop().animate({'opacity': 0.4});
	});
	$('.portfolio-item a.image').live('mouseout', function(){
		$('img', this).stop().animate({'opacity': 1}, {
			complete: function(){
				$(this).css('opacity', 1);
			}
		});
	});
	
	switchToLayout = function(layout) {
		if(typeof layout != 'string' || layout === '' || $('.portfolio').hasClass(layout)) {
			return;
		}
		
		$('.portfolio').fadeOut(300, function(){
			$(this).css('height', 'auto')
				.removeClass('layout-gallery')
				.removeClass('layout-1-column')
				.removeClass('layout-2-column')
				.removeClass('layout-3-column')
				.addClass(layout)
				.fadeIn(400);
			$('.portfolio-item-wrapper').removeClass('last').each(function(i){
				if(
					(layout == 'layout-gallery' && ((i+1) % 3 === 0)) ||
					(layout == 'layout-3-column' && ((i+1) % 3 === 0)) ||
					(layout == 'layout-2-column' && ((i+1) % 2 === 0)) 
				){
					$(this).addClass('last');
				}
			});
		});
	};
	
	var currentLayout = $('.portfolio').attr('class').replace('portfolio', '');
	currentLayout = $.trim(currentLayout);

	$('#switcher-'+currentLayout).addClass('current');
	$('.layout-switcher a').click(function(){		
		$('.layout-switcher a').removeClass('current');
		$(this).addClass('current');
		
		var current = $(this).attr('id').replace('switcher-', '');
		$('.layout-switcher').data('current', current);
		switchToLayout(current);
		
		return false;
	}).text('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
	
	$('.terms-tag').click(function(){
		$('.terms-active-left,.terms-active-right').remove();
		$('.terms-tag').removeClass('current');
		$('a', this).before('<div class="terms-active-left"></div>');
		$('a', this).after('<div class="terms-active-right"></div>');
		$(this).addClass('current');
	});
});