<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/* === HEADER */
if( !function_exists( 'yit_head' ) ) {
    function yit_head() {
        yit_get_template( '/header/head.php' );
    }
}

if( !function_exists( 'yit_add_custom_styles' ) ) {
    function yit_add_custom_styles() {        
        if( yit_get_option( 'responsive-enabled' ) ) {
            yit_enqueue_style( 9994, 'responsive', YIT_CORE_ASSETS_URL . '/css/responsive.css', array(), '1.0.0', 'all' ); 
            yit_enqueue_style( 9995, 'theme-responsive', get_template_directory_uri() . '/css/responsive.css', false, '2.0', 'all' );
        }
        
        global $wpdb;
        $cache_file = '/custom.css';
        if ( $wpdb->blogid != 0 ) $cache_file = str_replace( '.css', '-' . $wpdb->blogid . '.css', $cache_file );
        
        if( file_exists( YIT_CACHE_DIR . $cache_file ) )
            { yit_enqueue_style( 9999, 'cache-custom', yit_get_model('cache')->locate_url( $cache_file ), array(), false, 'all', true ); }
        yit_enqueue_style( 99999, 'custom', get_template_directory_uri() . '/custom.css', array(), false, 'all', true );
    }
}

if( !function_exists( 'yit_add_custom_scripts' ) ) {
    function yit_add_custom_scripts() {
    	if( yit_get_option( 'responsive-enabled' ) ) {
    		wp_enqueue_script( 'responsive', YIT_CORE_ASSETS_URL . '/js/responsive.js', array('jquery'), '1.0', true ); 
			wp_enqueue_script( 'responsive-theme', YIT_THEME_JS_URL . '/responsive.js', array( 'jquery' ), '1.0', true );
    	}

		wp_enqueue_script( 'jquery-placeholder', YIT_CORE_ASSETS_URL . '/js/jquery.placeholder.js', array('jquery'), '1.0', true ); 
    }
}

if( !function_exists( 'yit_topbar' ) ) {
    function yit_topbar() {
        yit_get_template( '/header/topbar.php' );
    }
}

if( !function_exists( 'yit_topbar_login' ) ) {
    function yit_topbar_login() {
        yit_get_template( '/header/login.php' );
    }
}


if( !function_exists( 'yit_single_service' ) ) {
    function yit_single_service() {
        yit_get_template( '/services/service.php' );
    }
}


if( !function_exists( 'yit_header' ) ) {
    function yit_header() {
        yit_get_template( '/header/header.php' );
    }
}

if( !function_exists( 'yit_logo' ) ) {
    function yit_logo() {
        yit_get_template( '/header/logo.php' );
    }
}

if( !function_exists( 'yit_header_sidebar' ) ) {
    function yit_header_sidebar() {
        yit_get_template( '/header/header-sidebar.php' );
    }
}

if( !function_exists( 'yit_main_navigation' ) ) {
    function yit_main_navigation() {
        yit_get_template( '/header/main-navigation.php' );
    }
}

if( !function_exists( 'yit_page_meta' ) ) {
    function yit_page_meta() {
        yit_get_template( '/header/page-meta.php' );
    }
}

if( !function_exists( 'yit_page_menu_args' ) ) {
	function yit_page_menu_args( $args ) {
	    $args['show_home'] = true;
	    $args['link_after'] = '<div style="position:absolute; left: 50%;"><span class="triangle">&nbsp;</span></div>';
		$args['menu_class'] = 'sf-menu';
	    return $args;
	}
}

if( !function_exists( 'yit_page_menu' ) ) {
	function yit_page_menu( $menu, $args ) {
	    $menu = str_replace('<div class="'. $args['menu_class'] .'">', '<div class="menu">', $menu);
	    $menu = str_replace('<ul>', '<ul class="'. $args['menu_class'] .'">', $menu);
		return $menu;
	}
}

/* === PAGE */
if( !function_exists( 'yit_loop_page' ) ) {
    function yit_loop_page() {
        yit_get_template( '/loop/page/content.php' );
    }
}

if( !function_exists( 'yit_404' ) ) {
    function yit_404() {
        yit_get_template( '404/404.php' );
    }
}

if( !function_exists( 'yit_is_primary_start' ) ) {
    function yit_is_primary_start() {
        global $is_primary;
        $is_primary = true;
    }
}

if( !function_exists( 'yit_is_primary_end' ) ) {
    function yit_is_primary_end() {
        global $is_primary;
        $is_primary = false;
    }
}

/* === LOOP */
if( !function_exists( 'yit_loop' ) ) {
    function yit_loop() {
        yit_get_template( '/loop/loop.php' );
    }
}

if( !function_exists( 'yit_loop_internal' ) ) {
    function yit_loop_internal() {
        yit_get_template( '/loop/loop_internal.php' );
    }
}

if( !function_exists( 'yit_loop_blog_big' ) ) {
    function yit_loop_blog_big() {
        yit_get_template( '/blog/big/markup.php' );
    }
}

