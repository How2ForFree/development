<?php

///////////////////////////////////////////////////////////////
// 
//	Initial Defines
//
///////////////////////////////////////////////////////////////
// Template name
define("UDS_TEMPLATE_NAME", "Superb");
define("UDS_TEMPLATE_VERSION", "1.0.0");
define("UDS_UPDATE_URL", "http://themes.udesignstudios.net/superb/wp-content/themes/superb/updates.json");
define("UDS_LIVE_PREVIEW", false);

///////////////////////////////////////////////////////////////
// 
//	PHP Settings
//
///////////////////////////////////////////////////////////////
// error_reporting(E_ALL);

ini_set('pcre.backtrack_limit', 500000);

///////////////////////////////////////////////////////////////
// 
//	Localization
//
///////////////////////////////////////////////////////////////

$path = get_template_directory() . '/lang';
load_theme_textdomain('uds-textdomain', $path);

///////////////////////////////////////////////////////////////
// 
//	Headers
//
///////////////////////////////////////////////////////////////


include 'admin/settings.php';
include 'uBillboard/billboard.php';
include 'uContact/contact.php';
include 'uPricing/pricing.php';
include 'portfolio/portfolio-common.php';
include 'uAd/ads-common.php';
include 'tinymce/tinymce.php';
include 'shortcodes/shortcodes.php';
include 'widgets/widgets.php';
include 'functions/functions-utility.php';
include 'functions/functions-post.php';
include 'functions/functions-twitter.php';
include 'functions/functions-flickr.php';
include 'functions/functions-live-preview.php';

if(is_admin()){
	include 'admin/admin.php';
}

///////////////////////////////////////////////////////////////
// 
//	Sidebar regstrations
//
///////////////////////////////////////////////////////////////

/**
 *	UDS Register Sidebars
 *	Register all sidebars
 */
