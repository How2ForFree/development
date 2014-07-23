<?php
/*
Template Name: Homepage Blog2
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
        <?php the_post_thumbnail( 'slider_image' ); ?>
        <?php endif; ?>
        <!--End conditional check for video -->
        
        <?php endwhile; ?>
        <!--/close loop--> 
        
      </div>
      <ul class="pagination"></ul>
        <div class="move"> <a href="#" class="prev">prev</a> <a href="#" class="next">next</a> </div>
    </div></div>
<!-- End Slider -->
  <!-- Begin Page Intro -->


  <?php
  
  global $wp_query;
$postid = $wp_query->post->ID;
  
    $intro = get_post_meta($postid, 'intro', true); 

	if ($intro) {
	    echo "<div class='container'><h1 class='intro'>$intro<span></span></h1></div>";
	}
?>
  <!-- End Page Intro -->
<div class="clearfix"></div>
<!-- Begin Container -->

<div id="container"> 

  
  <div id="blogcontent">
    <?php 
$bcat = get_option('of_blog_category');
$bcatid = get_cat_id($bcat);
if ( get_query_var('paged') ) {
$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
$paged = get_query_var('page');
} else {
$paged = 1;
}
query_posts( array( 'post_type' => 'post', 'paged' => $paged, 'cat'=> $bcatid, 'posts_per_page' => 9 ) );
?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
     <!-- Begin Post -->
    <div class="post">
    	<!-- Begin Post Information-->
        <div class="meta">
          <div class="date">
            <div class="year"><?php the_time('Y'); ?></div>
            <div class="day"><?php the_time('j'); ?></div>
            <div class="month"><?php the_time('M'); ?></div>
          </div>
          <div class="info">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p>Posted by <span class="gray"><?php the_author_posts_link(); ?> </span>
            
            <?php if ( count( get_the_category() ) ) : ?>
                               <?php printf( __( 'under %s' ), get_the_category_list( ', ' ) ); ?>
                            <?php endif; ?>
            
            <?php
                                    $tags_list = get_the_tag_list( '', ', ' );
                                    if ( $tags_list ) : ?>
                                      <?php printf( __( ' tagged %s' ), $tags_list ); ?>
                                <?php endif; ?> | <a href="#"><?php comments_popup_link( __( 'No Comments', 'elemis' ), __( '1 Comment', 'elemis' ), __( '% Comments', 'elemis' ) ); ?></a></p>
          </div>
        </div><!-- End Post Information-->
        <div class="clearfix"></div>
        <!-- Begin Post Image-->
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'fade_blog_thumbnail', array('class' => 'left'  )); ?></a><!-- End Post Image-->
      <p>  <?php echo cutMe(get_the_excerpt()); ?></p>
        <a href="<?php the_permalink(); ?>" class="more">Read More</a>

    </div>
    <!-- End Post -->
    
    <?php endwhile; endif; ?>
    <div class="clear"></div>
    <?php pagination(); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
