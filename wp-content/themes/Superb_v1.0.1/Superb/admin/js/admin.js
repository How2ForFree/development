function recalculateHeight() {
	var $ = jQuery;
	var menu_height = $('#wpbody').height();
	var admin_height = $('.uds-wrap').height();
	$('.uds-wrap').css('height', 'auto');
	if(menu_height > admin_height) {
		$('.uds-wrap').height(menu_height);
	}
}

jQuery(window).load(function(){
	recalculateHeight();
});

jQuery(document).ready(function($){	
	// make sure alternate sub-box is hidden when there are no children visible
	function checkAlternateVisibility(element) {
		var class = '.' + $('select', element).val() + '-container';
		//console.log($(class, element).length);
		if($(class, element).length === 0) {
			$('.alternates', element).slideUp();
		} else {
			$('.alternates', element).slideDown();
		}
	}
	// classic form handlers
	alternateHandler = function(){
		var parent = this;
		$('.alternates>div', this).slideUp('fast', function(){
			$('.alternates .'+$('select', parent).val()+'-container', parent).slideDown('fast', function(){
				checkAlternateVisibility(parent);
				recalculateHeight();
			});
		});
		checkAlternateVisibility(parent);
	}
	$('.alternate-wrapper').each(alternateHandler).change(alternateHandler);
	
	optionalHandler = function(){
		if($('>span>input:checked', this).length > 0){
			$('.optionals', this).slideDown('fast', function(){
				recalculateHeight();
			});
		} else {
			$('.optionals', this).slideUp();
		}
	}
	$('.optional-wrapper').each(optionalHandler).change(optionalHandler);
	
	// Controls
	$('.switch').each(function(){
		//console.log($('input[type=checkbox]', this).is(':checked'));
		if($('input[type=checkbox]', this).is(':checked')) {
			$(this).addClass('checked');
		} else {
			$(this).removeClass('checked');
		}
		
		$(this).css({
			width: '81px',
			height: '24px',
			backgroundImage: 'url(' + template_url + '/admin/images/admin-switch.png)',
			backgroundRepeat: 'no-repeat'
		});
		
		$('input[type=checkbox]', this).css({
			width: '81px',
			height: '24px',
			opacity: 0,
			cursor: 'pointer'
		}).hover(function(){
			$(this).parent().addClass('hover');
		}, function(){
			$(this).parent().removeClass('hover');
		}).click(function(){
			if($(this).is(':checked')) {
				$(this).parent().addClass('checked');
			} else {
				$(this).parent().removeClass('checked');
			}
		});
	});
	
	$('.dropdown').each(function(){
		$(this).prepend("<div>" + $('select option:selected', this).text() + "</div>");
		
		$(this).css({
			backgroundImage: 'url(' + template_url + '/admin/images/bg-dropdown.png)',
			backgroundRepeat: 'no-repeat'
		});
		
		$('div', this).css({
			width: '136px',
			height: '17px',
			marginBottom: '-23px',
			padding: '3px 25px 3px 6px'
		});
		
		$('select', this).css({
			opacity: 0,
			cursor: 'pointer'
		});
		
		$('select', this).change(function(){
			$(this).parent().find('div').text($('option:selected', this).text());
		});
	});
	
	$('.date').each(function(){
		var field = this;
		$(this).DatePicker({
			format: 'Y-m-d',
			date: $(field).val(),
			current: $(field).val(),
			onBeforeShow: function(){
				$(field).DatePickerSetDate($(field).val(), true);
			},
			onChange: function(formated, dates){
				$(field).val(formated);
				$(field).DatePickerHide();
			}
		});
	});
	
	$('div.time').each(function(){
		var field = this;
		$('.hour,.minute', this).change(function(){
			$('input.time', field).val($('.hour', field).val() + ":" + $('.minute', field).val());
		});
	});
});