function uds_register_sidebars()
{
	register_sidebar(array(
		'name' => __('Home', 'uds-textdomain'),
		'id' => 'home',
		'description' => __('Displayed on the home page provided that you are displaying posts', 'uds-textdomain'),
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => __('Common', 'uds-textdomain'),
		'id' => 'common',
		'description' => __('Displayed alongside the blog AND the pages', 'uds-textdomain'),
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => __('Blog', 'uds-textdomain'),
		'id' => 'blog',
		'description' => __('Displayed alongside the blog', 'uds-textdomain'),
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	register_sidebar(array(
		'name' => __('Page', 'uds-textdomain'),
		'id' => 'page',
		'description' => __('Displayed alongside the pages', 'uds-textdomain'),
	    'before_widget' => ' <div class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4 class="widget-heading">',
	    'after_title' => '</h4>'
	));
	
	$config = uds_get_option('uds-footer-config', 'uds_footer_options', 3);
	for($i = 1; $i <= $config; $i++){
		register_sidebar(array(
			'name' => sprintf(__('Footer %u', 'uds-textdomain'), $i),
			'id' => 'footer'.$i,
			'description' => sprintf(__('Footer Column #%u', 'uds-textdomain'), $i),
		    'before_widget' => ' <div class="footer-widget '.($i == $config ? 'last' : '').' %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h3>',
		    'after_title' => '</h3>'
		));
	}
	
	$sidebars = maybe_unserialize(get_option('uds-page-sidebars', array()));
	if(!empty($sidebars)) {
		foreach($sidebars as $sidebar) {
			register_sidebar(array(
				'name' => $sidebar,
				'id' => sanitize_title_with_dashes($sidebar),
				'description' => __('Per-page sidebar. Only appears on its page', 'uds-textdomain'),
		    	'before_widget' => ' <div class="widget %2$s">',
		    	'after_widget' => '</div>',
		    	'before_title' => '<h4 class="widget-heading">',
		    	'after_title' => '</h4>'
			));
		}
	}
}

add_action( 'widgets_init', 'uds_register_sidebars' );

///////////////////////////////////////////////////////////////
// 
//	Wordpress Support
//
///////////////////////////////////////////////////////////////
if (function_exists( 'add_theme_support' )){
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 610, 9999, false );
}

///////////////////////////////////////////////////////////////
// 
//	Wordpress Initialization Functions
//
///////////////////////////////////////////////////////////////

// init options and admin
add_action('init', 'uds_init');

/**
 *	UDS Init
 *	Initializes all required parts
 *
 */
function uds_init()
{
	global $pagenow, $uds_general_options, $uds_header_options, 
	$uds_home_page_options, $uds_blog_options, $uds_footer_options, 
	$uds_social_options, $uds_maintenance_options;
	
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {		
		$pages = array(
			'uds_home_page_options',
			'uds_general_options',
			'uds_blog_options',
			'uds_header_options',
			'uds_footer_options',
			'uds_social_options',
			'uds_maintenance_options'
		);
		
		foreach($pages as $page) {
			$options = $$page;
			$defaults = array();
			// Make sure all options exist
			foreach($options as $key => $option){
				$defaults[$key] = $option['default'];
				
				if($option['type'] == 'optional') {
					foreach($option['optionals'] as $key => $option) {
						$defaults[$key] = $option['default'];
					}
				}
				
				if($option['type'] == 'alternate') {
					foreach($option['alternates'] as $alternate) {
						foreach($alternate as $key => $option) {
							$defaults[$key] = $option['default'];
						}
					}
				}
			}
			add_option($page, $defaults);
		}
	}
	
	// Register Navigation Menus
    register_nav_menu('main-menu', __( 'Main Menu', 'uds-textdomain'));
    
    // Fix the goddamn wpautop.....
	add_filter('uds_shortcode_out_filter', 'uds_clear_autop');
}

/**
 *	UDS Clear Autop
 *	Removes all <p>, </p>, <br /> from the $content
 *
 *	@param string @content Content to be cleared
 *
 *	@return string Clean content
 */
function uds_clear_autop($content)
{
	$content = str_ireplace('<p>', '', $content);
	$content = str_ireplace('</p>', '', $content);
	$content = str_ireplace('<br />', '', $content);
	return $content;
}

// init stlyes
add_action("wp_print_styles", "uds_styles");
/**
 *	UDS Styles
 *	Enqueue all necessary styles using Wordpress Hooks
 *
 */
function uds_styles()
{
	global $uds_themes, $uds_backgrounds;
	$turbine = get_template_directory_uri()."/turbine/css.php";
	$cssdir = get_template_directory_uri()."/css/";
	$fancybox = get_template_directory_uri()."/fancybox/";
	
	if(!is_admin()){
		wp_enqueue_style('style', $cssdir.'style.css', false, false, 'screen');
		wp_enqueue_style('style-css3', $cssdir.'css3.css', false, false, 'screen');
		
		if(in_array('lightbox', uds_active_shortcodes()) || in_array('gallery', uds_active_shortcodes())) {
			wp_enqueue_style('fancybox', $fancybox.'jquery.fancybox-1.3.4.css', false, false, 'screen');
		}
		
		// load custom CSS
		wp_enqueue_style('custom', $cssdir.'custom.css', false, false, 'screen');
	}
}

add_action('wp_print_scripts', 'uds_css_globals');
/**
 *	UDS CSS Global
 *	Print variable CSS properties
 *	
 */
function uds_css_globals()
{
	$color = uds_driving_color();
	// figure out if we have the tranformed images

	$cachedir = get_template_directory() . '/cache';
	$transformabledir = get_template_directory() . '/images/transformable';

	$r = hexdec(substr($color, 0, 2));
	$g = hexdec(substr($color, 2, 2));
	$b = hexdec(substr($color, 4, 2));
	
	if(!file_exists($cachedir . '/bg-menu-active'.$color.'.png') && is_writable($cachedir)) {
		$transformables = array(
			'bg-menu-active.png',
			'bg-follow-footer.png',
			'read-more.png',
			'tagline-button-inner.png',
			'button.png'
		);
		
		foreach($transformables as $image) {
			$src = $transformabledir . '/' . $image;
			$dst = $cachedir . '/' . str_replace('.png', $color.'.png', $image);

			uds_colorize_image($src, $dst, $r, $g, $b);
		}
	}
	
	if(file_exists($cachedir . '/bg-menu-active'.$color.'.png')) {
		$menu_active = 	get_template_directory_uri() . '/cache/bg-menu-active'.$color.'.png';
		$twitter = get_template_directory_uri() . '/cache/bg-follow-footer'.$color.'.png';
		$read_more = get_template_directory_uri() . '/cache/read-more'.$color.'.png';
		$tagline_button_inner = get_template_directory_uri() . '/cache/tagline-button-inner'.$color.'.png';
		$button = get_template_directory_uri() . '/cache/button'.$color.'.png';
	} else {
		$menu_active = 	get_template_directory_uri() . '/images/bg-menu-active.png';
		$twitter = 	get_template_directory_uri() . '/images/bg-follow-footer.png';
		$read_more = get_template_directory_uri() . '/images/read-more.png';
		$tagline_button_inner = get_template_directory_uri() . '/images/tagline-button-inner.png';
		$button = get_template_directory_uri() . '/cache/button.png';
	}
	
	$color = '#' . $color;
	?>
	<style type="text/css">
		#content a,
		#add-comment .buttons button,
		#authorbox h4 a,
		#content .sidebar-wrapper .sidebar .widget_uds_popularposts .post-heading a, #content .sidebar-wrapper .sidebar .widget_uds_recentpopularposts .post-heading a,
		#content .sidebar-wrapper .uds-twitter-widget .twit-follow-footer,
		#content .sidebar-wrapper .uds-twitter-widget ul li .text a,
		#content .sidebar-wrapper .widget_nav_menu li.current-menu-item a,
		.sidebar-wrapper ul li a:hover, #content .sidebar-wrapper a:hover, #footer-inner a:hover, #content .portfolio-heading a:hover, #content .uds-tabs li a:hover, #content .uds-toggler.open:hover, #content .uds-divider a:hover,
		.post .read-more:hover, .portfolio .read-more:hover, #main .read-more:hover,
		#content .post h5.post-heading a:hover, .uds-toggler:hover, #logo .textual h3 a, #content .terms a:hover {
			color: <?php echo $color ?>;
		}
		
		#footer-inner .twit-follow-footer {
			color: <?php echo '#' . uds_darken(substr($color, 1, 6), 100) ?>;
		}
		
		.heading-wrapper, #bb-wrapper, #billboard-bottom,
		.uds-tour-status li.active {
			background-color: <?php echo $color ?>;
		}
		.nav li.current-menu-item a,
		.nav li.current_page_item a,
		.nav li.current_page_parent a,
		.nav li .current-menu-item-right {
			background-image: url(<?php echo $menu_active ?>);
		}
		
		#footer-inner .twit-follow-footer {
			background-image: url(<?php echo $twitter ?>);
		}
		
		#uds-billboard-description a.read-more {
			background-image: url(<?php echo $read_more ?>);
		}
		
		#content a.tour-button {
			background-image: url(<?php echo $tagline_button_inner ?>);
		}
		
		#footer-inner .twit-follow-footer {
			text-shadow: 0px 1px 0px <?php echo $color ?> !important;
		}
		
		#content a.tour-button,
		.custom-tagline,
		.heading #heading-title h2 a, 
		.heading #heading-title .breadcrumbs a {
			text-shadow: 1px 1px 1px <?php echo '#' . uds_darken(substr($color, 1, 6), 100) ?> !important;
		}
		
		#top-search {
			text-shadow: 1px 1px 1px <?php echo '#' . uds_darken(substr($color, 1, 6), 75) ?> !important;
		}
		
		.uds-button.transformable, .uds-button.transformable .uds-button-right {
			background-image: url(<?php echo $button ?>);
		}
	
	</style>
	<?php
}

