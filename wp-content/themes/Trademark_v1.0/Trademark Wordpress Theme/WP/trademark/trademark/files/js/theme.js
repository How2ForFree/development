// Jquery no conflict mode
$j = jQuery.noConflict();

$j(document).ready(function () {
    ChangeThemeVariant();
    
    SetStylesheet();
 	
    ChangeStylesheet();
	
    FloatThemeBox ();
	
    BestSellersClick();
	
	NavigationPosition();

  /* *******************************************************************
   * Background color
   * *******************************************************************/
	if(undefined != $j.cookie('bg-variant')) {
		$j('#colorpicker').val($j.cookie('bg-variant'));
		$j('#colorpicker').css('borderLeftColor', $j.cookie('bg-variant'));
    $j('html').css('backgroundColor', $j.cookie('bg-variant'));
	}
	
	$j('#colorpicker').ColorPicker({
		color: $j('#colorpicker').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('html').css('backgroundColor', hex);
      $j.cookie('bg-variant', hex, { path: '/' });
      RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('html').css('backgroundColor', '#' + hex);
      RefreshCufon ();	            					
      $j.cookie('bg-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
      $j('#colorpicker').val('#' + hex);  
			$j('#colorpicker').css('borderLeftColor', '#' + hex);
      $j('html').css('backgroundColor', '#' + hex);
      $j.cookie('bg-variant', '#' + hex, { path: '/' });
		}
	});

  /* *******************************************************************
   * Header color
   * *******************************************************************/
	if(undefined != $j.cookie('header-variant')) {
		$j('#colorpicker1').val($j.cookie('header-variant'));
		$j('#colorpicker1').css('borderLeftColor', $j.cookie('header-variant'));
    $j('#header').css('backgroundColor', $j.cookie('header-variant'));
    $j('#navigation-header li ul').css('backgroundColor', $j.cookie('header-variant'));
	}
  
	$j('#colorpicker1').ColorPicker({
		color: $j('#colorpicker1').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker1').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#header').css('backgroundColor', hex);
			$j('#navigation-header li ul').css('backgroundColor', hex);
            $j.cookie('header-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#header').css('backgroundColor1', '#' + hex);
			$j('#navigation-header li ul').css('backgroundColor1', '#' + hex);
            RefreshCufon ();	            					
            $j.cookie('header-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker1').val('#' + hex);  
			$j('#colorpicker1').css('borderLeftColor', '#' + hex);
            $j('#header').css('backgroundColor', '#' + hex);
            $j('#navigation-header li ul').css('backgroundColor', '#' + hex);
            $j.cookie('header-variant', '#' + hex, { path: '/' });
		}
	});
  
  /* *******************************************************************
   * Slider color
   * *******************************************************************/
	if(undefined != $j.cookie('slider-variant')) {
		$j('#colorpicker2').val($j.cookie('slider-variant'));
		$j('#colorpicker2').css('borderLeftColor', $j.cookie('slider-variant'));
    $j('#slider').css('backgroundColor', $j.cookie('slider-variant'));
	}
  
	$j('#colorpicker2').ColorPicker({
		color: $j('#colorpicker2').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker2').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#slider').css('backgroundColor', hex);
      $j.cookie('slider-variant', hex, { path: '/' });
      RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#slider').css('backgroundColor', '#' + hex);
      RefreshCufon ();	            					
      $j.cookie('slider-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
      $j('#colorpicker2').val('#' + hex);  
			$j('#colorpicker2').css('borderLeftColor', '#' + hex);
      $j('#slider').css('backgroundColor', '#' + hex);
      $j.cookie('slider-variant', '#' + hex, { path: '/' });
		}
	}); 
  
  /* *******************************************************************
   * Toolbar color
   * *******************************************************************/
	if(undefined != $j.cookie('toolbar-variant')) {
		$j('#colorpicker3').val($j.cookie('toolbar-variant'));
		$j('#colorpicker3').css('borderLeftColor', $j.cookie('toolbar-variant'));
    $j('#toolbar').css('backgroundColor', $j.cookie('toolbar-variant'));
	}
  
	$j('#colorpicker3').ColorPicker({
		color: $j('#colorpicker3').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker3').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#toolbar').css('backgroundColor', hex);
      $j.cookie('toolbar-variant', hex, { path: '/' });
      RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#toolbar').css('backgroundColor', '#' + hex);
      RefreshCufon ();	            					
      $j.cookie('toolbar-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
      $j('#colorpicker3').val('#' + hex);  
			$j('#colorpicker3').css('borderLeftColor', '#' + hex);
      $j('#toolbar').css('backgroundColor', '#' + hex);
      $j.cookie('toolbar-variant', '#' + hex, { path: '/' });
		}
	});    
  
  /* *******************************************************************
   * Main color
   * *******************************************************************/
	if(undefined != $j.cookie('main-variant')) {
		$j('#colorpicker4').val($j.cookie('main-variant'));
		$j('#colorpicker4').css('borderLeftColor', $j.cookie('main-variant'));
        $j('#container').css('backgroundColor', $j.cookie('main-variant'));
	$j('.frame-inner').css('borderColor', $j.cookie('main-variant'));
        $j('.rule span').css('backgroundColor', $j.cookie('main-variant'));
	}
  
	$j('#colorpicker4').ColorPicker({
		color: $j('#colorpicker4').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker4').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#container').css('backgroundColor', hex);
            $j('.rule span').css('backgroundColor', hex);

            $j.cookie('main-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#container').css('backgroundColor', '#' + hex);
			$j('.frame-inner').css('borderColor', '#' + hex);
            $j('.rule span').css('backgroundColor', '#' + hex);

            RefreshCufon ();	            					
            $j.cookie('main-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker4').val('#' + hex);  
			$j('#colorpicker4').css('borderLeftColor', '#' + hex);
            $j('#container').css('backgroundColor', '#' + hex);
            $j('.frame-inner').css('borderColor', '#' + hex);
            $j('.rule span').css('backgroundColor', '#' + hex);            
            $j.cookie('main-variant', '#' + hex, { path: '/' });
		}
	});   
  
  /* *******************************************************************
   * Navigation color
   * *******************************************************************/
	if(undefined != $j.cookie('navigation-variant')) {
		$j('#colorpicker5').val($j.cookie('navigation-variant'));
		$j('#colorpicker5').css('borderLeftColor', $j.cookie('navigation-variant'));
        $j('#navigation').css('backgroundColor', $j.cookie('navigation-variant'));
	}
  
	$j('#colorpicker5').ColorPicker({
		color: $j('#colorpicker5').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker5').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#navigation').css('backgroundColor', hex);
            $j.cookie('navigation-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#navigation').css('backgroundColor', '#' + hex);
             RefreshCufon ();	            					
            $j.cookie('navigation-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker5').val('#' + hex);  
			$j('#colorpicker5').css('borderLeftColor', '#' + hex);
            $j('#navigation').css('backgroundColor', '#' + hex);
            $j.cookie('navigation-variant', '#' + hex, { path: '/' });
		}
	});     

  /* *******************************************************************
   * Navigation Text color
   * *******************************************************************/
   /*
	if(undefined != $j.cookie('navigation-text-variant')) {
		$j('#colorpicker7').val($j.cookie('navigation-text-variant'));
		
		
		$j('#navigation li a:hover').hover(function () {
		  $j(this).css({'color': $j.cookie('navigation-text-variant') });
		  RefreshCufon();
		});
		
		$j('#colorpicker7').css('borderLeftColor', $j.cookie('navigation-text-variant'));
		$j('#navigation li.current-menu-item > a').css('color', $j.cookie('navigation-text-variant'));
		$j('#navigation li.current-page-parent > a').css('color', $j.cookie('navigation-text-variant'));
		$j('#navigation li.current-menu-item > a').css('color', $j.cookie('navigation-text-variant'));
	}
  
	$j('#colorpicker7').ColorPicker({
		color: $j('#colorpicker7').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker7').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
		
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-page-parent a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
		
            $j.cookie('navigation-text-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-page-parent a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
			
            RefreshCufon ();	            					
            $j.cookie('navigation-text-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker7').val('#' + hex);  
			$j('#colorpicker7').css('borderLeftColor', '#' + hex);
			
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-page-parent a').css('color', $j.cookie('navigation-text-variant'));
    		$j('#navigation li.current-menu-item a').css('color', $j.cookie('navigation-text-variant'));
            
            $j.cookie('navigation-text-variant', '#' + hex, { path: '/' });
		}
	});   
	  */
  /* *******************************************************************
   * Footer color
   * *******************************************************************/
	if(undefined != $j.cookie('main-footer-variant')) {
		$j('#colorpicker6').val($j.cookie('main-footer-variant'));
		$j('#colorpicker6').css('borderLeftColor', $j.cookie('main-footer-variant'));
    $j('#main-footer').css('backgroundColor', $j.cookie('main-footer-variant'));
	}
    
	$j('#colorpicker6').ColorPicker({
		color: $j('#colorpicker6').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker6').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			$j('#main-footer').css('backgroundColor', hex);
      $j.cookie('footer-main-variant', hex, { path: '/' });
      RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			$j('#main-footer').css('backgroundColor', '#' + hex);
      RefreshCufon ();	            					
      $j.cookie('main-footer-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
      $j('#colorpicker6').val('#' + hex);  
			$j('#colorpicker6').css('borderLeftColor', '#' + hex);
      $j('#main-footer').css('backgroundColor', '#' + hex);
      $j.cookie('main-footer-variant', '#' + hex, { path: '/' });
		}
	});
	
	var titlesColor;
	var linksColor;
	
	if(undefined != $j.cookie('titles-variant')) {
		$j('#colorpicker7').val($j.cookie('titles-variant'));
		$j('#colorpicker7').css('borderLeftColor', $j.cookie('titles-variant'));
		titlesColor = $j.cookie('titles-variant');
	} else {
		titlesColor = $j('#titlesColor').text();
	}
	
	if(undefined != $j.cookie('links-variant')) {
		$j('#colorpicker8').val($j.cookie('links-variant'));
		$j('#colorpicker8').css('borderLeftColor', $j.cookie('links-variant'));
		linksColor  = $j.cookie('links-variant');
	} else {
		linksColor = $j('#linksColor').text();
	}
	
	setTitlesLinksColor(titlesColor,linksColor);
	
	/* *******************************************************************
   * Titles color
   * *******************************************************************/
	
	$j('#colorpicker7').ColorPicker({
		color: $j('#colorpicker7').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker7').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			
			titlesColor = hex;
			setTitlesLinksColor(titlesColor,linksColor);
			
            $j.cookie('titles-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			
			titlesColor = '#' + hex;
			setTitlesLinksColor(titlesColor,linksColor);
			
            RefreshCufon ();	            					
            $j.cookie('titles-variant', '#' + hex, { path: '/' });            
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker7').val('#' + hex);  
			$j('#colorpicker7').css('borderLeftColor', '#' + hex);
			
            titlesColor = '#' + hex;
			setTitlesLinksColor(titlesColor,linksColor);
			
            $j.cookie('titles-variant', '#' + hex, { path: '/' });
		}
	});
	
  /* *******************************************************************
   * Links color
   * *******************************************************************/
	
	$j('#colorpicker8').ColorPicker({
		color: $j('#colorpicker8').attr('value'),
		onHide: function (colpkr) {
		    var hex = $j('#colorpicker8').val();
			if(undefined == hex) {
				$j(colpkr).hide();
				return false;
			}
			linksColor = hex;
			setTitlesLinksColor(titlesColor,linksColor);
		
            $j.cookie('links-variant', hex, { path: '/' });
            RefreshCufon ();
			$j(colpkr).hide();
			location.reload();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$j(el).val('#' + hex);
			$j(el).ColorPickerHide();
			
			linksColor = '#' + hex;
			setTitlesLinksColor(titlesColor,linksColor);
		
            RefreshCufon ();				
            $j.cookie('links-variant', '#' + hex, { path: '/' });
            location.reload();         
		},
		onBeforeShow: function () {                        
		},
		onChange: function (hsb, hex, rgb) {
            $j('#colorpicker8').val('#' + hex);  
			$j('#colorpicker8').css('borderLeftColor', '#' + hex);
			
            linksColor = '#' + hex;
			setTitlesLinksColor(titlesColor,linksColor);
		
            $j.cookie('links-variant', '#' + hex, { path: '/' });
		}
	});
	
});

