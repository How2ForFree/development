/* if user is using IE6 offer Google Chrome */
if(!window.XMLHttpRequest) { alert('Your browser is obsolete. Click OK to download Google Chrome, a faster and safer browser.'); window.location = 'http://www.google.com/chrome/'; }

function sendComment() {
  jQuery('#commentform').submit();
}
function validateContactForm() {
  var ok = true;
  jQuery.each(jQuery('.required-field'), function() {
    if(jQuery(this).val() == '') {
      ok = false;
      jQuery(this).css({'border':'#c00 solid 1px'});
    } else {
      jQuery(this).css({'border':'0'});
    }
  });
  if(ok) {
    return true;
  } else {
    jQuery('#contact-error').fadeIn();
  }
  return false;
}
function addHover() {
  jQuery('#grabber').hover(function() {
      jQuery('#topbar-holder').animate({'top':'-70px'}, {queue:false, duration:200, easing:'easeOutCubic'});
  }, function() {
      jQuery('#topbar-holder').animate({'top':'-75px'}, {queue:false, duration:200, easing:'easeOutCubic'});
  });
  jQuery('#grabber').animate({'background-position':'0px -30px'}, {queue:false, duration:300});
}
function backgroundResize() {
  if(jQuery('#bgimg').length > 0) {
    var oImg = new Image();
    oImg.src = jQuery('#bgimg').attr('src');
    jQuery(oImg).ready(function() {
      var orgW = oImg.width;
      var orgH = oImg.height;
      if(orgW != 0 && orgH != 0) {
      	var h = jQuery(window).height();
      	var w = jQuery(window).width();
      	var ratioW = w / orgW;
      	var ratioH = h / orgH;
      	if(ratioW > ratioH) {
      		jQuery('#bgimg').css({'height':(w * orgH / orgW), 'width':w});
      	} else {
      		jQuery('#bgimg').css({'height':h, 'width':(h * orgW / orgH)});
      	}
      	jQuery('#bgholder').css({'display':'block'});
    	}
    	setTimeout(function() {
      	jQuery('#bgholder').css({'display':'block'});
      }, 1000);
  	});
	}
}
function initializeGoogleMaps(gLat, gLng) {
  if(gLat == undefined || gLng == undefined) {
    var gLat = 51.190098;
    var gLng = 5.9974175;
  }
  var latlng = new google.maps.LatLng(gLat, gLng);
  var myOptions = {
    zoom:zoom,
    center:latlng,
    navigationControl:true,
    mapTypeControl:false,
    scaleControl:false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById('googlemaps'), myOptions);
  var marker = new google.maps.Marker({
      position:latlng,
      map:map,
      icon:'http://www.google.com/intl/en_us/mapfiles/ms/micons/orange-dot.png'
  });
}

