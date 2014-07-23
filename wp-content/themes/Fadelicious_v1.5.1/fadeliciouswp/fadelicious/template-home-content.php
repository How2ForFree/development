<?php
/*
Template Name: Homepage Content Slider
*/
?>
<?php get_header(); ?>

<!-- Begin Slider -->

<!-- Begin Alternative Slider -->

<div id="slider2">
<div id="slider2-wrapper">
  <div id="faded">

      <?php

         $fcat = get_option('of_featured_category');
        $fcatid = get_cat_id($fcat);
 $featuredPosts = new WP_Query();
 $featuredPosts->query('cat='.$fcatid.'&showposts=5');
 while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
 ?>
      <div>
        <div class="pic"><!-- Begin conditional check for video -->
          <?php $main_video=get_post_meta($post->ID, 'embed', true); ?>
          <?php if ( $main_video ) : ?>
          <div><?php echo get_post_meta($post->ID, "embed", $single = true); ?></div>
          <?php else : ?>
          <?php the_post_thumbnail( 'content_image' ); ?>
          <?php endif; ?>
          <!--End conditional check for video --></div>
        <div class="description">
         <h2>
	         <?php the_title(); ?>
         </h2>
         <p><?php echo trimText(get_the_excerpt(), 350); ?></p>
         <a href="<?php the_permalink(); ?> " class="button2">Read More<span></span></a> </div>
      </div>
      <?php endwhile; ?>
      <!--/close loop--> 
      

  </div><ul class="pagination"></ul>
</div></div>
<!-- End Alternative Slider -->
<div class="clearfix"></div>

<!-- Begin Container -->
<div id="container" class="homepage">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php endwhile; ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
