<?php
/*
Plugin Name: uBillboard
Plugin URI: http://code.udesignstudios.net/plugins/uBillboard
Description: uBillboard is a slider plugin by uDesignStudios that allows you to create an eye-catching presentation for your web. (Admin menu icon: http://p.yusukekamiyamane.com/)
Version: 2.1.4
Author: uDesign
Author URI: http://udesignstudios.net
Tags: billboard, slider, jquery, javascript, effects, udesign
*/

// General Options
define('UDS_BILLBOARD_VERSION', '2.1.4');
define('UDS_BILLBOARD_USE_COMPRESSION', true);
define('UDS_BILLBOARD_USE_RELATIVE_PATH', true);

// WARNING!!!
// set this to true only if you are calling uBillboard via shortcodes only!!!
define('UDS_BILLBOARD_ENABLE_SHORTCODE_OPTIMIZATION', true); 

if(uds_billboard_is_plugin()) {
	define('UDS_BILLBOARD_URL', plugin_dir_url(__FILE__));
	define('UDS_BILLBOARD_PATH', plugin_dir_path(__FILE__));
} else {
	define('UDS_BILLBOARD_URL', trailingslashit(get_template_directory_uri() . '/uBillboard'));
	define('UDS_BILLBOARD_PATH', trailingslashit(get_template_directory() . '/uBillboard'));
}

// User configurable options
define('UDS_BILLBOARD_OPTION', 'uds-billboard');

add_option(UDS_BILLBOARD_OPTION, array());

