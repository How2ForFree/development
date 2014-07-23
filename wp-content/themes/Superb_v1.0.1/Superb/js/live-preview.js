jQuery(document).ready(function($){
	var colorWheelDim = 200;
	var originalColor = $('#bb-wrapper').css('background-color');

	$('.uds-live-preview').css({
		left: '-200px',
		display: 'block'
	});
	
	var closed = true;
	$('.uds-preview-dragger').click(function(){
		if(closed) {
			$('.uds-live-preview').animate({
				left: '0px'
			}, {
				duration: 300,
				easing: 'easeOutCubic',
				complete: function(){
					$('.uds-preview-dragger', this).html('&laquo;');
					$('.live-preview-form').animate({
						height: '60px',
						easing: 'easeOutExpo'
					}, 300);
				}
			});
			closed = false;
		} else {
			$('.live-preview-form').animate({
				height: '0px'
			}, {
				duration: 300,
				easing: 'easeOutExpo',
				complete: function() {
					$('.uds-live-preview').animate({
						left: '-200px'
					}, {
						duration: 300,
						easing: 'easeOutCubic',
						complete: function(){
							$('.uds-preview-dragger', this).html('&raquo;');
						}
					});
				}
			});		
			closed = true;
		}
	}).trigger('click');
	
	function rad2deg(rad) {
		return (rad / Math.PI) * 180;
	}
	
	function rgb2hsl(r, g, b){
		r /= 255, g /= 255, b /= 255;
		var max = Math.max(r, g, b), min = Math.min(r, g, b);
		var h, s, l = (max + min) / 2;

		if(max == min){
			h = s = 0; // achromatic
		}else{
			var d = max - min;
			s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
			switch(max){
				case r: h = (g - b) / d + (g < b ? 6 : 0); break;
				case g: h = (b - r) / d + 2; break;
				case b: h = (r - g) / d + 4; break;
			}
			h /= 6;
		}
		
		return {h: h, s: s, l: l};
	}

	function hsl2rgb(h, s, l) {
		var m1, m2, hue;
		var r, g, b
		s /=100;
		l /= 100;
		if (s == 0)
			r = g = b = (l * 255);
		else {
			if (l <= 0.5)
				m2 = l * (s + 1);
			else
				m2 = l + s - l * s;
			m1 = l * 2 - m2;
			hue = h / 360;
			r = HueToRgb(m1, m2, hue + 1/3);
			g = HueToRgb(m1, m2, hue);
			b = HueToRgb(m1, m2, hue - 1/3);
		}
		return {r: r, g: g, b: b};
	}
	
	function HueToRgb(m1, m2, hue) {
		var v;
		if (hue < 0)
			hue += 1;
		else if (hue > 1)
			hue -= 1;
	
		if (6 * hue < 1)
			v = m1 + (m2 - m1) * hue * 6;
		else if (2 * hue < 1)
			v = m2;
		else if (3 * hue < 2)
			v = m1 + (m2 - m1) * (2/3 - hue) * 6;
		else
			v = m1;
	
		return 255 * v;
	}
	
	function dec2hex(d, padding) {
		var hex = Number(Math.round(d)).toString(16);
		padding = typeof (padding) === "undefined" || padding === null ? padding = 2 : padding;
	
		while (hex.length < padding) {
			hex = "0" + hex;
		}
	
		return hex;
	}
	
	function calculateColor(el, event) {
		var x = (event.pageX - $(el).offset().left) - (colorWheelDim / 2);
		var y = (event.pageY - $(el).offset().top) - (colorWheelDim / 2);
		
		// position wheel selection
		$('.uds-color-wheel-selection').show().css({
			top: (event.pageY - $(el).offset().top - 5) + "px",
			left: (event.pageX - $(el).offset().left - 5) + "px"
		});
		
		var h = 0;
		var s = 100;
		var l = 0;
		
		var l = 100 - Math.sqrt(Math.pow(x, 2) + Math.pow(y, 2));

		if( x == 0 && y < 0) {
			h = 180;
		} else if (x == 0 && y == 0) {
			l = 100;
			h = 0;
		} else {
			h = rad2deg(Math.atan2(x, y));
		}
		
		var color = hsl2rgb(h, s, l);
		
		var colorString = dec2hex(color.r, 2);
		colorString += dec2hex(color.g, 2);
		colorString += dec2hex(color.b, 2);
		
		return colorString;
	}

	$('.uds-color-wheel-selection').hide();

	
	$('.uds-color-wheel').mousemove(function(e){
		return;
		changeColors(calculateColor(this, e));
	}).click(function(e){
		changeColors(calculateColor(this, e));
		originalColor = calculateColor(this, e);
		$('input[name=color]').val(originalColor);
	}).mouseout(function(){
		changeColors(originalColor);
	});
	
	function changeColors(color) {
		$('#bb-wrapper,#billboard-bottom,.heading-wrapper').css({
			backgroundColor: "#" + color
		})
	}
});