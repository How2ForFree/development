<?php
function mr_admin_head() { ?>
	<style type="text/css">
		#admin h2 { margin-bottom: 20px; }
		#admin .title {background:black none repeat scroll 0 0;color:white;font-family:arial;font-size:12px;font-weight:bold !important;letter-spacing:1px;margin:0 !important;padding:10px;text-transform:uppercase;}
		#admin .container { background: #EEE; padding: 10px; }
		#admin .maintable { font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; background: #EAEAEA; margin-bottom: 20px; padding: 0px 0px; }
		#admin .mainrow { padding-bottom: 10px !important; margin: 0px 10px 10px 10px !important; background: #f1f1f1 url("http://flex.makedesignnotwar.com/themes/wp/mu/wpmu/wp-content/themes/flex/images/admin_panel/admin_gradient.jpg") repeat-x;  }
		#admin .mainrow td { border-bottom: 1px solid #FAFAFA; padding:10px}
		#admin .titledesc { font-size: 14px; font-weight:bold; width: 220px !important; margin-right: 20px !important; }
		#admin .forminp { width: 700px !important; valign: middle !important; }
		#admin .forminp input, .forminp select, .forminp textarea { margin-bottom: 9px !important; background: #fff; border: 1px solid #CCC; width: 500px; padding: 4px; font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; font-size: 12px; }
		#admin .forminp span { font-size: 10px !important; font-weight: normal !important; ine-height: 14px !important; }
		#admin .info { background: #FFFFCC; border: 1px dotted #D8D2A9; padding: 10px; color: #333; }
		#admin .forminp .checkbox { width:20px }
		#admin .info a { color: #333; text-decoration: none; border-bottom: 1px dotted #333 }
		#admin .info a:hover { color: #666; border-bottom: 1px dotted #666; }
		#admin .warning { background: #c3e3a7; border: 1px dotted #60982f; padding: 10px; color: #333; font-weight: bold; }
		em {font-size:12px}
	</style>
	<?php }

	/* ----------------------
		Variables
	------------------------ */

		/* Theme Name */
		$themename = "Flex";
		$shortname = "theme";
		
		$options = array();
		$template_path = get_bloginfo('template_directory');
		$mr_categories_obj = get_categories('hide_empty=0');
		$mr_categories = array();

		foreach ($mr_categories_obj as $mr_cat) {
			$mr_categories[$mr_cat->cat_ID] = $mr_cat->cat_name;
		}
		
		$yesno = array("Yes","No");
		$htmlxhtml = array("HTML 4.0 Strict","XHTML 1.0 Strict");
		$color = array("Carbon","Dark", "White", "Red", "Blue", "Green",  "Yellow", "DeepSpace", "Chrome", "WoodGrain", "Grunge", "Paper");
		$categories_tmp = array_unshift($mr_categories, "Select a category:");
		
		global $wpdb;
		$pages = $wpdb->get_results('select * from '. $wpdb->prefix .'posts where post_type="page" and post_status="publish"');
		$page_listing = array();
		
		foreach($pages as $page_list) {
			$page_listing[$page_list->post_title] = $page_list->post_title;
		}
		
	/* ----------------------
		Options
	------------------------ */

	$options = array (
			

			array(	"name" => "Design Settings",
					"type" => "heading"),
					
			array( 	"name" => "Theme Color",
					"desc" => "Take your pick! This will simply load a new custom-stylesheet after the core stylesheets are loaded. Modify these in the /css/custom folder. You can use these as-is, or customize them all you want.",
					"id" => $shortname."_color",
					"std" => "Theme Color:",
					"type" => "select",
					"options" => $color),
					
			array( 	"name" => "Logo URL",
					"desc" => "Enter the URL of your logo. IE: http://yourwebsite.com/images/yourlogo.png (note: this should be about 150x60 for quick and easy setup, but can be any size that you want. You can use the #logo ID in the CSS to customize the positioning using basic CSS margins.)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text"),

			array( 	"name" => "Favicon URL",
					"desc" => "Enter the URL of your image that you'd like to use for the Browser Icon (16px x 16px)",
					"id" => $shortname."_favicon",
					"std" => "",
					"type" => "text"),
			
			array( 	"name" => "Custom Page Width",
					"desc" => "Optional*: This will change the width of the content-column on all pages/posts that aren't the homepage. You can enter a simple number (ie: 640) into this field if you'd prefer to change it from the default (590). No need to enter px to the end.",
					"id" => $shortname."_customwidth",
					"std" => "",
					"type" => "text"),	
								
			array( 	"name" => "Custom CSS",
					"desc" => "You can enter custom style rules into this box if you'd like. IE: <i>a{color: red !important;}</i><br />
					This is an advanced option! This is not recommended for users not fluent in CSS.",
					"id" => $shortname."_customcss",
					"std" => "",
					"type" => "textarea"),		
						
			array( 	"name" => "Post Thumbnail Placeholder",
					"desc" => "Enter the URL to the image that you'd like to use for posts that don't have thumbnails assigned yet.",
					"id" => $shortname."_post_blankthumb",
					"std" => "",
					"type" => "text"),	
					
			array(	"name" => "Menu + Social Media",
					"type" => "heading"),
			
			array( 	"name" => "Home Link",
					"desc" => "A link to the homepage displayed at the front of the menu. Rule of thumb: if you show blog posts on your homepage pick yes, if you have a static page pick no.",
					"id" => $shortname."_home_link",
					"std" => "Display Home Link:",
					"type" => "select",
					"options" => $yesno),
					
			
			array( 	"name" => "Shuffle Link",
					"desc" => "This is just for fun right now, it adds a button to the main nav, that when clicked, randomly shuffles the order of the visible pieces in the grid.",
					"id" => $shortname."_shuffle_link",
					"std" => "Display Shuffle Link:",
					"type" => "select",
					"options" => $yesno),			
					
			array( 	"name" => "Shuffle Link Text",
					"desc" => "If you've selected Yes for the Shuffle-Link, you can enter the text for the link here. IE: Shuffle, Sort, Mix it up!, etc.",
					"id" => $shortname."_shuffle_text",
					"std" => "",
					"type" => "text"),
			
			array( 	"name" => "Category Link",
					"desc" => "Selecting this will display a new link in the navigation bar that drops down to reveal your categories.",
					"id" => $shortname."_category_link",
					"std" => "Display Category Links:",
					"type" => "select",
					"options" => $yesno),	
					
			
					
			array( 	"name" => "Facebook URL",
					"desc" => "Enter the URL of your Facebook page (leave blank if you don't want this option).",
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text"),
					
			array( 	"name" => "Twitter Username",
					"desc" => "Enter the username of your Twitter account (IE: http://twitter.com/your_user_name leave blank if you don't want this option).",
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text"),
					
			array( 	"name" => "Vimeo URL",
					"desc" => "Enter the URL of your Vimeo page (leave blank if you don't want this option).",
					"id" => $shortname."_vimeo",
					"std" => "",
					"type" => "text"),
			
			array( 	"name" => "Tumblr URL",
					"desc" => "Enter the URL of your Tumblr page (leave blank if you don't want this option).",
					"id" => $shortname."_tumblr",
					"std" => "",
					"type" => "text"),
					
			array( 	"name" => "Email Address",
					"desc" => "Enter an email address if you'd like people to be able to send you email from the top bar.",
					"id" => $shortname."_email",
					"std" => "",
					"type" => "text"),
			
			array( 	"name" => "Copyright Text",
					"desc" => "Enter the text that'll show up at the bottom of the page for your Copyright info.",
					"id" => $shortname."_copyright",
					"std" => "",
					"type" => "text"),
						
					
	  );

	/* ----------------------
		Admin Panel
	------------------------ */

	function mr_add_admin() {

		global $themename, $options;
		
		if ( $_GET['page'] == basename(__FILE__) ) {	
			if ( 'save' == $_REQUEST['action'] ) {
		
					foreach ($options as $value) {
						if($value['type'] != 'multicheck'){
							update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
						}else{
							foreach($value['options'] as $mc_key => $mc_value){
								$up_opt = $value['id'].'_'.$mc_key;
								update_option($up_opt, $_REQUEST[$up_opt] );
							}
						}
					}

					foreach ($options as $value) {
						if($value['type'] != 'multicheck'){
							if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
						}else{
							foreach($value['options'] as $mc_key => $mc_value){
								$up_opt = $value['id'].'_'.$mc_key;						
								if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
							}
						}
					}
					
					$options = array(
						'main_text'
						);
					foreach($options as $option)
					{
						update_option('theme_'. $option, (stripcslashes($_POST[$option])));
					}
					if(is_array($_POST['omit_pages']) && count($_POST['omit_pages']) >0){
						$page = join(',', $_POST['omit_pages']);
					}
					update_option('theme_footer_menu', $page);

					header("Location: admin.php?page=theme-panel.php&saved=true");								
				
				die;

			} else if ( 'reset' == $_REQUEST['action'] ) {
				delete_option('sandbox_logo');
				
				header("Location: admin.php?page=theme-panel.php&reset=true");
				die;
			}
		}

	add_menu_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'mr_page');
	}

	function mr_page (){
			global $options, $themename, $manualurl;
	?>
<div id="admin">
	<div class="wrap">

					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

							<h2 style="margin-bottom: -10px;"><img src="<?php bloginfo('template_directory'); ?>/images/admin_panel/adminpanel_header.jpg" /></h2>

							<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?> Options have been updated! w p l o c k e r . c o m</div><?php } ?>
							<?php if ( $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?> Options have been reset!</div><?php } ?>
									
									<table class="maintable" width="100%">
								<?php foreach ($options as $value) { ?>
		
										<?php if ( $value['type'] <> "heading" ) { ?>
		
											<tr class="mainrow">
											<td class="titledesc"><?php echo $value['name']; ?></td>
											<td class="forminp">
			
										<?php } ?>		 
		
										<?php
											
											switch ( $value['type'] ) {
											case 'text':
			
										?>
										
												<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
			
										<?php
											
											break;
											case 'select':
			
										?>
			
											<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
											<?php foreach ($value['options'] as $option) { ?>
												<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
											<?php } ?>
											</select>
			
										<?php
			
											break;
											case 'textarea':
											$ta_options = $value['options'];
			
										?>
										
											<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
			
										<?php
											
											break;
											case "radio":
			
											foreach ($value['options'] as $key=>$option) { 
					
														$radio_setting = get_settings($value['id']);
														
														if($radio_setting != '') {
															
															if ($key == get_settings($value['id']) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
														
														} else {
														
															if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
										} ?>
										
										<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
			
										<?php }
			 
											break;
											case "checkbox":
											
											if(get_settings($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
										
										?>
										
										<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			
										<?php
			
											break;
											case "multicheck":
			
											foreach ($value['options'] as $key=>$option) {
											
													$pn_key = $value['id'] . '_' . $key;
													$checkbox_setting = get_settings($pn_key);
					
													if($checkbox_setting != '') {
						
															if (get_settings($pn_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
					
													} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
					
										} ?>
										
										<input type="checkbox" class="checkbox" name="<?php echo $pn_key; ?>" id="<?php echo $pn_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $pn_key; ?>"><?php echo $option; ?></label><br />
										
										<?php }
			 
											break;
											case "heading":

										?>
										
											</table> 
											
													<h3 class="title"><?php echo $value['name']; ?></h3>
											
											<table class="maintable" width="100%">
												<?php if($value['desc']) { ?>
												<tr class="mainrow">
													<td colspan="2"><em><?php echo $value['desc']; ?></em></td>
												</tr>
												<?php } ?>
			
										<?php
											
											break;
											default:
											break;
										
										} ?>
		
										<?php if ( $value['type'] <> "heading" ) { ?>
		
											<?php if ( $value['type'] <> "checkbox" ) { ?><br/><?php } ?><span><?php echo $value['desc']; ?></span>
											</td></tr>
		
										<?php } ?>		
										<?php if ($value['name'] == "Menu") : ?>
										<tr class="mainrow">
										<td class="titledesc">Footer Menu</td>
										<td class="forminp">
										<select style="height:100px;width:180px" multiple="multiple" name="omit_pages[]">
<option value=""><strong>None</strong></option>
											<?php
											$omits = explode(',', get_option('theme_footer_menu'));
											global $wpdb;
											add_option('theme_footer_menu', '');
											$pages = $wpdb->get_results('select * from '. $wpdb->prefix .'posts where post_type="page" and post_status="publish"');
											
											foreach($pages as $page) {
												if(in_array($page->ID, $omits)){
													echo '<option selected value="'. $page->ID .'">'. $page->post_title .'</option>';
												}else{
													echo '<option value="'. $page->ID .'">'. $page->post_title .'</option>';
												}
											}
											?>
											</select>
											<br/><span>Pages that you want to include in the footer menu. Hold the SHIFT or CONTROL key to select  multiple.</span>
										</td>
									</tr>
									<?php endif; ?>
								<?php } ?>	
								
								</table>

								<p class="submit">
									<input name="save" type="submit" value="Save changes" />    
									<input type="hidden" name="action" value="save" />
								</p>							
								
								<div style="clear:both;"></div>						 
				</form>

	</div>
</div>
	<div style="clear:both;height:20px;"></div>
	 
	<?php
	};

	add_action('admin_menu', 'mr_add_admin');
	add_action('admin_head', 'mr_admin_head');	

	?>