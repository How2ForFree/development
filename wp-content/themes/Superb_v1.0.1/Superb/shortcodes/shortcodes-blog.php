<?php

///////////////////////////////////////////////////////////////
// 
//	Blog
//
///////////////////////////////////////////////////////////////
add_shortcode('posts', 'uds_posts');
function uds_posts($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'count' => 5
	), $atts));
	
	$out = uds_render_posts(array(
		'posts_per_page' => $count
	), $atts, 'uds-posts');
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Sitemap
//
///////////////////////////////////////////////////////////////
add_shortcode('sitemap', 'uds_sitemap');
function uds_sitemap($atts, $content = '')
{
	global $wp_query;
	
	extract(shortcode_atts(array(
		'type'				=> 'all',
		'depth'				=> '0',
		'child_of'			=> '0',
		'show_date' 		=> '',
		'number'			=> '',
		'post_order'		=> 'postbypost',
		'show_post_count'	=> '0',
		'feed'				=> ''
	), $atts));
	
	$out = '';
	
	$show_date_options = array('', 'modified', 'created');
	
	if($type == 'all' || $type == 'pages') {
		$out .= '<h3>' . __('Pages', 'uds-textdomain') . '</h3>';
		$out .= '<ul>';
		$out .= wp_list_pages(array(
			'depth'			=> (int)$depth,
			'show_date'		=> in_array($show_date, $show_date_options) ? $show_date : '',
			'date_format'	=> get_option('date_format'),
			'child_of'		=> (int)$child_of,
			'exclude'		=> '',
			'include'		=> '',
			'title_li'		=> '',
			'echo'			=> 0,
			'authors'		=> '',
			'sort_column'	=> 'menu_order, post_title',
			'link_before'	=> '',
			'link_after'	=> '',
			'number'		=> $number,
			'walker'		=> '' 
		));
		$out .= '</ul>';
	}
	
	$post_orders = array('yearly', 'monthly', 'daily', 'weekly', 'postbypost', 'alpha');
	
	if($type == 'all' || $type == 'posts') {
		if($type == 'all') $out .= '</br>';
		$out .= '<h3>' . __('Posts', 'uds-textdomain') . '</h3>';
		$out .= '<ul>';
		$out .= wp_get_archives(array(
		    'type'				=> in_array($post_order, $post_orders) ? $post_order : 'postbypost',
		    'limit'				=> $number,
		    'format'			=> 'html', 
		    'before'			=> '',
		    'after'				=> '',
		    'show_post_count'	=> (int)$show_post_count,
		    'echo'				=> 0
    	));
		$out .= '</ul>';
	}
	
	if($type == 'all' || $type == 'categories') {
		if($type == 'all') $out .= '</br>';
		$out .= '<h3>' . __('Categories', 'uds-textdomain') . '</h3>';
		$out .= '<ul>';
		$out .= wp_list_categories(array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'show_last_update'   => 0,
			'style'              => 'list',
			'show_count'         => (int)$show_post_count,
			'hide_empty'         => 1,
			'use_desc_for_title' => 1,
			'child_of'           => (int)$child_of,
			'feed'               => $feed,
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => true,
			'title_li'           => '',
			'number'             => $number,
			'echo'               => 0,
			'depth'              => (int)$depth,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'walker'             => 'Walker_Category'
		));
		$out .= '</ul>';
	}
	
	if($type == 'all' || $type == 'uds-posrtfolio') {
		if($type == 'all') $out .= '</br>';
		
		$out .= '<h3>' . __('Portfolio', 'uds-textdomain') . '</h3>';
		
		$temp = $wp_query;
		
		$wp_query = new WP_Query(array(
			'post_type' => 'uds-portfolio',
			'posts_per_page' => -1
		));
		
		$out .= '<ul>';
		foreach($wp_query->posts as $key => $post) {
			$out .= '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
		}
		
		$wp_query = $temp;
		
		$out .= '</ul>';
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>