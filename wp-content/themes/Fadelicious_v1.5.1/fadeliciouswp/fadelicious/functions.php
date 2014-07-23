<?php
include_once TEMPLATEPATH . '/functions/fadelicious-functions.php';
include_once TEMPLATEPATH . '/functions/shortcodes.php';
include_once TEMPLATEPATH . '/functions/tabs.php';
register_widget('fadelicious_widget_tab');


$functions_path = STYLESHEETPATH . '/functions/';

/* These files build out the options interface.  Likely won't need to edit these. */

require_once ($functions_path . 'admin-functions.php');		// Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once ($functions_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($functions_path . 'theme-functions.php'); 	// Theme actions based on options settings

function jquery_init() {
if (!is_admin()) {
wp_deregister_script('jquery');
wp_register_script('jquery', 'http://code.jquery.com/jquery-latest.min.js', false, '1.4.4', true);//load jquery from google api, and place in footer
wp_enqueue_script('jquery');


wp_enqueue_script( 'tools', get_bloginfo('stylesheet_directory').'/style/js/jquery.tools.min.js', array('jquery'));
wp_enqueue_script( 'cycle', get_bloginfo('stylesheet_directory').'/style/js/cycle.js', array('jquery'));
wp_enqueue_script( 'ticker', get_bloginfo('stylesheet_directory').'/style/js/ticker.js', array('jquery'));
wp_enqueue_script( 'tabs', get_bloginfo('stylesheet_directory').'/style/js/tabs.js', array('jquery'));
wp_enqueue_script( 'custom', get_bloginfo('stylesheet_directory').'/style/js/custom.js', array('jquery')); 
wp_enqueue_script( 'zoombox', get_bloginfo('stylesheet_directory')."/style/js/zoombox.js", array('jquery'));
wp_enqueue_script( 'sliding', get_bloginfo('stylesheet_directory').'/style/js/sliding_effect.js', array('jquery'));
}elseif (is_admin()){


}
}
add_action('init', 'jquery_init');