jQuery(document).ready(function() {
  /* Resize background image */
  if(jQuery('#bgimg').length > 0) {
    jQuery(window).resize(backgroundResize);
    jQuery('#bgimg').ready(backgroundResize);
    setTimeout(backgroundResize, 1000);
  }
  /* Fix content height if sidebar is higher */
  if(jQuery('.one-third-right').height() > jQuery('.two-thirds-left').height()) { jQuery('.sidebarmiddle').css({'height':(jQuery('.one-third-right').height() - 40) + 'px'}); }
  if(jQuery('.one-third-left').height() > jQuery('.two-thirds-right').height()) { jQuery('.sidebarmiddle').css({'height':(jQuery('.one-third-left').height() - 40) + 'px'}); }
  
  /* Fix padding for any multiline heading or payoff */
  if(jQuery('#payoff h2').height() > 26) { jQuery('#payoff h2').css({'padding':'3px 20px 0 10px'}); }
  if(jQuery('#heading h1').height() > 35) { jQuery('#heading h1').css({'padding':'5px 20px 0 10px'}); }
  
  /* Fix widget layout */
  jQuery.each(jQuery('.widget'), function() {
    if((jQuery('.widget').index(jQuery(this)) + 1) % 4 == 0) {
      jQuery(this).after('<div class="floatfix"></div>');
    }
  });
  
  /* Shortcode toggle */
  jQuery('.toggle_content').hide(); 
	jQuery('h4.toggle').toggle(function() {
		jQuery(this).addClass('active');
		}, function() {
		jQuery(this).removeClass('active');
	});
	jQuery('h4.toggle').click(function() {
		jQuery(this).next('.toggle-content').slideToggle();
	});
	
	/* Shortcode tabs */
	jQuery('.framed-tab-set .tab-content').eq(0).show();
	jQuery('.framed-tab-set .tabs li a').eq(0).addClass('current');
	jQuery('.framed-tab-set .tabs li a').click(function() {
	  jQuery('.framed-tab-set .tabs li a').removeClass('current');
	  jQuery(this).addClass('current');
	  jQuery('.framed-tab-set .tab-content').hide();
	  jQuery('.framed-tab-set .tab-content').eq(jQuery('.framed-tab-set .tabs li a').index(jQuery(this))).show();
	});
	
  /* Google Maps */
  if(jQuery('#googlemaps').length > 0) {
    var geocoder = new google.maps.Geocoder();
    if(geocoder) {
      geocoder.geocode({'address':address }, function(results, status) {
        if(status == google.maps.GeocoderStatus.OK) {
          var gLat = results[0].geometry.location.lat();
          var gLng = results[0].geometry.location.lng();
        }
        initializeGoogleMaps(gLat, gLng);
      });
    }
  }
  
  /* Blog category image hover */
  if(jQuery('.hoverimg').length > 0) {
    if(!jQuery.browser.opera) {
      jQuery('.hoverimg').hover(function() {
		  if(jQuery.browser.msie) {
				jQuery(this).find('img').stop(true, true).animate({'opacity':'.7'}, {queue:false, duration:300, easing:'easeOutCubic'});
			} else {
				jQuery(this).stop(true, true).animate({'opacity':'.7'}, {queue:false, duration:300, easing:'easeOutCubic'});
			}
      }, function() {
		  if(jQuery.browser.msie) {
				jQuery(this).find('img').stop(true, true).animate({'opacity':'1'}, {queue:false, duration:200, easing:'easeOutCubic'});
			} else {
				jQuery(this).stop(true, true).animate({'opacity':'1'}, {queue:false, duration:200, easing:'easeOutCubic'});
			}
      });
    }
  }
  
  /* TD button hover */
  if(jQuery('.td-button').length > 0) {
    if(!jQuery.browser.opera) {
      jQuery('.td-button').hover(function() {
        jQuery(this).stop(true, true).animate({'opacity':'.75'}, {queue:false, duration:400, easing:'easeOutCubic'});
      }, function() {
        jQuery(this).stop(true, true).animate({'opacity':'1'}, {queue:false, duration:500, easing:'easeOutCubic'});
      });
    }
  }
  
  /* Contact form validation */
  if(jQuery('#contactform').length > 0) {
    jQuery('#contactform').submit(function() { return validateContactForm(); });
    jQuery('#contact-submit').click(function() {
      jQuery('#contactform').submit();
    });
  }
  
  /* Topbar */
  addHover();
  jQuery('#grabber').click(function() {
    if(jQuery('#topbar-holder').css('top') != '-20px') {
      jQuery(this).unbind('mouseenter').unbind('mouseleave');
      jQuery('#s').focus();
      jQuery('#topbar-holder').animate({'top':'-20px'}, {queue:false, duration:400, easing:'easeOutBack', complete:function() { jQuery('#grabber').animate({'background-position':'0px -5px'}, {queue:false, duration:300}); }});
    } else {
      jQuery('#topbar-holder').animate({'top':'-75px'}, {queue:false, duration:200, easing:'easeOutCubic', complete:
      addHover});
    }
  });
  jQuery('#sociables img').css({'opacity':1});
  jQuery('#sociables img').hover(function() {
      jQuery(this).animate({'opacity':.5}, {queue:false, duration:200, easing:'easeOutCubic'});
  }, function() {
      jQuery(this).animate({'opacity':1}, {queue:false, duration:200, easing:'easeOutCubic'});
  });
  
/* Main menu */
  jQuery('#header-container .menu > ul > li > a').css({'opacity':1});
  jQuery('#header-container .menu > ul > li').hover(function() {
  if (jQuery.browser.msie) {
  	jQuery('> a', this).stop(true, true).css({'opacity':2});
  	jQuery('> ul > li > a', this).stop(true, true).css({'opacity':1});
  }
  else{
    jQuery('> a', this).stop(true, true).animate({'opacity':2}, {queue:false, duration:100, easing:'easeOutCubic'});
    jQuery('> ul > li > a', this).stop(true, true).animate({'opacity':1}, {queue:false, duration:500, easing:'easeOutCubic'});
 }
    
  }, function() {
    jQuery('> a', this).stop(true, true).animate({'opacity':1}, {queue:false, duration:500, easing:'easeOutCubic'});
    jQuery('> ul > li > a', this).stop(true, true).animate({'opacity':.1}, {queue:false, duration:500, easing:'easeOutCubic'});
  });
  
  /* Sub menu */
  if(jQuery('#header-container .menu > ul > li > ul').length > 0) {
    jQuery('#header').hover(function() {
      jQuery(this).animate({'height':(90 + hH) + 'px'}, {queue:false, duration:600, easing:'easeInOutExpo'});
      jQuery('#header-s').animate({'top':(90 + hH) + 'px'}, {queue:false, duration:600, easing:'easeInOutExpo'});
    }, function() {
      jQuery('#header-s').animate({'top':'90px'}, {queue:false, duration:600, easing:'easeInOutExpo'});
      jQuery(this).animate({'height':'90px'}, {queue:false, duration:600, easing:'easeInOutExpo'});
    });
    jQuery('#header-container .menu > ul > li > ul > li > a').css({'opacity':.2});
    jQuery('#header-container .menu > ul > li > ul > li > a').hover(function() {
       jQuery(this).css({'opacity':1});
    }, function() {
       jQuery(this).css({'opacity':1});
    });
    /* Fix submenu width and height */
    var first = true;
    var hH = 0;
    jQuery.each(jQuery('#header-container .menu > ul > li'), function() {
      if(jQuery('ul', this).length == 0) {
        if(first) {
          jQuery('ul', this).css({'background':'none'});
          first = false; 
        } else {
          jQuery(this).append('<ul></ul>');
        }
      }
      jQuery.each(jQuery('ul', this), function() {
        if(first) {
          jQuery(this).css({'background':'none'});
          first = false; 
        }
        var m = jQuery(this).width();
        var h = 13;
        jQuery.each(jQuery(this).children(), function() {
          if(m < jQuery(this).width()) { m = jQuery(this).width(); }
        });
        jQuery('a', this).css({'width':(m - 30) + 'px'});
        jQuery.each(jQuery(this).children(), function() {
          h += jQuery(this).height();
        });
        if(hH < h) { hH = h; }
      });
      jQuery('#header-container .menu ul li ul').css({'height':(hH + 10) + 'px'});
    });
  };
  
  /* Footer */
  jQuery('#footer a').css({'opacity':1});
  jQuery('#footer a').hover(function() {
    jQuery(this).stop(true, true).animate({'opacity':0.7}, {queue:false, duration:100, easing:'easeOutBack'});
  }, function() {
    jQuery(this).stop(true, true).animate({'opacity':1}, {queue:false, duration:500, easing:'easeOutBack'});
  });
});

