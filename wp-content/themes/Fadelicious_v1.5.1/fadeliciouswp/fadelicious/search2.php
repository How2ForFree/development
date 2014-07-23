<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>

<!-- Begin Container -->

<div id="container"> 
  <!-- Begin Page Intro -->
  
  <h3 class="contenttag"><?php printf( __( 'Search Results for: &ldquo;%s&rdquo;', 'elemis' ), '' . get_search_query() . '' ); ?></h3>
  <!-- End Page Intro -->
  <div id="blogcontent">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <?php if (is_search() && ($post->post_type=='page')) continue; ?>
    
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
    
    <?php endwhile; ?>
    <?php else : ?>
    <p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
    <div class="clear"></div>
    <?php pagination(); ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