function setTitlesLinksColor(titlesColor,linksColor){
	
	// set titles color
	setStyle("#color1",'a, #logo .title, #navigation-header li strong, #toolbar h2, #toolbar #descriptions strong, h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, #content h1, #content h2, #content h3, #content #content h4, #content h5, #content h6, #content h1 a, #content h2 a, #content h3 a, #content h4 a, #content h5 a, #content h6 a, #main-footer h3, .widget-container h1, .widget-container h2, .widget-container h3, .widget-container h4, .widget-container h5, .widget-container h6, .widget-container h1 a, .widget-container h2 a, .widget-container h3 a, .widget-container h4 a, .widget-container h5 a, .widget-container h6 a, .widget-container ul.menu li a:hover, .widget-container ul.menu li.current_page_item li a:hover, .widget_twitter .twitter-timestamp, .widget_calendar caption, .mainbar .entry-meta a, .mainbar .entry-utility a, .portfolio-website .website-name a, #comments .vcard .fn { color :' + titlesColor + '; }');
	// set links color
	setStyle("#color2",'.mainbar a, .mainbar a:hover, #main-footer a, #main-footer a:hover, h5 a:hover, h6 a:hover, #content h5 a:hover, #content h6 a:hover, .widget-container a:hover, .widget-container ul.menu li.current_page_item a { color : '+linksColor+'; } #navigation ul li.current-menu-item a { color : '+linksColor+'; } #navigation ul li.current-menu-item ul a { color : #fff !important; } #navigation li.current-page-ancestor a { color : '+linksColor+'; } #navigation li.current-page-ancestor ul a { color : #fff !important; } #navigation-header li a:hover span { color : '+linksColor+'; } #navigation-header li.current-menu-item span { color : '+linksColor+'; } #navigation-header li.current-page-ancestor span { color : '+linksColor+'; } #navigation li a:hover, #navigation li ul li a:hover { color : '+linksColor+' !important; } input#submit, input.wpcf7-submit { background-color : '+linksColor+'; border-color : '+linksColor+'; }');
	
	//$j('#navigation > ul > li > a:hover').css("color",linksColor);
	
	/* set cufon links color
	Cufon.replace('#navigation > ul > li > a', {
            textShadow: '1px 1px rgba(0, 0, 0, 0.3)',
            hover: {
                color: linksColor
            }
        });
    Cufon.replace('#feature-list-tabs h3 a', {
            textShadow: '1px 1px rgba(0, 0, 0, 0.3)',
            hover: {
                color: linksColor
            }
    });
	
    Cufon.replace('h1 a', { hover: { color: linksColor }});
    Cufon.replace('h2 a', { hover: { color: linksColor }});
    Cufon.replace('h3 a', { hover: { color: linksColor }});
    Cufon.replace('h4 a', { hover: { color: linksColor }});
        
	Cufon.replace('.portfolio-website .website-name a', { hover: { color: linksColor }});
	*/
	
	RefreshCufon();
	
}

