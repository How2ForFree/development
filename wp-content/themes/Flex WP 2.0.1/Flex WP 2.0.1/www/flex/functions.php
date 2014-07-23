<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

/* 
	MR Semantic Framework
	Version: 1.2.4
	Last Modified: 10th September 2009
	Optimised for: Wordpress 2.9
*/

/* Widgets */
include('functions/widgets.php');

/* Easy Custom Field */
include('functions/custom-field.php');

/* Comments */
include('functions/comments.php');

/* Site Menu */
include('functions/menu.php');

/* HTML or XHTML */
include('functions/doctype.php');

/* Remove WP Auto Formatting */
include('functions/formatting.php');

/* Breadcrumbs */
include('functions/breadcrumb-trail.php');

/* Page Title */
include('functions/page-title.php');

/* Page Order */
include('functions/page-order.php');

/* Control Panel */
include('functions/theme-panel.php');


if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	    add_theme_support( 'post-thumbnails' );
	    set_post_thumbnail_size( 200, 130, true ); // Normal post thumbnails
	}

?>