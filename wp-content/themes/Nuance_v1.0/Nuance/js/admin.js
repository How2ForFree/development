/* ------------------------------------------------------------------------------------------------------------

	JavaScript for the WordPress Admin 
	
------------------------------------------------------------------------------------------------------------ */

	/* --------------------------------------------------------------------------

		Name: layout_options_change()
		Description: Changes the metabox options based on which page template is selected.
		
	--------------------------------------------------------------------------  */
	function layout_options_change(){
		
		var current_page_template = jQuery('#page_template').find('option:selected').val();
		var current_layout = jQuery('.metabox-layout li.active input:hidden').val();
		
		if(current_page_template == 'template-portfolio.php'){
			
			jQuery('.metabox-layout-options-page').fadeOut(300, function(){
				jQuery('.metabox-layout-options-portfolio').fadeIn(300);
			});
			
			if(current_layout != 'layout_p3' && current_layout != 'layout_p4'){
			
				jQuery('.metabox-sidebar').parents('.metabox-field-container').animate({ opacity : 0.3 }, 600);
				jQuery('.metabox-sidebar').parents('.metabox-field-container').find('input, select').attr('disabled', 'disabled');
			
			}
			
			jQuery('.metabox-portfolio-categories').parents('.metabox-field-container').animate({ opacity : 1 }, 600);
						
			if(jQuery('.metabox-layout-options-portfolio li.active').length){
			
			}else{
				jQuery('.metabox-layout-options-portfolio').find('input[value=layout_p2]').parents('li').click();
			}
			
		}else{
		
			jQuery('.metabox-layout-options-portfolio').fadeOut(300, function(){
				jQuery('.metabox-layout-options-page').fadeIn(300);
			});
			
			jQuery('.metabox-portfolio-categories').parents('.metabox-field-container').animate({ opacity : 0.3 }, 600);
			jQuery('.metabox-sidebar').parents('.metabox-field-container').animate({ opacity : 1 }, 600);
			jQuery('.metabox-sidebar').parents('.metabox-field-container').find('input, select').attr('disabled', '');
		
		}
		
		if(current_layout == 'layout_p3' || current_layout == 'layout_p4'){
			jQuery('.metabox-sidebar').parents('.metabox-field-container').animate({ opacity : 1 }, 600);
			jQuery('.metabox-sidebar').parents('.metabox-field-container').find('input, select').attr('disabled', '');
		}

	}/* layout_option_change() END */
	
	
	/* --------------------------------------------------------------------------

		Name: resize_composer()
		Description: If browser width less then 1340 switch to smaller version.
		
	--------------------------------------------------------------------------  */
	function resize_composer(){
		
		var window_width = jQuery(window).width();
			
		if(window_width < 1340){
			jQuery('.metabox-composer').addClass('small-width-version');
		}else{
			jQuery('.metabox-composer').removeClass('small-width-version');
		}

	}/* resize_composer() END */
	
	
	/* --------------------------------------------------------------------------

		Name: composer_sidebar_layout()
		Description: Change layout of the content composer depending on sidebars.
		
	--------------------------------------------------------------------------  */
	function composer_sidebar_layout(){
		
		if(jQuery('#on-page-composer-container').length){
			var layout = jQuery('#on-page-composer-layout').val();
		}else{
			var layout = jQuery('.metabox-layout li.active').find('input[type=hidden]').val();
		}
		
		/* Change the content composer layout */
		if(layout == 'layout_cs'){
		
			jQuery('.metabox-composer').removeClass('has-left-sidebar');
			jQuery('.metabox-composer').addClass('has-right-sidebar');
			
			/* Change full width widgets to 2/3 */
			jQuery('.metabox-composer-content li.full-width').find('.composer-widget-width-less').click();
		
		}else if(layout == 'layout_sc'){
		
			jQuery('.metabox-composer').removeClass('has-right-sidebar');
			jQuery('.metabox-composer').addClass('has-left-sidebar');
		
			/* Change full width widgets to 2/3 */
			jQuery('.metabox-composer-content li.full-width').find('.composer-widget-width-less').click();
		
		}else{
			
			jQuery('.metabox-composer').removeClass('has-left-sidebar');
			jQuery('.metabox-composer').removeClass('has-right-sidebar');
			
		}
		
	}/* composer_sidebar_layout() */

	
	/* --------------------------------------------------------------------------

		START IT UP
		
	--------------------------------------------------------------------------  */
	jQuery(document).ready(function($){
	
		$('#colorpicker').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	
		/* start ON-PAGE composer */
		
		if($('#on-page-composer-container').length){
			var path_to_composer_load = $('#on-page-composer-container #path-top-composer-load').val();
			$('#on-page-composer').load(path_to_composer_load, function(){
				var composer = $(this).find('.metabox-composer');
				$('.metabox-composer-content ul').sortable({
					stop: function(event, ui) { generate_composer_code(composer); },
					forcePlaceholderSize: true,
					placeholder: "composer-widgets-placeholder"
				});
				$('body').css({ paddingBottom : $('#on-page-composer-container').outerHeight() });
				composer_sidebar_layout();
			});
		}
		
		/* end ON-PAGE composer */
		
		resize_composer(); /* Resize composer on page load */
		composer_sidebar_layout(); /* Set composer layout on page load */
		
		
		/* --------------------------------------------------------------------------
			
			Changing layout (the template) of the page/post.
			
		-------------------------------------------------------------------------- */
		$('.metabox-layout li').live('click', function(){
			
			var metabox_container = $(this).parents('.metabox-field-container');
			
			/* Add active class to the new one and remove from the old one */
			$(this).addClass('active').siblings('.active').removeClass('active');
			
			/* Change the value of the input field with the new layout options */
			var new_value = $(this).find('input[type=hidden]').val();
			metabox_container.find('input.real-value').val(new_value);
			
			composer_sidebar_layout();
			generate_composer_code($('.metabox-composer'));
			layout_options_change();
			
		});
		
		
		/* --------------------------------------------------------------------------
			
			Sidebar Metabox 
			
		-------------------------------------------------------------------------- */
		$('.metabox-sidebar input:not(.real-value)').keyup(function(){
			
			var metabox_container = $(this).parents('.metabox-field-container');
			
			/* Set the new value */
			var new_value = $(this).val();
			metabox_container.find('input.real-value').val(new_value);
			
			/* Disable or enable the select box */
			if(new_value != ''){
				metabox_container.find('select').attr('disabled', 'disabled');
				metabox_container.find('select option:first').attr('selected', 'selected');
			}else{
				metabox_container.find('select').attr('disabled', '');
			}
			
		});
		
		$('.metabox-sidebar select').change(function(){
			
			var metabox_container = $(this).parents('.metabox-field-container');
			
			/* Set the new value */
			var new_value = $(this).find('option:selected').val();
			metabox_container.find('input.real-value').val(new_value);
			
		});
		
		$('.metabox-sidebar-info a').live('click', function(e){
			
			e.preventDefault();
			
			var metabox_container = $(this).parents('.metabox-field-container');
			
			/* Change text to removed with red color */
			$(this).html('<span style="color:red;">removed</span>');
			
			/* Set the new value (delete the value actually) */
			metabox_container.find('input.real-value').val('');
			
			/* Show the sidebar manipulation div */
			$(this).parents('.metabox-sidebar-info').fadeOut(400, function(){
				metabox_container.find('.metabox-sidebar-manipulation').fadeIn(400);
			});
			
		});
		
		
		/* --------------------------------------------------------------------------
			
			Template change = Options change
			
		-------------------------------------------------------------------------- */
		
		$('#page_template').live('change', function(){
			
			layout_options_change();
			
		});
		
		
		/* --------------------------------------------------------------------------
			
			Slider Metabox
			
		-------------------------------------------------------------------------- */
		
		function generate_slider_code(the_container){
			
			if(the_container.hasClass('portfolio-images')){ shortcode_name = 'portfolio_image'; }else{ shortcode_name = 'slide'; }
			
			var slider_active = the_container.find('.metabox-slider-active');
			var output = '';
			var slide_img = '';
			var slide_link = '';
			var slide_title = '';
			var slide_description = '';
			var slide_link_attr = '';
			var slide_description_attr = '';
			var slide_title_attr = '';
			var slide_height = '';
			var slide_height_attr = '';
			
			slider_active.find('li').each(function(){
				
				slide_img = $(this).find('img').attr('alt');
				
				if(shortcode_name == 'slide'){
					slide_link = $(this).find('input.slider-link').val();
					slide_title = $(this).find('input.slider-title').val();
					slide_description = $(this).find('input.slider-description').val();
					slide_description = slide_description.replace(/'/g,'&#39;');
					slide_height = $(this).parents('.metabox-field-container').find('input[name=jw_slider_height]').val();
					
					
					if(slide_link != ""){ slide_link_attr = "link='" + slide_link + "' "; }else{ slide_link_attr = ""; }
					if(slide_title != ""){ slide_title_attr = "title='" + slide_title + "' "; }else{ slide_title_attr = ""; }
					if(slide_description != ""){ slide_description_attr = "description='" + slide_description + "' "; }else{ slide_description_attr = ""; }
					if(slide_height != ""){ slide_height_attr = "height='" + slide_height + "' "; }else { slide_height_attr = ""; }
					
				}
				
				output = output + '[' + shortcode_name + ' ' + slide_link_attr + slide_title_attr + slide_description_attr + slide_height_attr + ']' + slide_img +'[/' + shortcode_name + '] ';
				
			});
			
			the_container.find('textarea.real-value').val(output);
			
		}/* generate_slider_code() END */
		
		/* Initiate the sortable */
		$('.metabox-slider-active ul').each(function(){
			var the_container = $(this).parents('.metabox-slider');
			$(this).sortable({
				stop: function(event, ui) { generate_slider_code(the_container); },
				forcePlaceholderSize: true,
				placeholder: "composer-widgets-placeholder"
			});
		});
		
		/* Check checked boxes */
		$('input.jw-checked').click();
		
		/* Add image */
		$('.metabox-slider .metabox-slider-media ul li:not(.active)').live('click', function(){
			
				$(this).addClass('active');
				
				var the_container = $(this).parents('.metabox-slider');
				var slider_active = the_container.find('.metabox-slider-active');
				var slider_media = the_container.find('.metabox-slider-media');
				
				if(the_container.hasClass('portfolio-images')){ shortcode_name = 'portfolio_image'; }else{ shortcode_name = 'slide'; }
				
				var thumbnail_url = $(this).find('img').attr('src');
				var image_url = $(this).find('img').attr('alt');
				var size_text = $(this).find('.img-size').html();
				
				if(shortcode_name == 'slide'){
					slider_active.find('ul').append('<li><img src="'+ thumbnail_url +'" alt="'+ image_url +'" /><a class="metabox-slider-show-edit"></a><a class="metabox-slider-remove-slide"></a><input type="hidden" class="slider-title" /><input type="hidden" class="slider-link" /><input type="hidden" class="slider-description" /></li>');
				}else if(shortcode_name == 'portfolio_image'){
					slider_active.find('ul').append('<li><img src="'+ thumbnail_url +'" alt="'+ image_url +'" /><a class="metabox-slider-remove-slide"></a></li>');
				}
				
				generate_slider_code(the_container);
			
		});
		
		/* Remove image (from media) */
		$('.metabox-slider .metabox-slider-media ul li.active').live('click', function(){
			
				$(this).removeClass('active');
				
				var the_container = $(this).parents('.metabox-slider');
				var slider_active = the_container.find('.metabox-slider-active');
				var slider_media = the_container.find('.metabox-slider-media');
				
				var img_url = $(this).find('img').attr('alt');
			
				slider_active.find('img[alt=' + img_url + ']').parents('li').remove(); 
				
				generate_slider_code(the_container);
			
		});
		
		/* Remove image (from active) */
		$('.metabox-slider .metabox-slider-active .metabox-slider-remove-slide').live('click', function(){
				
				/* Get containers */
				var the_container = $(this).parents('.metabox-slider');
				var slider_active = the_container.find('.metabox-slider-active');
				var slider_media = the_container.find('.metabox-slider-media');
				
				var img_url = $(this).parents('li').find('img').attr('alt');
				
				slider_media.find('img[alt=' + img_url + ']').parents('li').removeClass('active'); 
				
				$(this).parents('li').fadeOut(200, function(){
					$(this).remove();
					generate_slider_code(the_container);
				});
			
		});
		
		/* Show media */
		$('.metabox-slider-show-media').live('click', function(e){
			
			e.preventDefault();
			
			$(this).parents('.metabox-slider').find('.metabox-slider-active').hide();
			$(this).parents('.metabox-slider').find('.metabox-slider-edit').hide();
			$(this).parents('.metabox-slider').find('.metabox-slider-media').show();
			
		});
		
		/* Show active */
		$('.metabox-slider-show-active').live('click', function(e){
			
			e.preventDefault();
			
			$(this).parents('.metabox-slider').find('.metabox-slider-media').hide();
			$(this).parents('.metabox-slider').find('.metabox-slider-edit').hide();
			$(this).parents('.metabox-slider').find('.metabox-slider-active').show();
			
			$('.metabox-slider-active li.editing').removeClass('editing');
			
		});
		
		/* Show edit */
		$('.metabox-slider-show-edit').live('click', function(e){
			
			e.preventDefault();
			
			$(this).parents('li').addClass('editing');
			
			/* Get containers */
			var slider_container = $(this).parents('.metabox-slider');
			var slider_media = slider_container.find('.metabox-slider-media');		
			var slider_active = slider_container.find('.metabox-slider-active');
			var slider_edit = slider_container.find('.metabox-slider-edit');
			var slider_edit_active = slider_active.find('li.editing');
			
			/* Get current values */
			var title = slider_edit_active.find('input.slider-title').val();
			var description = slider_edit_active.find('input.slider-description').val();
			var link = slider_edit_active.find('input.slider-link').val();
			
			/* Set current values */
			slider_edit.find('input.slider-edit-title').val(title);
			slider_edit.find('textarea.slider-edit-description').val(description);
			slider_edit.find('input.slider-edit-link').val(link);
			
			/* Hide & Show */
			slider_media.hide();
			slider_active.hide();
			slider_edit.show();
			
		});
		
		/* Submit edit */
		$('.metabox-slider-submit-edit').live('click', function(e){
		
			e.preventDefault();
			
			/* Get containers */
			var slider_container = $(this).parents('.metabox-slider');
			var slider_media = slider_container.find('.metabox-slider-media');		
			var slider_active = slider_container.find('.metabox-slider-active');
			var slider_edit = slider_container.find('.metabox-slider-edit');
			var slider_edit_active = slider_active.find('li.editing');
			
			/* Get new values */
			var title = slider_edit.find('input.slider-edit-title').val();
			var description = slider_edit.find('textarea.slider-edit-description').val();
			var link = slider_edit.find('input.slider-edit-link').val();
			
			/* Set new values */
			slider_edit_active.find('input.slider-title').val(title);
			slider_edit_active.find('input.slider-description').val(description);
			slider_edit_active.find('input.slider-link').val(link);
			
			/* Hide edit and show active */
			slider_container.find('.metabox-slider-edit').hide();
			slider_container.find('.metabox-slider-active').show();
			
			/* Regenerate code */
			generate_slider_code(slider_container);
			
			/* Remove active class */
			slider_edit_active.removeClass('editing');
			
		});
		
		/* Add active class to the active items in media */
		$('.metabox-slider-active ul li').each(function(){
			
			var img_url = $(this).find('img').attr('alt');
			$(this).parents('.metabox-slider').find('.metabox-slider-media').find('img[alt=' + img_url + ']').parents('li').addClass('active');
			
		});
		
		/* Changed height */
		$('.metabox-field-container input[name=jw_slider_height]').keyup(function(){ 
			var slider_container = $(this).parents('.metabox-field-container').find('.metabox-slider');
			generate_slider_code(slider_container); 
		});
		
		
		/* --------------------------------------------------------------------------
			
			Composer Metabox
			
		-------------------------------------------------------------------------- */
		
		function generate_composer_code(composer){
			
			var composer_content = composer.find('.metabox-composer-content');
			
			var composer_front = composer.find('textarea.jw-composer-front');
			var composer_back = composer.find('textarea.jw-composer-back');
			
			if($('#on-page-composer-container').length){
				var layout = $('#on-page-composer-layout').val();
			}else{
				var layout = $('.metabox-layout li.active').find('input[type=hidden]').val();
			}
			
			var composer_front_new_value = '';
			
			var widget_name;
			var widget_width;
			var widget_content;
			
			var widget_width_total = 0;
			var last_attr = '';
			
			composer_content.find('li').each(function(){
				
				widget_name = $(this).find('input.composer-widget-name-value').val();
				widget_width = $(this).find('input.composer-widget-width-value').val();
				widget_content = $(this).find('input.composer-widget-content').val();
				widget_content_before = $(this).find('input.composer-widget-content-before').val();
				widget_content_after = $(this).find('input.composer-widget-content-after').val();
				
				/* Determine if it should have the last class */
				
				if(widget_width == 'full-width'){ widget_width_size = 10; }
				else if(widget_width == 'two-third'){ widget_width_size = 6.66; }
				else if(widget_width == 'one-half'){ widget_width_size = 5; }
				else if(widget_width == 'one-third'){ widget_width_size = 3.33; }
				else if(widget_width == 'one-fourth'){ widget_width_size = 2.5; }
				else if(widget_width == 'three-fourth'){ widget_width_size = 7.5; }
				
				widget_width_total = widget_width_total + widget_width_size;
				
				if(layout == 'layout_cs' || layout == 'layout_sc'){
					widget_width_max = 4.9;
				}else{
					widget_width_max = 9.9;
				}
				
				if(widget_width_total > widget_width_max){
					last_attr = ' last=true';
					widget_width_total = 0;
				}else{
					last_attr = '';
				}
				
				/* Set the attributes */
				widget_atts = " width='" + widget_width + "' content_before='" + widget_content_before + "' content_after='" + widget_content_after + "'" + last_attr;
				
				/* Special attributes */
				if(widget_name == 'separator'){ 
					
					if($(this).find('.composer-widget-separator-line:checked').val() !== undefined){
						widget_atts = widget_atts + ' line=yes';
						$(this).find('.composer-widget-separator-line').addClass('jw-checked');
					}else{
						$(this).find('.composer-widget-separator-line').removeClass('jw-checked');
					}
					
				}else if(widget_name == 'ltweet'){	
					
					ltweet_profile = $(this).find('input.composer-widget-content').val();
					
					if(ltweet_profile != ''){ ltweet_profile = ' profile="' + ltweet_profile + '"'; }
					
					widget_atts = widget_atts + ltweet_profile;
					
				}else if(widget_name == 'service'){
					
					var service_icon = $(this).find('.service-icon-value').val();
					widget_atts = widget_atts + ' icon="' + service_icon + '"';
					
				}else if(widget_name == 'testimonials'){
					
					var testimonial_type = $(this).find('.testimonial-type-value').val();
					var testimonial_amount = $(this).find('.testimonial-amount-value').val();
					var testimonial_columns = $(this).find('.testimonial-columns-value').val();
					var testimonial_category = $(this).find('.testimonial-category-value').val();
					
					if(testimonial_type != ''){ testimonial_type = ' type="' + testimonial_type + '"'; }
					if(testimonial_amount != ''){ testimonial_amount = ' amount="' + testimonial_amount + '"'; }
					if(testimonial_columns != ''){ testimonial_columns = ' columns="' + testimonial_columns + '"'; }
					if(testimonial_category != ''){ testimonial_category = ' category="' + testimonial_category + '"'; }
					
					widget_atts = widget_atts + testimonial_type + testimonial_amount + testimonial_columns + testimonial_category;
					
				}else if(widget_name == 'portfolio_posts'){
					
					var portfolio_type = $(this).find('.portfolio_posts-type-value').val();
					var portfolio_amount = $(this).find('.portfolio_posts-amount-value').val();
					var portfolio_item_width = $(this).find('.portfolio_posts-item-width-value').val();
					var portfolio_show_thumbnail = $(this).find('.portfolio_posts-show-thumbnail-value').val();
					var portfolio_show_title = $(this).find('.portfolio_posts-show-title-value').val();
					var portfolio_show_excerpt = $(this).find('.portfolio_posts-show-excerpt-value').val();
					var portfolio_show_meta = $(this).find('.portfolio_posts-show-meta-value').val();
					var portfolio_category = $(this).find('.portfolio_posts-category-value').val();
					
					if(portfolio_type != ''){ portfolio_type = ' type="' + portfolio_type + '"'; }
					if(portfolio_amount != ''){ portfolio_amount = ' amount="' + portfolio_amount + '"'; }
					if(portfolio_item_width != ''){ portfolio_item_width = ' item_width_value="' + portfolio_item_width + '"'; }
					if(portfolio_show_thumbnail != ''){ portfolio_show_thumbnail = ' show_thumbnail="' + portfolio_show_thumbnail + '"'; }
					if(portfolio_show_title != ''){ portfolio_show_title = ' show_title="' + portfolio_show_title + '"'; }
					if(portfolio_show_excerpt != ''){ portfolio_show_excerpt = ' show_excerpt="' + portfolio_show_excerpt + '"'; }
					if(portfolio_show_meta != ''){ portfolio_show_meta = ' show_meta="' + portfolio_show_meta + '"'; }
					if(portfolio_category != ''){ portfolio_category = ' category="' + portfolio_category + '"'; }
					
					widget_atts = widget_atts + portfolio_type + portfolio_amount + portfolio_item_width + portfolio_show_thumbnail + portfolio_show_title + portfolio_show_excerpt + portfolio_show_meta + portfolio_category;
					
				}else if(widget_name == 'blog_posts'){
			
					var blog_type = $(this).find('.blog_posts-type-value').val();
					var blog_amount = $(this).find('.blog_posts-amount-value').val();
					var blog_item_width = $(this).find('.blog_posts-item-width-value').val();
					var blog_show_thumbnail = $(this).find('.blog_posts-show-thumbnail-value').val();
					var blog_show_title = $(this).find('.blog_posts-show-title-value').val();
					var blog_show_excerpt = $(this).find('.blog_posts-show-excerpt-value').val();
					
					if(blog_type != ''){ blog_type = ' type="' + blog_type + '"'; }
					if(blog_amount != ''){ blog_amount = ' amount="' + blog_amount + '"'; }
					if(blog_item_width != ''){ blog_item_width = ' item_width_value="' + blog_item_width + '"'; }
					if(blog_show_thumbnail != ''){ blog_show_thumbnail = ' show_thumbnail="' + blog_show_thumbnail + '"'; }
					if(blog_show_title != ''){ blog_show_title = ' show_title="' + blog_show_title + '"'; }
					if(blog_show_excerpt != ''){ blog_show_excerpt = ' show_excerpt="' + blog_show_excerpt + '"'; }
					
					widget_atts = widget_atts + blog_type + blog_amount + blog_item_width + blog_show_thumbnail + blog_show_title + blog_show_excerpt;
					
				}
				
				if(widget_name == 'testimonials' || widget_name == 'portfolio_posts' || widget_name == 'blog_posts' || widget_name == 'ltweet' || widget_name == 'contact_form'){
					composer_front_new_value = composer_front_new_value + '[' + widget_name + widget_atts + '] ';
				}else{
					composer_front_new_value = composer_front_new_value + '[' + widget_name + widget_atts + ']' + widget_content + '[/' + widget_name + '] ';
				}
				
			});
			
			var composer_back_new_value = composer_content.find('ul').html();
			
			composer_back.val(composer_back_new_value);		
			composer_front.val(composer_front_new_value);
			
			if($('#on-page-composer-container').length){
				var path_to_composer_load = $('#on-page-composer-container #path-top-composer-load').val();
				$.post(path_to_composer_load, { 'new_composer_value' : composer_front_new_value }, function(data) {
					$('#content').html(data);
				});
			}
			
		}/* generate_composer_code() END */	
		
		/* Add Switch */
		if($('input#post_type').val() != 'jw_testimonials'){
			$('div#titlediv').after('<p class="composer-switch"><a href="#" class="switch-to-composer button-primary">Switch to composer</a></p>');
		}
		
		/* Switch to composer */
		$('.switch-to-composer').live('click', function(e){
			
			e.preventDefault();
			
			$('#postdivrich').hide();
			$('#jw_page_metabox_compose').show();
			
			$('#jw_page_metabox_compose').find('input.real-value').val('active');
			
			$(this).html('Switch to classic').removeClass('switch-to-composer').addClass('switch-to-classic');
			
		});
		
		/* Switch to classic */
		$('.switch-to-classic').live('click', function(e){
			
			e.preventDefault();
			
			$('#jw_page_metabox_compose').hide();
			$('#postdivrich').show();
			
			$('#jw_page_metabox_compose').find('input.real-value').val('inactive');
			
			$(this).html('Switch to composer').removeClass('switch-to-classic').addClass('switch-to-composer');
			
		});
		
		if($('#jw_page_metabox_compose').find('input.real-value').val() == 'active'){
			
			$('.switch-to-composer').click();
			
		}
		
		/* Add widget */
		$('.metabox-composer-widgets ul li a').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var widget = $(this).parents('li');
			
			var widget_name = widget.attr('id');
			
			var path_to_composer = $('#jw_path_to_shortcodes_ajax').val();
			
			$.get(path_to_composer + '?widget_name=' + widget_name, function(data) {
				$('.metabox-composer-content ul').append(data);
				generate_composer_code(composer);
			});
			
		});	
		
		/* Increase size */
		$('.composer-widget-width-more').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var widget = $(this).parents('li');
			var widget_size_input = widget.find('input.composer-widget-width-value');
			var widget_size_info = widget.find('.composer-widget-width-current');
			var widget_size = widget_size_input.val();
			
			if(widget_size == 'one-fourth'){
				widget.removeClass('one-fourth').addClass('one-third');
				widget_size_input.val('one-third');
				widget_size_info.html('1/3');
			}else if(widget_size == 'one-third'){
				widget.removeClass('one-third').addClass('one-half');
				widget_size_input.val('one-half');
				widget_size_info.html('1/2');
			}else if(widget_size == 'two-third'){
				widget.removeClass('two-third').addClass('three-fourth');
				widget_size_input.val('three-fourth');
				widget_size_info.html('3/4');
			}else if(widget_size == 'three-fourth'){
				widget.removeClass('three-fourth').addClass('full-width');
				widget_size_input.val('full-width');
				widget_size_info.html('1/1');
			}else if(widget_size == 'one-half'){
				widget.removeClass('one-half').addClass('two-third');
				widget_size_input.val('two-third');
				widget_size_info.html('2/3');
			}else if(widget_size == 'full-width'){
				
			}
			
			generate_composer_code(composer);
		
		});
		
		/* Decrease size */
		$('.composer-widget-width-less').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var widget = $(this).parents('li');
			var widget_size_input = widget.find('input.composer-widget-width-value');
			var widget_size_info = widget.find('.composer-widget-width-current');
			var widget_size = widget_size_input.val();
			
			if(widget_size == 'one-fourth'){
				
			}else if(widget_size == 'one-third'){
				widget.removeClass('one-third').addClass('one-fourth');
				widget_size_input.val('one-fourth');
				widget_size_info.html('1/4');
			}else if(widget_size == 'two-third'){
				widget.removeClass('two-third').addClass('one-half');
				widget_size_input.val('one-half');
				widget_size_info.html('1/2');
			}else if(widget_size == 'one-half'){
				widget.removeClass('one-half').addClass('one-third');
				widget_size_input.val('one-third');
				widget_size_info.html('1/3');
			}else if(widget_size == 'full-width'){
				widget.removeClass('full-width').addClass('three-fourth');
				widget_size_input.val('three-fourth');
				widget_size_info.html('3/4');
			}else if(widget_size == 'three-fourth'){
				widget.removeClass('three-fourth').addClass('two-third');
				widget_size_input.val('two-third');
				widget_size_info.html('2/3');
			}
			
			generate_composer_code(composer);
			
		});
		
		/* Remove widget ask */
		$('.composer-widget-remove-ask').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var widget = $(this).parents('li');
			
			widget.find('.composer-widget-actions').hide();
			widget.find('.composer-widget-title').hide();
			widget.find('.composer-widget-width').hide();
			widget.find('.composer-widget-remove-container').show();
			
		});
		
		/* Cancel remove */
		$('.composer-widget-remove-cancel').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var widget = $(this).parents('li');
			
			widget.find('.composer-widget-remove-container').hide();
			widget.find('.composer-widget-actions').show();
			widget.find('.composer-widget-title').show();
			widget.find('.composer-widget-width').show();
			
		});
		
		/* Remove widget */
		$('.composer-widget-remove').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			
			$(this).parents('li').fadeOut(300, function(){
				$(this).remove();
				generate_composer_code(composer)
			});
			
		});
		
		/* Initiate the sortable */
		$('.metabox-composer-content ul').each(function(){
			var composer = $(this).parents('.metabox-composer');
			$(this).sortable({
				stop: function(event, ui) { generate_composer_code(composer); },
				forcePlaceholderSize: true,
				placeholder: "composer-widgets-placeholder"
			});
		});
		
		/* Edit widget */
		$('.composer-widget-edit').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var composer_content = composer.find('.metabox-composer-content');
			var composer_edit = composer.find('.metabox-composer-edit');
			
			composer_edit.html('Loading...');
			
			var widget = $(this).parents('li');
			var widget_name = widget.find('input.composer-widget-name-value').val();
			
			widget.addClass('editing');
			
			composer_content.hide();
			composer_edit.show();
			
			var path_to_composer = $('#jw_path_to_shortcodes_ajax').val();
			
			$.get(path_to_composer + '?widget_name=' + widget_name + '_edit', function(data) {
				composer_edit.html(data);
				$('.metabox-new-field-title').val(widget.find('.composer-widget-title').text());
				$('.metabox-new-field-content').val(widget.find('.composer-widget-content').val());
				$('.metabox-new-field-content-before').val(widget.find('.composer-widget-content-before').val());
				$('.metabox-new-field-content-after').val(widget.find('.composer-widget-content-after').val());
				if(widget_name == 'service'){
					var service_icon = widget.find('.service-icon-value').val();
					$('.metabox-service-icons li').has('img[alt=' + service_icon + ']').addClass('active');
				}else if(widget_name == 'testimonials'){
					
					var testimonial_type = widget.find('.testimonial-type-value').val();
					var testimonial_amount = widget.find('.testimonial-amount-value').val();
					var testimonial_columns = widget.find('.testimonial-columns-value').val();
					var testimonial_category = widget.find('.testimonial-category-value').val();
					
					composer_edit.find('.testimonial-type-value-new').val(testimonial_type);
					composer_edit.find('.testimonial-amount-value-new').val(testimonial_amount);
					composer_edit.find('.testimonial-columns-value-new').val(testimonial_columns);
					composer_edit.find('.testimonial-category-value-new').val(testimonial_category);
					
				}else if(widget_name == 'portfolio_posts'){
						
					var portfolio_type = widget.find('.portfolio_posts-type-value').val();	
					var portfolio_amount = widget.find('.portfolio_posts-amount-value').val();	
					var portfolio_item_width = widget.find('.portfolio_posts-item-width-value').val();
					var portfolio_show_thumbnail = widget.find('.portfolio_posts-show-thumbnail-value').val();
					var portfolio_show_title = widget.find('.portfolio_posts-show-title-value').val();
					var portfolio_show_excerpt = widget.find('.portfolio_posts-show-excerpt-value').val();
					var portfolio_show_meta = widget.find('.portfolio_posts-show-meta-value').val();					
					var portfolio_category = widget.find('.portfolio_posts-category-value').val();					
					
					composer_edit.find('.portfolio_posts-type-value-new').val(portfolio_type);
					composer_edit.find('.portfolio_posts-amount-value-new').val(portfolio_amount);
					composer_edit.find('.portfolio_posts-item-width-value-new').val(portfolio_item_width);
					composer_edit.find('.portfolio_posts-show-thumbnail-value-new').val(portfolio_show_thumbnail);
					composer_edit.find('.portfolio_posts-show-title-value-new').val(portfolio_show_title);
					composer_edit.find('.portfolio_posts-show-excerpt-value-new').val(portfolio_show_excerpt);
					composer_edit.find('.portfolio_posts-show-meta-value-new').val(portfolio_show_meta);
					composer_edit.find('.portfolio_posts-category-value-new').val(portfolio_category);
					
				}else if(widget_name == 'blog_posts'){
						
					var blog_type = widget.find('.blog_posts-type-value').val();	
					var blog_amount = widget.find('.blog_posts-amount-value').val();	
					var blog_item_width = widget.find('.blog_posts-item-width-value').val();
					var blog_show_thumbnail = widget.find('.blog_posts-show-thumbnail-value').val();
					var blog_show_title = widget.find('.blog_posts-show-title-value').val();
					var blog_show_excerpt = widget.find('.blog_posts-show-excerpt-value').val();					
					
					composer_edit.find('.blog_posts-type-value-new').val(blog_type);
					composer_edit.find('.blog_posts-amount-value-new').val(blog_amount);
					composer_edit.find('.blog_posts-item-width-value-new').val(blog_item_width);
					composer_edit.find('.blog_posts-show-thumbnail-value-new').val(blog_show_thumbnail);
					composer_edit.find('.blog_posts-show-title-value-new').val(blog_show_title);
					composer_edit.find('.blog_posts-show-excerpt-value-new').val(blog_show_excerpt);
					
				}
			});
			
		});
		
		/* Edit widget submit */
		$('.composer-edit-save').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var composer_content = composer.find('.metabox-composer-content');
			var composer_edit = composer.find('.metabox-composer-edit');
			
			var widget_editing = composer_content.find('li.editing');
			
			var widget_title = widget_editing.find('.composer-widget-title');
			var widget_content = widget_editing.find('.composer-widget-content');
			var widget_content_before = widget_editing.find('.composer-widget-content-before');
			var widget_content_after = widget_editing.find('.composer-widget-content-after');
			
			var widget_new_title = composer_edit.find('.metabox-new-field-title').val();
			var widget_new_content = composer_edit.find('.metabox-new-field-content').val();
			var widget_new_content_before = composer_edit.find('.metabox-new-field-content-before').val();
			var widget_new_content_after = composer_edit.find('.metabox-new-field-content-after').val();
			
			/* special fields */
			
			if(composer_edit.find('.service-edit').length){
				
				var service_icon = composer_edit.find('.metabox-service-icons li.active img').attr('alt');
				widget_editing.find('.service-icon-value').val(service_icon);
				
			}else if(composer_edit.find('.testimonial-type-value-new').length){
				
				var testimonial_type = composer_edit.find('.testimonial-type-value-new').val();
				var testimonial_amount = composer_edit.find('.testimonial-amount-value-new').val();
				var testimonial_columns = composer_edit.find('.testimonial-columns-value-new').val();
				var testimonial_category = composer_edit.find('.testimonial-category-value-new').val();
				
				widget_editing.find('.testimonial-type-value').val(testimonial_type);
				widget_editing.find('.testimonial-amount-value').val(testimonial_amount);
				widget_editing.find('.testimonial-columns-value').val(testimonial_columns);
				widget_editing.find('.testimonial-category-value').val(testimonial_category);
				
			}else if(composer_edit.find('.portfolio_posts-type-value-new').length){
				
				var portfolio_posts_type = composer_edit.find('.portfolio_posts-type-value-new').val();
				var portfolio_posts_amount = composer_edit.find('.portfolio_posts-amount-value-new').val();
				var portfolio_posts_item_width = composer_edit.find('.portfolio_posts-item-width-value-new').val();
				var portfolio_posts_show_thumbnail = composer_edit.find('.portfolio_posts-show-thumbnail-value-new').val();
				var portfolio_posts_show_title = composer_edit.find('.portfolio_posts-show-title-value-new').val();
				var portfolio_posts_show_excerpt = composer_edit.find('.portfolio_posts-show-excerpt-value-new').val();
				var portfolio_posts_show_meta = composer_edit.find('.portfolio_posts-show-meta-value-new').val();
				var portfolio_posts_category = composer_edit.find('.portfolio_posts-category-value-new').val();
				
				widget_editing.find('.portfolio_posts-type-value').val(portfolio_posts_type);
				widget_editing.find('.portfolio_posts-amount-value').val(portfolio_posts_amount);
				widget_editing.find('.portfolio_posts-item-width-value').val(portfolio_posts_item_width);
				widget_editing.find('.portfolio_posts-show-thumbnail-value').val(portfolio_posts_show_thumbnail);
				widget_editing.find('.portfolio_posts-show-title-value').val(portfolio_posts_show_title);
				widget_editing.find('.portfolio_posts-show-excerpt-value').val(portfolio_posts_show_excerpt);
				widget_editing.find('.portfolio_posts-show-meta-value').val(portfolio_posts_show_meta);
				widget_editing.find('.portfolio_posts-category-value').val(portfolio_posts_category);
				
			}else if(composer_edit.find('.blog_posts-amount-value-new').length){
	
				var blog_posts_type = composer_edit.find('.blog_posts-type-value-new').val();
				var blog_posts_amount = composer_edit.find('.blog_posts-amount-value-new').val();
				var blog_posts_item_width = composer_edit.find('.blog_posts-item-width-value-new').val();
				var blog_posts_show_thumbnail = composer_edit.find('.blog_posts-show-thumbnail-value-new').val();
				var blog_posts_show_title = composer_edit.find('.blog_posts-show-title-value-new').val();
				var blog_posts_show_excerpt = composer_edit.find('.blog_posts-show-excerpt-value-new').val();
				
				widget_editing.find('.blog_posts-type-value').val(blog_posts_type);
				widget_editing.find('.blog_posts-amount-value').val(blog_posts_amount);
				widget_editing.find('.blog_posts-item-width-value').val(blog_posts_item_width);
				widget_editing.find('.blog_posts-show-thumbnail-value').val(blog_posts_show_thumbnail);
				widget_editing.find('.blog_posts-show-title-value').val(blog_posts_show_title);
				widget_editing.find('.blog_posts-show-excerpt-value').val(blog_posts_show_excerpt);
				
			}
			
			/* end special fields */
			
			widget_title.html(widget_new_title);
			widget_content.val(widget_new_content);
			widget_content_before.val(widget_new_content_before);
			widget_content_after.val(widget_new_content_after);
			
			composer_edit.hide();
			composer_content.show();
			
			widget_editing.removeClass('editing');
			
			generate_composer_code(composer);
			
		});
		
		
		/* Edit widget cancel */
		$('.composer-edit-cancel').live('click', function(e){
			
			e.preventDefault();
			
			var composer = $(this).parents('.metabox-composer');
			var composer_content = composer.find('.metabox-composer-content');
			var composer_edit = composer.find('.metabox-composer-edit');
			var widget_editing = composer_content.find('li.editing');
			
			composer_edit.hide();
			composer_content.show();
			
			widget_editing.removeClass('editing');
			
			generate_composer_code(composer);
			
		});
		
		$('.composer-widget-separator-line').live('click', function(){
			var composer = $(this).parents('.metabox-composer');
			generate_composer_code(composer);
		});
		
		/* Services composer widget icon selection */
		$('.metabox-service-icons li').live('click', function(){
			$(this).addClass('active').siblings('.active').removeClass('active');		
		});
		
		/* Windows resize */
		$(window).resize(function(){
			resize_composer();
		});
		
		/* Metaboxes - Set the first to be active */
		$('#jwmeta-sidebar ul li:first-child').addClass('active');
		$('#jwmeta-content .jwmeta-section:first-child').siblings('.jwmeta-section').hide();
		
		$('#jwmeta-sidebar ul li a').click(function(e){
			e.preventDefault();
			var section_id = $(this).attr('href');
			$(section_id).show().siblings('.jwmeta-section').hide();
			$(this).parents('li').addClass('active').siblings('.active').removeClass('active');
		});
		
		$('.metabox-composer-content ul li').not(':has(.inner)').wrapInner('<div class="inner" />');
		$('.metabox-composer-content ul li .inner').not(':has(.inner-2)').wrapInner('<div class="inner-2" />');
		
		$('.metabox-composer-content ul li').live('mouseenter',function(){
			$(this).find('.composer-widget-actions').css({ 'opacity' : 1 });
		}).live('mouseleave', function(){
			$(this).find('.composer-widget-actions').css({ 'opacity' : 0.3 });
		});
		
	});

	/* Fire up when everything is loaded */
	jQuery(window).load(function(){

		layout_options_change();

	});