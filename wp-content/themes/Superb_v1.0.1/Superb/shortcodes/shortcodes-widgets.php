<?php

///////////////////////////////////////////////////////////////
// 
//	Twitter
//
///////////////////////////////////////////////////////////////
add_shortcode('twitter', 'uds_twitter');
function uds_twitter($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'user' => '',
		'count' => 5
	), $atts));
	
	$statuses = uds_twitter_statuses($user, $count);
	
	if(is_wp_error($statuses)) {
		return '<p class="error">' . $statuses->get_error_message() . '</p>';
	}
	
	if(!empty($statuses)) {
		$out = '<ul class="uds-twitter-statuses">';
		foreach($statuses as $status) {
			$out .= '<li><span class="text">'.esc_html($status->text).'</span> <span class="time">'.esc_html($status->created_at).' ago</span></li>';
		}
		$out .= '</ul>';
	} else {
		$out = '<p class="info">'.__('There are no statuses to display').'</p>';
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Flickr Photos
//
///////////////////////////////////////////////////////////////
add_shortcode('flickr', 'uds_flickr_public_shortcode');
function uds_flickr_public_shortcode($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'title' => __('Flickr Photo Stream'),
		'id' => '',
		'ids' => '',
		'tags' => '',
		'tagmode' => ''
	), $atts));
	
	$photos = uds_flickr_public($id, $ids, $tags, $tagmode);
	
	if(is_wp_error($photos)) {
		return '<p class="error">' . $photos->get_error_message() . '</p>';
	}
	
	$photos = $photos['items'];
	
	if(!empty($photos)) {
		$out .= "<div class='uds-flickr'>";
		$out .= "<div class='uds-flickr-inner'>";
		$out .= "<h3>$title</h3>";
		foreach($photos as $key => $photo) {
			if($key > 8) break;
			$class = ($key+1) % 3 == 0 ? 'last' : '';
			$out .= "<a href='{$photo['url']}' class='$class uds-flickr-photo' target='_blank'>";
			$out .= "<img src='{$photo['t_url']}' alt='{$photo['title']}' />";
			$out .= "</a>";
		}
		
		$out .= "</div>";
		$out .= "<div class='clear'></div>";
		$out .= "</div>";
	} else {
		$out = '<p class="info">'.__('There are no photos to display').'</p>';
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Recent Posts
//
///////////////////////////////////////////////////////////////
add_shortcode('recent-posts', 'uds_recent_posts');
function uds_recent_posts($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'count' => 5
	), $atts));
	
	$out = uds_render_posts(array(
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => $count
	), $atts, 'uds-recent-posts');
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Popular posts
//
///////////////////////////////////////////////////////////////
add_shortcode('popular-posts', 'uds_popular_posts');
function uds_popular_posts($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'count' => 5
	), $atts));
	
	$out = uds_render_posts(array(
		'orderby' => 'comment_count',
		'order' => 'DESC',
		'posts_per_page' => $count
	), $atts, 'uds-recent-posts');
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Time Popular posts
//
///////////////////////////////////////////////////////////////
// Helper function for time popular posts 
function uds_time_popular_filter_orderby($orderby = '')
{
	$orderby = "comment_count / (TIMESTAMPDIFF(day, post_date, NOW()) + 1) DESC, post_date DESC";
	return $orderby;
}

add_shortcode('time-popular-posts', 'uds_time_popular_posts');
function uds_time_popular_posts($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'count' => 5
	), $atts));
	
	add_filter('posts_orderby', 'uds_time_popular_filter_orderby');
	$posts =  uds_render_posts(array(
		'orderby' => 'comment_count',
		'order' => 'DESC',
		'posts_per_page' => $count
	), $atts, 'uds-recent-posts');
	remove_filter('posts_orderby', 'uds_time_popular_filter_orderby');
	
	return apply_filters('uds_shortcode_out_filter', $posts);
}

?>