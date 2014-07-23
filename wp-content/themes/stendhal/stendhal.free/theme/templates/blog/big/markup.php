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

$post_classes = 'hentry-post group blog-big';
?>                 
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <!-- post featured & title -->
    <?php
    yit_get_template( 'blog/big/post-formats/standard.php' );
    ?>
    
    <?php if( is_single() ) : ?>
        <!-- post content -->
        <div class="the-content<?php if( is_single() ) echo ' single'; ?> group"><?php
            the_content( yit_get_option('blog-read-more-text') );
            
            if( is_single() && yit_get_option('blog-show-tags') )
                { the_tags( '<p class="tags">' . __( 'Tags: ', 'yit' ), ', ', '</p>' ); }
        ?></div>
        
        <div class="clear"></div>
    <?php endif ?>
    
    <?php wp_link_pages(); ?>
	<?php if( is_paged() && is_single() ) { previous_post_link(); echo ' | '; next_post_link(); } ?>    
</div>