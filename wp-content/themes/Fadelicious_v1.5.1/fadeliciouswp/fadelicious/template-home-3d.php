<?php
/*
Template Name: Homepage 3D Slider
*/
?>
<?php get_header(); ?>

<!-- Begin Container -->
<div id="container" class="homepage">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php endwhile; ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