function setStyle(id, val)
{
	if($j.browser.msie) {
		var el = document.getElementById(id.replace('#', ''));
		el.styleSheet.cssText = val;		
	}
	else {
		$j(id).html(val);
	}
}

function ChangeThemeVariant() {
    /*
		var color2, color3, color4 = '';
		if(undefined != $j.cookie('slider-variant2')) {
			color2 = 'a, a:hover,	.sidebox h3 a, table#wp-calendar tfoot a:hover,	.portfolio-website .website-url a, .portfolio-website .website-url a:hover, .dark a, .dark a:hover, .dark .sidebox h3 a, .dark table#wp-calendar tfoot a:hover, .dark .portfolio-website .website-url a, .dark .portfolio-website .website-url a:hover { color: ' + $j.cookie('slider-variant2') + ';}';
		}
		if(undefined != $j.cookie('slider-variant3')) {
			color3 = 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,	.website-name,  .website-name a, .website-name a:hover, .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6,	.dark h1 a, .dark h2 a, .dark h3 a, .dark h4 a, .dark h5 a, .dark h6 a,	.dark h1 a:hover, .dark h2 a:hover, .dark h3 a:hover, .dark h4 a:hover, .dark h5 a:hover, .dark h6 a:hover,	.dark .website-name, .dark .website-name a, .dark .website-name a:hover { color: ' + $j.cookie('slider-variant3') + ';}';
		}
		if(undefined != $j.cookie('slider-variant4')) {
			color4 = '.footer-links h2, .footer-links h2 a, .footer-links h3,.footer-links h3 a { color: ' + $j.cookie('slider-variant4') + ' !important;}';
		}
		if(undefined != $j.cookie('slider-variant5')) {
			$j('.gold').css({'backgroundColor': $j.cookie('slider-variant5')});
			$j('.gold').css({'borderColor': $j.cookie('slider-variant5')});
		}
		if(undefined != $j.cookie('slider-variant6')) {
			$j('.black').css({'backgroundColor': $j.cookie('slider-variant6') });
			$j('.black').css({'borderColor': $j.cookie('slider-variant6') });
		}
		if(undefined != $j.cookie('slider-variant7')) {
			$j('.red').css({'backgroundColor': $j.cookie('slider-variant7') });
			$j('.red').css({'borderColor': $j.cookie('slider-variant7') });
		}
		
		$j('body').append('<style type="text/css" id="color2">' + color2 + '</style>');
		$j('body').append('<style type="text/css" id="color3">' + color3 + '</style>');
		$j('body').append('<style type="text/css" id="color4">' + color4 + '</style>');
		
        $j('#heading').css({'backgroundColor': $j.cookie('slider-variant')});		
        $j('#footer').css({'backgroundColor': $j.cookie('slider-variant')});		
            $j('.footer-links h2').css('color', $j.cookie('slider-variant'));	
            $j('.footer-links h3').css('color', $j.cookie('slider-variant'));	
            $j('.footer-links h2 a').css('color', $j.cookie('slider-variant'));	
            $j('.footer-links h3 a').css('color', $j.cookie('slider-variant'));	
        if ( $j.cookie('slider-variant')) {
        }
        */
                
        if ( $j.cookie('theme-variant') == 'light' ) {
            $j('body').removeClass('dark').addClass('light');
        }
        else if ( $j.cookie('theme-variant') == 'dark' ) {
            $j('body').removeClass('light').addClass('dark');
        }
        
        $j('#theme-light').click(function () { 
            $j('body').removeClass('dark').addClass('light'); 
            $j.cookie('theme-variant', 'light', { path: '/' });
            RefreshCufon ();
            return false; 
        });
        
        $j('#theme-dark').click(function () { 
            $j('body').removeClass('light').addClass('dark'); 
            $j.cookie('theme-variant', 'dark', { path: '/' });
            RefreshCufon ();
            return false;
        });
}

