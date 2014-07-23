<?php
/**
 * Template for Archive
 *
 */

get_header(); ?>

<!-- Begin Container -->

<div id="container">
  <h3 class="contenttag">
    <?php if ( is_day() ) : ?>
    <?php printf( __( 'Daily Archives: %s', 'elemis' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?>
    <?php printf( __( 'Monthly Archives: %s', 'elemis' ), get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?>
    <?php printf( __( 'Yearly Archives: %s', 'elemis' ), get_the_date('Y') ); ?>
    <?php else : ?>
    <?php _e( 'Blog Archives', 'elemis' ); ?>
    <?php endif; ?>
  </h3>
  <div id="blogcontent">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
    <!-- Begin Blog Box -->
    <div class="blogcol"> 
      <!-- Begin Post Caption -->
      <div class="caption peek">
        <div class="meta">
          <div class="date">
            <?php the_time('j M Y'); ?>
          </div>
          <div class="comments">
            <?php comments_popup_link( __( '0', 'elemis' ), __( '1', 'elemis' ), __( '%', 'elemis' ) ); ?>
          </div>
        </div>
        <!-- End Post Caption --> 
        <!-- Begin Post Image --> 
        <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 'fade_thumbnail', array('class' => 'cover'  )); ?>
        </a> </div>
      <!-- End Post Image -->
      <div class="clearfix"></div>
      <h4><a href="<?php the_permalink(); ?>">
        <?php the_title_shorten(26,'...'); ?>
        </a></h4>
      <!-- /Post Header -->
      
      <p> <?php echo cutMeAgain(get_the_excerpt()); ?></p>
      <!-- /Post Text --> 
      
      <a href="<?php the_permalink(); ?>" class="more">Read More</a> </div>
    <!-- /Blog Box -->
    
    <?php endwhile; endif; ?>
    <div class="clear"></div>
    <?php pagination(); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<!-- End Container -->

<?php get_footer(); ?>
