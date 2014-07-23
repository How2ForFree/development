// In case we forget to take out console statements. IE becomes very unhappy when we forget. Let's not make IE unhappy
if(typeof(console) === 'undefined') {
    var console = {}
    console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
}

//emulate jquery live to preserve jQuery.live() call
if( typeof jQuery.fn.live == 'undefined' ) {
    jQuery.fn.live = function( types, data, fn ) {
        jQuery( this.context ).on( types, this.selector, data, fn );
        return this;
    };
}

jQuery( document ).ready( function( $ ) {
	$('body').removeClass('no_js').addClass('yes_js');
    
    if ( YIT_Browser.isIE8() ) {
        $('*:last-child').addClass('last-child');
    }
    
    if( YIT_Browser.isIE10() ) {
        $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
    }
    
    //placeholder support
    $('input[placeholder], textarea[placeholder]').placeholder();
    $('input[placeholder], textarea[placeholder]').each(function(){
    	$(this).focus(function(){
    		$(this).data('placeholder', $(this).attr('placeholder'));
    		$(this).attr('placeholder', '');
    	}).blur(function(){
    		$(this).attr('placeholder', $(this).data('placeholder'));
    	});
    });
	
	//iPad, iPhone hack
	$('.ch-item').bind('hover', function(e){});
    
    //Form fields shadow
    $( 'form input[type="text"], form textarea' ).focus(function() {
        //Hide label
        $( this ).parent().find( 'label.hide-label' ).hide(); 
    }).blur(function() {        
        //Show label
        if( $( this ).val() == '' )
            { $( this ).parent().find( 'label.hide-label' ).show(); }
    }).each( function() {
        //Show label
        if( $( this ).val() != '' && $( this ).parent().find( 'label.hide-label' ).is( ':visible' ) )
            { $( this ).parent().find( 'label.hide-label' ).hide(); }
    });
	
    //play, zoom on image hover
	var yit_lightbox;
	(yit_lightbox = function(){
		
	    if( jQuery( 'body' ).hasClass( 'isMobile' ) ) {
	        jQuery("a.thumb.img, .overlay_img, .section .related_proj, a.ch-info-lightbox").colorbox({
	            transition:'elastic',
	            rel:'lightbox',
	    		fixed:true,
	    		maxWidth: '100%',
	    		maxHeight: '100%',
	    		opacity : 0.7
	        });
	        
	        jQuery(".section .related_lightbox").colorbox({
	            transition:'elastic',
	            rel:'lightbox2',
	    		fixed:true,
	    		maxWidth: '100%',
	    		maxHeight: '100%',
	    		opacity : 0.7
	        });
	    } else {
	        jQuery("a.thumb.img, .overlay_img, .section.portfolio .related_proj, a.ch-info-lightbox, a.ch-info-lightbox").colorbox({
	            transition:'elastic',
	            rel:'lightbox',
	    		fixed:true,
	    		maxWidth: '80%',
	    		maxHeight: '80%',
	    		opacity : 0.7
	        });   
	        
	        jQuery(".section.portfolio .related_lightbox").colorbox({
	            transition:'elastic',
	            rel:'lightbox2',
	    		fixed:true,
	    		maxWidth: '80%',
	    		maxHeight: '80%',
	    		opacity : 0.7
	        });   
	    }
	    
	    jQuery("a.thumb.video, .overlay_video, .section.portfolio .related_video, a.ch-info-lightbox-video").colorbox({
	        transition:'elastic',
	        rel:'lightbox',
			fixed:true,
			maxWidth: '60%',
			maxHeight: '80%',
	        innerWidth: '60%',
	        innerHeight: '80%',
			opacity : 0.7,
	        iframe: true,
	        onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
	    });
	    jQuery(".section.portfolio .lightbox_related_video").colorbox({
	        transition:'elastic',
	        rel:'lightbox2',
			fixed:true,
			maxWidth: '60%',
			maxHeight: '80%',
	        innerWidth: '60%',
	        innerHeight: '80%',
			opacity : 0.7,
	        iframe: true,
	        onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
	    });
	})();      
            
              
	//overlay
  	$('.picture_overlay').hover(function(){
  		
	  	var width = $(this).find('.overlay div').innerWidth();
	  	var height =  $(this).find('.overlay div').innerHeight();
	  	var div = $(this).find('.overlay div').css({
	  		'margin-top' : - height / 2,
	  		'margin-left' : - width / 2
	  	});
  		
		if(YIT_Browser.isIE8()) {
  			$(this).find('.overlay > div').show();
  		}
  	}, function(){
  		
  		if(YIT_Browser.isIE8()) {
  			$(this).find('.overlay > div').hide();
  		}
  	}).each(function(){
	  	var width = $(this).find('.overlay div').innerWidth();
	  	var height =  $(this).find('.overlay div').innerHeight();
	  	var div = $(this).find('.overlay div').css({
	  		'margin-top' : - height / 2,
	  		'margin-left' : - width / 2
	  	});
	});

    //Sticky Footer
    $( '#primary' ).imagesLoaded( function() {
        if( $( '#footer' ).length > 0 )
            { $( '#footer' ).stickyFooter(); }
        else
            { $( '#copyright' ).stickyFooter(); }
    } );
});