<?php

$uds_tab_mode = null;

///////////////////////////////////////////////////////////////
// 
//	Tabs
//
///////////////////////////////////////////////////////////////
$uds_tabs = $uds_panes = array();

add_shortcode('tabs', 'uds_tabs');
function uds_tabs($atts, $content = null)
{
	global $uds_tab_mode, $uds_tabs, $uds_panes;
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => ''
	), $atts));
	
	$uds_tab_mode = 'tabs';
	do_shortcode($content);
	$uds_tab_mode = null;
	
	$out = '<div class="uds-tabs-wrapper '.esc_attr($type).'">';
	
	$out .= '<ul class="uds-tabs">';
	foreach($uds_tabs as $tab) {
		$out .= $tab;
	}
	$out .= '</ul>';
	
	$out .= '<div class="uds-panes">';
	foreach($uds_panes as $pane) {
		$out .= $pane;
	}
	$out .= '</div>';
	
	$out .= '</div>';
	
	$uds_tabs = $uds_panes = array();
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('tab', 'uds_tab');
function uds_tab($atts, $content = null)
{
	global $uds_tab_mode, $uds_tabs, $uds_panes;
	if($uds_tab_mode === null) return '';
	
	extract(shortcode_atts(array(
		'title' => '',
		'href' => '#'
	), $atts));
	
	if($uds_tab_mode == 'tabs') {
		$uds_tabs[] = '<li><a href="'.esc_attr($href).'">'.esc_html($title).'</a></li>';
		$uds_panes[] = '<div>' . do_shortcode($content) . '</div>';
	} elseif($uds_tab_mode == 'accordion') {
		$out = '<h2>'.esc_html($title).'</h2>';
		$out .= '<div class="pane">' . do_shortcode($content) . '</div>';
		return apply_filters('uds_shortcode_out_filter', $out);
	}
}


///////////////////////////////////////////////////////////////
// 
//	Accordion
//
///////////////////////////////////////////////////////////////
$accordion = array();

add_shortcode('accordion', 'uds_accordion');
function uds_accordion($atts, $content = null)
{
	global $uds_tab_mode, $uds_tabs, $uds_panes;
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'type' => '',
		'align' => ''
	), $atts));
	
	$out = '<div class="uds-accordion-wrapper '.esc_attr($type).' '.esc_attr($align).'">';
	
	$uds_tab_mode = 'accordion';
	$out .= do_shortcode($content);
	$uds_tab_mode = null;
	
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Toggle
//
///////////////////////////////////////////////////////////////

add_shortcode('toggle', 'uds_toggle');
function uds_toggle($atts, $content = null)
{
	if($content == null) return '';
	
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));
	
	$out = '<div class="uds-toggler">'.esc_html($title).'</div>';
	$out .= '<div class="uds-toggle">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Lightbox
//	Usage:
//		[lightbox small="_IMAGE_URL_" full="_IMAGE_URL_"]
//		[lightbox full="_IMAGE_URL_" autothumb="true"]
//		[lightbox small="_IMAGE_URL_"]Your lightbox content[/lightbox]
//		[lightbox small="_IMAGE_URL_" full="_IMAGE_URL_" group="GROUP1" title="My title"]
//
///////////////////////////////////////////////////////////////

add_shortcode('lightbox', 'uds_lightbox');
function uds_lightbox($atts, $content = null)
{
	static $id = 0;
	
	extract(shortcode_atts(array(
		'small' => '',
		'full' => '',
		'group' => '',
		'title' => '',
		'align' => '',
		'autothumb' => false
	), $atts));
	
	if($autothumb == 'true') {
		$dir = get_template_directory_uri();
		$thumb = urlencode($full);
		$small = "$dir/timthumb.php?src=$thumb&amp;w=160&amp;zc=1&amp;q=80";
	}

	if(!empty($content)) {
		$href = '#uds-fancybox-details-' . $id;
		$align = esc_attr($align);
		$content = esc_attr($content);
		$content = "
			<div class='fancybox-inline $align'>
				<div class='details' id='uds-fancybox-details-$id'>
					$content
				</div>
			</div>
		";
	} else {
		$href = $full;
		$content = '';
	}
	
	$out = "
		<a href='".esc_url($href)."' rel='".esc_attr($group)."' title='".esc_attr($title)."' class='fancybox ".esc_attr($align)."'>
			<img src='".esc_url($small)."' alt='' />
		</a>
		".esc_html($content)."
	";
	
	$id++;
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

///////////////////////////////////////////////////////////////
// 
//	Tour
//	Usage:
//		[tour layout="full"]
//			[tour-page title="Title 1"]Content 1[/tour-page]
//			[tour-page title="Title 2"]Content 2[/tour-page]
//			[tour-page title="Title 3"]Content 3[/tour-page]
//		[/tour]
//
///////////////////////////////////////////////////////////////
$tour_titles = array();
add_shortcode('tour', 'uds_tour');
function uds_tour($atts, $content = null)
{
	global $tour_titles;
	extract(shortcode_atts(array(
		'layout' => 'sidebar'
	), $atts));
	
	if($layout != 'full' && $layout != 'sidebar') {
		$layout = 'sidebar';
	}
	
	$tour_titles = array();
	
	$content = do_shortcode($content);
	
	$titles = '';
	foreach($tour_titles as $title) {
		$titles .= "<li>".esc_html($title)."</li>";
	}
	$tour_titles = array();
	
	$out = "
		<ul class='uds-tour-status ".esc_attr($layout)."'>
			$titles
		</ul>
		<div class='uds-tour ".esc_attr($layout)."'>
			<div class='pages'>
				$content
			</div>
		</div>
	";
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

add_shortcode('tour_page', 'uds_tour_page');
function uds_tour_page($atts, $content = null)
{	
	global $tour_titles;
	if($content == null) return;
	
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));
	
	$tour_titles[] = $title;
	
	$content = do_shortcode($content);
	
	$out = "
		<div class='page'>$content</div>
	";
	
	return apply_filters('uds_shortcode_out_filter', $out);
}

?>