// define general options for billboard
$uds_billboard_general_options = array(
	'name' => array(
		'type' => 'text',
		'label' => __('Billboard Name', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('Enter a name for this Billboard. You will use this name to create the Billboard on your site.', 'uds-textdomain'),
		'default' => 'billboard'
	),
	'width' => array(
		'type' => 'text',
		'label' => __('Billboard Width', 'uds-textdomain'),
		'unit' => 'pixels',
		'tooltip' => __('Billboard Width in pixels', 'uds-textdomain'),
		'default' => 960
	),
	'height' => array(
		'type' => 'text',
		'label' => __('Billboard Height', 'uds-textdomain'),
		'unit' => 'pixels',
		'tooltip' => __('Billboard Height in pixels', 'uds-textdomain'),
		'default' => 420
	),
	'square-size' => array(
		'type' => 'text',
		'label' => __('Square Size', 'uds-textdomain'),
		'unit' => 'pixels',
		'tooltip' => __('Square dimension, applies only to transitions based on squares', 'uds-textdomain') .' <img src="'.UDS_BILLBOARD_URL .'images/square_size.png" alt="" />',
		'default' => 100
	),
	'column-width' => array(
		'type' => 'text',
		'label' => __('Column Width', 'uds-textdomain'),
		'unit' => 'pixels',
		'tooltip' => __('Column width, applies only to column-based transitions', 'uds-textdomain') . ' <img src="'.UDS_BILLBOARD_URL .'images/column_width.png" alt="" />',
		'default' => 50
	),
	'show-paginator' => array(
		'type' => 'checkbox',
		'label' => __('Show Paginator', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('Check to show paginator in the bottom right corner', 'uds-textdomain') . ' <img src="'.UDS_BILLBOARD_URL .'images/paginator.png" alt="" />',
		'default' => 'on'
	),
	'show-controls' => array(
		'type' => 'checkbox',
		'label' => __('Show Controls', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('Check to show playback controls in the bottom left corner', 'uds-textdomain') . ' <img src="'.UDS_BILLBOARD_URL .'images/show_controls.png" alt="" />',
		'default' => ''
	),
	'show-pause' => array(
		'type' => 'checkbox',
		'label' => __('Show Play/Pause button', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('Unchecked will pause on hover, otherwise will show Play/Pause button', 'uds-textdomain') . ' <img src="'.UDS_BILLBOARD_URL .'images/show-playpause.png" alt="" />',
		'default' => ''
	),
	'autoplay' => array(
		'type' => 'checkbox',
		'label' => __('Autoplay', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('Automatically start playing slides, makes sense to turn this off only if Show Controls is enabled.', 'uds-textdomain'),
		'default' => 'on'
	),
	'use-timthumb' => array(
		'type' => 'checkbox',
		'label' => __('Use Automatic Image Resizing', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('When checked, all your images will be resized and zoomed/stretched to fit the Billboard size', 'uds-textdomain'),
		'default' => ''
	),
	'timthumb-zoom' => array(
		'type' => 'checkbox',
		'label' => __('Zoom Disproportionate Images', 'uds-textdomain'),
		'unit' => '',
		'tooltip' => __('When checked will crop images that don\'t have the same proportions as Billboard. Otherwise will stretch images to fit the Billboard', 'uds-textdomain'),
		'default' => ''
	),
	'timthumb-quality' => array(
		'type' => 'text',
		'label' => __('Image Quality', 'uds-textdomain'),
		'unit' => 'pixels',
		'tooltip' => __('Image compression - use lower values for faster page loads and lower traffic, use high values to increase image quality. Optimal values are 60-80', 'uds-textdomain'),
		'default' => 80
	)
);

// define data structure for billboard
$uds_billboard_attributes = array(
	'image'=> array(
		'type' => 'image',
		'label' => __('Image', 'uds-textdomain')
	),
	'title' => array(
		'type' => 'text',
		'label' => __('Title', 'uds-textdomain')
	),
	'link' => array(
		'type' => 'text',
		'label' => __('Link URL', 'uds-textdomain')
	),
	'text' => array(
		'type' => 'textarea',
		'label' => __('Text', 'uds-textdomain')
	),
	'delay' => array(
		'type' => 'select',
		'label' => __('Delay', 'uds-textdomain'),
		'options' => array(
			'1000' => '1s',
			'2000' => '2s',
			'3000' => '3s',
			'4000' => '4s',
			'5000' => '5s',
			'10000' => '10s',
		),
		'default' => '5000'
	),
	'layout' => array(
		'type' => 'select',
		'label' => __('Slide Layout', 'uds-textdomain'),
		'options' => array(
			'none' => __('No Description', 'uds-textdomain'),
			'stripe-left' => __('Stripe Left', 'uds-textdomain'),
			'stripe-right' => __('Stripe Right', 'uds-textdomain'),
			'stripe-bottom' => __('Stripe Bottom', 'uds-textdomain'),
			'stripe-left alt' => __('Alternate Stripe Left', 'uds-textdomain'),
			'stripe-right alt' => __('Alternate Stripe Right', 'uds-textdomain'),
			'stripe-bottom alt' => __('Alternate Stripe Bottom', 'uds-textdomain'),
		),
		'default' => 'none'
	),
	'transition' => array(
		'type' => 'select',
		'label' => __('Transition', 'uds-textdomain'),
		'options' => array(
			'random' => __('Random', 'uds-textdomain'),
			'fade' => __('Fade', 'uds-textdomain'),
			'slideLeft' => __('Slide from Left', 'uds-textdomain'),
			'slideTop' => __('Slide from Top', 'uds-textdomain'),
			'slideRight' => __('Slide from Right', 'uds-textdomain'),
			'slideBottom' => __('Slide from Bottom', 'uds-textdomain'),
			'scaleTop' => __('Scale from Top', 'uds-textdomain'),
			'scaleCenter' => __('Scale from Center', 'uds-textdomain'),
			'scaleBottom' => __('Scale from Bottom', 'uds-textdomain'),
			'scaleRight' => __('Scale from Right', 'uds-textdomain'),
			'scaleLeft' => __('Scale from Left', 'uds-textdomain'),
			'squaresRandom' => __('Squares Random', 'uds-textdomain'),
			'squaresRows' => __('Squares by Rows', 'uds-textdomain'),
			'squaresCols' => __('Squares by Columns', 'uds-textdomain'),
			'squaresMoveIn' => __('Squares Fly in', 'uds-textdomain'),
			'squaresMoveOut' => __('Squares Fly out', 'uds-textdomain'),
			'columnsRandom' => __('Columns Random', 'uds-textdomain'),
			'columnWave' => __('Column Wave', 'uds-textdomain'),
			'curtainRight' => __('Curtain Right', 'uds-textdomain'),
			'curtainLeft' => __('Curtain Left', 'uds-textdomain'),
			'curtainRotateRight' => __('Curtain Rotate Right', 'uds-textdomain'),
			'curtainRotateLeft' => __('Curtain Rotate Left', 'uds-textdomain'),
			'interweaveLeft' => __('Interweave Left', 'uds-textdomain'),
			'interweaveRight' => __('Interweave Right', 'uds-textdomain')
		),
		'default' => 'fade'
	)
);

global $uds_billboard_errors;

if(!function_exists('d')) {
	function d($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}
}

// returns true if used as a standalone plugin, false when it's used as part of a theme
function uds_billboard_is_plugin()
{
	$plugins = get_option('active_plugins');
	return in_array('uBillboard/billboard.php', $plugins);
}

function uds_billboard_cache_is_writable()
{
	if(uds_billboard_is_plugin()) {
		return is_writable(UDS_BILLBOARD_PATH . 'cache');
	} else {
		return is_writable(get_template_directory() . '/cache');
	}
}

function uds_billboard_is_active()
{
	if(true == UDS_BILLBOARD_ENABLE_SHORTCODE_OPTIMIZATION) {
		if(function_exists('uds_active_shortcodes')) {
			$active_shortcodes = uds_active_shortcodes();
			if( ! in_array('uds-billboard', $active_shortcodes)) {
				return false;
			}
		}
	}
	
	return true;
}

// initialize billboard
add_action('init', 'uds_billboard_init');
function uds_billboard_init()
{
	global $uds_billboard_general_options, $uds_billboard_attributes;
	// Fix older uBillboards
	$billboards = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION));
	if(! empty($billboards[0])) {
		$new_billboards = array();
		foreach($uds_billboard_general_options as $key => $option) {
			$new_billboards['billboard'][$key] = $option['default'];
		}
		$new_billboards['billboard']['slides'] = $billboards;
		$billboards = $new_billboards;
		update_option(UDS_BILLBOARD_OPTION, serialize($billboards));
	}

	$billboard = current($billboards);
	if(!empty($billboard['slides'][0]) && !is_array($billboard['slides'][0])) {
		foreach($billboards as $bbkey => $billboard) {
			foreach($billboard['slides'] as $slidekey => $slide) {
				if(!is_array($slide)) {
					$slide_original = $slide;
					unset($billboards[$bbkey]['slides'][$slidekey]);
					$billboards[$bbkey]['slides'][$slidekey] = array();
					foreach($uds_billboard_attributes as $attrib => $options) {
						$billboards[$bbkey]['slides'][$slidekey][$attrib] = $slide_original->$attrib;
					}
				}
			}
		}

		update_option(UDS_BILLBOARD_OPTION, serialize($billboards));
	}
	
	// Basic init
	$dir = UDS_BILLBOARD_URL;
	if(is_admin()){
		add_thickbox();
		
		// process updates
		if(!empty($_POST['uds-billboard-nonce']) && !wp_verify_nonce($_POST['uds-billboard-nonce'], 'uds-billboard')){
			die(__('Security check failed', 'uds-textdomain'));
		} else {
			uds_billboard_proces_updates();
		}
		
		// process imports/exports
		if(isset($_GET['page']) && $_GET['page'] == 'uds_billboard_import_export') {
			if(isset($_GET['download_export']) && wp_verify_nonce($_GET['download_export'], 'uds-billboard-export')) {
				uds_billboard_export();
			}
			if(is_uploaded_file($_FILES['uds-billboard-import']['tmp_name'])) {
				uds_billboard_import($_FILES['uds-billboard-import']['tmp_name']);
			}
		}
	}
}

add_action('wp_print_scripts', 'uds_billboard_scripts');
function uds_billboard_scripts()
{
	global $wp_version;
	if(!uds_billboard_is_active() && !is_front_page()) return;
	
	$dir = UDS_BILLBOARD_URL;
	
	// We need to override jQuery on WP < 3.0 because the default there is jQuery 1.3 and we need 1.4
	if(version_compare($wp_version, '3.0.0', '<=')){
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
	}
	
	//wp_enqueue_script("easing", $dir."js/jquery.easing.js", array('jquery'));
	if(UDS_BILLBOARD_USE_COMPRESSION){
		wp_enqueue_script("uds-billboard", $dir."js/billboard.min.js", array('jquery'));
	} else {
		wp_enqueue_script("uds-billboard", $dir."js/billboard.js", array('jquery'));
	}
}

add_action('wp_print_styles', 'uds_billboard_styles');
function uds_billboard_styles()
{
	if(!uds_billboard_is_active() && !is_front_page()) return;
	
	$dir = UDS_BILLBOARD_URL;
	wp_enqueue_style('uds-billboard', $dir.'css/billboard.css', false, false, 'screen');
}

////////////////////////////////////////////////////////////////////////////////
//
//	Plugin update
//
////////////////////////////////////////////////////////////////////////////////

//add_filter('plugins_api_result', 'uds_billboard_updater');
//function uds_billboard_updater($res, $action, $args)
//{
//	d($res);
//	d($action);
//	d($args);
//}

////////////////////////////////////////////////////////////////////////////////
//
//	Activation hooks
//
////////////////////////////////////////////////////////////////////////////////

if(uds_billboard_is_plugin()) {
	register_activation_hook(__FILE__, 'uds_billboard_activation_hook');
	register_activation_hook(__FILE__, 'uds_billboard_deactivation_hook');
}

function uds_billboard_activation_hook()
{
	add_option(UDS_BILLBOARD_OPTION, array());
}

function uds_billboard_deactivation_hook()
{
	//delete_option(UDS_BILLBOARD_OPTION);
}

////////////////////////////////////////////////////////////////////////////////
//
//	Admin menus
//
////////////////////////////////////////////////////////////////////////////////

add_action('admin_menu', 'uds_billboard_menu');
function uds_billboard_menu()
{
	global $menu;
	$position = 101;
	if(!empty($menu[$position])) $position = null;
	
	$icon = UDS_BILLBOARD_URL . 'images/menu-icon.png';
	$ubillboard = add_menu_page(__("uBillboard", 'uds-textdomain'), __("uBillboard", 'uds-textdomain'), 'manage_options', 'uds_billboard_admin', 'uds_billboard_admin', $icon, $position);
	$ubillboard_add = add_submenu_page('uds_billboard_admin', __("Add Billboard", 'uds-textdomain'), __('Add Billboard', 'uds-textdomain'), 'manage_options', 'uds_billboard_add', 'uds_billboard_add');
	$ubillboard_importexport = add_submenu_page('uds_billboard_admin', __("Import/Export", 'uds-textdomain'), __('Import/Export', 'uds-textdomain'), 'manage_options', 'uds_billboard_import_export', 'uds_billboard_import_export');
	
	add_action("admin_print_styles-$ubillboard", 'uds_billboard_enqueue_admin_styles');
	add_action("admin_print_styles-$ubillboard_add", 'uds_billboard_enqueue_admin_styles');
	add_action("admin_print_styles-$ubillboard_importexport", 'uds_billboard_enqueue_admin_styles');
	
	add_action("admin_print_scripts-$ubillboard", 'uds_billboard_enqueue_admin_scripts');
	add_action("admin_print_scripts-$ubillboard_add", 'uds_billboard_enqueue_admin_scripts');
	add_action("admin_print_scripts-$ubillboard_importexport", 'uds_billboard_enqueue_admin_scripts');
}

// Admin menu entry handling
function uds_billboard_admin()
{
	include 'billboard-admin.php';
}

// Admin menu entry handling
function uds_billboard_add()
{
	include 'billboard-add.php';
}

// Admin menu entry handling
function uds_billboard_import_export()
{
	global $uds_billboard_errors;
	include 'billboard-import-export.php';
}

function uds_billboard_enqueue_admin_styles()
{
	$dir = UDS_BILLBOARD_URL;
	wp_enqueue_style('uds-billboard', $dir.'css/billboard-admin.css', false, false, 'screen');
}

function uds_billboard_enqueue_admin_scripts()
{
	$dir = UDS_BILLBOARD_URL;
	wp_enqueue_script("jquery-ui-sortable");
	wp_enqueue_script("jquery-ui-draggable");
	wp_enqueue_script('uds-cookie', $dir."js/jquery_cookie.js");
	wp_enqueue_script('uds-billboard', $dir."js/billboard-admin.js");
}

////////////////////////////////////////////////////////////////////////////////
//
//	Importer and Exporter
//
////////////////////////////////////////////////////////////////////////////////

function uds_billboard_import($file, $redirect = true)
{
	global $uds_billboard_errors, $uds_billboard_attributes;
	$import = @file_get_contents($file);
	
	$uds_billboards_errors = array();
	
	if(empty($import)) {
		$uds_billboard_errors[] = __('Import file is empty', 'uds-textdomain');
		return;
	}
	
	$import = maybe_unserialize($import);
	
	if(empty($import['data'])) {
		$uds_billboard_errors[] = __('Import file is corrupted', 'uds-textdomain');
		return;
	}
	
	$billboards = $import['data'];
	
	if(isset($_POST['import-attachments']) && $_POST['import-attachments'] == 'on') {
		foreach($billboards as $bbname => $billboard) {
			foreach($billboard['slides'] as $key => $slide) {
				$urlinfo = parse_url($slide['image']);
				$localurl = parse_url(get_option('siteurl'));
				//if($urlinfo['hostname'] == $localurl['hostname']) continue;
				
				//echo "Downloading attachment";
				$image = @file_get_contents($slide['image']);
				if(!empty($image)) {
					$uploads = wp_upload_dir();
					if(false === $uploads['error']) {
						$filename = pathinfo($urlinfo['path']);
						$path = trailingslashit($uploads['path']) . wp_unique_filename($uploads['path'], $filename['basename']);
						if(! (false === @file_put_contents($path, $image)) ) {
							$filename = pathinfo($path);
							$billboards[$bbname]['slides'][$key]['image'] = $uploads['url'] . '/' . $filename['basename'];
							
							$wp_filetype = wp_check_filetype(basename($path), null );
							$attachment = array(
								'post_mime_type' => $wp_filetype['type'],
								'post_title' => preg_replace('/\.[^.]+$/', '', basename($path)),
								'post_content' => '',
								'post_status' => 'inherit'
							);
							$attach_id = wp_insert_attachment( $attachment, $path );
							// you must first include the image.php file
							// for the function wp_generate_attachment_metadata() to work
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attach_data = wp_generate_attachment_metadata( $attach_id, $path );
							wp_update_attachment_metadata( $attach_id,  $attach_data );
							//echo "Attachment saved in ".$billboards[$bbname]['slides'][$key]->image;
						} else {
							$uds_billboard_errors[] = sprintf(__("Failed to save image to %s", 'uds-textdomain'), $path);
							break;
						}
					} else {
						$uds_billboard_errors[] = __("Uploads dir is not writable", 'uds-textdomain');
						break;
					}
				} else {
					$uds_billboard_errors[] = __("Failed to download image", 'uds-textdomain');
					break;
				}
			}
			
			if(!empty($uds_billboards_errors)) break;
		}
	}
	
	update_option(UDS_BILLBOARD_OPTION, $billboards);
	
	if($redirect && empty($uds_billboards_errors))
		wp_redirect('admin.php?page=uds_billboard_admin');
	
	return $uds_billboards_errors;
}

function uds_billboard_export()
{
	$export = array();
	$export['version'] = UDS_BILLBOARD_VERSION;
	$export['data'] = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION, array()));
	
	$export = serialize($export);
	
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="uBillboard.txt"');
	die($export);
}

////////////////////////////////////////////////////////////////////////////////
//
//	Slide Add/Update logic
//
////////////////////////////////////////////////////////////////////////////////

// check for POST data and update billboard accordingly
function uds_billboard_proces_updates()
{
	global $uds_billboard_attributes, $uds_billboard_general_options;

	$post = isset($_POST['uds_billboard']) ? $_POST['uds_billboard'] : array();
	//d($post);
	if(empty($post)) return;
	
	if(!is_admin()) return;
	
	// update billboard array
	$slides = array();
	foreach($uds_billboard_attributes as $attrib => $options){
		foreach($post[$attrib] as $key => $item){
			if(!isset($slides[$key]) || $slides[$key] == null){
				$slide = uds_billboard_default_billboard();
			} else {
				$slide = $slides[$key];
			}
			
			$slide[$attrib] = $item;
			$slides[$key] = $slide;
		}
	}
	
	// delete empty billboards
	$bb_default = uds_billboard_default_billboard();
	foreach($slides as $key => $bb){
		$delete = true;
		foreach($uds_billboard_attributes as $attrib => $options){
			if($bb[$attrib] != $bb_default[$attrib]){
				$delete = false;
			}
		}
		
		if($delete){
			unset($slides[$key]);
		}
	}
	
	// update general options
	$billboard = array();
	$billboard['slides'] = $slides;
	foreach($uds_billboard_general_options as $key => $option) {
		$billboard[$key] = empty($_POST['uds-billboard-'.$key]) ? '' : $_POST['uds-billboard-'.$key];
	}
	
	// process name changes and save by name
	$billboard_saved = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION, array()));
	$name_orig = $_POST['original_name'];
	$name = $_name = $_POST['uds-billboard-name'];
	if($name_orig != $name) {
		$n = 1;
		while(isset($billboard_saved[$name])) {
			$name = $_name . '-' . $n;
			$n++;
		}
		unset($billboard_saved[$name_orig]);
	}
	
	$billboard_saved[$name] = $billboard;
	
	//d($billboard_saved);
	
	update_option(UDS_BILLBOARD_OPTION, serialize($billboard_saved));
	//delete_option(UDS_BILLBOARD_OPTION);
	
	if($name_orig == '' || $name_orig != $name) {
		wp_redirect('admin.php?page=uds_billboard_add&uds-billboard-edit='.$name);
	}
}

