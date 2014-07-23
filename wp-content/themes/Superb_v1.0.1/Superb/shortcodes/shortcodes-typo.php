<?php

///////////////////////////////////////////////////////////////
// 
//	Pullquotes
//
///////////////////////////////////////////////////////////////
add_shortcode('pullquote', 'uds_pullquote');
function uds_pullquote($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'align' => '',
		'cite' => ''
	), $atts));
	
	$out = '<blockquote class="uds-pullquote '.esc_attr($align).'">';
	$out .= '<div class="content">' . $content . '</div>';
	if(!empty($cite)) $out .= '<div class="cite">' . esc_html($cite) . '</div>';
	$out .= '</blockquote>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Dropcaps
//
///////////////////////////////////////////////////////////////
add_shortcode('dropcap', 'uds_dropcap');
function uds_dropcap($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$out = '<span class="uds-dropcap '.esc_attr($type).'">';
	$out .= esc_html($content);
	$out .= '</span>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Pre
//
///////////////////////////////////////////////////////////////
add_shortcode('pre', 'uds_pre');
function uds_pre($atts, $content = null)
{
	if($content == null) return '';
	
	$out = '<pre class="uds-pre">';
	$out .= $content;
	$out .= '</pre>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Code
//
///////////////////////////////////////////////////////////////
add_shortcode('code', 'uds_code');
function uds_code($atts, $content = null)
{
	if($content == null) return '';
	
	$out = '<code class="uds-code">';
	$out .= $content;
	$out .= '</code>';
	
	return $out;
}

///////////////////////////////////////////////////////////////
// 
//	List styles
//
///////////////////////////////////////////////////////////////
add_shortcode('list', 'uds_list');
function uds_list($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$out = '<div class="uds-list '.esc_attr($type).'">';
	$out .= $content;
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Icon
//
///////////////////////////////////////////////////////////////
add_shortcode('icon', 'uds_icon');
function uds_icon($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'type' => '',
		'href' => '',
		'color' => 'black'
	), $atts));
	
	if(empty($href)) {
		$out = '<span class="uds-icon '.esc_attr($type).' '.esc_attr($color).'">';
		$out .= $content;
		$out .= '</span>';
	} else {
		$out = '<a href="' . esc_url($href) . '" class="uds-icon '.esc_attr($type).' '.esc_attr($color).'">';
		$out .= $content;
		$out .= '</a>';
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Highlight
//
///////////////////////////////////////////////////////////////
add_shortcode('highlight', 'uds_highlight');
function uds_highlight($atts, $content = '')
{	
	extract(shortcode_atts(array(
		'color' => 'black',
		'background' => '#08C'
	), $atts));
	
	$out = '<span class="highlight" style="color:'.esc_attr($color).';background-color:'.esc_attr($background).';">'.$content.'</span>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Clear
//
///////////////////////////////////////////////////////////////
add_shortcode('clear', 'uds_clear');
function uds_clear($atts)
{
	$out = '<div class="clear"></div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	BR
//
///////////////////////////////////////////////////////////////
add_shortcode('br', 'uds_br');
function uds_br($atts)
{
	$out = '<br  />';
	
	return $out;
}
?>