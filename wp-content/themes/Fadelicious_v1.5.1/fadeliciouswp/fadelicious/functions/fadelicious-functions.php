<?php


	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'fade_thumbnail', 180, 120, true );
	add_image_size( 'fade_thumbnail_bigger', 195, 120, true );
	add_image_size( 'fade_blog_thumbnail', 250, 200, true );
	add_image_size( 'content_image', 640, 350, true );
	add_image_size( 'slider_image', 930, 350, true );
	add_image_size( 'mini_thumbnail', 80, 80, true );
	add_image_size( 'portfolio-permalink', 640, 350, true );
	add_image_size( 'wide-permalink', 918, 9999, true );
	add_image_size( 'blog-permalink', 630, 350, true );
	}




function fadelicious_addmenus() {
	register_nav_menus(
		array(
			'main_nav' => 'The Main Menu',
		)
	);
}
add_action( 'init', 'fadelicious_addmenus' );
 
function fadelicious_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
        wp_nav_menu( 'container=&container_class=pagemenu&fallback_cb=fadelicious_nav_fallback' );
    else
        fadelicious_nav_fallback();
}
 
function fadelicious_nav_fallback() {
    wp_page_menu( 'show_home=1&include=999' );
}	



function elemis_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'elemis' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'elemis' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'elemis' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'elemis_filter_wp_title', 10, 2 );



if ( ! function_exists( 'elemis_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function elemis_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li class="clearfix" id="comment-<?php comment_ID(); ?>">
  <div class="user"><?php echo get_avatar( $comment, 80 ); ?></div>
  <div class="message">
    <div class="info">
      <h2><?php printf( __( '%s', 'elemis' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h2>
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      <!-- .reply -->
      <p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s', 'elemis' ), get_comment_date(),  get_comment_time() ); ?>
        </a>
        <?php edit_comment_link( __( '(Edit)', 'elemis' ), ' ' );
			?>
      </p>
    </div>
    <?php comment_text(); ?>
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <h5>
      <?php _e( 'Your comment is awaiting moderation.', 'elemis' ); ?>
    </h5>
    <?php endif; ?>
  </div>
  <div class="clear"></div>
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'elemis' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __('(Edit)', 'elemis'), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;



/**
 * Changes the default HTML structure of the author, email and url comment form fields to better suite the design
 */
function elemis_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$fields = array(
		'author' => '<div id="form-section-author" class="form-section"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" /><label for="author">' . __( 'Name (Required)', 'elemis' ) . '</label></div>',
		'email'  => '<div id="form-section-email" class="form-section"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /><label for="email">' . __( 'Email (Required. Will not be published)', 'elemis' ) . '</label></div>',
		'url'    => '<div id="form-section-url" class="form-section"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /><label for="url">' . __( 'Website (Optional)', 'elemis' ) . '</label></div>',
	);
	return $fields;
}
add_filter('comment_form_default_fields','elemis_comment_fields');



/**
 * Changes the default HTML structure of the comment form field to better suite the design
 */
function elemis_comment_form_field_comment( $args ) {	
	return '<div id="form-section-comment" class="form-section"><textarea id="comment" name="comment" cols="65" rows="10"></textarea></div>';
}
add_filter('comment_form_field_comment','elemis_comment_form_field_comment');

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 */
function elemis_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'elemis' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );



	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'elemis' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'elemis' ),
		'before_widget' => '<div class="col3"><div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	
}
/** Register sidebars by running elemis_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elemis_widgets_init' );


function elemis_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'elemis_remove_recent_comments_style' );




/**
 * Custom Experts
 *
 */
