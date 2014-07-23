jQuery(document).ready(function( $ ){

    // menu in responsive, with select
	if(yit_responsive_menu_type == "select")
	{
		if( $('body').hasClass('responsive') ) {  
			$('#logo-headersidebar-container').after('<div class="row"><div class="span12"><div class="menu-select"></div></div></div>');
			$('#nav ul:first-child').clone().appendTo('.menu-select');  
			$('.menu-select > ul').attr('id', 'nav-select').after('<div class="arrow-icon"></div>');
					  
			$( '#nav-select' ).hide().mobileMenu({
				subMenuDash : '-'
			});
			
			if( $('#header .slider').length <= 0 ) {
				$('.menu-select').addClass('no-slider');
			}
		}
	}
	else
	{
		if( $('body').hasClass('responsive') ) {
			$('#nav .container').prepend('<div class="menu-responsive group"><div class="navigate-text">' + yit_responsive_menu_text + '</div><div class="menu-arrow"></div></div>');
			$('#nav .container > ul').clone().appendTo('.menu-responsive');
			$('.menu-responsive .sub-menu li a').prepend('- ');
			$('.menu-responsive .sub-menu .sub-menu li a').prepend('- ');
			$('.menu-arrow').on("click", function(event){
				$('.menu-responsive > ul').toggle();
				$(event.target).toggleClass("opened");
			});
		}
	}
});