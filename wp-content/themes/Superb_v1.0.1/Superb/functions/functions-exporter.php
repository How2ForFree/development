<?php

function uds_export_theme_data()
{
	$options_list = array(
		'sidebars_widgets',
		'uds-contact',
		'uds-pricing-tables',
		'widget_archives',
		'widget_calendar',
		'widget_categories',
		'widget_links',
		'widget_meta',
		'widget_nav_menu',
		'widget_pages',
		'widget_recent-comments',
		'widget_recent-posts',
		'widget_rss',
		'widget_search',
		'widget_tag_cloud',
		'widget_text',
		'widget_ucontact',
		'widget_uds-ads',
		'widget_uds_contact',
		'widget_uds_envato_last_files',
		'widget_uds_flickr',
		'widget_uds_gmap',
		'widget_uds_popularposts',
		'widget_uds_recentpopularposts',
		'widget_uds_slideshow',
		'widget_uds_twitter'
	);
	
	$options = array();
	
	foreach($options_list as $option) {
		$options[$option] = maybe_unserialize(get_option($option));
	}
	
	header('Content-type: text/plain');
	header('Content-Disposition: attachment; filename="options-'.date('Y-m-d').'.txt"');
	die(maybe_serialize($options));
}

function uds_import_theme_data()
{
	$file = file_get_contents(get_template_directory() . '/admin/install/install.txt');
	
	$options = maybe_unserialize($file);
	
	$log = array();
	
	foreach($options as $key => $value) {
		$log[] = $key;
		update_option($key, $value);
	}
	
	return $log;
}

?>