function SetStylesheet () {
    if ($j.cookie('stylesheet-color')) {
        $j('#stylesheet-color').attr('href', $j.cookie('stylesheet-color')); 
    }

    if ($j.cookie('stylesheet-bg')) {
        $j('#stylesheet-bg').attr('href', $j.cookie('stylesheet-bg')); 
    }
}

function ChangeStylesheet () {
    
    $j('#sections li a').click(function () {
        sectionName = $j(this).attr('rel');
       
        if ($j('.' + sectionName).is(':visible')) {
            $j('.' + sectionName).hide();
            $j('#page-wrap .homesection:visible:last').addClass('backgroundNone');
        }
        else {
            $j('.' + sectionName).show();
            $j('#page-wrap .homesection').prev('.backgroundNone').removeClass('backgroundNone');
            $j('#page-wrap .homesection:visible:last').addClass('backgroundNone');
        }
            
        return false;
    });
    
	if ($j.cookie('theme-pattern')) {
        $j('html').css('background-image', "url(" + $j.cookie('theme-pattern') + ")");
        $j('html').css('background-repeat', "repeat");
        $j('html').css('background-attachment', "scroll");
    }
      
    $j('#theme-box .theme-patterns a').click(function() {
        var rel = $j(this).attr('rel');
        if (rel.length) {
            if(rel == "none"){
				$j('html').css('background-image','none');
				$j.cookie('theme-pattern', rel, { path: '/' });
			} else {
				var baseDir = $j('#theme-box #theme-box-reset').attr("href");
				var path = '/wp-content/themes/trademark/files/images/patterns/' + rel;
				path = baseDir + path;
				$j.cookie('theme-pattern', path, { path: '/' });
				$j('html').css('background-image', "url(" + path + ")");
			}
        }
    });
        
    $j('#theme-box a.not').click(function () {        
        /****************
         * Reset
         ****************/
        if ($j(this).attr('id') == 'theme-box-reset') {
            $j.cookie('bg-variant', null, { path: '/' });  
            $j.cookie('header-variant', null, { path: '/' });  
            $j.cookie('slider-variant', null, { path: '/' });  
            $j.cookie('toolbar-variant', null, { path: '/' });  
            $j.cookie('main-variant', null, { path: '/' });  
            $j.cookie('navigation-variant', null, { path: '/' });  
            $j.cookie('navigation-text-variant', null, { path: '/' });
            $j.cookie('titles-variant', null, { path: '/' });
            $j.cookie('links-variant', null, { path: '/' });
            $j.cookie('main-footer-variant', null, { path: '/' });  
            $j.cookie('theme-variant', null, { path: '/' });              
            $j.cookie('theme-pattern', null, { path: '/' });
            $j.cookie('navigation-position', null, { path: '/' });             
            location.href='http://www.ait.sk/trademark/';
        }
    
        return false;
    });

    $j('#theme-box a.link').click(function () {        
        /****************
         * Standard Link
         ****************/
        location.href = $j(this).attr('href');
        return false;
    });
    
    $j('#stylesheet-color-setter li a').click(function () {
        path = $j(this).attr('href');        
                
        $j('#stylesheet-color').attr('href', path);
        $j.cookie('stylesheet-color', path, { path: '/' });  

        RefreshCufon ();
                
        return false;
    });
    
    $j('#stylesheet-bg-setter li a').click(function () {
        path = $j(this).attr('href');
                        
        $j('#stylesheet-bg').attr('href', path);        
        $j.cookie('stylesheet-bg', path, { path: '/' });  

        RefreshCufon ();        
        
        return false;
    });
} 

