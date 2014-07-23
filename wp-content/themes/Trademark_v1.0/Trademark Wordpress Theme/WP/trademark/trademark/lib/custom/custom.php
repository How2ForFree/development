<?php
/**
 * Get most popular posts
 *
 * @param int $limit Number of displayed posts
 * @return string List of posts
 */
function get_popular_posts ( $limit = 5 ) {
	$sql = "SELECT id, post_title FROM {$wpdb->prefix}posts ORDER BY comment_count DESC LIMIT 0, $limit";
	$popular_posts = $wpdb->get_results($sql);
	
	$output = '<ul class="popular-posts">';
	foreach ( $popular_posts as $post )
		$output = '<li><a href="' . get_permalink( $post->id ) . '">' . $post->post_title . '</a></li>';	
	
	$output = '</ul>';
	
	return $output; 
}

/**
 * Prints better page title
 */
function perfect_title ($sep = '|') {
	echo '<title>';
	
	if ( function_exists( 'is_tag' ) && is_tag() ) {
		single_tag_title( __('Tag Archive for') . '&quot;' ); 
		$output .= '&quot; ' . $sep; 
	} 
	elseif ( is_archive() ) {
		wp_title( '' ); 
		echo __('Archive') . ' ' . $sep . ' '; 
	} 
	elseif ( is_search() ) {
		echo __('Search for') . ' &quot;' . esc_html( $_GET['s'] ) . '&quot; ' . $sep . ' '; 
	} 
	elseif ( !( is_404() ) && ( (is_single() ) || ( is_page()) && ! is_front_page() ) ) {
		wp_title( '' ); 
		echo ' ' . $sep . ' '; 
	} 
	elseif ( is_404() ) {
		echo __('Not Found') . $sep;
	} 
	elseif ( is_home() ) {
	   echo __('Blog') . ' ' . $sep . ' ';
	}
	
	if (is_front_page()) {
		bloginfo( 'description' );
		echo ' ' . $sep . ' '; 		
        bloginfo( 'name' ); 
    } 
	else {
		bloginfo('name');
	} 
	
	if ($paged > 1) {
		echo ' ' . $sep . ' ' . __('page') . ' ' . $paged;
	}
	
	echo '</title>';	
}

/**
 * Process better link
 */
function link_to ( $link = null) {
    if ( $link == null ) return;

    if ( strpos($link, 'http://') !== false) {
        return $link;
    }
    elseif ( strpos($link, '/') == 0  ) {
        return get_option( 'siteurl' ) . $link;
    }
    else {
        return get_option( 'siteurl' ) . '/' . $link;
    }
}

/**
 * Parse YAML admin options
 */
function get_yaml_options ( $filename ) {
    if ( empty( $filename ) ) return;
	$dir = dirname(__FILE__) . '/../../files/conf/' . $filename; 
	$options = sfYaml::load($dir);
	    
    return $options;
}

function strip_string ( $string, $limit, $end = '...' ) {
    if ( empty( $limit ) || empty( $string ) ) return;
    
    $my_text = substr( $string, 0, $limit );
    $pos = strrpos( $my_text, ' ' ); 
    $my_post_text = substr( $my_text, 0, ( $pos ? $pos : -1 ) ) . $end;
    $result = strip_tags( $my_post_text );
    
    return $result;
}

function make_seo_title($str)
{
	// html decode, in case it is coming encoded (AJAX request)
	$seo_title = rawurldecode($str);
	// some characters that might create trouble
	$switch_chars = '(,),\,/';
	$sc = explode(',', $switch_chars);
	foreach ($sc as $c) $seo_title = str_replace($c, '-', $seo_title);
	// leave only alphanumeric characters and replace spaces with hyphens
	$seo_title = strtolower(str_replace('--', '-', preg_replace('/[\s]/', '-', preg_replace('/[^[:alnum:]\s-]+/', '', $str))));
	$len = strlen($seo_title);
	if ($seo_title[$len - 1] == '-') $seo_title = substr($seo_title, 0, -1);
	if ($seo_title[0] == '-') $seo_title = substr($seo_title, 1, $len);
	return $seo_title;
}
