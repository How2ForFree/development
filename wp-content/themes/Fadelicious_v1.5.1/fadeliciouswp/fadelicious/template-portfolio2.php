<?php
/**
 * Template Name: Portfolio2
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/style/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">

jQuery(document).ready(function() {
    // Initialise the first and second carousel by class selector.
	// Note that they use both the same configuration options (none in this case).
	jQuery('.carousel').jcarousel({
        scroll: 4
    });
	
	
});

</script>
<!-- Begin Container -->
<div id="container" class="pcarousel sgrid">
<!-- Begin Page Intro -->

<?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?>
<!-- End Page Intro -->

<?php
$pcat = get_option('of_portfolio_category');
$pcatid = get_cat_id($pcat);


$cat_args=array(
  'orderby' => 'ID',
  'order' => 'ASC',
  'child_of' =>$pcatid
   );
$categories=get_categories($cat_args);
  
  foreach($categories as $category) { 
  
   echo '<h2><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </h2><ul class="carousel"> ';
    $args=array(
      'showposts' => 99999,
      'category__in' => array($category->term_id),
      'caller_get_posts'=>1
    );
    $posts=get_posts($args);
      if ($posts) {
     
        foreach($posts as $post) {
          setup_postdata($post); ?>
 <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
      
      <li>
      <!-- Begin Full Size Link and Description --> 
      <!-- Begin conditional check for video -->
<?php 
    $main_video=get_post_meta($post->ID, 'main_video', true); 
    $main_music=get_post_meta($post->ID, 'main_music', true);
    $site_url=get_post_meta($post->ID, 'site_url', true);
    ?>
    <?php if ( $main_video ) : ?>
    <a rel="zoombox[portfolio]" href="<?php echo get_post_meta($post->ID, "main_video", $single = true); ?>" alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="play2"><?php the_post_thumbnail( 'fade_thumbnail' ); ?> </a>
    

    <?php elseif ( $main_music ) : ?>
    
    
    
    <a rel="zoombox[portfolio]" href="<?php echo get_post_meta($post->ID, "main_music", $single = true); ?>" alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="play2"><?php the_post_thumbnail( 'fade_thumbnail' ); ?> </a>
    

    <?php else : ?>
    
    <a rel="zoombox[portfolio]" href="<?php echo $image_url;?>" alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="zoom2"><?php the_post_thumbnail( 'fade_thumbnail' ); ?></a>
    <?php endif; ?>
<!--End conditional check for video --> 
      <!-- End Full Size Link and Description --> 
      
      </span> </li>
      <?php
          $otherson = get_post_meta($post->ID, 'others', false); 
      
      	if ($otherson) { ?>
      	    
      <div class="hiddenothers">
      <?php $others = get_post_meta($post->ID, 'others', false); ?>
      
      
                  <?php foreach($others as $other) { ?>
                  <a href="<?php echo ''.$other.'' ?>" rel="zoombox[portfolio]" alt="<?php the_title(); ?>"></a>         
                  <?php }?>
      
      </div>
      
      
      	<?php } ?>
          <?php
        } // foreach($posts
      } // if ($posts
      echo '</ul>';
    } // foreach($categories
 ?>

<div class="clearfix"></div>
<!-- End Container -->

</div>
<?php get_footer(); ?>
