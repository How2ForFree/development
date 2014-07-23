<?php
///////////////////////////////////////////////////////////////
//
//	Custom layout shortcodes
//
///////////////////////////////////////////////////////////////

$fourths = 0;
$fifths = 0;
$sixths = 0;

// Thirds
add_shortcode('third', 'third');
function third($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths % 2 != 0 || $fifths != 0 || $sixths > 4){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$sixths += 2;

	if($content == null) return '';
	
	$class = 'layout-third';

	if($sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($sixths == 6){
		$out .= '<div class="clear"></div>';
		$sixths = 0;
		$fourths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

// Two Thirds
add_shortcode('two-thirds', 'two_thirds');
function two_thirds($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths != 0 || $fifths != 0 ||  $sixths > 2){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$sixths += 4;

	if($content == null) return '';
	
	$class = 'layout-two-thirds';
	
	if($sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($sixths == 6){
		$out .= '<div class="clear"></div>';
		$sixths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////

// Halves
add_shortcode('half', 'half');
function half($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fifths != 0 || $fourths > 2 || $sixths > 3){
		$sixths = 0;
		$fourths = 0;
		$fifths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths += 2;
	$sixths += 3;

	if($content == null) return '';
	
	$class = 'layout-half';
	
	if($fourths == 4 || $sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4 || $sixths == 6){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
		$sixths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

// Fourths
add_shortcode('fourth', 'fourth');
function fourth($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($sixths % 3 != 0 || $fifths != 0){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths++;

	if($content == null) return '';
	
	$class = 'layout-fourth';
	
	if($fourths == 4) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
		$sixths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

// Three Fourths
add_shortcode('three-fourths', 'three_fourths');
function three_fourths($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($sixths != 0 || $fourths > 1 || $fifths != 0){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fourths += 3;

	if($content == null) return '';
	
	$class = 'layout-three-fourths';
	
	if($fourths == 4) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fourths == 4){
		$out .= '<div class="clear"></div>';
		$fourths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////

// Fifths
add_shortcode('fifth', 'fifth');
function fifth($atts, $content = null)
{
	global $thirds, $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths != 0){
		$thirds = 0;
		$fourths = 0;
		$fifths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fifths++;

	if($content == null) return '';
	
	$class = 'layout-fifth';
	
	if($fifths == 5) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fifths == 5){
		$out .= '<div class="clear"></div>';
		$fifths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('two-fifths', 'two_fifths');
function two_fifths($atts, $content = null)
{
	global $thirds, $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths != 0 || $fifths > 3){
		$thirds = 0;
		$fourths = 0;
		$fifths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fifths += 2;

	if($content == null) return '';
	
	$class = 'layout-two-fifths';
	
	if($fifths == 5) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fifths == 5){
		$out .= '<div class="clear"></div>';
		$fifths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('three-fifths', 'three_fifths');
function three_fifths($atts, $content = null)
{
	global $thirds, $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths != 0 || $fifths > 2){
		$thirds = 0;
		$fourths = 0;
		$fifths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fifths += 3;

	if($content == null) return '';
	
	$class = 'layout-three-fifths';
	
	if($fifths == 5) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fifths == 5){
		$out .= '<div class="clear"></div>';
		$fifths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('four-fifths', 'four_fifths');
function four_fifths($atts, $content = null)
{
	global $thirds, $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($thirds != 0 || $fourths != 0 || $fifths > 1){
		$thirds = 0;
		$fourths = 0;
		$fifths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$fifths += 4;

	if($content == null) return '';
	
	$class = 'layout-four-fifths';
	
	if($fifths == 5) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($fifths == 5){
		$out .= '<div class="clear"></div>';
		$fifths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////

// Sixths
add_shortcode('sixth', 'sixth');
function sixth($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths % 2 != 0 || $fifths != 0 || $sixths > 5){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$sixths++;

	if($content == null) return '';
	
	$class = 'layout-sixth';

	if($sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($sixths == 6){
		$out .= '<div class="clear"></div>';
		$sixths = 0;
		$fourths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('four-sixths', 'four_sixths');
function four_sixths($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths != 0 || $fifths != 0 || $sixths > 2){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$sixths += 4;

	if($content == null) return '';
	
	$class = 'layout-four-sixths';

	if($sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($sixths == 6){
		$out .= '<div class="clear"></div>';
		$sixths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('five-sixths', 'five_sixths');
function five_sixths($atts, $content = null)
{
	global $fourths, $fifths, $sixths;
	
	// check if an incompatible layout combination isn't in progress
	$out = '';
	if($fourths != 0 || $fifths != 0 || $sixths > 1){
		$fourths = 0;
		$fifths = 0;
		$sixths = 0;
		$out = '<div class="clear"></div>';
	}
	
	$sixths += 5;

	if($content == null) return '';
	
	$class = 'layout-five-sixths';

	if($sixths == 6) $class .= ' layout-last';
	
	$out .= '<div class="'.$class.'">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	if($sixths == 6){
		$out .= '<div class="clear"></div>';
		$sixths = 0;
	}
	
	return apply_filters('uds_shortcode_out_filter', $out);
}
?>