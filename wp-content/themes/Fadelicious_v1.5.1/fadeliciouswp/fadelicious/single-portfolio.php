<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>



<!-- Begin Container -->

<div id="container">
<?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?>
<div id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      
      <!-- Begin Post -->
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> title="<?php $category = get_the_category(); echo $category[0]->cat_name; ?>">

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
                                <?php endif; ?> | <a href="#"><?php comments_popup_link( __( 'No Comments', 'fadelicious' ), __( '1 Comment', 'fadelicious' ), __( '% Comments', 'fadelicious' ) ); ?></a></p>
          </div>
        </div><!-- End Post Information-->
        <div class="clearfix"></div>
        <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<!-- Begin conditional check for image -->
    <?php 


if(has_post_thumbnail()) { ?>
	



<!-- Begin conditional check for video -->
    <?php 
    $main_video=get_post_meta($post->ID, 'main_video', true); 
    $main_music=get_post_meta($post->ID, 'main_music', true);
    ?>
    
    
    <?php if ( $main_video ) : ?>
<a href="<?php echo get_post_meta($post->ID, "main_video", $single = true); ?>" rel="zoombox[<?php echo the_slug(); ?>]" alt="<?php the_title(); ?>" class="play">
<?php the_post_thumbnail( 'blog-permalink'); ?></a>
    

    <?php elseif ( $main_music ) : ?>

   <a href="<?php echo get_post_meta($post->ID, "main_music", $single = true); ?>" rel="zoombox[<?php echo the_slug(); ?>]" alt="<?php the_title(); ?>" class="play">
<?php the_post_thumbnail( 'blog-permalink'); ?></a>
    

    <?php else : ?>
    
    
  <a rel="zoombox[<?php echo the_slug(); ?>]" href="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="zoom">
<?php the_post_thumbnail( 'blog-permalink'); ?></a>
    <?php endif; ?>
<!--End conditional check for video -->


<?php } else { ?>
  


   

 <?php }  ?>
<!--End conditional check for image -->



<?php
    $otherson = get_post_meta($post->ID, 'others', false); 

	if ($otherson) { ?>
	    
<div class="hiddenothers">
<?php $others = get_post_meta($post->ID, 'others', false); ?>


            <?php foreach($others as $other) { ?>
            <a href="<?php echo ''.$other.'' ?>" rel="zoombox[<?php echo the_slug(); ?>]" alt="<?php the_title(); ?>"></a>         
            <?php }?>

</div>


	<?php } ?>
	<br />
      <p>  <?php the_content(); ?></p>

    </div>
    <div class="sharesocial"><h3>Share this</h3>
    <div class="share">
    
    <a href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php the_permalink(); ?>" title="Tweet this!">
	<img src="<?php bloginfo('template_directory'); ?>/style/images/s_twitter.png" alt="Tweet this!" /></a>				
	<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="StumbleUpon.">
	<img src="<?php bloginfo('template_directory'); ?>/style/images/s_stumbleupon.png" alt="StumbleUpon" /></a>
	<a href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Digg this!">
	<img src="<?php bloginfo('template_directory'); ?>/style/images/s_digg.png" alt="Digg This!" /></a>				
	<a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Bookmark on Delicious.">
	<img src="<?php bloginfo('template_directory'); ?>/style/images/s_delicious.png" alt="Bookmark on Delicious" /></a>
	<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php the_title(); ?>" title="Share on Facebook.">
	<img src="<?php bloginfo('template_directory'); ?>/style/images/s_facebook.png" alt="Share on Facebook" id="sharethis-last" /></a>
    <a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_google.png" alt="" /></a>
    <a href="http://www.friendfeed.com/share?title=<?php the_title(); ?>&link=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_friendfeed.png" alt="" /></a>
    <a href="http://www.tumblr.com/share?v=3&u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_tumblr.png" alt="" /></a>
    <a href="http://technorati.com/faves?add=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_techorati.png" alt="" /></a>
    <a href="mailto:?body=<?php the_permalink(); ?>&subject=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_email.png" alt="" /></a>
    <a href="http://posterous.com/share?linkto=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/s_posterous.png" alt="" /></a>
    </div>
     </div>
    <!-- End Post -->
      
<?php comments_template( '', true ); ?>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
