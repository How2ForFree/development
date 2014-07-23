<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Post types
	
	Description: Register new post types and taxonomies
	
------------------------------------------------------------------------------------------------------------ */
	
	/* Actions and filters */
	add_action('init', 'jw_register_post_types');
	
	
	/* -----------------------------------------------------------------
		
		Name: jw_register_post_types
		
	----------------------------------------------------------------- */
	function jw_register_post_types(){
			
			global $domain; /* The unique string used for translation */
			
			$portfolio_slug = get_option('jw_portfolio_slug');
			if(empty($portfolio_slug)){ $portfolio_slug = 'portfolio-view'; }
			$portfolio_comments = get_option('jw_portfolio_comments');
			
			if($portfolio_comments == 'on'){
				$portfolio_comments = 'comments';
			}else{
				$portfolio_comments = '';
			}
			
			/* Portfolio */
			register_post_type( 'jw_portfolio',
				array(
					'labels' => array(
						'name' => __( 'Portfolio', $domain ),
						'singular_name' => __( 'Portfolio Post', $domain ),
						'add_new' => __( 'Add New', $domain ),
						'add_new_item' => __( 'Add New Portfolio Post', $domain ),
						'edit' => __( 'Edit', $domain ),
						'edit_item' => __( 'Edit Portfolio Post', $domain ),
						'new_item' => __( 'New Portfolio Post', $domain ),
						'view' => __( 'View Portfolio', $domain ),
						'view_item' => __( 'View Portfolio Post', $domain ),
						'search_items' => __( 'Search Portfolio Posts', $domain ),
						'not_found' => __( 'No portfolio posts found', $domain ),
						'not_found_in_trash' => __( 'No portfolio posts in Trash', $domain ),
						'parent' => __( 'Parent Portfolio', $domain ),
					),
					'public' => true,
					'menu_position' => 5,
					'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', $portfolio_comments ),
					'rewrite' =>  array( 'slug' => $portfolio_slug, 'with_front' => false )
				)
			);
			register_taxonomy('jw_portfolio_categories', 'jw_portfolio', array( 'label' => 'Categories', 'hierarchical' => true));
			register_taxonomy('jw_portfolio_tags', 'jw_portfolio', array( 'label' => 'Tags', 'hierarchical' => false));
			
			/* Testimonials */
			register_post_type( 'jw_testimonials',
				array(
					'labels' => array(
						'name' => __( 'Testimonials', $domain ),
						'singular_name' => __( 'Testimonial', $domain ),
						'add_new' => __( 'Add New', $domain ),
						'add_new_item' => __( 'Add New Testimonial', $domain ),
						'edit' => __( 'Edit', $domain ),
						'edit_item' => __( 'Edit Testimonial', $domain ),
						'new_item' => __( 'New Testimonial Post', $domain ),
						'view' => __( 'View Testimonials', $domain ),
						'view_item' => __( 'View Testmonial', $domain ),
						'search_items' => __( 'Search Testimonials', $domain ),
						'not_found' => __( 'No testimonial found', $domain ),
						'not_found_in_trash' => __( 'No testimonial in Trash', $domain ),
						'parent' => __( 'Parent Testimonial', $domain ),
					),
					'public' => true,
					'menu_position' => 5,
					'supports' => array( 'title', 'custom-fields' ),
					'rewrite' =>  array( 'slug' => 'testimonial-view', 'with_front' => false ),
					'exclude_from_search' => true
				)
			);
			register_taxonomy('jw_testimonials_categories', 'jw_testimonials', array( 'label' => 'Categories', 'hierarchical' => true));
	
	} /* jw_register_post_types() END */
	
?>