/* Background-position fix  */
(function(jQuery) {
	if(!document.defaultView || !document.defaultView.getComputedStyle){ // IE6-IE8
		var oldCurCSS = jQuery.curCSS;
		jQuery.curCSS = function(elem, name, force){
			if(name === 'background-position'){
				name = 'backgroundPosition';
			}
			if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
				return oldCurCSS.apply(this, arguments);
			}
			var style = elem.style;
			if ( !force && style && style[ name ] ){
				return style[ name ];
			}
			return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
		};
	}
	
	var oldAnim = jQuery.fn.animate;
	jQuery.fn.animate = function(prop){
		if('background-position' in prop){
			prop.backgroundPosition = prop['background-position'];
			delete prop['background-position'];
		}
		if('backgroundPosition' in prop){
			prop.backgroundPosition = '('+ prop.backgroundPosition;
		}
		return oldAnim.apply(this, arguments);
	};
	
	function toArray(strg){
		strg = strg.replace(/left|top/g,'0px');
		strg = strg.replace(/right|bottom/g,'100%');
		strg = strg.replace(/([0-9\.]+)(\s|\)|jQuery)/g,'jQuery1pxjQuery2');
		var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
		return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
	}
	
	jQuery.fx.step. backgroundPosition = function(fx) {
		if (!fx.bgPosReady) {
			var start = jQuery.curCSS(fx.elem,'backgroundPosition');
			
			if(!start){//FF2 no inline-style fallback
				start = '0px 0px';
			}
			
			start = toArray(start);
			
			fx.start = [start[0],start[2]];
			
			var end = toArray(fx.options.curAnim.backgroundPosition);
			fx.end = [end[0],end[2]];
			
			fx.unit = [end[1],end[3]];
			fx.bgPosReady = true;
		}
		//return;
		var nowPosX = [];
		nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
		nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];           
		fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];

	};
})(jQuery);