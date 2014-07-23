<?php

///////////////////////////////////////////////////////////////
// 
//	Buttons
//
///////////////////////////////////////////////////////////////
add_shortcode('button', 'uds_button');
function uds_button($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'link' => '#',
		'type' => '',
		'align' => '',
		'target' => ''
	), $atts));
	
	$out = '
		<div class="uds-button '.esc_attr($type).' '.esc_attr($align).'">
			<a href="'.esc_attr($link).'" target="'.esc_attr($target).'">' . do_shortcode($content) . '</a>
			<div class="uds-button-right"></div>
		</div>
	';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Boxes
//
///////////////////////////////////////////////////////////////
add_shortcode('box', 'uds_box');
function uds_box($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$out = '<div class="uds-box '.esc_attr($type).'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Dividers
//
///////////////////////////////////////////////////////////////
add_shortcode('divider', 'divider');
function divider($atts)
{
	$out = '<div class="uds-divider"><a href="#">'.__('Top', 'uds-textdomain').'</a></div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Social Buttons
//
///////////////////////////////////////////////////////////////
add_shortcode('social', 'uds_social');
function uds_social($atts, $content = null)
{
	extract(shortcode_atts(array(
		'twitter' => true,
		'facebook' => true
	), $atts));
	
	if($twitter !== true) $twitter = false;
	if($facebook !== true) $facebook = false;
	
	$url = get_permalink();
	if(empty($url)) {
		$url = get_bloginfo('url');
	}
	
	$out = '<div class="uds-social">';
	if($twitter) {
		$out .= '
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-url="'.esc_attr($url).'">Tweet</a>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		';
	}

	if($facebook) {
		$out .= '<iframe src="http://www.facebook.com/plugins/like.php';
		$out .= '?href='.urlencode($url).'&amp;';
		$out .= 'layout=button_count&amp;show_faces=false&amp;width=450';
		$out .= '&amp;action=like&amp;colorscheme=light&amp;height=21" ';
		$out .= 'scrolling="no" frameborder="0" style="border:none; ';
		$out .= 'overflow:hidden; width:450px; height:21px;" ';
		$out .= 'allowTransparency="true"></iframe>';
	}
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Contact
//
///////////////////////////////////////////////////////////////
add_shortcode('contact', 'uds_contact_info');
function uds_contact_info($atts, $content = null)
{
	extract(shortcode_atts(array(
		'name' => '',
		'tel' => '',
		'email' => '',
		'address' => '',
		'address1' => '',
		'address2' => ''
	), $atts));
	
	$out = '<div class="uds-contact-info">';
	if(!empty($name)) {
		$out .= '<span class="name">'.$name.'</span>';
	}
	if(!empty($tel)) {
		$out .= '<span class="tel">'.$tel.'</span>';
	}
	if(!empty($email)) {
		$out .= '<span class="email">'.$email.'</span>';
	}
	if(!empty($address)) {
		$out .= '<span class="address">'.$address;
		if(!empty($address1)) {
			$out .= ' <br  /> '.$address1;
		}
		if(!empty($address2)) {
			$out .= ' <br  /> '.$address2;
		}
		$out .= '</span>';
	}
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>