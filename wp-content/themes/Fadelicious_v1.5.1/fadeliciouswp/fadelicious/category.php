<?php
/**
 * Template for Categories
 *
 */

get_header(); ?>

<!-- Begin Container -->

<div id="container"> 
  <!-- Begin Page Intro -->
  
  <?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?>
  <!-- End Page Intro -->
  
  <div id="blogcontent">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
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
      <!-- Post Header -->
      
      <p> <?php echo cutMeAgain(get_the_excerpt()); ?></p>
      <!-- Post Text --> 
      
      <a href="<?php the_permalink(); ?>" class="more">Read More</a> </div>
    <!-- End Blog Box -->
    
    <?php endwhile; endif; ?>
    <div class="clear"></div>
    <?php pagination(); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
