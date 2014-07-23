<?php

if(!function_exists('d')) {
	/**
	 *	d
	 *	d is a helper debugging function, it pretty prints the variable given to it
	 *
	 *	@param mixed $d variable to be pretty-printed
	 *
	 */
	function d($d)
	{
		echo "<pre>";
		var_dump($d);
		echo "</pre>";
	}
}

/**
 *	Get First Image
 *	Returns the URL of the first image in the current post, if there is none, it 
 *	returns the URL of a default image
 *
 *	@return string URL of the first image in the current post
 */
function get_first_image()
{
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
	if(empty($first_img)){ //Defines a default image
		$first_img = get_template_directory_uri()."/images/portfolio-default.jpg";
	}
	return $first_img;
}

/**
 *	UDS Booleize
 *	Converts strings like "False" or "No" to boolean
 *
 *	@param mixed $var variable to booleize
 *	
 *	@return bool Booleized $var
 */
function uds_booleize($var)
{
	if(is_string($var)) 
		$var = strtolower($var);
	
	if(is_bool($var)) return $var;
	if($var == 'false') return false;
	if($var == 'true') return true;
	if($var == 'no') return false;
	if($var == 'yes') return true;
	
	return $var;
}

/**
 *	UDS Get Post Thumbnail
 *	Returns the post-thumbnail as an image element (usful for portfolio and the like,
 *	uses TimThumb to resize the image if necessary
 *
 *	@param int $id post ID
 *	@param int $width Resize the thumbnail to this width
 *	@param int $height Resize the thumbnail to this height
 *	@param bool $zc Zoom/Crop 0=false=Zoom, 1=true=Crop
 *	@param int $q 0-100 JPEG compression quality
 *
 *	@return string Final timthumb image element
 */
function uds_get_post_thumbnail($id, $width, $height, $zc = 0, $q = 80)
{
	if(!has_post_thumbnail($id)) return;
	
	$dir = get_template_directory_uri();
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
	$thumb = str_replace(get_bloginfo('url') . '/wp-content/', '', $thumb);
	$thumb = urlencode($thumb[0]);
	return "<img src=\"$dir/timthumb.php?src=$thumb&amp;w=$width&amp;h=$height&amp;zc=$zc&amp;q=$q\" class=\"attachment-post-thumbnail\" alt=\"\" />";
}

/**
 *	UDS The Post Thumbnail
 *	Echoes the post-thumbnail as an image element. This uses the uds_get_post_thumbnail()
 *
 *	@param int $id post ID
 *	@param int $width Resize the thumbnail to this width
 *	@param int $height Resize the thumbnail to this height
 *	@param bool $zc Zoom/Crop 0=false=Zoom, 1=true=Crop
 *	@param int $q 0-100 JPEG compression quality
 *
 *	@return string Final timthumb image element
 */
function uds_the_post_thumbnail($id, $width, $height, $zc = 0, $q = 80)
{
	echo uds_get_post_thumbnail($id, $width, $height, $zc, $q);
}

/**
 *	Is Ajax
 *	Simple tag that detects if the current request is an AJAX Call
 *
 *	@return bool True if current page has been requested via AJAX
 */
function is_ajax()
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

/**
 *	Breadcrumbs template tag
 *	Handles all pages,posts,categories and portfolio. Echoes its content
 *
 */
function the_breadcrumbs()
{
	global $post;
	
	if(is_front_page()) return;
	
	$sep = esc_html(get_option('uds-breadcrumb-separator', '/'));
	
	echo "<div class='breadcrumbs'>";
	echo "<a href='".get_bloginfo('url')."'>".__('Home', 'uds-textdomain')."</a>";
	if(is_page()){
		$ancestors = get_post_ancestors($post->ID);
		if(!empty($ancestors)){
			$ancestors = array_reverse($ancestors);
			foreach($ancestors as $ancestor){
				if(get_permalink($ancestor) == get_bloginfo('url')) continue;
				echo " $sep <a href='".get_permalink($ancestor)."'>".get_the_title($ancestor).'</a>';
			}
		}
		if( ! is_front_page()) echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	} elseif(get_post_type() == 'portfolio') {
		echo $sep . ' ' . __("Portfolio", 'uds-textdomain');
		echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	} elseif(is_home()) {
		echo " $sep <a href='".get_permalink(get_option('page_for_posts'))."'>".__('Blog', 'uds-textdomain')."</a>";
	} elseif(is_search()) {
		echo " $sep <a href='#'>".__('Search', 'uds-textdomain')."</a>";
	} elseif(is_404()) {
		echo " $sep <a href='#'>".__('404 Not Found', 'uds-textdomain')."</a>";
	} else {
		echo " $sep <a href='".get_permalink(get_option('page_for_posts'))."'>".__('Blog', 'uds-textdomain')."</a>";
		//the_category(', ');
		echo " $sep <a href='".get_permalink()."'>".get_the_title().'</a>';
	}
	
	echo "</div>";
}

if(!function_exists('uds_active_shortcodes')) {
	/**
	 *	UDS Active Shortcodes
	 *	List all shortcodes that are in use on current page (this does not include widgets
	 *	Useful to detect usage of a shortcode and include appropriate JS/CSS
	 *
	 *	@return array Flat list of active shortcodes (names only)
	 */
	function uds_active_shortcodes()
	{
		global $posts;
		static $list = null;
		
		if($list !== null) return $list;
		
		if(empty($posts[0])) return array();
		
		$list = array_unique(_uds_active_shortcodes_helper($posts[0]->post_content));
	
		return $list;
	}
}