function new_excerpt_length($length) {
return 100;
}
function cutMe($content){
$limit = 450;
$content = strip_tags($content);
if (strlen($content) > $limit)
$content = substr($content, 0, strpos($content," ",$limit)) . ' &raquo;';
return $content;
}
function cutMeAgain($content){
$limit = 170;
$content = strip_tags($content);
if (strlen($content) > $limit)
$content = substr($content, 0, strpos($content," ",$limit)) . ' &raquo;';
return $content;
}
function cutMeSmaller($content){
$limit = 145;
$content = strip_tags($content);
if (strlen($content) > $limit)
$content = substr($content, 0, strpos($content," ",$limit)) . ' &raquo;';
return $content;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Trim Text
 *
 */

function trimText($text, $max_char) {
    if (strlen($text) > $max_char) {
        $text = substr($text, 0, $max_char - 3) . '...';
    }
    return $text;
}

/**
 * Get Slug
 *
 */

function the_slug() {
$post_data = get_post($post->ID, ARRAY_A);
$slug = $post_data['post_name'];
return $slug; }









/**
 * Tag Cloud Size
 *
 */

function orz_tag_cloud_filter($args = array()) {
   $args['smallest'] = 12;
   $args['largest'] = 12;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'orz_tag_cloud_filter', 90);

/**
 * Pagination
 *
 */

function pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<ul class='pagenavi'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><a href='".get_pagenum_link($i)."' class='current' >".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul>\n";
     }
}








/**
 * Archives Widget
 *
 */
 
  function widget_archives_limit($args) { extract($args); $options = get_option('widget_archives'); $c = $options['count'] ? '1' : '0'; $d = $options['dropdown'] ? '1' : '0'; $title = empty($options['title']) ? __('Archives') : apply_filters('widget_title', $options['title']); $limit = empty($options['limit']) ? __('Limit') : apply_filters('widget_limit', $options['limit']); echo $before_widget; echo $before_title . $title . $after_title; if($d) { ?>
  <select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
    <option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
    <?php wp_get_archives("type=monthly&format=option&show_post_count=$c&limit=$limit"); ?>
  </select>
  <?php } else { ?>
  <ul>
    <?php wp_get_archives("type=monthly&show_post_count=$c&limit=$limit"); ?>
  </ul>
  <?php } echo $after_widget; } wp_register_sidebar_widget('archives limit', __('Archives Limit'), 'widget_archives_limit', $widget_ops); /** * Display and process archives widget options form. * * @since 2.2.0 */ function widget_archives_limit_control() { $options = $newoptions = get_option('widget_archives'); if ( isset($_POST["archives-submit"]) ) { $newoptions['count'] = isset($_POST['archives-count']); $newoptions['dropdown'] = isset($_POST['archives-dropdown']); $newoptions['title'] = strip_tags(stripslashes($_POST["archives-title"])); $newoptions['limit'] = strip_tags(stripslashes($_POST["archives-limit"])); } if ( $options != $newoptions ) { $options = $newoptions; update_option('widget_archives', $options); } $count = $options['count'] ? 'checked="checked"' : ''; $dropdown = $options['dropdown'] ? 'checked="checked"' : ''; $title = attribute_escape($options['title']); $limit = attribute_escape($options['limit']); ?>
  <p>
    <label for="archives-title">
      <?php _e('Title:'); ?>
      <input class="widefat" id="archives-title" name="archives-title" type="text" value="<?php echo $title; ?>" />
    </label>
  </p>
  <p>
    <label for="archives-count">
      <input class="checkbox" type="checkbox" <?php echo $count; ?> id="archives-count" name="archives-count" />
      <?php _e('Show post counts'); ?>
    </label>
    <br />
    <label for="archives-dropdown">
      <input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="archives-dropdown" name="archives-dropdown" />
      <?php _e('Display as a drop down'); ?>
    </label>
  </p>
  <p>
    <label for="archives-limit">
      <?php _e('Limit (enter a number):'); ?>
      <input class="widefat" id="archives-limit" name="archives-limit" type="text" value="<?php echo $limit; ?>" />
    </label>
  </p>
  <input type="hidden" id="archives-submit" name="archives-submit" value="1" />
  <?php } wp_register_widget_control('archives limit', __('Archives Limit'), 'widget_archives_limit_control' );


function vibeExcludePages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','vibeExcludePages');



/**
 * Title Trim
 *
 */

function the_title_shorten($len,$rep='...') {
	$title = the_title('','',false);
	$shortened_title = textLimit($title, $len, $rep);
	print $shortened_title;
}


function textLimit($string, $length, $replacer) {
	if(strlen($string) > $length)
	return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
	return $string;
}

?>
