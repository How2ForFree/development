<?php 

/**
 * P tag removal from shortcodes
 *
 */

function remove_wpautop($content) { 
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}


/**
 * Recent Posts 
 *
 */
function recent_func($atts) {
extract(shortcode_atts(array(
            'class_name'    => 'cat-post',
            'totalposts'    => '8',
            'thumbnail'     => 'false',
            'excerpt'       => 'false',
            'orderby'       => 'post_date'
            ), $atts));
$pcat = get_option('of_portfolio_category');
$pcatid = get_cat_id($pcat);
    $output = '<ul class="frame">';
    global $post;
    $myposts = get_posts('numberposts=8&category='.$pcatid.'&orderby=$orderby');


    foreach($myposts as $post) {
        setup_postdata($post);
        $output .= '<li>';

            $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(null,'mini_thumbnail').'</a>';

        $output .= '</li>';

    };
    $output .= '</ul>';
    return $output;
}
add_shortcode('recent', 'recent_func');


/**
 * Intro
 *
 */

function intro_shortcode( $atts, $content = null ) {
    return '<h1 class="intro">' .remove_wpautop($content). '<span></span></h1>';
}
add_shortcode( 'intro', 'intro_shortcode' );


/**
 * Columns
 *
 */

/** Homepage 4 Columns */
function col4_home_shortcode( $atts, $content = null ) {
   return '<div class="col4 center">'.remove_wpautop($content).'</div>';
}
add_shortcode('col4_home', 'col4_home_shortcode');



/** Homepage 4 Columns Last */
add_shortcode( 'col4_home_last', 'col4_home_last_shortcode' );
function col4_home_last_shortcode( $atts, $content = null ) {
    return '<div class="col4 center last">' .remove_wpautop($content). '</div>';
}

/** Homepage 2 Columns*/
add_shortcode( 'col2_home', 'col2_home_shortcode' );
function col2_home_shortcode( $atts, $content = null ) {
    return '<div class="col2">' .remove_wpautop($content). '</div>';
}

/** Homepage 2 Columns Last */
add_shortcode( 'col2_home_last', 'col2_home_last_shortcode' );
function col2_home_last_shortcode( $atts, $content = null ) {
    return '<div class="col2 last">' .remove_wpautop($content). '</div>';
}


/** 2 Columns */
function col2_shortcode( $atts, $content = null ) {
   return '<div class="one-half">'.remove_wpautop($content).'</div>';
}
add_shortcode('col2', 'col2_shortcode');



/** 2 Columns Last */
add_shortcode( 'col2_last', 'col2_last_shortcode' );
function col2_last_shortcode( $atts, $content = null ) {
    return '<div class="one-half last">' .remove_wpautop($content). '</div>';
}

/** 3 Columns */
function col3_shortcode( $atts, $content = null ) {
   return '<div class="one-third">'.remove_wpautop($content).'</div>';
}
add_shortcode('col3', 'col3_shortcode');



/** 3 Columns Last */
add_shortcode( 'col3_last', 'col3_last_shortcode' );
function col3_last_shortcode( $atts, $content = null ) {
    return '<div class="one-third last">' .remove_wpautop($content). '</div>';
}

/** 4 Columns */
function col4_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth">'.remove_wpautop($content).'</div>';
}
add_shortcode('col4', 'col4_shortcode');



/** 4 Columns Last */
add_shortcode( 'col4_last', 'col4_last_shortcode' );
function col4_last_shortcode( $atts, $content = null ) {
    return '<div class="one-fourth last">' .remove_wpautop($content). '</div>';
}


/** One-Third Columns */
function col1_3_shortcode( $atts, $content = null ) {
   return '<div class="one-third">'.remove_wpautop($content).'</div>';
}
add_shortcode('col1_3', 'col1_3_shortcode');

/** One-Third Columns Last */
function col1_3_last_shortcode( $atts, $content = null ) {
   return '<div class="one-third last">'.remove_wpautop($content).'</div>';
}
add_shortcode('col1_3_last', 'col1_3_last_shortcode');


