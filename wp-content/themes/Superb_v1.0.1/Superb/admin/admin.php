<?php

global $uds_errors, $current_page;
$uds_errors = array();

add_action('admin_init', 'uds_admin_init');
/**
 *	Admin Init Action Hook
 *
 */
function uds_admin_init()
{
	global $uds_install_result, $uds_options_pages;
	
	foreach($uds_options_pages as $page => $options) {
		register_setting($page, $page);
	}
	
	add_thickbox();
	
	// delete page sidebars that are no longer in use
	uds_sanitize_page_sidebars();
	
	if(isset($_GET['action']) && $_GET['action'] == 'export') {
		include get_template_directory() . '/functions/functions-exporter.php';
		uds_export_theme_data();
	}
}

// setup Admin menu entry
add_action('admin_menu', 'uds_menu');
/**
 *	UDS Menu
 *	Actions run to initialize the theme settings in WP Admin
 */
function uds_menu()
{
	// Setup Theme Options menu
	global $menu, $uds_options_pages;
	$position = 100;
	if(!empty($menu[$position])) $position = null;
	
	$icon = get_template_directory_uri() . '/admin/images/menu-icon.png';
	$theme_options = add_menu_page(UDS_TEMPLATE_NAME, __("Theme Options", 'uds-textdomain'), 'manage_options', 'uds_theme_admin_general', 'uds_theme_admin_general', $icon, $position);
	
	foreach($uds_options_pages as $key => $options) {
		if($key == 'uds_general_options') continue;
		$page = add_submenu_page('uds_theme_admin_general', UDS_TEMPLATE_NAME, $options['menu'], 'manage_options', $options['function'], $options['function']);
		add_action("admin_print_styles-$page", 'admin_enqueue_styles');
		add_action("admin_print_scripts-$page", 'admin_enqueue_scripts');
	}
	
	if((int)get_option('uds-install-version', 0) < 1) {
		$page = add_submenu_page('uds_theme_admin_install', UDS_TEMPLATE_NAME, __('Install', 'uds-textdomain'), 'manage_options', 'uds_theme_admin_install', 'uds_theme_admin_install');
		add_action("admin_print_styles-$page", 'admin_enqueue_styles');
		add_action("admin_print_scripts-$page", 'admin_enqueue_scripts');
	}
	
	// load admin scripts and styles
	add_action("admin_print_styles-$theme_options", 'admin_enqueue_styles');
	add_action("admin_print_scripts-$theme_options", 'admin_enqueue_scripts');
}

/**
 *	UDS Theme Admin Maintenance
 *	Load Maintenance Options
 */
function uds_theme_admin_install()
{
	include 'admin-install.php';
}

/**
 *	UDS Theme Admin
 *	Load General Options
 */
