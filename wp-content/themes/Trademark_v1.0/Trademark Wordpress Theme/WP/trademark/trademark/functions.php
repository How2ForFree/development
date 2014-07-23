<?php
require_once( 'lib/bootstrap.php' );

/**
 * Hook init
 */
function theme_init () {
    define('PATH_CSS', get_template_directory_uri() . '/files/css/');
    define('PATH_JS', get_template_directory_uri() . '/files/js/');
    
    if (is_admin()) {
        wp_enqueue_style( 'CSS_admin', get_template_directory_uri() . '/files/css/admin.css' );		    
        wp_enqueue_style( 'CSS_colorpicker', get_template_directory_uri() . '/files/css/jquery.colorpicker.css' );
                
        wp_enqueue_script( 'JS_admin', get_template_directory_uri() . '/files/js/admin.js', array('jquery') );        
        wp_enqueue_script( 'JS_colorpicker', get_template_directory_uri() . '/files/js/jquery.colorpicker.js', array('jquery') );        		
	}
    elseif (!is_admin()) {
        wp_enqueue_style( 'CSS_style', get_template_directory_uri() . '/style.css');          
        wp_enqueue_style( 'CSS_comments',     PATH_CSS . 'comments.css');    
        wp_enqueue_style( 'CSS_portfolio',    PATH_CSS . 'portfolio.css');    
        wp_enqueue_style( 'CSS_colorpicker',  PATH_CSS . 'jquery.colorpicker.css' );
        wp_enqueue_style( 'CSS_fancybox',     PATH_CSS . 'jquery.fancybox.css' );
        
        wp_enqueue_script( 'JS_cycle',        PATH_JS . 'jquery.cycle.js',  array('jquery') );       
        wp_enqueue_script( 'JS_cookie',       PATH_JS . 'jquery.cookie.js',  array('jquery') );       
        wp_enqueue_script( 'JS_colorpicker',  PATH_JS . 'jquery.colorpicker.js', array('jquery') );        		          
        wp_enqueue_script( 'JS_infieldlabel', PATH_JS . 'jquery.infieldlabel.js', array('jquery') );
        wp_enqueue_script( 'JS_scrollto',     PATH_JS . 'jquery.scroll-to.js', array('jquery') );    
        wp_enqueue_script( 'JS_fancybox',     PATH_JS . 'jquery.fancybox.js', array('jquery') );
        wp_enqueue_script( 'JS_script',       PATH_JS . 'script.js',  array('jquery') );                         
        wp_enqueue_script( 'JS_theme',        PATH_JS . 'theme.js',  array('jquery') );       
        wp_enqueue_script( 'JS_cufon',        PATH_JS . 'cufon.js' );        		  
        wp_enqueue_script( 'JS_ottawa',       PATH_JS . 'fonts/ottawa.js' );       
        //wp_enqueue_script( 'JS_pixastic', get_template_directory_uri() . '/files/js/pixastic.custom.js', array('jquery') );                		                  
        //wp_enqueue_script( 'JS_colorpicker', get_template_directory_uri() . '/files/js/jquery.colorpicker.js', array('jquery') );        		  
        
        //wp_enqueue_script( 'JS_theme', get_template_directory_uri() . '/files/js/theme.js', array('jquery') );
    }
}
add_action('init', 'theme_init');

/**
 * Hook after_setup_theme
 */
function theme_setup() {
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
  
	register_nav_menu('header', 'Header Navigation');    
	register_nav_menu('main', 'Main Navigation');  
	register_nav_menu('footer', 'Footer Navigation');  


	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'theme', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file ); 
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Hook wp_nav_menu_items
 */
function addClassToLastMenuItem($theMenu)
{
	$classToSearchFor = 'class="menu-item';

	$lengthOfClassToSearchFor = strlen($classToSearchFor);

	$lastOccurranceOfClass = strripos( $theMenu, $classToSearchFor );

	$beforeTheClass = substr( $theMenu,
		0,
		($lastOccurranceOfClass + $lengthOfClassToSearchFor) );

	$afterTheClass = substr( $theMenu,
		($lastOccurranceOfClass + $lengthOfClassToSearchFor),
		strlen($theMenu) );

	return $beforeTheClass . ' last' . $afterTheClass;
}
add_filter('wp_nav_menu_items','addClassToLastMenuItem', 20, 1);


/**
 * Implementation widgets_init()
 */
function theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'theme' ),
		'id' => 'sidebar',
		'description' => __( 'Sidebar widget area', 'theme' ),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title"><span class="title-wrapper">',
		'after_title' => '<span class="wd-icon"></span></span></h3>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * Prints HTML with meta information for the current post—date/time and author.
 */

if ( ! function_exists( 'theme_posted_on' ) ) {

    function theme_posted_on() {
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'theme' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'theme' ), get_the_author() ),
                get_the_author()
            )
        );
    }
}

function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'theme' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				printf( __( '%1$s at %2$s', 'theme' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'theme' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'theme' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
