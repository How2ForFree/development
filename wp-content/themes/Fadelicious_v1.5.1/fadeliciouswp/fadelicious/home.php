<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

<!-- Begin Slider -->

<div id="slider">
  <div id="slider-wrapper">  <div id="faded">
        <?php
        $fcat = get_option('of_featured_category');
        $fcatid = get_cat_id($fcat);
 $featuredPosts = new WP_Query();
 $featuredPosts->query('cat='.$fcatid.'&showposts=5');
 while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
 ?>
        
        <!-- First -->
        
        <?php $main_video=get_post_meta($post->ID, 'embed', true); ?>
        <?php if ( $main_video ) : ?>
        <div><?php echo get_post_meta($post->ID, "embed", $single = true); ?></div>
        <?php else : ?>
         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'slider_image' ); ?></a>
        <?php endif; ?>
        <!--End conditional check for video -->
        
        <?php endwhile; ?>
        <!--/close loop--> 
        
      </div>
      <ul class="pagination"></ul>
        <div class="move"> <a href="#" class="prev">prev</a> <a href="#" class="next">next</a> </div>
    </div></div>
<!-- End Slider -->

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
