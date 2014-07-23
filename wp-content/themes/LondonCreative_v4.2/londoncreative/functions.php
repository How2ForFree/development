<?php
////////////////////////////////////////////////////////////////////////////////
// FRESHPANEL INCLUDING
////////////////////////////////////////////////////////////////////////////////

 include 'freshwork/freshpanel/freshpanel.php';     // theme options panel
 include 'freshwork/freshslider/freshslider.php';     // theme options panel                                  
 include 'freshwork/writepanels.php';               // page & post writepanels
 include 'freshwork/writepanels-category.php';               // page & post writepanels
 include 'freshwork/widgets.php';               // page & post writepanels
 include 'freshwork/shortcodes.php';               // page & post writepanels
////////////////////////////////////////////////////////////////////////////////
// THEME INIT
////////////////////////////////////////////////////////////////////////////////
  if ( function_exists('register_sidebar') )
	register_sidebar(array(
	  'name' => 'Navigation',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
  if ( function_exists('register_sidebar') )
  	register_sidebar(array(
  	  'name' => 'Home Sidebar',
  		'before_widget' => '<div class="widget">',
  		'after_widget' => '</div>',
  		'before_title' => '	<h3 class="widget_title">',
  		'after_title' => '</h3>',
  	));
  
  if ( function_exists('register_sidebar') )
  	register_sidebar(array(
  	  'name' => 'Page Sidebar',
  		'before_widget' => '<div class="widget">',
  		'after_widget' => '</div>',
  		'before_title' => '	<h3 class="widget_title">',
  		'after_title' => '</h3>',
  	));
  if ( function_exists('register_sidebar') )
  	register_sidebar(array(
  	  'name' => 'Portfolio Sidebar',
  		'before_widget' => '<div class="widget">',
  		'after_widget' => '</div>',
  		'before_title' => '	<h3 class="widget_title">',
  		'after_title' => '</h3>',
  	));
  if ( function_exists('register_sidebar') )
  	register_sidebar(array(
  	  'name' => 'Blog Sidebar',
  		'before_widget' => '<div class="widget">',
  		'after_widget' => '</div>',
  		'before_title' => '	<h3 class="widget_title">',
  		'after_title' => '</h3>',
  	));
  if ( function_exists('register_sidebar') )
  	register_sidebar(array(
  	  'name' => 'Single Sidebar',
  		'before_widget' => '<div class="widget">',
  		'after_widget' => '</div>',
  		'before_title' => '	<h3 class="widget_title">',
  		'after_title' => '</h3>',
  	));	    	
	

 function my_get_posts( $query ) {


//   $query->set( 'post_type', array( 'post', 'blog', 'portfolio') );
//echo $query->get('post_type'); 
	/* foreach($query->get('post_type') as $neco)
   {
      echo $neco;
   }  */
  return $query;
}

function my_init_method() {
wp_deregister_script( 'jquery' );
wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js');
wp_enqueue_script( 'jquery' );
}

if(!is_admin())
    add_action('init', 'my_init_method');


add_action( 'after_setup_theme', 'lcp_setup' );
add_action('init', 'init_post_types');
  
function lcp_setup()
{
  // suport functions
  add_theme_support( 'nav-menus' );

}

function init_post_types()
{                
  // BLOG POST
  	                               


  // PORTFOLIO POST
  register_post_type( 'portfolio',
              array( 'label' => __('Portfolio Post'), 'public' => true, 'show_ui' => true ,  'supports' => array(
                                        'author',
                                        'title',
                                        'editor',
                                        'post-thumbnails',
                                        'excerpt',
                                        'trackbacks',
                                        'custom-fields',
                                        'comments',
                                        'revisions')) );
  register_taxonomy_for_object_type('category', 'portfolio');   
}

function post_in_child_cat( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

function lcp_option($name)
{
    return htmlspecialchars_decode(stripslashes(get_option($name)));
}	

function the_category_filter($thelist,$separator=' ') {  
     if(!defined('WP_ADMIN')) {  
            //Category Names to exclude  
            $exclude = array('slider');  
      
            $cats = explode($separator,$thelist);  
            $newlist = array();  
            foreach($cats as $cat) {  
                $catname = trim(strip_tags($cat));  
              if(!in_array($catname,$exclude))  
                   $newlist[] = $cat;  
           }  
           return implode($separator,$newlist);  
       } else {  
           return $thelist;  
       }  
   }  
add_filter('the_category','the_category_filter', 10, 2);  
?>