if( !function_exists( 'yit_archives' ) ) {
    function yit_archives() {
        yit_get_template( '/loop/archives.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comments' ) ) {
    function yit_comments() {
        yit_get_template( '/comments/markup.php' );
    }
}

if( !function_exists( 'yit_comments_password_required' ) ) {
    function yit_comments_password_required() {
        yit_get_template( '/comments/password-required.php' );
    }
}

if( !function_exists( 'yit_comments_navigation' ) ) {
    function yit_comments_navigation() {
        yit_get_template( '/comments/navigation.php' );
    }
}

if( !function_exists( 'yit_trackbacks' ) ) {
    function yit_trackbacks() {
        yit_get_template( '/comments/trackbacks.php' );
    }
}

/* === MISC */
if( !function_exists( 'yit_searchform' ) ) {
    function yit_searchform( $post_type ) {
        yit_get_template( '/searchform/' . $post_type . '.php' );
    }
}

if( !function_exists( 'yit_extra_content' ) ) {
    function yit_extra_content() {
        yit_get_template( '/loop/extra-content.php' );
    }
}

/* === FOOTER */
if( !function_exists( 'yit_footer' ) ) {
    function yit_footer() {
        yit_get_template( '/footer/footer.php' );
    }
}

if( !function_exists( 'yit_footer_big' ) ) {
    function yit_footer_big() {
        yit_get_template( '/footer/footer-big.php' );
    }
}

if( !function_exists( 'yit_copyright' ) ) {
    function yit_copyright() {
        yit_get_template( '/footer/copyright.php' );
    }
}

/* === SIDEBAR */
if( !function_exists( 'yit_default_sidebar' ) ) {
    function yit_default_sidebar() {
        yit_get_template( '/sidebars/default.php' );
    }
}

/* === TESTIMONIALS */
if( !function_exists( 'yit_single_testimonial' ) ) {
    function yit_single_testimonial() {
        yit_get_template( '/testimonial/testimonial.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comment' ) ) {
    /**
     * Print comments
     * 
     * @param object $comment
     * @param array $args
     * @param int $depth
     * @return string
     * @since 1.0.0
     */
    function yit_comment( $comment, $args, $depth ) {
        
        $GLOBALS['comment'] = $comment;
        
        switch ( $comment->comment_type ) :
            case 'pingback'  :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e( 'Pingback:', 'yit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'yit'), ' ' ); ?></p>
        <?php
                break;
            
            default:
        ?>
        <li <?php comment_class( yit_comment_has_children( $comment->comment_ID ) ? ' parent' : '' ); ?> id="li-comment-<?php comment_ID(); ?>">
            <div class="<?php echo 'offset' . ( yit_comment_depth( get_comment_ID() ) - 1 ) . ' span' . ( 10 - yit_comment_depth( get_comment_ID() ) ) ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                    <div class="parent-line"><span></span></div>
                    <div class="row">
                        <div class="comment-author vcard span3">
                            <div class="row">
                                <div class="span1"><span><?php echo get_avatar( $comment, 64 ); ?></span></div>
                                <img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/comments/images/horizontal-lines.png" class="horizontal-lines-left" />
                                <img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/comments/images/horizontal-lines.png" class="horizontal-lines-right" />
                                <div class="comment-meta commentmetadata reply comment-author-name comment-date span2">
                                    <!-- author name -->
                                    <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
                                    
                                    <!-- date -->
                                    <a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                    <?php
                                        /* translators: 1: date, 2: time */
                                        printf( __( '%1$s', 'yit' ), get_comment_date( 'M j, Y' ) ); ?></a>
                                    
                                    <!-- reply -->
                                    <?php
                                    comment_reply_link( array_merge( $args, array(
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'reply_text' => apply_filters( 'yit_comment_reply_link_text', '<img class="comment-reply-link" src="' . YIT_THEME_TEMPLATES_URL . '/comments/images/comment-reply-link.png" title="' . __( 'reply', 'yit' ) . '" alt="+" />' . __( 'reply', 'yit' ) )
                                    ) ) ); ?>
                                </div><!-- .reply -->
                            </div>
                        </div><!-- .comment-author .vcard -->
                        
                        <div class="comment-content span<?php echo 7 - yit_comment_depth( get_comment_ID() ) ?>">
                            <div>
                                <?php if ( $comment->comment_approved == '0' ) : ?>
                                    <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'yit' ); ?></em>
                                    <br />
                                <?php endif; ?>                        
                                <div class="comment-body"><?php comment_text(); ?></div>
                            </div>
                        </div><!-- .comment-meta .commentmetadata -->
                    </div>
                </div><!-- #comment-##  -->
            </div>
        <?php
                break;
        endswitch;
    }
}

if( !function_exists( 'yit_unregister_post_types' ) ) {
	function yit_unregister_post_types() {
		$post_types = array('services');
		
		foreach($post_types as $pt) {
			yit_unregister_post_type($pt);
		}
	}
}

if( !function_exists( 'yit_simple_read_more_classes' ) ) {
    /**
     * Add a class to the read more if it is not a button shortcode
     * 
     * @param string $link
     * @return string
     * @since 1.0.0
     */ 
    function yit_simple_read_more_classes( $link ) {        
        if( !strpos( $link, 'class="btn' ) ) {
            $link = '<br />' . $link;
            return str_replace( 'class="', 'class="not-btn ', $link );
        }
        
        return $link;
    }
}