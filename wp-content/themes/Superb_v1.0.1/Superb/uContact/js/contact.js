jQuery(document).ready(function($){
	function error(message) {
		return "<p class='error'>" + message + "</p>";
	}
	
	function validate(element) {
		//d("Validating element: "+element);
		var messages = '';
		var container = $(element).parents('.uds-contact-element');
		
		if($(container).size() == 0) {
			return true;
		}
		
		var label = $('label', container).html();
		
		var isRequired = $(container).hasClass('required');
		var isEmpty = ($('input[type=text],textarea', container).val() == '' || $('input[type=checkbox]:checked', container).size() == 1);
		var isCaptchaHidden = $(element).is('#recaptcha_challenge_field');
		if(isRequired && isEmpty && !isCaptchaHidden) {
			messages += error(label.replace(':', '') + " is required");
			$(container).addClass('error');
		}
		
		$(container).find('.uds-contact-element-messages').append(messages);
	}
	
	function haveErrors(form) {
		return !!($('.uds-contact-element.error', form).length > 0);
	}
	
	$('.uds-contact-form').each(function(){
		$('form', this).submit(function(){
			$('.uds-contact-element', this).removeClass('error');
			$('.uds-contact-element-messages *', this).remove();
			
			$('input,textarea', this).each(function(){
				validate(this);
			});
			
			if(haveErrors(this)) {	
				return false;
			}
		});
	});
});