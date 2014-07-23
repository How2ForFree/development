jQuery(document).ready(function($){
	
	//Show first section
	$('.jwpanel-section:first').show();
	$('#jwpanel-sidebar ul li:first').addClass('jwpanel-active');
	
	//z-index hack because of select boxes
	var top_z = 2000;
	$('.jwpanel-option').each(function(){
		top_z = top_z - 10;
		$(this).css({ 'z-index' : top_z });
	});	
	
	//Tabs click, change section
	$('#jwpanel-sidebar ul li a').click(function(e){
		
		e.preventDefault();
		
		var section = $(this).attr('href');
		
		$('.jwpanel-active').removeClass('jwpanel-active');
		$(this).parent().addClass('jwpanel-active');
		
		$('.jwpanel-section').hide();
		$(section).fadeIn(200);
		
	});
	
	//Switch on off
	$('.jwpanel-switch.on').live('click', function(e){
		e.preventDefault();
		$(this).removeClass('on').addClass('off').siblings('input').val('off');
	});
	
	$('.jwpanel-switch.off').live('click', function(e){
		e.preventDefault();
		$(this).removeClass('off').addClass('on').siblings('input').val('on');
	});
	
	//Select (custom)
	$('.jwpanel-option-select').each(function(){
		$(this).find('.jwpanel-select-value').text($(this).find('.current-option').text());
	});
	
	$('.jwpanel-select-switch').click(function(){
		$(this).parents('.jwpanel-option').find('.jwpanel-select-options').slideToggle();
	});
	
	$('.jwpanel-select-options ul li').click(function(){
		
		var new_value = $(this).attr('id');
		var new_value_text = $(this).text();
		
		$(this).parents('.jwpanel-option').find('.jwpanel-select-value').text(new_value_text);
		$(this).parents('.jwpanel-option').find('input[type=hidden]').val(new_value);
		$(this).parents('.jwpanel-option').find('.jwpanel-select-options').slideUp();
		
	});
	
	//Reset (since ver 1.1)
	$('.jwpanel-reset input').click(function(e){
		e.preventDefault();
		$('#jwpanel-reset-button').click();
	});
	
	
});