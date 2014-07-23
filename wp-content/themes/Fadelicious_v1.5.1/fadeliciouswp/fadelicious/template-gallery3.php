<?php
/**
 * Template Name: Gallery 3 Columns
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<!-- Begin Container -->

<div id="container">
<!-- Begin Page Intro -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?> <?php endwhile; endif; ?>
<!-- End Page Intro -->


       <h2><?php the_title(); ?></h2>
      

        	<ul id="gallery3">
        
<?php 

if (  $wp_query->have_posts()) : while (have_posts()) : the_post(); 
      the_content();
       $attachment_args = array(
         'post_type' => 'attachment',
         'numberposts' => -1, 
         'post_status' => null,
         'post_parent' =>$post->ID,
         'orderby' => 'menu_order ID'
    );
    $attachments = get_posts($attachment_args);
    if ($attachments) {
      foreach($attachments as $gallery_image )                                                                 
      {
        $attachment_img =  wp_get_attachment_url( $gallery_image->ID);
        echo '<li><a alt="'.$gallery_image->post_title.'" rel="zoombox['.$post->ID.']" href="'.$attachment_img.'" class="zoom2">';
        echo  '<img src="'.get_bloginfo('template_url').'/functions/img_resize/timthumb.php?src='.$attachment_img.'&amp;w=270&amp;h=200&amp;zc=1" alt=""/>';
        echo '</a></li>';
      }
    }
?>

<?php endwhile; endif; ?>

		
			</ul>
 
        <div class="clear"></div>
   
</div>

<?php get_footer(); ?>
