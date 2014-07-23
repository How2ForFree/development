<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<script type="text/javascript">
			$(document).ready(function(){
				$('.caption.peek').hover(function(){
					$(".cover", this).stop().animate({top:'25px'},{queue:false,duration:160});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:160});
				});
			});
			
			
		</script>		

<!-- Begin Container -->

<div id="container">
<h3 class="contenttag"><?php
					printf( __( 'Tag Archives: %s', 'twentyten' ), '' . single_tag_title( '', false ) . '' );
				?></h3>
<div id="blogcontent">
	

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
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>