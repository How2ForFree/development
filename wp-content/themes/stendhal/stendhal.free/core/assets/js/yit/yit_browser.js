var YIT_Browser = {
	
	isTablet : function() {
	    var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'iPad' ) || jQuery( 'body' ).hasClass( 'Blakberrytablet' ) || jQuery( 'body' ).hasClass( 'isAndroidtablet' ) || jQuery( 'body' ).hasClass( 'isPalm' );
	    var size   = jQuery( window ).width() <= 1024 && jQuery( window ).width() >= 768;
	    
	    return device && size ; 
	},
	
	isPhone : function () {
	    var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'isIphone' ) || jQuery( 'body' ).hasClass( 'isWindowsphone' ) || jQuery( 'body' ).hasClass( 'isAndroid' ) || jQuery( 'body' ).hasClass( 'isBlackberry' );
	    var size   = jQuery( window ).width() <= 480 && jQuery( window ).width() >= 320;
	    
	    return device && size ;
	},

	isViewportBetween : function( high, low ) {
	    if( low == 'undefinied' )
	        { low = 0; }
	    
	    if( !low )
	        { return jQuery( window ).width() < high; }
	    else
	        { return jQuery( window ).width() < high && jQuery( window ).width() > low; }
	},
	
	isLowResMonitor: function () {
	    return jQuery( window ).width() < 1200;
	},
	
	isMobile: function() {
	    return this.isTablet() || this.isPhone();
	},
	
	
	
	isIE: function() {
		return jQuery.browser.msie;
	},
	
	isIE8: function() {
		return this.isIE() && jQuery.browser.version == '8.0';
	},
	
	isIE9: function() {
		return this.isIE() && jQuery.browser.version == '9.0';
	},
	
	isIE10: function() {
	    return this.isIE() && jQuery.browser.version == '10.0';
	}

};

