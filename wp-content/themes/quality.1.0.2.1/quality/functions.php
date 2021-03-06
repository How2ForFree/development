<?php
/**Theme Name	: Quality
 * Theme Core Functions and Codes
*/	
	/**Includes reqired resources here**/
	define('WEBRITI_TEMPLATE_DIR_URI',get_template_directory_uri());	
	define('WEBRITI_TEMPLATE_DIR',get_template_directory());
	define('WEBRITI_THEME_FUNCTIONS_PATH',WEBRITI_TEMPLATE_DIR.'/functions');	
	define('WEBRITI_THEME_OPTIONS_PATH',WEBRITI_TEMPLATE_DIR_URI.'/functions/theme_options');
	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php'); //Menu Walker Class
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/webriti_nav_walker.php');  //Menu Walker Class	
	require_once( WEBRITI_THEME_FUNCTIONS_PATH . '/scripts/scripts.php');     //Theme Scripts And Styles	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/resize_image/resize_image.php'); //Image Resizing 	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/commentbox/comment-function.php'); //Comment Handling
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/widget/custom-sidebar.php'); //Sidebar Registration
	
		
	
	//content width
	if ( ! isset( $content_width ) ) $content_width = 700;//In PX		
	//wp title tag starts here
	function quality_head( $title, $sep )
	{	global $paged, $page;		
		if ( is_feed() )
			return $title;
		// Add the site name.
		$title .= get_bloginfo( 'name' );
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( _e( 'Page', 'quality' ), max( $paged, $page ) );
		return $title;
	}	
	add_filter( 'wp_title', 'quality_head', 10, 2);
	
	add_action( 'after_setup_theme', 'quality_setup' ); 	
	function quality_setup()
	{	// Load text domain for translation-ready
		load_theme_textdomain( 'quality', WEBRITI_THEME_FUNCTIONS_PATH . '/lang' );
		
		add_theme_support( 'post-thumbnails' ); //supports featured image
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'quality' ) ); //Navigation
		// theme support 	
		add_theme_support( 'automatic-feed-links');
		
		require_once('theme_setup_data.php');
		// setup admin pannel defual data for index page		
		$quality_options=theme_data_setup();
		
		$current_theme_options = get_option('quality_options'); // get existing option data 		
		if($current_theme_options)
		{ 	$quality_options = array_merge($quality_options, $current_theme_options);
			update_option('quality_options',$quality_options);	// Set existing and new option data			
		}
		else
		{
			add_option('quality_options', $quality_options);
		}
		require( WEBRITI_THEME_FUNCTIONS_PATH . '/theme_options/option_pannel.php' ); // for Option Panel Settings		
	}
	// Read more tag to formatting in blog page 
	function quality_new_content_more($more)
	{  global $post;
	   return ' <a href="' . get_permalink() . "#more-{$post->ID}\" class=\"qua_blog_btn\">Read More<i class='fa fa-long-arrow-right'></i></a>";
	}   
	add_filter( 'the_content_more_link', 'quality_new_content_more' );
?>