<?php
	
/* ------------------------------------------------------------------------------------------------------------

	Functions - Main functions file
	
	Description: The main functions file
	
------------------------------------------------------------------------------------------------------------ */

	$domain = 'nuance';

	add_action('after_setup_theme', 'jw_theme_setup');
	
	/*-----------------------------------------------------------------
	
		Name: jw_theme_setup
		
		Adding theme-supported features, actions and filters.
	
	-----------------------------------------------------------------*/
	function jw_theme_setup(){
	
		global $domain; /* The unique string used for translation */
	
		/* Add theme-supported features. */
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		
		/* Add post thumbnail sizes */
		set_post_thumbnail_size(598, 188, true);
		
		add_image_size('jw_blog', 564, 9999); /* Blog third with no specific height */ 
		add_image_size('jw_blog_full', 880, 9999); /* Blog full with no specific height */ 
		
		
		add_image_size('jw_full', 914, 312, true);
		add_image_size('jw_third', 270, 170, true);
		add_image_size('jw_blog_third', 254, 160, true);
		add_image_size('jw_half', 425, 232, true);
		add_image_size('jw_portfolio_grid', 241, 225, true);
		add_image_size('jw_portfolio_listing', 280, 140, true);
		add_image_size('jw_portfolio_listing_fourth', 201, 129, true);
		add_image_size('jw_portfolio_twothird', 598, 9999);
		
		/* Don't change the sizes bellow */
		add_image_size('jw_63', 63, 63, true);
		add_image_size('jw_100', 100, 100, true);
		
		/* Localization */
		load_theme_textdomain($domain, TEMPLATEPATH . '/lang');
		
		if (!is_admin()) add_filter('widget_text', 'do_shortcode', 11);
		
		/* Add description to nav items */
		class description_walker extends Walker_Nav_Menu
		{
			  function start_el(&$output, $item, $depth, $args)
			  {
				   global $wp_query;
				   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				   $class_names = $value = '';

				   $classes = empty( $item->classes ) ? array() : (array) $item->classes;

				   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				   $class_names = ' class="'. esc_attr( $class_names ) . '"';

				   $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

				   $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				   $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				   $prepend = '';
				   $append = '';
				   $description  = ! empty( $item->description ) ? '<span class="nav-description">'.esc_attr( $item->description ).'</span>' : '';

				   if($depth != 0)
				   {
							 $description = $append = $prepend = "";
				   }

					$item_output = $args->before;
					$item_output .= '<a'. $attributes .'>';
					$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
					$item_output .= $description.$args->link_after;
					$item_output .= '</a>';
					$item_output .= $args->after;

					$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
					}
		}

		
	}
	
	include TEMPLATEPATH.'/functions/jwpanel/jwpanel-framework.php';
	include TEMPLATEPATH.'/functions/jwpanel/jwpanel-options.php';
	
	include TEMPLATEPATH.'/functions/core.php';
	include TEMPLATEPATH.'/functions/common.php';
	include TEMPLATEPATH.'/functions/shortcodes.php';
	include TEMPLATEPATH.'/functions/menus.php';
	include TEMPLATEPATH.'/functions/sidebars.php';
	include TEMPLATEPATH.'/functions/metaboxes.php';
	include TEMPLATEPATH.'/functions/post-types.php';
	
	/* Include widgets */
	include TEMPLATEPATH.'/functions/widgets/widget.recent-posts.php';
	include TEMPLATEPATH.'/functions/widgets/widget.slider-posts.php';
	include TEMPLATEPATH.'/functions/widgets/widget.recent-tweets.php';
	include TEMPLATEPATH.'/functions/widgets/widget.testimonials.php';
	include TEMPLATEPATH.'/functions/widgets/widget.popular-recent-comments.php';
	include TEMPLATEPATH.'/functions/widgets/widget.contact.php';
	
?>