/** Two-Third Columns */
function col2_3_shortcode( $atts, $content = null ) {
   return '<div class="two-third">'.remove_wpautop($content).'</div>';
}
add_shortcode('col2_3', 'col2_3_shortcode');

/** Two-Third Columns Last */
function col2_3_last_shortcode( $atts, $content = null ) {
   return '<div class="two-third last">'.remove_wpautop($content).'</div>';
}
add_shortcode('col2_3_last', 'col2_3_last_shortcode');

/** One-Fourth Columns */
function col1_4_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth">'.remove_wpautop($content).'</div>';
}
add_shortcode('col1_4', 'col1_4_shortcode');

/** One-Fourth Columns Last */
function col1_4_last_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth last">'.remove_wpautop($content).'</div>';
}
add_shortcode('col1_4_last', 'col1_4_last_shortcode');

/** Three-Fourth Columns */
function col3_4_shortcode( $atts, $content = null ) {
   return '<div class="three-fourth">'.remove_wpautop($content).'</div>';
}
add_shortcode('col3_4', 'col3_4_shortcode');

/** Three-Fourth Columns Last */
function col3_4_last_shortcode( $atts, $content = null ) {
   return '<div class="three-fourth last">'.remove_wpautop($content).'</div>';
}
add_shortcode('col3_4_last', 'col3_4_last_shortcode');




/** Divider */
function divider_shortcode( $atts, $content = null ) {
   return '<div class="clearfix"></div><div class="divider3"></div>';
}
add_shortcode('divider', 'divider_shortcode');


/** Divider */
function dividerbig_shortcode( $atts, $content = null ) {
   return '<div class="divider"></div>';
}
add_shortcode('dividerbig', 'dividerbig_shortcode');

/** Clear */
function clear_shortcode( $atts, $content = null ) {
   return '<div class="clearfix"></div>';
}
add_shortcode('clear', 'clear_shortcode');

/** Button */
add_shortcode( 'button', 'button_shortcode' );
function button_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( "url" => '', "color" => '' ), $atts ) );
    return '<a href="' . $url . '" class="button ' . $color . '">' .remove_wpautop($content). '<span></span></a>';
}

/** Button2 */
add_shortcode( 'button2', 'button2_shortcode' );
function button2_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( "url" => '', "color" => '' ), $atts ) );
    return '<a href="' . $url . '" class="button2 ' . $color . '">' .remove_wpautop($content). '<span></span></a>';
}

/**
 * View Button
 */
add_shortcode( 'view', 'view_shortcode' );
function view_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( "url" => ''), $atts ) );
    return '<div class="view"><a href="' . $url . '" class="button">' .remove_wpautop($content). '<span></span></a></div>';
}

/**
 * Image
 */
function image_shortcode($atts) {
	extract(shortcode_atts(array(		
		"url" => "",
		"img" => "",
		"alt" => "",
		"align" => "",
		"border" => "",
		"lightbox" => 'false'
	), $atts));
	
	if ( $img == '' )
		return NULL;
	
	if( $lightbox == 'true' )
		$img_rel = 'rel="zoombox"';
		
	if( $url != '' ) {
		$output  .=  "\n" . '<a href="' . $url . '" title="' . $alt . '" ' . $img_rel . '><img src="' . $img . '" class="' . $align . ' ' . $border . '" alt="' . $alt . '" title="' . $alt . '" ' . $class . '/></a>';
	} else {
		$output  .=  "\n" . '<img src="' . $img . '" alt="' . $alt . '" title="' . $alt . '" class="' . $align . ' ' . $border . '"/>';
	}
	
	return $output;
}
add_shortcode('image', 'image_shortcode');


/**
 * Video
 */
function video_shortcode($atts, $content = null) {	
	return '<div>' .remove_wpautop($content). '</div>';
}
add_shortcode('video', 'video_shortcode');


