<?php

$uds_ads_db_version = "1.2";
$uds_ads_resolutions = array(
	'16'  => '16x16',
	'125' => '125x125',
	'160' => '160x600',
	'200' => '200x125',
	'234' => '234x60',
	'250' => '250x250',
	'260' => '260x120',
	'300' => '300x250',
	'468' => '468x60',
	'728' => '728x90'
);
define("UDS_ADS_TABLE_NAME", "uds_ads");
define("UDS_ADS_MAX_POSITION", 10);
define("UDS_ADS_MAX_PRIORITY", 10);

function array2object($array) {
    if (is_array($array)) {
        $obj = new StdClass();
 
        foreach ($array as $key => $val){
            $obj->$key = $val;
        }
    } else { 
    	$obj = $array;
    }
 
    return $obj;
}

function uds_ads_install () {
	global $wpdb;
	global $uds_ads_db_version;

	$table_name = $wpdb->prefix . UDS_ADS_TABLE_NAME;
	if($uds_ads_db_version != get_option('uds_ads_db_version') || $wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
		$sql = "CREATE TABLE `$table_name` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
		  `image_url` text NOT NULL,
		  `destination_url` text NOT NULL,
		  `format` varchar(50) NOT NULL,
		  `click_limit` int(11),
		  `showing` tinyint DEFAULT 1,
		  `position` int(11) DEFAULT 0,
		  `priority` int(11) DEFAULT 0,
		  `display_from` datetime DEFAULT NULL,
		  `display_to` datetime DEFAULT NULL,
		  `ignore_date` tinyint DEFAULT 1,
		  `times_clicked` int(11) DEFAULT 0,
		  `new_window` tinyint DEFAULT 1,
		  `created` datetime NOT NULL,
		  `modified` datetime NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
 
		add_option("uds_ads_db_version", $uds_ads_db_version);
		update_option("uds_ads_db_version", $uds_ads_db_version);
   }
}

uds_ads_install();

function create_ad($ad)
{
	global $wpdb;
	
	$query = $wpdb->prepare("
		INSERT INTO ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." SET
			name = %s,
			image_url = %s,
			destination_url = %s,
			format = %s,
			click_limit = %d,
			showing = %d,
			position = %d,
			priority = %d,
			display_from = %s,
			display_to = %s,
			ignore_date = %d,
			times_clicked = %d,
			new_window = %d,
			created = NOW(),
			modified = NOW()
	", array(
		$ad['name'],
		$ad['image_url'],
		$ad['destination_url'],
		$ad['format'],
		$ad['click_limit'],
		$ad['showing'],
		$ad['position'],
		$ad['priority'],
		$ad['display_from'],
		$ad['display_to'],
		$ad['ignore_date'],
		$ad['times_clicked'],
		$ad['new_window']
	));
	
	return $wpdb->query($query);
}

function update_ad($ad)
{
	global $wpdb;
	
	$query = $wpdb->prepare("
		UPDATE ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." SET
			name = %s,
			image_url = %s,
			destination_url = %s,
			format = %s,
			click_limit = %d,
			showing = %d,
			position = %d,
			priority = %d,
			display_from = %s,
			display_to = %s,
			ignore_date = %d,
			times_clicked = %d,
			new_window = %d,
			modified = NOW()
		WHERE id = %s
	", array(
		$ad['name'],
		$ad['image_url'],
		$ad['destination_url'],
		$ad['format'],
		$ad['click_limit'],
		$ad['showing'],
		$ad['position'],
		$ad['priority'],
		$ad['display_from'],
		$ad['display_to'],
		$ad['ignore_date'],
		$ad['times_clicked'],
		$ad['new_window'],
		$ad['id']
	));
	
	return $wpdb->query($query);
}

function delete_ad($id)
{
	global $wpdb;
	
	$query = $wpdb->prepare("
		DELETE FROM ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." 
		WHERE id = %s
	", array(
		$id
	));
	
	return $wpdb->query($query);
}


// Setup

add_action('init', 'uds_ad_clicked');
function uds_ad_clicked()
{
	global $wpdb;
	
	if(!isset($_GET['uds_ads_id'])) return;
	
	$id = (int)$_GET['uds_ads_id'];
	
	if($id == 0) return;
	
	$table = $wpdb->prefix . UDS_ADS_TABLE_NAME;
	
	$query = $wpdb->prepare("
		UPDATE $table SET
			times_clicked = times_clicked + 1
		WHERE id = %d
	", array(
		$id
	));
	
	$wpdb->query($query);
	
	$url = $wpdb->get_var("SELECT destination_url FROM $table WHERE id=$id");
	
	if(!empty($url)){
		header("Location: $url");
	}
	
	exit();
}

// admin
// setup Admin menu entry
add_action('admin_menu', 'uds_menu_ads');
function uds_menu_ads()
{
	global $menu;
	$position = 102;
	if(!empty($menu[$position])) $position = null;
	
	$icon = get_template_directory_uri() . '/uAd/images/menu-icon.png';

	$page = add_menu_page('uAd', 'uAd', 'manage_options', 'uds_ads', 'uds_ads_admin', $icon, $position);
	$create_page = add_submenu_page('uds_ads', 'Ads', __('Create ad', 'uds-textdomain'), 'manage_options', 'uds_ads_create', 'uds_ads_create');
	$view_page = add_submenu_page('uds_ads', 'Ads', __('View ad', 'uds-textdomain'), 'manage_options', 'uds_ads_view', 'uds_ads_view');
	
	add_action("admin_print_styles-$page", 'uds_ads_admin_setup_css');
	add_action("admin_print_styles-$create_page", 'uds_ads_admin_setup_css');
	add_action("admin_print_styles-$view_page", 'uds_ads_admin_setup_css');
}

// Admin menu entry handling
function uds_ads_admin()
{
	global $wpdb;
	include "ads-admin.php";
}

function uds_ads_create()
{
	global $wpdb, $uds_ads_resolutions;
	include "ads-create.php";
}

function uds_ads_view()
{
	global $wpdb, $uds_ads_resolutions;
	include "ads-view.php";
}

// setup css
function uds_ads_admin_setup_css()
{
	wp_enqueue_style('uds_ads', get_template_directory_uri().'/uAd/css/admin.css', false, false, 'screen');
}

// register ads widget
include 'ads-widget.php';
register_widget('UDS_Ads');

?>