if(!function_exists('_uds_active_shortcodes_helper')) {
	/**
	 *	UDS Active SHortcodes Helper
	 *	Used to recursively parse the current post, ensuring that all nested shortcodes
	 *	are found as well
	 *
	 *	@param string $haystack The content string that will be recursively searched for shortcodes
	 *	
	 *	@return array List of all found shortcodes
	 */
	function _uds_active_shortcodes_helper($haystack)
	{
		$ret = array();
		$pattern = get_shortcode_regex();
		
		preg_match_all('/'.$pattern.'/s', $haystack, $matches);
	
		if(is_array($matches[5]) && !empty($matches[5])) {
			foreach($matches[5] as $match) {
				$ret = array_merge($ret, _uds_active_shortcodes_helper($match));
			}
		}
	
		if(!empty($matches[2])) {
			$ret = array_merge($ret, $matches[2]);
		}
		
		return $ret;
	}
}

/**
 *	Publish Later On Feed
 *	Will edit the SQL WHERE condition in order to delay post publication on Feed.
 *	This will give you time to proof read your post before people see it
 *
 *	@param string $where Origina WHERE condition
 *
 *	@return string Updated WHERE condition
 */
function publish_later_on_feed($where)
{
	global $wpdb;

	if ( is_feed() ) {
		// timestamp in WP-format
		$now = gmdate('Y-m-d H:i:s');

		// value for wait; + device
		$wait = '30'; // integer

		// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
		$device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

		// add SQL-sytax to default $where
		$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	}
	return $where;
}
add_filter('posts_where', 'publish_later_on_feed');

/**
 *	We need to create a div element for the right side of our current menu item
 */
class UDS_Menu_Walker extends Walker_Nav_Menu
{
	function end_el(&$output, $item, $depth)
	{
		global $post;
		
		if($depth == 0 && is_array($item->classes) && (in_array('current-menu-item', $item->classes) || in_array('current_page_parent', $item->classes))) {
			$output .= "<span class='current-menu-item-right'></span>\n";
		}
		
		parent::end_el($output, $item, $depth);
	}
}

/**
 *	Reads image from $src and multiplies it by color specified by $r, $g and $b, honoring original image alpha
 *	Then it writes the image to $dst
 *
 *	@param string $src source image path
 *	@param string $dst destinations image path
 *	@param int $r Red component of the multiply color (0-255)
 *	@param int $g Green component of the multiply color (0-255)
 *	@param int $b Blue component of the multiply color (0-255)
 */
function uds_colorize_image($src, $dst, $r, $g, $b)
{
	$img = imagecreatefrompng($src);
	
	$width = imagesx($img);
	$height = imagesy($img);
	for($y = 0; $y < $height; $y++) {
		for($x = 0; $x < $width; $x++) {
			$rgb = imagecolorat($img, $x, $y);
			$rgb = imagecolorsforindex($img, $rgb);
			
			$fr = (int) ((($r/255) * ($rgb['red']/255)) * 255);
			$fg = (int) ((($g/255) * ($rgb['green']/255)) * 255);
			$fb = (int) ((($b/255) * ($rgb['blue']/255)) * 255);
			
			$color = imagecolorallocatealpha($img, $fr, $fg, $fb, $rgb['alpha']);
			
			imagesetpixel($img, $x, $y, $color);
		}
	}
	
	imagesavealpha($img, true);
	imagepng($img, $dst);
}

/**
 *	Clamps $value to the limits, returning the limit value if $value exceeds the limit
 *	
 *	@param int|float $value value to clamp
 *	@param int|float $lower_limit
 *	@param int|float $upper_limit
 *	@return $val
 */
function uds_constrain($value, $lower_limit, $upper_limit) 
{
	if($value > $upper_limit) return $upper_limit;
	if($value < $lower_limit) return $lower_limit;
	return $value;
}

/**
 *	Lightens a color $color 
 *	
 *	@param string $color HTML color without the hash (e.g. 000000)
 *	@param int|float $lower_limit
 *	@param int|float $upper_limit
 *
 *	@return string HTML color without the leading hash
 */
function uds_lighten($color, $amount = 5)
{
	$r = hexdec(substr($color, 0, 2));
	$g = hexdec(substr($color, 2, 2));
	$b = hexdec(substr($color, 4, 2));
	
	$out  = str_pad(dechex(uds_constrain($r + $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	$out .= str_pad(dechex(uds_constrain($g + $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	$out .= str_pad(dechex(uds_constrain($b + $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	
	return $out;
}

/**
 *	Darkens a color $color 
 *	
 *	@param string $color HTML color without the hash (e.g. 000000)
 *	@param int|float $lower_limit
 *	@param int|float $upper_limit
 *
 *	@return string HTML color without the leading hash
 */
function uds_darken($color, $amount = 5)
{
	$r = hexdec(substr($color, 0, 2));
	$g = hexdec(substr($color, 2, 2));
	$b = hexdec(substr($color, 4, 2));
	
	$out  = str_pad(dechex(uds_constrain($r - $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	$out .= str_pad(dechex(uds_constrain($g - $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	$out .= str_pad(dechex(uds_constrain($b - $amount, 0, 255)), 2, '0', STR_PAD_LEFT);
	
	return $out;
}
?>