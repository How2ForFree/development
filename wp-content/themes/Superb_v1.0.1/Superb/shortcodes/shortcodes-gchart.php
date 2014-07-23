<?php

///////////////////////////////////////////////////////////////
// 
//	Google Charts
//
///////////////////////////////////////////////////////////////

$uds_gchart_colors = array(
	'69D2E7',
	'A7DBD8',
	'E0E4CC',
	'F38630',
	'FA6900'
);

add_shortcode('gchart-bar', 'uds_google_chart_bar');
function uds_google_chart_bar($atts, $content = null)
{
	global $uds_gchart_colors;
	extract(shortcode_atts(array(
		'type' => 'bvs',
		'size' => '610x300',
		'colors' => implode('|', $uds_gchart_colors),
		'title' => __('UDS Google Chart', 'uds-textdomain'),
		'background' => 'FAFAFA',
		'data' => '',
		'labels' => '',
		'labels_axes' => 'x,y'
	), $atts));
	
	$atts['cht'] = $type;
	$atts['chs'] = $size;
	$atts['chco'] = $colors;
	$atts['chtt'] = $title;
	$atts['chf'] = "bg,s,$background";
	$atts['chd'] = 't:'.$data;
	$atts['chxt'] = $labels_axes;
	$atts['chxl'] = $labels;

	return uds_google_chart($atts, $content);
}

add_shortcode('gchart', 'uds_google_chart');
function uds_google_chart($atts, $content = null)
{
	$options = array(
		'chbh' => '',
		'chco' => '',
		'chd' => '',
		'chdl' => '',
		'chdlp' => '',
		'chds' => '',
		'chem' => '',
		'chf' => '',
		'chfd' => '',
		'chg' => '',
		'chl' => '',
		'chld' => '',
		'chls' => '',
		'chm' => '',
		'chma' => '',
		'choe' => '',
		'chof' => '',
		'chp' => '',
		'chs' => '',
		'chst' => '',
		'cht' => '',
		'chtm' => '',
		'chtt' => '',
		'chts' => '',
		'chxt' => '',
		'chxr' => '',
		'chxl' => '',
		'chxp' => '',
		'chxs' => '',
		'chxtc' => '',
	);
	
	extract(shortcode_atts($options, $atts));
	
	$chart = "http://chart.apis.google.com/chart?";
	
	$params = array();
	
	foreach($options as $key => $value) {
		if(empty($$key)) continue;
		$params[] = "$key={$$key}";
	}
	
	$chart = esc_attr($chart.implode('&', $params));
	$out = "<img class='uds-gchart' src='$chart' alt='' />";
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>