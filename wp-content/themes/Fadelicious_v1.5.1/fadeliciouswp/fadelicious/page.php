<?php
/**
 * Template Name: Full Width Page
 *
 * A custom page template without sidebar.
 *
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
?>
<!-- End Page Intro -->
 
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><!-- Post Header -->
      
      
    <?php the_content(); ?>
    <?php endwhile; endif; ?>
    
</div>


<?php get_footer(); ?>
