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
 
global $post;
 
// use static header image
if ( isset( $post->ID ) && get_post_meta( $post->ID, '_use_static_image', true ) ) { 
    $image_url = get_post_meta( $post->ID, '_static_image', true );
	$image_size = getimagesize($image_url);
    $image_id = yit_get_attachment_id( $image_url );
    list( $thumb_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id );
?>
	    <div class="slider fixed-image inner group">
			<div class="fixed-image-wrapper" style="max-width: <?php echo $image_size[0] ?>px;">
	        	<img src="<?php echo $image_url ?>" alt="<?php bloginfo('name') ?> Header" />
			</div>
	    </div>
	<?php
		add_action( 'yit_after_header', 'yit_slider_space' );
    
// use the slider
} else {
    yit_slider();
}