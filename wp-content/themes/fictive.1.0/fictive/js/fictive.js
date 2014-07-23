/* Scroll past header image on small screens */

jQuery( document ).ready( function( $ ) {

	var $width = $(window).width();
	var $height = $(window).height();
	var $masthead = $( '.site-header' );
	var $timeout = false;
	var $sidebarheight = $masthead.height() + 100;
	var $originalPosition = $( '.site-branding' ).position().top;
	var $scrollPosition;

	//Calculate distance to scroll
	if ( $width < 600 ) { //Static admin bar
		$scrollPosition = $originalPosition - 20;
	} else { //Fixed admin bar
		$scrollPosition = $originalPosition - 60;
	}

	//Scroll past header image on screen widths less than 820px
	$.fn.scrollDown = function() {
		$( 'body,html' ).animate( {
			scrollTop: $scrollPosition
		}, 400 );
	};

	//Allow sidebar to scroll if the sidebar is too tall for the screen height
	if ( $sidebarheight > $height ) {
		$masthead.css( 'position', 'relative' );
	}

	//Toggle open $class by clicking $toggle
	$.fn.navToggle = function() {
		$( '.main-navigation' ).addClass( 'active' );

		$( '#menu-toggle' ).unbind( 'click' ).click( function() {

			$( '.widget-area' ).hide().removeClass( 'active' );
			$( '.header-search' ).hide().removeClass( 'active' );

			$( '.main-navigation' ).slideToggle( 'ease' );
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	$.fn.widgetsToggle = function() {
		$( '.widget-area' ).addClass( 'active' );

		$( '#widgets-toggle' ).unbind( 'click' ).click( function() {

			$( '.main-navigation' ).hide().removeClass( 'active' );
			$( '.header-search' ).hide().removeClass( 'active' );

			$( '.widget-area' ).slideToggle( 'ease' );
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	$.fn.searchToggle = function() {
		$( '.header-search' ).addClass( 'active' );

		$( '#search-toggle' ).unbind( 'click' ).click( function() {

			$( '.main-navigation' ).hide().removeClass( 'active' );
			$( '.widget-area' ).hide().removeClass( 'active' );

			$( '.header-search' ).slideToggle( 'ease' );
			$( this ).toggleClass( 'toggled-on' );
		} );
	};


	// Check viewport width on first load.
	if ( $width < 820 ) {
		$.fn.navToggle();
		$.fn.widgetsToggle();
		$.fn.searchToggle();
		$.fn.scrollDown();
	}

	// Check viewport width when user resizes the browser window.
	$( window ).on( 'resize', function() {

		$width = $(window).width();

		if ( false !== $timeout ) {
			clearTimeout( $timeout );
		}

		$timeout = setTimeout( function() {

			if ( $width < 600 ) { //Static admin bar
				$scrollPosition = $originalPosition - 20;
			} else { //Fixed admin bar
				$scrollPosition = $originalPosition - 60;
			}

			//Allow sidebar to scroll if the sidebar is too tall for the screen height
			if ( $sidebarheight > $height ) {
				$masthead.css( 'position', 'relative' );
			}

			if ( $width < 820 ) {
				$.fn.navToggle();
				$.fn.widgetsToggle();
				$.fn.searchToggle();
				$.fn.scrollDown();
				$.fn.scrollDown();
			} else {
				$( '.main-navigation' ).removeClass( 'active' );
				$( '.widget-area' ).removeClass( 'active' );
				$( '.header-search' ).removeClass( 'active' );

				$( '.main-navigation' ).removeAttr( 'style' );
				$( '.widget-area' ).removeAttr( 'style' );
				$( '.header-search' ).removeAttr( 'style' );
			}
		}, 200 );
	} );


});
