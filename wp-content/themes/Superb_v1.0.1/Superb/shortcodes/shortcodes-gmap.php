<?php

///////////////////////////////////////////////////////////////
// 
//	Google Map
//
///////////////////////////////////////////////////////////////

add_shortcode('gmap', 'uds_google_map');
function uds_google_map($atts, $content = null)
{
	extract(shortcode_atts(array(
		'lat' => '51.507222',
		'lng' => '-0.1275',
		'zoom' => '13',
		'type' => 'HYBRID',
		'width' => '100%',
		'height' => '300px',
		'marker' => 'true',
		'wheel' => 'true',
		'scale_control' => 'true',
		'map_type_control' => 'true',
		'navigation_control' => 'true',
		'street_view_control' => 'true'
	), $atts));
	
	$supported_options = array(
		'lat' => 'lat', 
		'lng' => 'lng',
		'zoom' => 'zoom',
		'type' => 'mapTypeId',
		'width' => 'width',
		'height' => 'height',
		'marker' => 'marker',
		'wheel' => 'wheel',
		'scale_control' => 'scaleControl',
		'map_type_control' => 'mapTypeControl',
		'navigation_control' => 'navigationControl',
		'street_view_control' => 'streetViewControl'
	);
	
	// normalize the Map Type
	$type = strtoupper($type);
	if(!in_array($type, array('ROADMAP', 'HYBRID', 'SATELLITE', 'TERRAIN'))) {
		$type = 'HYBRID';
	}
	
	$options = '';
	foreach($supported_options as $key => $option) {
		$options .= '<span class="'.esc_attr($option).'">'.esc_html($$key).'</span>';
	}

	if(!empty($content)) {
		$content = esc_html($content);
		$options .= "<div class='marker-content'>$content</div>";
	}

	$out = '<div class="uds-google-map">';
	$out .= $options;
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>