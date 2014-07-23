$j = jQuery.noConflict();

/* ******************************************************************************************
 * DOM ready
 * ******************************************************************************************/
$j(document).ready(function () {
  InitBoxes();
  
  InitColorpicker();
});

/* ******************************************************************************************
 * Boxes
 * ******************************************************************************************/
function InitBoxes() {
  $j('.theme-admin-head .expander-wrap').click(function () {
    $j(this).parent().parent().toggleClass('expanded');
    
    if ($j(this).text().toLowerCase() == 'open') 
        $j(this).text('close');
    else 
        $j(this).text('open');
        
    var admin_box = $j(this).parent().parent().parent();
    var content = admin_box.find('.theme-admin-content');
    content.toggleClass('expanded');
    
    if (content.hasClass('expanded'))
        content.slideDown();
    else
        content.slideUp();     
  });
}

/* ******************************************************************************************
 * ColorPicker
 * ******************************************************************************************/
function InitColorpicker() {
  // ********************************************
  // Background 
  $j('.colorpic-background').css('borderLeftColor', $j('.colorpic-background').val());		                   
	$j('.colorpic-background').ColorPicker({
		color: $j('.colorpic-background').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-background').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-background').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-background').val('#' + hex);
			$j('.colorpic-background').css('borderLeftColor', '#' + hex);		
		}
	});
  // ********************************************	
  // Header	
  $j('.colorpic-header').css('borderLeftColor', $j('.colorpic-header').val());		                   
	$j('.colorpic-header').ColorPicker({
		color: $j('.colorpic-header').attr('value'),
		onHide: function (colpkr) {		
		    var hex = $j('.colorpic-header').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-header').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-header').val('#' + hex);
			$j('.colorpic-header').css('borderLeftColor', '#' + hex);		
		}
	});
  // ********************************************	
  // Titles
  $j('.colorpic-titles').css('borderLeftColor', $j('.colorpic-titles').val());		                   
	$j('.colorpic-titles').ColorPicker({
		color: $j('.colorpic-titles').attr('value'),
		onHide: function (colpkr) {		
		    var hex = $j('.colorpic-titles').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-titles').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-titles').val('#' + hex);
			$j('.colorpic-titles').css('borderLeftColor', '#' + hex);		
		}
	});
  // ********************************************  
  // Main	
  $j('.colorpic-main').css('borderLeftColor', $j('.colorpic-main').val());		                   
	$j('.colorpic-main').ColorPicker({
		color: $j('.colorpic-main').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-main').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-main').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-main').val('#' + hex);
			$j('.colorpic-main').css('borderLeftColor', '#' + hex);		
		}
	});		
  // ********************************************  
  // Slider	
  $j('.colorpic-slider').css('borderLeftColor', $j('.colorpic-slider').val());		                   
	$j('.colorpic-slider').ColorPicker({
		color: $j('.colorpic-slider').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-slider').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-slider').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-slider').val('#' + hex);
			$j('.colorpic-slider').css('borderLeftColor', '#' + hex);		
		}
	});		
  // ********************************************  
  // Toolbar	
  $j('.colorpic-toolbar').css('borderLeftColor', $j('.colorpic-toolbar').val());		                   
	$j('.colorpic-toolbar').ColorPicker({
		color: $j('.colorpic-toolbar').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-toolbar').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-toolbar').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-toolbar').val('#' + hex);
			$j('.colorpic-toolbar').css('borderLeftColor', '#' + hex);		
		}
	});		

  // ********************************************  
  // Navigation
  $j('.colorpic-navigation').css('borderLeftColor', $j('.colorpic-navigation').val());		                   
	$j('.colorpic-navigation').ColorPicker({
		color: $j('.colorpic-navigation').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-navigation').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-navigation').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-navigation').val('#' + hex);
			$j('.colorpic-navigation').css('borderLeftColor', '#' + hex);		
		}
	});			

  // ********************************************  
  // Navigation links
  $j('.colorpic-links').css('borderLeftColor', $j('.colorpic-links').val());		                   
	$j('.colorpic-links').ColorPicker({
		color: $j('.colorpic-links').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-links').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-links').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-links').val('#' + hex);
			$j('.colorpic-links').css('borderLeftColor', '#' + hex);		
		}
	});	
			
  // ********************************************  
  // Footer
  $j('.colorpic-footer').css('borderLeftColor', $j('.colorpic-footer').val());		                   
	$j('.colorpic-footer').ColorPicker({
		color: $j('.colorpic-footer').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('.colorpic-footer').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('.colorpic-footer').css('borderLeftColor', hex);
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j(el).css('borderLeftColor', '#' + hex);
		},
		onBeforeShow: function () {   
		},
		onChange: function (hsb, hex, rgb) {
		  $j('.colorpic-footer').val('#' + hex);
			$j('.colorpic-footer').css('borderLeftColor', '#' + hex);		
		}
	});			
}