function RefreshCufon () {
    Cufon.replace('#page h1, #page h2, #page h3, #logo .title, #navigation-header strong');    
    Cufon.replace('#feature-list-tabs h3', {
        textShadow: '1px 1px rgba(0, 0, 0, 0.2)'
    });
    
    Cufon.replace('#navigation > ul > li > a', {
        textShadow: '1px 1px rgba(0, 0, 0, 0.2)'
    });
}

function FloatThemeBox () {
    if ($j.cookie('themebox-status') == 'closed') {
        $j('#theme-box').css({'left': '-131px'});
        $j('#theme-box-closer').removeClass('opened').addClass('closed');       
    }
    
    $j('#theme-box-closer').click(function () {
        if ($j(this).hasClass('opened')) {
            $j('#theme-box').animate({
                'left': '-131px'
            }, 500, function () {
                $j('#theme-box-closer').removeClass('opened').addClass('closed');       
                $j.cookie('themebox-status', 'closed', { path: '/' });
            });
        }
        
        if ($j(this).hasClass('closed')) {
            $j('#theme-box').animate({
                'left': '-0px'
            }, 500, function () {
                $j('#theme-box-closer').removeClass('closed').addClass('opened');       
                $j.cookie('themebox-status', 'opened', { path: '/' });
            });
        }        
    });
    
    var name = '#theme-box';  
    var menuYloc = null; 
    if ($j(name).length) {
        menuYloc = parseInt($j(name).css('top').substring(0,$j(name).css('top').indexOf('px')))      
        $j(window).scroll(function () {
            var offset = menuYloc + $j(document).scrollTop() + 'px';  
            $j(name).animate({top:offset},{duration:500,queue:false});          
        });
    }
}