add_action('wp_print_scripts', 'uds_javascript_globals');
/**
 *	UDS JavaScript Globals
 *	Print these variable to allow us load some stuff from arbitrary URL
 *
 */
function uds_javascript_globals()
{
    ?>
	<script type="text/javascript">
		var base_url = "<?php echo bloginfo('url')?>";
		var template_url = "<?php echo get_template_directory_uri()?>";
	</script>
    <?php
}

// init scripts
add_action("wp_print_scripts", "uds_scripts");
/**
 *	UDS Scripts
 *	Enqueue all necessary scripts using Wordpress Hooks
 *
 */
function uds_scripts()
{
	$jsdir = get_template_directory_uri()."/js/";
	$fancybox = get_template_directory_uri()."/fancybox/";
	
	if(!is_admin()) {
		wp_deregister_script('jquery');
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js');
    	//wp_register_script('jquery', $jsdir.'jquery.min.js');
    	//wp_register_script('easing',  $jsdir."jquery.easing.js", array('jquery'));
    	
    	if(in_array('lightbox', uds_active_shortcodes()) || in_array('gallery', uds_active_shortcodes())) {
			wp_register_script("mousewheel", $fancybox."jquery.mousewheel-3.0.4.pack.js", array('jquery'));
			wp_enqueue_script("fancybox", $fancybox."jquery.fancybox-1.3.4.pack.js", array('jquery', 'mousewheel'));
		}
    	
    	//if(count(array_intersect(array('tabs', 'accordion', 'toggle', 'tour'), uds_active_shortcodes())) > 0)
	    //	wp_enqueue_script('jquery.tools',  $jsdir."jquery.tools.min.js", array('jquery'));
    	
    	if(in_array('gmap', uds_active_shortcodes()) || is_active_widget(false, false, 'uds_gmap'))
			wp_enqueue_script("google.maps", "http://maps.google.com/maps/api/js?sensor=false", false, false, true);

		wp_enqueue_script("scripts", $jsdir."scripts.js", array('jquery'));
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
}

/**
 *	UDS Driving Color
 *	Gets the main driving color with respect to the live preview settings if necessary
 *
 */
function uds_driving_color()
{
	$color = uds_get_option('uds-main-color', 'uds_general_options', '2cb0e0');
	if(UDS_LIVE_PREVIEW) {
		if(isset($_SESSION['color']) && !empty($_SESSION['color'])) {
			$color = $_SESSION['color'];
		}
		
		if(isset($_POST['color']) && !empty($_POST['color'])) {
			$color = substr($_POST['color'], 0, 6);
		}
		
		$_SESSION['color'] = $color;
	}
	
	return $color;
}

/**
 *	UDS Get page id
 *	Gets page id based on page name
 *
 */
function get_page_id($page_name)
{
	global $wpdb;
	return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
}

function uds_get_option($option, $page, $default = '')
{
	$uds_settings = maybe_unserialize(get_option($page, array()));
	//d($uds_settings);
	if(isset($uds_settings[$option]) && !empty($uds_settings[$option])) {
		return $uds_settings[$option];
	} else {
		return $default;
	}
}

?>