function uds_theme_admin_general()
{
	global $uds_general_options, $current_page;
	$options = $uds_general_options;
	$heading = 'General Options';
	$current_page = 'uds_general_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin
 *	Load Header Options
 */
function uds_theme_admin_header()
{
	global $uds_header_options, $current_page;
	$options = $uds_header_options;
	$heading = 'Header Options';
	$current_page = 'uds_header_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin
 *	Load Header Options
 */
function uds_theme_admin_home_page()
{
	global $uds_home_page_options, $current_page;
	$options = $uds_home_page_options;
	$heading = 'Home Page Options';
	$current_page = 'uds_home_page_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin
 *	Load Header Options
 */
function uds_theme_admin_blog()
{
	global $uds_blog_options, $current_page;
	$options = $uds_blog_options;
	$heading = 'Blog Options';
	$current_page = 'uds_blog_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin
 *	Load Footer Options
 */
function uds_theme_admin_footer()
{
	global $uds_footer_options, $current_page;
	$options = $uds_footer_options;
	$heading = 'Footer Options';
	$current_page = 'uds_footer_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin Social
 *	Load Social Options
 */
function uds_theme_admin_social()
{
	global $uds_social_options, $current_page;
	$options = $uds_social_options;
	$heading = 'Social Networks Options';
	$current_page = 'uds_social_options';
	include 'admin-template.php';
}

/**
 *	UDS Theme Admin Maintenance
 *	Load Maintenance Options
 */
function uds_theme_admin_maintenance()
{
	global $uds_maintenance_options, $current_page;
	$options = $uds_maintenance_options;
	$heading = 'Maintenance Options';
	$current_page = 'uds_maintenance_options';
	include 'admin-template.php';
}

/**
 *	Admin Enqueue Styles
 *
 */
function admin_enqueue_styles()
{
	$dir = get_template_directory_uri()."/admin/";
	wp_enqueue_style('uds-admin', $dir.'css/admin.css', false, false, 'screen');
	wp_enqueue_style('uds-admin-datepicker', $dir.'datepicker/css/datepicker.css', false, false, 'screen');
}

/**
 *	Admin Enqueue Scripts
 *
 */
function admin_enqueue_scripts()
{
	$jsdir = get_template_directory_uri()."/admin/";
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script("jquery-cookie", $jsdir."js/jquery_cookie.js");
	wp_enqueue_script("uds-colorpicker", $jsdir."colorpicker/jscolor.js");
	wp_enqueue_script("uds-datepicker", $jsdir."datepicker/js/datepicker.js");
	wp_enqueue_script("admin", $jsdir."js/admin.js", array('jquery'));	
}

// Installer
/**
 *	UDS Theme Install
 *	Installs the theme. Sets up all options and pages
 */
function uds_theme_install()
{
	global $uds_errors;

	$menus = wp_get_nav_menu_items('main-menu');
	//d($menus); return;

	require_once get_template_directory() . "/admin/importer/importer.php";
	
	$install_version = (int)get_option('uds-install-version', 0);
	if($install_version >= 1) {
		$uds_errors[] = __("Already installed", 'uds-textdomain');
		return false;
	}
	
	$log = '';
	
	if(isset($_POST['delete']) && $_POST['delete'] == 'on') {
		wp_delete_post(1);
		wp_delete_post(2);
		wp_delete_post(3);
		$log .= '<em>' . __('Moved Hello World post to trash', 'uds-textdomain') . '</em><br />' . "\n";
		$log .= '<em>' . __('Moved About page to trash', 'uds-textdomain') . '</em><br />' . "\n";
	}
	
	if(isset($_POST['import']) && $_POST['import'] == 'on') {
		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;
		$user = wp_get_current_user();
		$wp_import->id = $user->ID;
		ob_start();
		$result = $wp_import->import(get_template_directory() . '/admin/install/install.xml');
		$log .= ob_get_clean();
		if(is_wp_error($result)) {
			$uds_errors[] = $result->get_error_message();
			return false;
		}		
	} else {
		$log = '<ol>';
	}
	
	if(isset($_POST['permalinks']) && $_POST['permalinks'] == 'on') {
		// Permalinks
		if(!function_exists('save_mod_rewrite_rules')) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			require_once ABSPATH . '/wp-admin/includes/misc.php';
		}
		update_option('permalink_structure', '/%year%/%monthnum%/%postname%/');
		$log .= '<em>' . __('Setting Permalink Structure', 'uds-textdomain') . '</em><br />' . "\n";
		if(false === save_mod_rewrite_rules()) {
			$uds_errors[] = __("Failed to create .htaccess file", 'uds-textdomain');
		}
		$log .= '<em>' . __('Creating .htaccess file', 'uds-textdomain') . '</em><br />' . "\n";
	}
	
	if(isset($_POST['setup_pages']) && $_POST['setup_pages'] == 'on') {
		update_option('show_on_front', 'page');
		$log .= '<em>' . __('Setting Frontpage Config', 'uds-textdomain') . '</em><br />' . "\n";
		
		$home_id = get_page_id('home');
		$blog_id = get_page_id('blog');
		
		if($home_id > 0 && $blog_id > 0) {	
			update_option('page_on_front', $home_id);
			update_option('page_for_posts', $blog_id);
			$log .= '<em>' . __('Setting Home and Blog Pages', 'uds-textdomain') . '</em><br />' . "\n";
		} else {
			$uds_errors[] = __("Home or Blog page does not exist", 'uds-textdomain');
		}
	}
	
	if(isset($_POST['widgets']) && $_POST['widgets'] == 'on') {
		include_once get_template_directory() . '/functions/functions-exporter.php';
		uds_import_theme_data();
		$log .= '<em>' . __('Setting up widgets, uContact and uPricing', 'uds-textdomain') . '</em><br />' . "\n";
	}
	
	if(isset($_POST['ubillboard']) && $_POST['ubillboard'] == 'on') {
		include_once get_template_directory() . '/uBillboard/billboard.php';
		$errors = uds_billboard_import(get_template_directory() . '/admin/install/uBillboard.txt', false);
		if(!empty($errors)) {
			foreach($errors as $error) {
				$log .= '<em>'.$error.'</em><br />' . "\n";
			}
		} else {
			$log .= '<em>' . __('Setting up uBillboard', 'uds-textdomain') . '</em><br />' . "\n";
		}
	}
	
	$log .= "</ol>";
	
	// mark finished installation
	//add_option('uds-install-version', 1);
	return $log;
}

/**
 *	UDS Render header
 *	Renders header for the admin panel
 */
function uds_admin_render_header()
{
	global $current_user;
	?>
	<div class="uds-admin-header">
		<img src="<?php echo get_template_directory_uri() . '/admin/images/admin-logo.png' ?>" class="uds-admin-logo" alt="" />
		<div class="uds-admin-header-greeting">
			<p><?php printf(__('w p l o c k e r . c o m', 'uds-textdomain'), $current_user->display_name) ?></p>
			<div class="uds-admin-header-notices">
				<?php $updates = uds_check_for_updates(); ?>
				<?php if(!is_wp_error($updates) && (int)$updates > 0): ?>
					<span class="notice-number"><?php echo $updates ?></span> <?php echo _n('update is available on ThemeForest', 'updates are available on ThemeForest', $updates, 'uds-textdomain') ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="uds-admin-header-buttons">
			<a href="http://themeforest.net/user/uDesignStudios" class="buy-more-button"><?php _e("Buy more items", 'uds-textdomain') ?></a>
			<a href="http://twitter.com/#!/udesignstudios" class="follow-button"><?php _e("Follow on Twitter", 'uds-textdomain') ?></a>
		</div>
	</div>
	<?php
}

/**
 *	UDS Render sidebar
 *	Renders sidebar for the admin panel
 */
function uds_admin_render_sidebar()
{
	global $uds_options_pages;
	$pages = '';
	
	foreach($uds_options_pages as $key => $options) {
		$class = $options['function'];
		$class .= $_GET['page'] == $options['function'] ? " active" : '';
		$pages .= "
			<li class='$class'>
				<a href='". admin_url("admin.php?page=" . $options['function']) ."'>{$options['menu']}</a>
			</li>
		";
	}
	
	?>
	<div class="uds-admin-sidebar">
		<ul>
			<?php if((int)get_option('uds-install-version', 0) < 1): ?>
				<li class="uds_theme_admin_install <?php echo $_GET['page'] == 'uds_theme_admin_install' ? " active" : '';?>">
					<a href="<?php echo admin_url("admin.php?page=uds_theme_admin_install")?>"><?php _e("Install", 'uds-textdomain') ?></a>
				</li>
			<?php endif; ?>
			<?php echo $pages ?>
		</ul>
	</div>
	<?php
}

/**
 *	UDS Render Options Form
 *	Creates form from an array structure of options
 *
 *	@param array $options Options to render
 */
function uds_render_options_form($options){
	global $uds_errors, $current_page;
	?>
	<?php if(!empty($uds_errors)): ?>
		<div class="uds-errors">
			<?php foreach($uds_errors as $error): ?>
				<p class="error"><?php echo $error ?></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<form action="options.php" method="post" class="uds-general-form">
		<?php //wp_nonce_field('update-options') ?>
		<?php settings_fields($current_page) ?>
		<table id="uds-general-table">
			<?php $n = 0;?>
			<?php foreach($options as $key => $item): ?>
			<tr class="<?php echo $n%2 == 0 ? 'even' : 'odd' ?>">
				<td>
					<?php uds_render_field($options[$key], $key) ?>
				</td>
			</tr>
			<?php $n++; ?>
			<?php endforeach; ?>
		</table>
wplocker.com
		<!--<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo implode(',', uds_config_keys($options)) ?>" />-->
		<input type="submit" value="<?php esc_attr_e('Update', 'uds-textdomain') ?>" class="submit" />
	</form>
	<?php
}

/**
 *	UDS Config Keys
 *	Recursively reduces the options array structure to a flat key index.
 *	Returns all keys in the options array
 *
 *	@param array $options Options array
 *
 *	@return array All config keys
 */
function uds_config_keys($options) {
	$keys = array_keys($options);
	foreach($options as $option) {
		if(!empty($option['optionals'])){
			$keys = array_merge($keys, array_keys($option['optionals']));
		}
		if(!empty($option['alternates'])){
			foreach($option['alternates'] as $alternate){
				$keys = array_merge($keys, array_keys($alternate));
			}
		}
	}
	return $keys;
}

/**
 *	UDS Render Field
 *	Renders the appropriate field for the option from the Options control structure
 *
 *	@param array $options Options control structure
 *	@param string $key The key in the control structure for which it generates the HTML
 *
 */
function uds_render_field($options, $key){
	static $id = 0;

	switch($options['type']){
		case 'input':
		case 'text':
		case 'string':
			uds_render_text($key, $options, $id);
			break;
		case 'color':
			uds_render_colorpicker($key, $options, $id);
			break;
		case 'textarea':
			uds_render_textarea($key, $options, $id);
			break;
		case 'select':
			uds_render_select($key, $options, $id);
			break;
		case 'checkbox':
		case 'switch':
			uds_render_switch($key, $options, $id);
			break;
		case 'image':
			uds_render_image($key, $options, $id);
			break;
		case 'alternate':
			uds_render_alternate($key, $options, $id);
			break;
		case 'optional':
			uds_render_optional($key, $options, $id);
			break;
		case 'date':
			uds_render_date($key, $options, $id);
			break;
		case 'time':
			uds_render_time($key, $options, $id);
			break;
		default:
	}
	
	$id++;
}

/**
 *	UDS Render Text
 *	Renders text field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_text($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : $options['default'];
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="text" name="'. $name .'" value="' . $value . '" id="general-'. $key .'-'. $unique_id .'" class="input-text general-'. $key .'" />';
	echo '</div>';
	echo '<div class="clear"></div>';
}

/**
 *	UDS Render Colorpicker
 *	Renders text field with Colorpicker
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_colorpicker($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;

	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : $options['default'];

	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<span class="colorpicker">';
	echo '#<input type="text" name="'. $name .'" value="' . $value . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .' color" />';
	echo '</span>';
	echo '</div>';
}


/**
 *	UDS Render Textarea
 *	Renders textarea
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_textarea($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : $options['default'];
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<textarea name="'. $name .'" class="general-'. $key .'">'. $value .'</textarea>';
	echo '</div>';
}

/**
 *	UDS Render Select
 *	Renders select field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_select($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	if($options['type'] != 'select') return;

	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$selected_value = isset($field[$key]) ? $field[$key] : $options['default'];

	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<div class="dropdown">';
	echo '<select name="'. $name .'" class="general-'. $key .'">';
	if(is_array($options['options'])){
		foreach($options['options'] as $option => $value){
			$selected = '';
			if($selected_value == $option){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $option .'" '. $selected .'>'. $value .'</option>';
		}
	}
	echo '</select>';
	echo '</div>';
	echo '</div>';
}

/**
 *	UDS Render Alternate
 *	Renders alternate HTML gizmo that lets you pick one of multiple alternatives
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_alternate($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	if($options['type'] != 'alternate') return;

	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$selected_value = isset($field[$key]) ? $field[$key] : $options['default'];

	echo '<div class="'. $key .'-wrapper alternate-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<div class="dropdown">';
	echo '<select name="'. $name .'" class="general-'. $key .'">';
	if(is_array($options['options'])){
		foreach($options['options'] as $option => $value){
			$selected = '';
			if($selected_value == $option){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $option .'" '. $selected .'>'. $value .'</option>';
		}
	}
	echo '</select>';
	echo '</div>';
	echo '<div class="clear"></div>';
	
	if(is_array($options['alternates'])){
		echo '<div class="alternates">';
		foreach($options['alternates'] as $key => $alternate){
			echo '<div class="'.$key.'-container">';
			foreach($alternate as $key => $alt_options){
				uds_render_field($alt_options, $key);
			}
			echo '</div>';
		}
		echo "</div>";
	}
	echo '</div>';
}

/**
 *	UDS Render Switch
 *	Renders Checkbox
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_switch($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';

	$value = isset($field[$key]) ? $field[$key] : '';
	
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<span class="switch">';
	echo '<input type="checkbox" name="'. $name .'" ' . checked('on', $value, false) . ' id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	echo '</span>';
	echo '</div>';
}

/**
 *	UDS Render Optional
 *	Renders optional field, you need to check a checkbox to show the optional field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_optional($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;

	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : '';

	echo '<div class="'. $key .'-wrapper optional-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<span class="switch control">';
	echo '<input type="checkbox" name="'. $name .'" ' . checked('on', $value, false) . '" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key .'" />';
	echo '</span>';
	echo '<div class="clear"></div>';
	
	if(is_array($options['optionals'])){
		echo '<div class="optionals">';
		foreach($options['optionals'] as $key => $optional){
			uds_render_field($optional, $key);
		}
		echo "</div>";
	}
	echo '</div>';
}

/**
 *	UDS Render Image
 *	Renders image picker field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_image($key, $options, $unique_id, $value = '')
{
	global $current_page;
	
	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$image = isset($field[$key]) ? $field[$key] : $options['default'];
		
	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="text" name="'. $name .'" value="'. $image .'" id="general-'. $key .'-'. $unique_id .'-hidden" class="input-text" />';
	echo '<div class="clear margin-bottom-10"></div>';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'.__('Preview', 'uds-textdomain').' <span class="hint">('.__('Click to open Media Library', 'uds-textdomain').'):</span></label>';
	echo '<div class="uds-image-upload">';
		echo '<a class="thickbox" title="Add an Image" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">';
		echo '<img alt="Add an Image" src="'. $image .'" id="general-'. $key .'-'. $unique_id .'" class="general-'. $key  .'" />';
		echo '</a><br />';
		echo '</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}


/**
 *	UDS Render Date
 *	Renders date field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_date($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	if($options['type'] != 'date') return;
	
	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : $options['default'];
	
	if(empty($value)) {
		$value = date('Y-m-d');
	}

	echo '<div class="'. $key .'-wrapper">';
	echo '<label for="general-'. $key .'-'. $unique_id .'">'. $options['label'] .'</label>';
	echo '<input type="text" name="'.$name.'" value="'.$value.'" class="date" />';
	echo '<div class="clear"></div>';
	echo '</div>';
}

/**
 *	UDS Render Date
 *	Renders date field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_time($key, $options, $unique_id, $value = '')
{
	global $uds_general_options, $current_page;
	
	if($options['type'] != 'time') return;

	$field = get_option($current_page);
	
	$name = $current_page.'['.$key.']';
	$value = isset($field[$key]) ? $field[$key] : $options['default'];

	echo '<div class="'. $key .'-wrapper time">';
	echo '<label for="general-'. $key .'-'. $unique_id .'" class="time-label">'. $options['label'] .'</label>';
	echo '<input type="hidden" name="'.$name.'" value="'.$value.'" class="time" />';
	
	echo '<select class="hour">';
	for($i = 0; $i < 24; $i++){
		$selected = '';
		if($i == (int)substr($value, 0, 2)) {
			$selected = "selected='selected'";
		}
		echo '<option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'" '. $selected .'>'. str_pad($i, 2, '0', STR_PAD_LEFT) .'</option>';
	}
	echo '</select>:';
	echo '<select class="minute">';
	for($i = 0; $i < 60; $i++){
		$selected = '';
		if($i == (int)substr($value, 3, 2)) {
			$selected = "selected='selected'";
		}
		echo '<option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'" '. $selected .'>'. str_pad($i, 2, '0', STR_PAD_LEFT) .'</option>';
	}
	echo '</select>';	

	echo '</div>';
}

/**
 *	UDS Render JS Support
 *	Renders supportive JS for the image field
 *
 *	@param string $key Key name in the Control structure
 *	@param array $options Control structure
 *	@param int $unique_id Unique ID within the current form (used for labels and stuff)
 *	@param string $value Deprecated
 */
function uds_render_js_support()
{
	global $uds_general_options;
	$selectors = array();
	foreach($uds_general_options as $attrib => $options){
		if($options['type'] == 'image'){
			$selectors[] = '.general-'.$attrib;
		}
		if(isset($options['alternates']) && is_array($options['alternates'])){
			foreach($options['alternates'] as $alternates){
				foreach($alternates as $key => $alternate){
					if($alternate['type'] == 'image'){
						$selectors[] = '.general-'.$key;
					}
				}
			}
		}
		if(isset($options['optionals']) && is_array($options['optionals'])){
			foreach($options['optionals'] as $key => $optional){
				if($optional['type'] == 'image'){
					$selectors[] = '.general-'.$key;
				}
			}
		}
	}
	?>
	<script language='JavaScript' type='text/javascript'>
	var set_receiver = function(rec){
		//console.log(rec);
		window.receiver = jQuery(rec).attr('id');
		window.receiver_hidden = jQuery(rec).attr('id')+'-hidden';
	}
	var send_to_editor = function(img){
		tb_remove();
		if(jQuery(jQuery(img)).is('a')){ // work around Link URL supplied
		   var src = jQuery(jQuery(img)).find('img').attr('src');
		} else {
		   var src = jQuery(jQuery(img)).attr('src');
		}
	 
		//console.log(window.receiver);
		//console.log(src);
		jQuery('#'+window.receiver).attr('src', src);
		jQuery("#"+window.receiver_hidden).val(src);
	}
	jQuery('<?php echo implode(',', $selectors); ?>').click(function(){
		set_receiver(this);
	});
	</script>
	<?php
}	


// page tagline

add_action( 'do_meta_boxes', 'uds_add_page_tagline_meta_box', 0, 2 );
/**
 *	UDS Add Page Tagline Meta Box
 *	Adds meta box for the tagline
 *
 *	@param string $page Post type to render on
 *	@param context $context Position of the meta box
 */
function uds_add_page_tagline_meta_box( $page, $context ) {
	if ( ( 'page' === $page || 'post' === $page || 'uds-portfolio' == $page ) && 'advanced' === $context )
		add_meta_box( 'uds-page-tagline', 'Page Tagline', 'uds_page_tagline_meta_box', $page, 'normal', 'high' );
	if ( ( 'page' === $page || 'uds-portfolio' == $page ) && 'side' === $context )
		add_meta_box( 'uds-page-sidebar', 'Custom Sidebar', 'uds_page_sidebar_meta_box', $page, 'side', 'low' );
}

/**
 *	UDS Page Tagline Meta Box
 *	Renders tagline metabox
 *
 */
function uds_page_tagline_meta_box() {
	global $post;
	echo '<p>';
	wp_nonce_field( 'uds_tagline_nonce', 'uds_tagline_nonce', false, true );
	echo '</p>';
	$tagline = get_post_meta( $post->ID, 'uds-page-tagline', true);
	$type = get_post_meta( $post->ID, 'uds-page-tagline-type', true);
	if($type == '') $type = 'default';
?>
	<p>
		<?php _e('Tagline Type', 'uds-textdomain') ?>: 
		<select name="uds-page-tagline-type">
			<option value="off" <?php echo $type == 'off' ? "selected='selected'" : '' ?>><?php _e('No tagline', 'uds-textdomain') ?></option>
			<option value="default" <?php echo $type == 'default' ? "selected='selected'" : '' ?>><?php _e('Default tagline', 'uds-textdomain') ?></option>
			<option value="custom" <?php echo $type == 'custom' ? "selected='selected'" : '' ?>><?php _e('Custom tagline', 'uds-textdomain') ?></option>
		</select>
	</p>
	<p><?php _e('Custom Tagline', 'uds-textdomain') ?>: <input name="uds-page-tagline" type="text" style="width:200px" id="uds-page-tagline" value="<?php echo esc_attr( $tagline , 'uds-textdomain'); ?>" /></p>
<?php
}

/**
 *	UDS Page Sidebar Meta Box
 *	Renders Sidebar options for variable sidebars metabox
 *
 */
function uds_page_sidebar_meta_box() {
	global $post;
	echo '<p>';
	wp_nonce_field( 'uds_sidebar_nonce', 'uds_sidebar_nonce', false, true );
	echo '</p>';
	$sidebar = get_post_meta( $post->ID, 'uds-page-sidebar', true);
	$sidebars = maybe_unserialize(get_option('uds-page-sidebars', array()));
?>
	<p><?php _e('Name', 'uds-textdomain') ?>:<input name="uds-page-sidebar" type="text" style="width:200px" id="uds-page-sidebar-new" value="<?php echo $sidebar?>" /></p>
	<p><?php _e('If you fill this field, a new widget area will be created in Appearance &gt; Widgets. Widgets you add to this area will appear only on this page.', 'uds-textdomain') ?></p>
<?php
}

add_action( 'save_post', 'uds_page_save_meta_box');
/**
 *	UDS Render Colorpicker
 *	Renders text field with Colorpicker
 *
 *	@param int $post_ID that we'll be updating
 *
 *	@return int Edited Post ID
 */
function uds_page_save_meta_box( $post_ID ) {
	if (isset($_REQUEST['uds_tagline_nonce']) && wp_verify_nonce( $_REQUEST['uds_tagline_nonce'], 'uds_tagline_nonce' ) ) {
		if ( isset( $_POST['uds-page-tagline-type'] ) ) {
			update_post_meta( $post_ID, 'uds-page-tagline-type', $_REQUEST['uds-page-tagline-type'] );
			update_post_meta( $post_ID, 'uds-page-tagline', $_REQUEST['uds-page-tagline'] );
		} else {
			delete_post_meta( $post_ID, 'uds-page-tagline-type' );
			delete_post_meta( $post_ID, 'uds-page-tagline');
		}
	}
	
	if (isset($_REQUEST['uds_sidebar_nonce']) && wp_verify_nonce( $_REQUEST['uds_sidebar_nonce'], 'uds_sidebar_nonce' ) ) {
		$sidebar = isset($_REQUEST['uds-page-sidebar']) ? $_REQUEST['uds-page-sidebar'] : '';
		
		if(!empty($sidebar)) {
			$sidebars = maybe_unserialize(get_option('uds-page-sidebars'));
			$sidebars[] = $sidebar;
			$sidebars = array_unique($sidebars);
			update_option('uds-page-sidebars', serialize($sidebars));
			update_post_meta($post_ID, 'uds-page-sidebar', $sidebar);
		} else {
			delete_post_meta($post_ID, 'uds-page-sidebar');
		}
	}
	return $post_ID;
}

/**
 *	UDS Sanitize Page Sidebars
 *	Will check which of the registered sidebars are still in use on pages
 *	and update the WP option accordingly
 */
function uds_sanitize_page_sidebars()
{
	global $wpdb;
	$sidebars_in_use = $wpdb->get_col("SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'uds-page-sidebar'");
	$sidebars = maybe_unserialize(get_option('uds-page-sidebars', array()));

	foreach($sidebars as $key => $sidebar) {
		if(!in_array($sidebar, $sidebars_in_use)) unset($sidebars[$key]);
	}
	
	update_option('uds-page-sidebars', serialize($sidebars));
}

/**
 *	Check for updates
 *	Will check update URL, parse the updates.json file and then return update count
 *	
 *	@return mixed Returns false or 0 when no updates are found, int update count when
 *		updates are found and WP_Error on error
 */
function uds_check_for_updates()
{
	$transient = get_transient('uds-theme-updates');
	if(false !== $transient) {
		return $transient;
	}
	
	//$updates_json = @file_get_contents(get_template_directory() . "/updates.json");
	$updates_json = @file_get_contents(UDS_UPDATE_URL);
	if(empty($updates_json)) {
		return new WP_Error("uds_update_failed", __("Update File is not available", 'uds-textdomain'));
	}
	
	$updates = json_decode($updates_json);
	if($updates == null || !is_array($updates->updates)) {
		return new WP_Error("uds_update_failed", __("Update File is corrupt", 'uds-textdomain'));
	}
	
	$updates = $updates->updates;
	if(empty($updates)) {
		return false;
	}
	
	$update_count = 0;
	foreach($updates as $update) {
		if($update->ready === true && version_compare($update->version, UDS_TEMPLATE_VERSION, '>')){
			$update_count++;
		}
	}
	
	set_transient('uds-theme-updates', $update_count, 3 * 24 * 3600);
	
	return $update_count;
}

?>