function NavigationPosition(){
	
	/* set with php
	if(undefined != $j.cookie('navigation-position')) {
		if($j.cookie('navigation-position') == 'top'){
			$j("#slider").before($j("#navigation"));
			location.reload();
		} else {
			$j("#main").prepend($j("#navigation"));
			location.reload();
		}
	}
	*/
	
	$j("#main-navigation-top").click(function(){
		// set with php
		//$j("#slider").before($j("#navigation"));
		$j.cookie('navigation-position', "top", { path: '/' });
		location.reload(); 
	});
	
	$j("#main-navigation-bottom").click(function(){
		// set with php
		//$j("#main").prepend($j("#navigation"));
		$j.cookie('navigation-position', "bottom", { path: '/' });
		location.reload();
	});
}


function BestSellersClick(){
	
	$j("#theme-box select#best-sellers").change(function(){
		switch($j(this).val())
		{
			case "corporate":
				window.location.href = 'http://www.ait.sk/corporate/wp';
				break;
			case "simplicius":
				window.location.href = 'http://www.ait.sk/simplicius/wp';
				break;
			case "universal-business":
				window.location.href = 'http://www.ait.sk/universal-business/wp';
				break;
			case "glamorous":
				window.location.href = 'http://www.ait.sk/glamorous/wp';
				break;
			case "trademark":
				window.location.href = 'http://www.ait.sk/trademark/wp';
				break;
			case "fullscreen":
				window.location.href = 'http://www.ait.sk/fullscreen/wp';
				break;
			default:
		}
	});
}
