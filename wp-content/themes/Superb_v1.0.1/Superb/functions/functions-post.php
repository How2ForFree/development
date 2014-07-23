<?php

/**
*	UDS Comment
*	Comment callback, processes single comments using the comment teplate
*
*/
function uds_comment($comment, $args, $depth) 
{
	$GLOBALS['comment'] = $comment;
	include get_template_directory() . "/comment.php";
}

/**
*	UDS Render Posts
*	Renders posts from a custom query object using uds_post()
*	
*	@param array $args Options passed to WP_Query constructor
*	@param array $view_settings View settings passed to uds_post()
*	@param string $class Class for the wrapping DIV
*
*	@return string Processed posts
*/
function uds_render_posts($args, $view_settings, $class = '')
{
	$posts = new WP_Query($args);
	
	$out = '<div class="'.$class.'">';
	while($posts->have_posts()) {
		$posts->the_post();
		$out .= uds_post($view_settings);
	}
	
	$out .= '</div>';
	
	wp_reset_query();
	return $out;
}

/**
*	UDS Post
*	Renders single post in a list of posts (used in index.php and blog shortcodes)
*	
*	@param array $options Options that can affect what is rendered and what's not
*
*	@return string Rendered post
*/
function uds_post($options = array())
{
	// settings
	$defaults = array(
		'count' => 5,
		'thumb' => true,
		'thumb_width' => 240,
		'thumb_height' => 160,
		'title' => true,
		'title_tag' => 'h5',
		'content' => true,
		'date' => true,
		'comment_count' => true,
		'read_more' => true,
		'author' => true
	);
	extract(shortcode_atts($defaults, $options));

	// normalize variables
	foreach($defaults as $key => $value) {
		if(is_bool($value)) {
			$$key = uds_booleize($$key);
		}
	}

	// setup content
	if($content) {
		$setting = get_option('uds-blog-post-length', 'excerpt');
		$content_string = "<div class='post-content'>";
		if(($setting == 'auto' && has_excerpt()) || $setting == 'excerpt'){
			$content_string .= get_the_excerpt();
		} else {
			$content_string .= strip_shortcodes(get_the_content());
		}
		$content_string .= '</div>';
	}
	
	
	$heading = '';
	if($title) {
		$heading = "<$title_tag class='post-heading'><a href='". get_permalink() ."'>". get_the_title() ."</a></$title_tag>";
	}
	

	
	$meta = '';
	if($date || $author || $comment_count) {
		$meta = "
			<p class='meta'>";
			
		$parts = array();
		
		if($date) {
			$parts[] = "<img src='". get_template_directory_uri() . "/images/time.png' class='meta-img' alt='Time' /> " . sprintf(__('Posted on %s', 'uds-textdomain'), get_the_time('j') .", ". get_the_time('M'));
		}
		
		if($author) { 
			$parts[] = "<img src='". get_template_directory_uri() . "/images/author.png' class='meta-img' alt='author' /> " . sprintf(__('Posted by %s', 'uds-textdomain'), get_the_author());
		}
		
		if($comment_count) { 
			$cc = wp_count_comments(get_the_ID());
			$parts[] = "<img src='". get_template_directory_uri() . "/images/comment.png' class='meta-img' alt='comments' /> " . sprintf(__('%u comments', 'uds-textdomain'), $cc->total_comments);
		}
		
		$meta .= implode(' | ', $parts);
		
		$meta .= "
			</p>
		";
		
	}
	
	$image = '';
	if($thumb) {
		$image = uds_get_post_thumbnail(get_the_ID(), $thumb_width, $thumb_height);
	}
	
	$read_more_string = '';
	if($read_more) {
		$read_more_string = "
			<div class='uds-button default'>
				<a href='". get_permalink() ."'>" . __('Continue reading', 'uds-textdomain') . "</a>
			    <div class='uds-button-right'></div>
			</div>
		";
	}
	
	$pages = '';
	if(($setting == 'auto' && !has_excerpt()) || ($setting != 'excerpt')) {
		$pages = wp_link_pages(array(
	    	'before'			=> '<p class="center" id="post-pager">',
	    	'after'				=> '</p>',
	    	'link_before'		=> ' ',
	    	'link_after'		=> ' ',
	    	'next_or_number'	=> 'number',
	    	'nextpagelink'		=> __('Next page &raquo;', 'uds-textdomain'),
	    	'previouspagelink'	=> __('&laquo; Previous page', 'uds-textdomain'),
	    	'pagelink'			=> '%',
	    	'more_file'			=> '',
	    	'echo'				=> 0 )
	    );
	}
	
	$out ="
		<div id='post-". get_the_ID() ."' class='". implode(' ', get_post_class('')) ."'>
		<div class='heading-meta'>
			$heading
			$meta
		</div>	
			<div class='post-except-img'>
				$image
				$content_string
			</div>
			$read_more_string
			$pages
			<div class='clear'></div>
		</div>
	";
	
	return $out;
}

?>