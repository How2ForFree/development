<?php

///////////////////////////////////////////////////////////////
// 
//	Youtube
//
///////////////////////////////////////////////////////////////

add_shortcode('youtube', 'youtube_shortcode');
function youtube_shortcode($atts, $content = null)
{
	$link = substr($atts[0], 1);
	$out = '
	<object width="425" height="355">
	  <param name="movie" value="'.$link.'"></param>
	  <param name="allowFullScreen" value="true"></param>
	  <embed src="'.$link.'"
	    type="application/x-shockwave-flash"
	    width="425" height="355" 
	    allowfullscreen="true"></embed>
	</object>
	';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Google video
//
///////////////////////////////////////////////////////////////

add_shortcode('googlevideo', 'googlevideo_shortcode');
function googlevideo_shortcode($atts, $content = null)
{
	$link = substr($atts[0], 1);
	$out = '
	<object width="425" height="355">
	  <param name="movie" value="'.$link.'"></param>
	  <param name="allowFullScreen" value="true"></param>
	  <embed src="'.$link.'"
	    type="application/x-shockwave-flash"
	    width="425" height="355" 
	    allowfullscreen="true"></embed>
	</object>
	';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>