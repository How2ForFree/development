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

<!-- Begin Blog Box -->
    <div class="blogcol">
      <!-- Begin Post Caption -->
      <div class="caption peek">
        <div class="meta">
          <div class="date"><?php the_time('j M Y'); ?></div>
          <div class="comments"><?php comments_popup_link( __( '0', 'fadelicious' ), __( '1', 'fadelicious' ), __( '%', 'fadelicious' ) ); ?></div>
        </div>
        <!-- End Post Caption -->
        <!-- Begin Post Image -->
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'fade_thumbnail', array('class' => 'cover'  )); ?></a> </div><!-- End Post Image -->
      <div class="clearfix"></div>
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><!-- Post Header -->
      
      
    <p>  <?php echo cutMeAgain(get_the_excerpt()); ?></p>
<!-- Post Text -->
      
      
      <a href="<?php the_permalink(); ?>" class="more">Read More</a>
    </div><!-- End Blog Box -->

<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>