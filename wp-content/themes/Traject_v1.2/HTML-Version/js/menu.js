jQuery(document).ready(function($) {
	

	function megaHoverOver(){
		
		// show effect
		$(this).find(".sub").stop().slideDown();
		
		// render cufon on headings again (because it wasn't visible before)
		Cufon.replace('#MainMenu h2', { fontFamily: 'Vegur' });
			
		//Calculate width of all ul's
		(function($) { 
			jQuery.fn.calcSubWidth = function() {
				rowWidth = 0;
				//Calculate row
				$(this).find("ul").each(function() {					
					rowWidth += $(this).width(); 
				});	
			};
		})(jQuery); 
		
		if ( $(this).find(".row").length > 0 ) { //If row exists...
			var biggestRow = 0;	
			//Calculate each row
			$(this).find(".row").each(function() {							   
				$(this).calcSubWidth();
				//Find biggest row
				if(rowWidth > biggestRow) {
					biggestRow = rowWidth + 68;
				}
			});
			//Set width
			$(this).find(".sub").css({'width' :biggestRow});
			$(this).find(".row:last").css({'margin':'0'});
			
		} else { //If row does not exist...
			
			$(this).calcSubWidth();
			//Set Width
			$(this).find(".sub").css({'width' : rowWidth});
			
		}
		//Set height
		subHeight = $(this).find(".sub .mm-sub-middle").height();
		$(this).find(".sub .mm-sub-r").css({'height' : subHeight + 'px'});
		$(this).find(".sub .mm-sub-l").css({'height' : subHeight + 'px'});
		$(this).find(".sub .mm-sub-m").css({'height' : subHeight + 'px'});
		

	}
	
	function megaHoverOut(){ 
	  $(this).find(".sub").stop().slideUp('fast');
	}

	// initialize the menu
	$("ul#MegaMenu li").each( function() {
		// add some necessary containers for styling
		if ($(this).find(".sub .mm-sub-middle").length <= 0) {
			$(this).find(".sub").html('<div class="mm-sub-top"><div class="mm-sub-tr"></div><div class="mm-sub-tl"></div><div class="mm-sub-tm"></div></div><div class="mm-sub-middle"><div class="mm-sub-r"></div><div class="mm-sub-l"></div><div class="mm-sub-m">'+ $(this).find(".sub").html() +'<div class="clear"></div></div></div><div class="mm-sub-bottom"><div class="mm-sub-br"></div><div class="mm-sub-bl"></div><div class="mm-sub-bm"></div></div>')
		}
		// add a drop down arrow symbol
		if ($(this).find(".sub").length !== 0) {
			$(this).children('a:first').css('padding-right','28px').append('<span class="mm-arrow"></span>');
			$(this).find(".sub").css({
				 'display': 'none',
				 'visibility': 'visible'
			});
		}
	});

	var MmConfig = {    
		 sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
		 interval: 100, // number = milliseconds for onMouseOver polling interval    
		 over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
		 timeout: 500, // number = milliseconds delay before onMouseOut    
		 out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
	};

	$("ul#MegaMenu li").hoverIntent(MmConfig);
	

});
