jQuery(document).ready(function($){
	/////////////////////////////////////////////////////////////////////////////////////////
	//
	// Admin page JS
	//
	/////////////////////////////////////////////////////////////////////////////////////////
	$('.contact-delete').click(function(){
		if(confirm('Do you really want to delete this contact form?')) {
			return true;
		}
		return false;
	});
	
	/////////////////////////////////////////////////////////////////////////////////////////
	//
	// Add page JS
	//
	/////////////////////////////////////////////////////////////////////////////////////////
	
	// compute arrow position
	var templatesHeight = $('#uds-contact-templates').height();
	$('#uds-arrow').css('margin-top', (templatesHeight / 2) - 30 + 'px');
	
	// Element ID counter, used to uniquely identify elements within the form
	var elementId = $('.uds-contact-id-counter').val();
	
	// Element cloning function
	$('.uds-contact-create').click(function(){
		cloneAndSetID($(this).next(), elementId).appendTo('#uds-contact-fields');
		elementId++;
	});
	
	// captcha fields
	if( ! $('input[name=uds-contact-form-use-captcha]').is(':checked')) {
		$('.uds-captcha').slideUp(0);
	}
	$('input[name=uds-contact-form-use-captcha]').change(function(){
		$('.uds-captcha').slideToggle(300, function(){
			$("#uds-contact-fields").sortable('refresh');
		});
	});
	
	// validators
	$('.validators-listing').slideUp();
	$('.options-validators>p').live('click', function(){
		$(this).next().slideToggle(300);
	});
	
	// cloning function, used to create actual form fields from templates
	function cloneAndSetID(element, id) {
		var field = $(element).clone();
		var idr = '_ID_';
		$('*', field).each(function(){
			var $this = $(this);
			var attributes = ['value', 'for', 'id', 'class', 'name'];
			
			for(i in attributes) {
				if(typeof $this.attr(attributes[i]) != 'undefined') {
					$this.attr(attributes[i], $this.attr(attributes[i]).replace(idr, id));
				}
			}
		});
		
		return field;
	}
	
	// detect droppable empty
	var emptyMessage = $('.uds-contact-fields-empty').clone();
	function emptyifyFieldsContainer() {
		if($('#uds-contact-fields>div').length == 0) {
			$('#uds-contact-fields').addClass('empty');
			if($('.uds-contact-fields-empty').length == 0) {
				$('#uds-contact-fields').append(emptyMessage);
			}
		}
	}
	emptyifyFieldsContainer();
	
	// setup contact form template draggables
	$('.uds-contact-create').draggable({
		connectToSortable: '#uds-contact-fields',
		helper: 'clone',
		revert: 'invalid'
	});
	
	// contact form setup sortables
	function refreshSortables() {
		$("#uds-contact-fields").sortable({
			axis: 'y',
			containment: 'document',
			handle: '.uds-actions-move',
			items: '.uds-contact-field',
			cursor: 'move',
			forceHelperSize: false,
			forcePlaceholderSize: true,
			placeholder: 'uds-placeholder',
			revert: true,
			tolerance: 'intersect',
			start: function(event, ui) {
				$('.uds-placeholder').height(ui.helper.outerHeight());
			},
			sort: function() {
				$(this).removeClass('uds-active');
			},
			receive: function(event, ui) {
				//console.log(ui);
				var id = '#'+ui.item.attr('id');
				$(id).trigger('click');
				
				var newField = $('#uds-contact-fields>.uds-contact-field:last');
				newField.hide();
				$('#uds-contact-fields>a').replaceWith(newField);
				newField.slideDown(300);
				$(this).sortable('refresh');
				// roll up validators
				$('.validators-listing').slideUp();
				// fix Empty
				$('#uds-contact-fields').removeClass('empty');
				$('.uds-contact-fields-empty').remove();
			}
		});
		$("#uds-contact-fields").disableSelection();
	}
	refreshSortables();
	
	// contact form delete fields
	$('.uds-actions-delete').live('click', function(){
		if(confirm("Really delete?")) {
			$(this).parents('.uds-contact-field').remove();
			emptyifyFieldsContainer();
			$("#uds-contact-fields").sortable('refresh');
		}
	});
	
	//contextual help
	function setupHelp(hoverElement, helpElement) {
		var $help = $('#uds-contextual-help');
		var $hint = $('#uds-contact-descriptions .hint');
		$help.css('display', 'block');
		$(hoverElement).hover(function(){
			$hint.stop().fadeOut(300, function() {
				$help.stop().html($(helpElement).html()).fadeIn(300, function() {
					$(this).css('opacity', 1);
				});
			});
		}, function(){
			$help.stop().fadeOut(300, function(){
				$hint.stop().fadeIn(300, function() {
					$(this).css('opacity', 1);
				});
			});
		});
	}
	setupHelp('#uds-contact-create-text', '#uds-contact-describe-text');
	setupHelp('#uds-contact-create-textarea', '#uds-contact-describe-textarea');
	setupHelp('#uds-contact-create-email', '#uds-contact-describe-email');
	setupHelp('#uds-contact-create-captcha', '#uds-contact-describe-captcha');
	
	setupHelp('.uds-contact-field.text', '#uds-contact-describe-text');
	setupHelp('.uds-contact-field.textarea', '#uds-contact-describe-textarea');
	setupHelp('.uds-contact-field.email', '#uds-contact-describe-email');
	setupHelp('.uds-contact-field.captcha', '#uds-contact-describe-captcha');
	
});