// Initialize empty billboard instance
function uds_billboard_default_billboard()
{
	global $uds_billboard_attributes;

	$attribs = $uds_billboard_attributes;

	$bb = array();
	foreach($attribs as $att => $options){
		if(isset($options['default'])){
			$bb[$att] = $options['default'];
		} else {
			$bb[$att] = '';
		}
	}
	return $bb;
}

////////////////////////////////////////////////////////////////////////////////
//
//	Functions to render billboard admin form based on the data structure
//
////////////////////////////////////////////////////////////////////////////////

// Render a single input field
function uds_billboard_render_field($item, $attrib, $unique_key)
{
	global $uds_billboard_attributes;

	$attrib_full = $uds_billboard_attributes[$attrib];
	switch($attrib_full['type']){
		case 'input':
		case 'text':
			uds_billboard_render_text($item, $attrib, $unique_key);
			break;
		case 'textarea':
			uds_billboard_render_textarea($item, $attrib, $unique_key);
			break;
		case 'select':
			uds_billboard_render_select($item, $attrib, $unique_key);
			break;
		case 'image':
			uds_billboard_render_image($item, $attrib, $unique_key);
			break;
		default:
	}
}

// Render text field
function uds_billboard_render_text($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<input type="text" name="uds_billboard['. $attrib .'][]" value="' . htmlspecialchars(stripslashes($item[$attrib])) . '" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib .'" />';
	echo '</div>';
}

