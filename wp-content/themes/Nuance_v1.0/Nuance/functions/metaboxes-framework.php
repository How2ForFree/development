<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Metaboxes framework
	
	Description: The custom metaboxes framework.
	
	Table of contents:
		1) jw_metabox_add
		2) jw_metabox_output
		3) jw_metabox_save
	
------------------------------------------------------------------------------------------------------------ */


	/* Actions */
	add_action('admin_init', 'jw_metabox_add', 1);
	add_action('save_post', 'jw_metabox_save');
	
	/* -----------------------------------------------------------------
		
		Name: jw_metabox_add
1)		
		Add the custom metaboxes. The output of those metaboxes is 
		regulated inside the jw_metabox_output function which is set
		as the callback for add_meta_box().
		
		add_meta_box( id, title, callback, post type, position, priority, callback_args )
		
	----------------------------------------------------------------- */	
	function jw_metabox_add(){

		/* Get the metaboxes */
		global $jw_metabox, $jw_metabox_fields;
		
		/* Loop all metaboxes and add them */
		foreach($jw_metabox as $instance){
			add_meta_box($instance['id'], $instance['title'], 'jw_metabox_output', $instance['post_type'], $instance['position'], $instance['priority'], $instance);
		}
		
	} /* jw_metabox_add() END */

	
	/* -----------------------------------------------------------------
		
		Name: jw_metabox_output
2)		
		This is the callback function of add_meta_box() function used
		inside the jw_metabox_add() function. The metaboxes content is
		regulated here.
		
	----------------------------------------------------------------- */	
	function jw_metabox_output($post, $metabox){
		
		global $domain;
		
		/* Get the metaboxes */
		global $jw_metabox, $jw_metabox_fields;
		
		/* Get the metabox id and the fields */
		$metabox_name = $metabox['id'];
		$metabox_fields[] = $jw_metabox_fields[$metabox_name];
		
		$output = '';
		$menu = '';
		
		/* Loop all the fields from the metabox */
		foreach($metabox_fields as $fields){
						
			$section_count = 0;
			
			/* Loop the fields */
			foreach($fields as $field){
				
				if($field['type'] != 'open' && $field['type'] != 'close'){
					
					$value = get_post_meta($post->ID, $field['name']);
					
					if(!empty($value)){ $value = $value[0]; }else{ $value = $field['default']; }
		
					$orig_value = $value;
					$value = htmlspecialchars($value);
					
					if($field['type'] == 'composer'){
						$composer_back = get_post_meta($post->ID, 'jw_composer_back');
						if(!empty($composer_back)){ $composer_back_stripped = htmlspecialchars($composer_back[0]); $composer_back = $composer_back[0]; }else{ $composer_back = ''; $composer_back_stripped = ''; }
						$composer_front = get_post_meta($post->ID, 'jw_composer_front');
						if(!empty($composer_front)){ $composer_front_stripped = htmlspecialchars($composer_front[0]); $composer_front = $composer_front[0]; }else{ $composer_front = ''; $composer_front_stripped = ''; }
					}
					
				}
				
				switch ($field['type']){
			
					/* Section open */
					case 'open':
					
						$section_count++;
						
						$output .= '<div class="jwmeta-section" id="jwmeta-content-'.$section_count.'"><div class="metabox-field-container">';
						$output .= '<div class="jwmeta-intro">'.$field['descr'].'</div>';
						
						$menu .= '<li><a href="#jwmeta-content-'.$section_count.'" id="jwmeta-sidebar-'.$section_count.'">'.$field['title'].'</a></li>';
					
					break;
					
					/* Section close */
					case 'close':
						
						$output .= '</div></div><!-- .jw-meta-section -->';
						
					break;
					
					/* Field: Text input */
					case 'text':
						
						$output .= '
						<div class="metabox-field">
							<label><span>'.$field['title'].'</span></label>
							<input type="text" name="'.$field['name'].'" value="'.$value.'" />
							<div class="clear"></div>';
							
							if(isset($field['descr'])){
								$output .= '<small>'.$field['descr'].'</small>';
							}
							
						$output .= 
						'</div>';
						
					break;
					
					/* Field: Textarea */
					case 'textarea':
					
						$output .= '
						<div class="metabox-field">
							<label><span>'.$field['title'].'</span></label>
							<textarea name="'.$field['name'].'" rows="3" style="width:50%;">'.$value.'</textarea>
							<div class="clear"></div>';
							
							if(isset($field['descr'])){
								$output .= '<small>'.$field['descr'].'</small>';
							}
							
						$output .= '
						</div>';
					
					break;
					
					/* Field: Select */
					case 'select':
						
						$output .= '
						<div class="metabox-field">
							<label><span>'.$field['title'].'</span></label>';
							
							$output .='
							<select name="'.$field['name'].'">';

								foreach($field['options'] as $key => $val){
									if($value == $val){ $selected = 'selected'; }else{ $selected = ''; }
									$output .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';
								}
								
							$output .= '
							</select>
							<div class="clear"></div>';
							
							if(isset($field['descr'])){
								$output .= '<small>'.$field['descr'].'</small>';
							}
							
						$output .= '
						</div>';
						
					break;
					
					/* Field: Radio */
					case 'radio':
						
						if($value == 'yes'){ $checked_yes = 'checked'; }else{ $checked_yes = ''; }
						if($value == 'no'){ $checked_no = 'checked'; }else{ $checked_no = ''; }
						
						$output .= '
						<div class="metabox-field">
							<label><span>'.$field['title'].'</span></label>';
							
							$output .= __('Yes', $domain).'<input type="radio" name="'.$field['name'].'" value="yes" '.$checked_yes.' />
							'.__('No', $domain).'<input type="radio" name="'.$field['name'].'" value="no" '.$checked_no.' />
							<div class="clear"></div>';
						
							if(isset($field['descr'])){
								$output .= '<small>'.$field['descr'].'</small>';
							}
							
						$output .= '
						</div>';
						
					break;
					
					/* Custom: Sidebar */
					case 'sidebar':
						
						$output .= '
						<div class="metabox-field metabox-sidebar">';
					
							if($value != ''){
								
								$output .= '<p class="metabox-sidebar-info">'.__('Active widget section:', $domain).'<strong>'.$value.'</strong> - <a href="#">'.__('remove', $domain).'</a></p>';
								
							}
							
							if($value != ''){ $display = 'style="display:none"'; }else{ $display = ''; }
							
							$output .= '
							<div class="metabox-sidebar-manipulation" '.$display.'>
							
								<p><label><span>'.__('Create New', $domain).'<span></label> <input type="text" /></p>
								<p><em>'.__('or', $domain).'</em></p>
								<p><label><span>'.__('Select Existing', $domain).'</span></label>
									<select>
										<option value="">'.__('- Select -', $domain).'</option>';
										
										global $wpdb;
		
										$widgetized_pages = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'jw_sidebar'"));
										
										if($widgetized_pages){
											
											foreach($widgetized_pages as $w_page){
												$output .= '<option>'.$w_page.'</option>';
											}
											
										}
										
									$output .= '
									</select>
								</p>
							</div>
							
							<input type="hidden" name="'.$field['name'].'" class="real-value" value="'.$value.'" />
							
						</div>';
						
					break;
					
					/* Custom: Layout */
					case 'layout':
						
						$output .= '
						<div class="metabox-field metabox-layout">
							
							<ul class="metabox-layout-options-page">';
							
								$output .= '<li'; if($value == 'layout_c'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-c.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_c" /></li>';
								$output .= '<li'; if($value == 'layout_cs'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-c+s.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_cs" /></li>';
								$output .= '<li'; if($value == 'layout_sc'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-s+c.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_sc" /></li>';
							
							$output .= '
							</ul>
							<ul class="metabox-layout-options-portfolio">';
							
								$output .= '<li'; if($value == 'layout_p1'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-p1.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_p1" /></li>';
								$output .= '<li'; if($value == 'layout_p2'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-p2.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_p2" /></li>';
								$output .= '<li'; if($value == 'layout_p3'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-p3.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_p3" /></li>';
								$output .= '<li'; if($value == 'layout_p4'){ $output .= ' class="active"'; } $output .= '><img src="'.get_template_directory_uri().'/functions/images/layout-p4.png" /><span class="active-info"><img src="'.get_template_directory_uri().'/functions/images/icon-tick.png" /></span><input type="hidden" value="layout_p4" /></li>';
							
							$output .= '
							</ul>
							<input type="hidden" name="'.$field['name'].'" class="real-value" value="'.$value.'" />
							
						</div>';
						
					break;
					
					/* Custom: Portfolio categories */
					case 'portfolio_categories':
					
						$output .= '<div class="metabox-field metabox-portfolio-categories">';
						
							if(strpos($value, ',') !== false) {
								$selected_cats = explode(',', $value);
							}else{
								$selected_cats[] = $value;
							}
							
							$categories =  get_categories('taxonomy=jw_portfolio_categories'); 
							if(!empty($categories)){
								foreach($categories as $cat){
									if(in_array($cat->term_id, $selected_cats)){ $checked = 'checked'; }else{ $checked = ''; }
									$output .= '<p><input type="checkbox" name="'.$cat->category_nicename.'" value="'.$cat->term_id.'" '.$checked.' />'.$cat->name.'</p>';
								}
							}else{
								$output .= '<p>'.__("There aren\'t any categories yet. All will be shown.", $domain).'</p>';
							}
							
							$output .= '<input type="hidden" name="'.$field['name'].'" value="'.$value.'" />';
						
						$output .= '</div>';
					
					break;
					
					/* Custom: slider */
					case 'slider':
						
						$output .= '
						<div class="metabox-field metabox-slider">
								
							<label><span>'.$field['title'].'</span></label>
							
							<!-- Currently active -->
							<div class="metabox-slider-active">
								
								<p>'.__('Currently active slides:', $domain).' <a href="#" class="metabox-slider-show-media" style="float:right;">'.__('+ Add slides', $domain).'</a></p>
								
								<ul>';
										
									$value_admin = $orig_value;
									$value_admin = str_replace('[slide', '[slide_admin', $value_admin);
									$value_admin = str_replace('[/slide]', '[/slide_admin]', $value_admin);
									
									$output .= do_shortcode($value_admin);
										
								$output .= '
								</ul>
								
							</div><!-- .metabox-slider-active-->
							
							<!-- All images listing -->
							<div class="metabox-slider-media">
								
								<p>'.__('Add slides:', $domain).' <a href="#" class="metabox-slider-show-active" style="float:right;">'.__('&larr; Finish adding', $domain).'</a></p>';
								
								$min_width = 920;
								
								global $wpdb;
								$media_images = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' order by ID desc");
								
								if(!empty($media_images)){
								
									$output .= '<ul>';
									
										foreach($media_images as $image_post){
											
											$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
											
											//If image is big enough for the slider proceed
											if($img_details[1] >= $min_width){
											
												$thumb_src = wp_get_attachment_image_src($image_post->ID, 'jw_100');
												$thumb_src = $thumb_src[0];
												
												if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
												
												$output .= '
												<li'.$class_attr.'>
													<img src="'.$thumb_src.'" alt="'.$img_details[0].'" />
													<span class="img-size">'.$img_details[1].'x'.$img_details[2].'</span>
													<span class="added-notice">'.__('Added', $domain).'</span>
												</li>';
												
											}
											
										}
										
									$output .= '</ul>';
									
								}else{
									$output .= '<p>Use the WordPress Media Library to upload images. They need to be at least 920px wide in order to show up here</p>';
								}
								
							$output .= '
							</div><!-- .metabox-slider-media -->
							
							<!-- Edit a slide -->
							<div class="metabox-slider-edit">
								
								<p>'.__('Edit slide', $domain).' <a href="#" class="metabox-slider-show-active" style="float:right;">&larr; Back</a></p>
								
								<p><label>'.__('Title', $domain).'</label><input type="text" class="slider-edit-title" /></p>
								<p><label>'.__('Description', $domain).'</label><textarea class="slider-edit-description"></textarea></p>
								<p><label>'.__('Link', $domain).'</label><input type="text" class="slider-edit-link" /></p>
								<p><label>&nbsp;</label><a href="#" class="metabox-slider-submit-edit">'.__('Save', $domain).'</a> - <a href="#" class="metabox-slider-show-active">'.__('Cancel', $domain).'</a>
								
							</div><!-- .metabox-slider-edit -->
							
							<textarea name="'.$field['name'].'" class="real-value" rows="10">'.$value.'</textarea>
							
						</div>';
						
					break;
					
					/* Custom: Content composer */
					case 'composer':
						
						$modules = array();
						
						$modules[] = array(	'id' => 'blank',
											'title' => 'Blank');
						
						$modules[] = array(	'id' => 'separator',
											'title' => 'Separator');
											
						$modules[] = array(	'id' => 'ltweet',
											'title' => 'Latest tweet');
											
						$modules[] = array(	'id' => 'service',
											'title' => 'Service');
											
						$modules[] = array(	'id' => 'testimonials',
											'title' => 'Testimonials');
																
						$modules[] = array(	'id' => 'portfolio_posts',
											'title' => 'Portfolio');
						
						$modules[] = array(	'id' => 'blog_posts',
											'title' => 'Blog');
						
						$modules[] = array(	'id' => 'contact_form',
											'title' => 'Contact Form');
						
						
						$output .= '
						<div class="metabox-composer">
							
							<div class="metabox-composer-widgets">
								
								<p>&darr; Modules <small>click to add</small></p>
								
								<ul>';
									
									foreach ($modules as $module){
									
										$output .= '
										<li id="'.$module['id'].'">
											<a href="#">'.$module['title'].'<img src="'.get_template_directory_uri().'/functions/images/ajax-loader.gif" class="metabox-composer-widget-load" /></a>
										</li>';
									
									}
									
								$output .= '
								</ul>
							
							</div><!-- .metabox-composer-widgets -->
							
							<div class="metabox-composer-c-s-container">
								
								<p>&darr; Content <small>modules you added</small></p>
								
								<div class="metabox-composer-content">
								
									<ul>
										'.$composer_back.'
									</ul>
									
								</div><!-- .metabox-composer-content -->
								
								<div class="metabox-composer-content-sidebar">Used Area<br />(sidebar)</div>
							
							</div><!-- .metabox-composer-c-s-container -->
							
							<div class="metabox-composer-edit">
								<!-- This will be populated via ajax call to composer-widgets.php -->
							</div><!-- .metabox-composer-edit -->
							
							<!-- The 2 textareas bellow hold the layouts for the backend(admin) and frontend(website) -->
							<textarea name="jw_composer_front" class="jw-composer-front">'.$composer_front_stripped.'</textarea>
							<textarea name="jw_composer_back" class="jw-composer-back">'.$composer_back_stripped.'</textarea>
							<input type="hidden" name="'.$field['name'].'" class="widefat real-value" value="'.$value.'" />
							
							<input type="hidden" id="jw_path_to_shortcodes_ajax" value="'.get_template_directory_uri().'/functions/composer-widgets.php" />
							
						</div><!-- .metabox-composer -->';
						
					break;
					
					/* Custom: Portfolio images */
					case 'portfolio_images':
						
						$output .= '
						<div class="metabox-slider portfolio-images">
							
							<!-- Currently active -->
							<div class="metabox-slider-active">
								
								<p>'.__('Currently active images:', $domain).' <a href="#" class="metabox-slider-show-media" style="float:right;">'.__('+ Add image', $domain).'</a></p>
								
								<ul>';
										
									$value_admin = $orig_value;
									$value_admin = str_replace('[portfolio_image', '[portfolio_image_admin', $value_admin);
									$value_admin = str_replace('[/portfolio_image]', '[/portfolio_image_admin]', $value_admin);
									
									$output .= do_shortcode($value_admin);
									
								$output .= '
								</ul>
								
							</div><!-- .metabox-slider-active-->
							
							<!-- All images listing -->
							<div class="metabox-slider-media">
								
								<p>'.__('Add images:', $domain).' <a href="#" class="metabox-slider-show-active" style="float:right;">'.__('&larr; Finish adding', $domain).'</a></p>';
								
								$min_width = 0;
								
								global $wpdb;
								$media_images = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' order by ID desc");
								
								$output .= '
								<ul>';
								
									foreach($media_images as $image_post){
										
										$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
										
										//If image is big enough for the slider proceed
										if($img_details[1] >= $min_width){
										
											$thumb_src = wp_get_attachment_image_src($image_post->ID, 'jw_100');
											$thumb_src = $thumb_src[0];
											
											if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
											
											$output .= '
											<li'.$class_attr.'>
												<img src="'.$thumb_src.'" alt="'.$img_details[0].'" />
												<span class="img-size">'.$img_details[1].'x'.$img_details[2].'</span>
												<span class="added-notice">'.__('Added', $domain).'</span>
											</li>';
											
										}
										
									}
								
								$output .= '
								</ul>
								
							</div><!-- .metabox-slider-media -->
							
							<textarea name="'.$field['name'].'" class="real-value" rows="10" style="width:100%;">'.$value.'</textarea>
							
						</div>';
						
					break;
				
				}
				
			}
			
		} /* metaboxes loop END */
		
		?>
		<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
		
		<div id="jwmeta-container">
			
			<div id="jwmeta-sidebar">
				<ul>
					<?php echo $menu; ?>
				</ul>
			</div><!-- #jwmeta-sidebar -->
			
			<div id="jwmeta-content">
				<?php echo $output; ?>
			</div><!-- #jwmeta-content -->
			
		</div>
		<?php
	  
	} /* jw_metabox_output() END */

	/* -----------------------------------------------------------------
		
		Name: jw_metabox_save
3)		
		Saving the values of our custom fields from our custom metaboxes
		
	----------------------------------------------------------------- */	
	function jw_metabox_save($post_id){

		/* Get the metaboxes */
		global $jw_metabox, $jw_metabox_fields;

		/* If the save is triggered by the autosave WordPress feature don't continue executing the script */
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			return $post_id;
		
		/* Loop all metaboxes */
		foreach($jw_metabox_fields as $fields){
			
			/* Loop all fields of a metabox */
			foreach($fields as $field){
				
				if($field['type'] != 'open' && $field['type'] != 'close'){
				
					/* Field name */
					$name = $field['name'];
					
					if(isset($_POST[$name])){
						
						if($field['type'] == 'portfolio_categories'){
							$selected_cats = '';
							$categories =  get_categories('taxonomy=jw_portfolio_categories'); 
							foreach($categories as $cat){
								if(isset($_POST[$cat->category_nicename])){
									$selected_cats .= ','.$_POST[$cat->category_nicename];
								}
							}
							$selected_cats = preg_replace('/,/', '', $selected_cats, 1);
							if(!empty($selected_cats)){ $value = $selected_cats; }else{ $value = ''; }
						}else{
							/* Get the value */
							$value = $_POST[$name];						
						}
						
						/* Add if it's new */
						if (get_post_meta($post_id, $name) == '') { add_post_meta($post_id, $name, $value, true); }

						/* Update if already has a value */
						elseif ($value != get_post_meta($post_id, $name, true)) { update_post_meta($post_id, $name, $value); }

						/* Delete if empty */
						elseif ($value == '') { delete_post_meta($post_id, $name, get_post_meta($post_id, $name, true)); }
						
					
					}
					
					if(isset($_POST['jw_composer_back']) && $field['type'] == 'composer'){
						
						/* Get the value */
						$composer_back = $_POST['jw_composer_back'];
						$composer_front = $_POST['jw_composer_front'];
						
						/* COMPOSER BACK */
						
						/* Add if it's new */
						if (get_post_meta($post_id, 'jw_composer_back') == '') { add_post_meta($post_id, 'jw_composer_back', $composer_back, true); }

						/* Update if already has a value */
						elseif ($composer_back != get_post_meta($post_id, 'jw_composer_back', true)) { update_post_meta($post_id, 'jw_composer_back', $composer_back); }

						/* Delete if empty */
						elseif ($composer_back == '') { delete_post_meta($post_id, 'jw_composer_back', get_post_meta($post_id, 'jw_composer_back', true)); }
						
						/* COMPOSER FRONT */
						
						/* Add if it's new */
						if (get_post_meta($post_id, 'jw_composer_front') == '') { add_post_meta($post_id, 'jw_composer_front', $composer_front, true); }
						
						/* Update if already has a value */
						elseif ($composer_front != get_post_meta($post_id, 'jw_composer_front', true)) { update_post_meta($post_id, 'jw_composer_front', $composer_front); }
						
						/* Delete if empty */
						elseif ($composer_front == '') { delete_post_meta($post_id, 'jw_composer_front', get_post_meta($post_id, 'jw_composer_front', true)); }
					}
				
				} /* If not open or close END */
				
			} /* metabox fields loop END */
			
		} /* metaboxes loop END */
		
	} /* jw_metabox_save() END */
	
?>