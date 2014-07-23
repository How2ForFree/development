<?php
/**
 * Template Name: Portfolio4
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
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/style/js/quicksand.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/style/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/style/js/portfolio.js"></script>
<!-- Begin Container -->
<div id="container" class="quicksand">
<!-- Begin Page Intro -->

<?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?>
<!-- End Page Intro -->
<ul class="gallerynav">
      <li>Show:</li>
      <li class="selected-1"><a href="#" data-value="all" class="button2">All<span></span></a></li>
      <?php 
      $pcat = get_option('of_portfolio_category');
$pcatid = get_cat_id($pcat);
  $categories=  get_categories('child_of='.$pcatid.'&orderby=id'); 
  foreach ($categories as $cat) {
  	$input = '<li><a href="#" data-value="category-'.$cat->category_nicename.'" class="button2">';
	$input .= $cat->cat_name;
	$input .= '<span></span></a></li>';
	echo $input;
  }
 ?>
    </ul>
     <div class="clearfix"></div>
<ul id="gallery" class="qsmall">

<?php $recent = new WP_Query(); ?>
<?php $recent->query('showposts=99999&orderby=date&order=desc'); ?>
<?php while($recent->have_posts()) : $recent->the_post(); ?>
 <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>


<?php if ( in_category($pcatid) ) {?>
          <!-- Begin Image -->

    <li data-id="<?php echo "post-".get_the_id();?>"<?php post_class() ?>>  
      <!-- Begin Full Size Link and Description --> 
      <!-- Begin conditional check for video -->
    <?php 
    $main_video=get_post_meta($post->ID, 'main_video', true); 
    $main_music=get_post_meta($post->ID, 'main_music', true);
    $site_url=get_post_meta($post->ID, 'site_url', true);
    ?>
    <?php if ( $main_video ) : ?>
    <a rel="zoombox[portfolio]" href="<?php echo get_post_meta($post->ID, "main_video", $single = true); ?>" 
    
    alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="play2">
    
    
    
    
    <?php the_post_thumbnail( 'fade_thumbnail_bigger' ); ?> </a>
    

    <?php elseif ( $main_music ) : ?>
    
    <a rel="zoombox[portfolio]" href="<?php echo get_post_meta($post->ID, "main_music", $single = true); ?>" alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="play2"><?php the_post_thumbnail( 'fade_thumbnail_bigger' ); ?> </a>
    

    <?php else : ?>
    
    
    <a rel="zoombox[portfolio]" href="<?php echo $image_url;?>" alt="<?php the_title(); ?>  <?php if ( $site_url ) : ?>| &lt;a href=&quot;<?php echo get_post_meta($post->ID, "site_url", $single = true); ?>&quot;&gt;Visit&lt;/a&gt;<?php else : ?><?php endif; ?>" class="zoom2"><?php the_post_thumbnail( 'fade_thumbnail_bigger' ); ?></a>
    <?php endif; ?>
<!--End conditional check for video --> 
      <!-- End Full Size Link and Description --> 
      
      </span> 
      
      
      </li>

    <!-- End Image --> 
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
    
    <?php }?>
    <?php  endwhile; ?>
    
    
    
         
</ul>
<div class="clearfix"></div>
<!-- End Container -->

</div>
<?php get_footer(); ?>