// Render textarea
function uds_billboard_render_textarea($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<textarea name="uds_billboard['. $attrib .'][]" class="billboard-'. $attrib .'">'. htmlspecialchars(stripslashes($item[$attrib])) .'</textarea>';
	echo '</div>';
}

// Render Select field
function uds_billboard_render_select($item, $attrib, $unique_id)
{
	global $uds_billboard_attributes;
	$attrib_full = $uds_billboard_attributes[$attrib];
	
	if($attrib_full['type'] != 'select') return;

	echo '<div class="'. $attrib .'-wrapper">';
	echo '<label for="billboard-'. $attrib .'-'. $unique_id .'">'. $attrib_full['label'] .'</label>';
	echo '<select name="uds_billboard['. $attrib .'][]" class="billboard-'. $attrib .'">';
	if(is_array($attrib_full['options'])){
		foreach($attrib_full['options'] as $key => $option){
			$selected = '';
			if($item[$attrib] == $key){
				$selected = 'selected="selected"';
			}
			echo '<option value="'. $key .'" '. $selected .'>'. $option .'</option>';
		}
	}
	echo '</select>';
	echo '</div>';
}

// Render Image input
function uds_billboard_render_image($item, $attrib, $unique_id)
{
	echo '<div class="'. $attrib .'-wrapper">';
	echo '<a class="thickbox" title="Add an Image" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">';
	if(!empty($item['image'])){
		echo '<img alt="' . esc_attr__('Add an Image', 'uds-textdomain') . '" src="'. $item[$attrib] .'" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib  .'" />';
	} else {
		echo '<img alt="' . esc_attr__('Add an Image', 'uds-textdomain') . '" src="'. UDS_BILLBOARD_URL .'images/noimg385x180.jpg" id="billboard-'. $attrib .'-'. $unique_id .'" class="billboard-'. $attrib .'" />';
	}
	echo '</a>';
	echo '<input type="hidden" name="uds_billboard['. $attrib .'][]" value="'. $item[$attrib] .'" id="billboard-'. $attrib .'-'. $unique_id .'-hidden" />';
	echo '</div>';
}