/**
 * Dropcap
 */
function dropcap_shortcode($atts, $content = null) {	
	return '<span class="dropcap">' .remove_wpautop($content). '</span>';
}
add_shortcode('dropcap', 'dropcap_shortcode');

/**
 * Hightlight
 */
function highlight_shortcode($atts, $content = null) {	
	return '<span class="highlight1">' .remove_wpautop($content). '</span>';
}
add_shortcode('highlight', 'highlight_shortcode');

/**
 * Hightlight2
 */
function highlight2_shortcode($atts, $content = null) {	
	return '<span class="highlight2">' .remove_wpautop($content). '</span>';
}
add_shortcode('highlight2', 'highlight2_shortcode');

/**
 * Check List
 */
function check_list_shortcode($atts, $content = null) {	
	return '<ul class="check">' .remove_wpautop($content). '</ul>';
}
add_shortcode('check_list', 'check_list_shortcode');

/**
 * Two Column Check List
 */
function two_check_list_shortcode($atts, $content = null) {	
	return '<ul class="check2">' .remove_wpautop($content). '</ul>';
}
add_shortcode('two_check_list', 'two_check_list_shortcode');

/**
 * Bullet List
 */
function bullet_list_shortcode($atts, $content = null) {	
	return '<ul class="bullet">' .remove_wpautop($content). '</ul>';
}
add_shortcode('bullet_list', 'bullet_list_shortcode');

/**
 * Two Column Bullet List
 */
function two_bullet_list_shortcode($atts, $content = null) {	
	return '<ul class="bullet2">' .remove_wpautop($content). '</ul>';
}
add_shortcode('two_bullet_list', 'two_bullet_list_shortcode');


/**
 * Blockquote-Right
 */
function quote_right_shortcode($atts, $content = null) {	
	return '<span class="quote-right">' .remove_wpautop($content). '</span>';
}
add_shortcode('quote_right', 'quote_right_shortcode');


/**
 * Blockquote-Left
 */
function quote_left_shortcode($atts, $content = null) {	
	return '<span class="quote-left">' .remove_wpautop($content). '</span>';
}
add_shortcode('quote_left', 'quote_left_shortcode');

/**
 * Infobox
 */
 
/** Info */
function info_box_shortcode($atts, $content = null) {	
	return '<div class="info-box">' .remove_wpautop($content). '</div>';
}
add_shortcode('info_box', 'info_box_shortcode');

/** Warning */
function warning_box_shortcode($atts, $content = null) {	
	return '<div class="warning-box">' .remove_wpautop($content). '</div>';
}
add_shortcode('warning_box', 'warning_box_shortcode');


/** Note */
function note_box_shortcode($atts, $content = null) {	
	return '<div class="note-box">' .remove_wpautop($content). '</div>';
}
add_shortcode('note_box', 'note_box_shortcode');


/** Download */
function download_box_shortcode($atts, $content = null) {	
	return '<div class="download-box">' .remove_wpautop($content). '</div>';
}
add_shortcode('download_box', 'download_box_shortcode');


/**
 * Table
 */
function table_shortcode($atts, $content = null) {	
	return '<table class="normal">' .remove_wpautop($content). '</table>';
}
add_shortcode('table', 'table_shortcode');

/**
 * Pricing Table
 */
function table_price_shortcode($atts, $content = null) {	
	return '<table class="price">' .remove_wpautop($content). '</table>';
}
add_shortcode('table_price', 'table_price_shortcode');


/**
 * Toggle
 */

function toggle_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => '',
    ), $atts));
	
	
	$out .= '<div class="toggle">';
	$out .= '<h2 class="trigger">' .$heading. '</h2>';
	$out .= '<div class="togglebox"><p>';
	$out .= remove_wpautop($content);
	$out .= '</p></div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('toggle', 'toggle_shortcode');


/**
 * Toggle2
 */