// render JS support for image input
function uds_billboard_render_js_support()
{
	global $uds_billboard_attributes;
	$selector = '';
	foreach($uds_billboard_attributes as $attrib => $options){
		if($options['type'] == 'image'){
			$selector .= '.billboard-'.$attrib;
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
	jQuery('<?php echo $selector; ?>').click(function(){
		set_receiver(this);
	});
	</script>
	<?php
}

// Functions to render single fields in general options for each billboard
function uds_billboard_render_general_text($option, $field, $value)
{
	?>
	<div class="uds-billboard-<?php echo $option ?>">
		<label for="uds-billboard-<?php echo $option ?>"><?php echo $field['label'] ?></label>
		<input type="text" id="uds-billboard-<?php echo $option ?>" name="uds-billboard-<?php echo $option ?>" value="<?php echo empty($value) ? $field['default'] : $value ?>" />
		<span class="unit"><?php echo $field['unit'] ?></span>
		<span class="tooltip">?</span>
		<div class="tooltip-content"><?php echo $field['tooltip'] ?></div>
	</div>
	<?php
}

function uds_billboard_render_general_checkbox($option, $field, $value)
{
	$checked = ( $value === null ? $field['default'] : $value ) == 'on' ? 'checked="checked"' : '';
	?>
	<div class="uds-billboard-<?php echo $option ?>">
		<label for="uds-billboard-<?php echo $option ?>"><?php echo $field['label'] ?></label>
		<input type="checkbox" id="uds-billboard-<?php echo $option ?>" name="uds-billboard-<?php echo $option ?>" <?php echo $checked ?> />
		<span class="unit"><?php echo $field['unit'] ?></span>
		<span class="tooltip">?</span>
		<div class="tooltip-content"><?php echo $field['tooltip'] ?></div>
	</div>
	<?php
}

function uds_billboard_admin_options($billboard, $name)
{
	global $uds_billboard_general_options;
	
	foreach($uds_billboard_general_options as $key => $option) {
		switch($option['type']){
			case 'checkbox':
				uds_billboard_render_general_checkbox($key, $option, $billboard[$key]);
				break;
			case 'text':
			default:
				uds_billboard_render_general_text($key, $option, $key == 'name' ? $name : $billboard[$key]);
		}
	}
}

////////////////////////////////////////////////////////////////////////////////
//
//	Frontend rendering functions
//
////////////////////////////////////////////////////////////////////////////////

add_action('wp_print_scripts', 'uds_billboard_options_javascript');
function uds_billboard_options_javascript()
{
    ?>
    <script type="text/javascript">
        var uds_billboard_url = '<?php echo UDS_BILLBOARD_URL ?>';
    </script>
    <?php
}

function get_uds_billboard($name = 'billboard')
{
	static $has_run = false;
	
	if($has_run) return;
	else $has_run = true;
	
	$bb = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION));
	
	$bb = $bb[$name];
	
	if(empty($bb)) return "";
	
	$out = '
		<div id="uds-billboard-wrapper">
			<div id="uds-billboard-settings">
				<span id="uds-billboard-width">'.(int)apply_filters('uds-billboard-width', $bb['width'], $bb).'</span>
				<span id="uds-billboard-height">'.(int)apply_filters('uds-billboard-height', $bb['height'], $bb).'</span>
				<span id="uds-billboard-square-size">'.(int)apply_filters('uds-billboard-square-size', $bb['square-size'], $bb).'</span>
				<span id="uds-billboard-column-width">'.(int)apply_filters('uds-billboard-column-width', $bb['column-width'], $bb).'</span>
				<span id="uds-billboard-show-paginator">'.(apply_filters('uds-billboard-show-paginator', $bb['show-paginator'], $bb) == 'on' ? 'true' : 'false') .'</span>
				<span id="uds-billboard-show-controls">'. (apply_filters('uds-billboard-show-controls', $bb['show-controls'], $bb) == 'on' ? 'true' : 'false') .'</span>
				<span id="uds-billboard-show-pause">'. (apply_filters('uds-billboard-show-pause', $bb['show-pause'], $bb) == 'on' ? 'true' : 'false') .'</span>
				<span id="uds-billboard-autoplay">'. (apply_filters('uds-billboard-autoplay', $bb['autoplay'], $bb) == 'on' ? 'true' : 'false') .'</span>
			</div>
			<div id="uds-loader"><div id="uds-progress"></div></div>
			<div id="uds-next-slide"></div>
			<div id="uds-billboard">';
				foreach($bb['slides'] as $b):
					if($b['image'] != ''):
						if($bb['use-timthumb'] == 'on'){
							$width = (int)$bb['width'];
							$height = (int)$bb['height'];
							$zoom = $bb['timthumb-zoom'] == 'on' ? 1 : 0;
							$quality = (int)$bb['timthumb-quality'];
							
							if(UDS_BILLBOARD_USE_RELATIVE_PATH) {
								$image = urlencode(str_replace(get_bloginfo('siteurl') . '/wp-content/', '', $b['image']));
							} else {
								$image = urlencode($b['image']);
							}
							
							if(uds_billboard_is_plugin()) {
								$url = UDS_BILLBOARD_URL . "timthumb.php?src=$image&amp;w=$width&amp;h=$height&amp;zc=$zoom&amp;q=$quality";
							} else {
								$url = get_template_directory_uri() . "/timthumb.php?src=$image&amp;w=$width&amp;h=$height&amp;zc=$zoom&amp;q=$quality";
							}
						} else {
							$url = $b['image'];
						}
						$out .= '
						<div class="uds-slide">
							<input type="hidden" class="uds-billboard-option" name="uds-billboard-delay" value="'. apply_filters('uds-billboard-delay', $b['delay'], $bb) .'" />
							<input type="hidden" class="uds-billboard-option" name="uds-billboard-transition" value="'. apply_filters('uds-billboard-transition', $b['transition'], $bb) .'" />
							<input type="hidden" class="uds-billboard-option" name="uds-billboard-layout" value="'. apply_filters('uds-billboard-layout', $b['layout'], $bb) .'" />
							<img src="' . apply_filters('uds-billboard-image', $url, $bb) . '" alt="" />
							<div class="uds-descr-wrapper">
								<div class="uds-descr">';
									if(stripslashes($b['title']) != ''):
										$out .= '<h2>'. apply_filters('uds-billboard-title', stripslashes($b['title']), $bb) .'</h2>';
									endif;
									$out .= '<p>' . apply_filters('uds-billboard-description', stripslashes($b['text']), $bb) . '</p>';
									if(stripslashes($b['link']) != ''):
										$out .= '<a href="'. apply_filters('uds-billboard-link', stripslashes($b['link']), $bb) .'" class="read-more">' . __('Read more', 'uds-textdomain') . '</a>';
									endif;
									$out .= '
								</div>
							</div>
						</div>';
					endif;
				endforeach;
			$out .= '
			</div>
			<div id="uds-billboard-controls"></div>
		</div>';
	
	return apply_filters('uds-billboard-output', $out, $bb);
}

function the_uds_billboard($name = 'billboard')
{
	echo get_uds_billboard($name);
}

add_shortcode('uds-billboard', 'uds_billboard_shortcode');
function uds_billboard_shortcode($atts, $content = null)
{	
	extract(shortcode_atts(array(
		'name' => 'billboard'
	), $atts));
	return get_uds_billboard($name);
}

?>