function toggle2_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => '',
    ), $atts));
	
	
	$out .= '<div class="toggle">';
	$out .= '<h2 class="trigger">' .$heading. '</h2>';
	$out .= '<div class="togglebox" style="background:none; border:none;"><p>';
	$out .= remove_wpautop($content);
	$out .= '</p></div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('toggle2', 'toggle2_shortcode');


/**
 * Testimonial
 */

function testimonial_shortcode( $atts, $content = null ) {
	
	
	
	$out .= '<div id="ticker-wrapper"><div class="ticker"><ul>';
	$out .= remove_wpautop($content);
	$out .= '</ul></div></div>';
	
   return $out;
}
add_shortcode('testimonial', 'testimonial_shortcode');


/**
 * Testimonial2
 */

function testimonial2_shortcode( $atts, $content = null ) {
	
	
	
	$out .= '<div id="ticker-wrapper2"><div class="ticker2"><ul>';
	$out .= remove_wpautop($content);
	$out .= '</ul></div></div>';
	
   return $out;
}
add_shortcode('testimonial2', 'testimonial2_shortcode');


function msg_shortcode($atts, $content = null) {


extract(shortcode_atts(array(
        'author'      => '',
    ), $atts));
    
    if( $author != '' ) {
		$output  .=  "\n" . '<li> <div class="message"><p>' .remove_wpautop($content). ' <br /><strong>by ' .$author. '</strong></p></div></li>';
	} else {
		$output  .=  "\n" . '<li> <div class="message"><p>' .remove_wpautop($content). '</p></div></li>';
	}

  return $output;
}
add_shortcode('msg', 'msg_shortcode');



/**
 * Tabs
 */
add_shortcode( 'tabgroup', 'etdc_tab_group' );
function etdc_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

remove_wpautop($content);

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a class="" href="#">'.$tab['heading'].'</a></li>';
$panes[] = '<div class="pane">'.do_shortcode($tab['content']).'</div>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><div class="panes">'.implode( "\n", $panes ).'</div>'."\n";
}
return $return;
}

add_shortcode( 'tab', 'etdc_tab' );
function etdc_tab( $atts, $content ){
extract(shortcode_atts(array(
'heading' => 'Tab %d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'heading' => sprintf( $heading, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}

/**
 * Check Icon
 */

function shortcode_check( $atts, $content = null)
{
  $url = get_bloginfo('template_url');
   return '<img src="'.$url.'/style/images/tick_16.png" />';
}
add_shortcode('check', 'shortcode_check');



/**
 * Full Slider
 */
function full_slider_shortcode( $atts, $content = null ) {
   return '</div><div id="slider">
  <div id="slider-wrapper">

    <div id="faded">
      '.remove_wpautop($content).'</div><ul class="pagination"></ul><div class="move"> <a href="#" class="prev">prev</a> <a href="#" class="next">next</a> </div>
</div></div><div class="container">';
}
add_shortcode('full_slider', 'full_slider_shortcode');


/**
 * Content Slider
 */
function content_slider_shortcode( $atts, $content = null ) {
   return '<div id="slider2">

<div id="slider2-wrapper">
    <div id="faded">
       '.remove_wpautop($content).'
</div><ul class="pagination"></ul></div></div>';
}
add_shortcode('content_slider', 'content_slider_shortcode');


/** Slider Embed */
function embed_shortcode( $atts, $content = null ) {
   return '<div>'.remove_wpautop($content).'</div>';
}
add_shortcode('embed', 'embed_shortcode');


/** Slider Image Wrapper */
function pic_shortcode( $atts, $content = null ) {
   return '<div class="pic">'.remove_wpautop($content).'</div>';
}
add_shortcode('pic', 'pic_shortcode');

/** Slider Description Wrapper */

function desc_shortcode( $atts, $content = null ) {
   return '<div class="description">'.remove_wpautop($content).'</div>';
}
add_shortcode('desc', 'desc_shortcode');

?>