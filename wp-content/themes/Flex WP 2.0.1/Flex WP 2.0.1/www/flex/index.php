<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

        <div <?php post_class("post_float rounded") ?> id="post-<?php the_ID(); ?>">
        	
			<?php
			if ( has_post_thumbnail() ) { ?>
				
					<?php if(get_custom_field('lightbox_link')) { ?>
						
						<a class="ceebox" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>"><?php the_post_thumbnail(); ?></a>
						
					<?php } elseif(get_custom_field('lightbox_gallery_link')) { ?>
						
						<div class="ceebox"><a title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_gallery_link',true); ?>"><?php the_post_thumbnail(); ?></a> <div style="display: none;"><?php echo do_shortcode('[gallery link="file"]'); ?></div>
</div>
						
					<?php } else { ?>
						
						<a class="img_link" title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
						
					<?php } ?>	
									
			<?php } else { ?>
				
					<a class="img_link" title="<?php the_title(); ?>" href="<?php the_permalink() ?>"> <img src="<?php echo get_option('theme_post_blankthumb',true); ?>" class="avatar" alt="<?php the_title(); ?>" /></a>   
					        
			<?php } ?>
                
                
               
			<?php if(get_custom_field('lightbox_link')) { ?>
				
            	<h2><a class="ceebox" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>"><?php the_title(); ?></a></h2>
            
            <?php } else { ?>
					
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
			<?php } ?>	
			
            <div class="post_tags"><?php the_tags('', ', ', '<br />'); ?></div>
            
        </div>

	<?php endwhile; ?>
   	<?php  
		include('wp-pagenavi.php');  
		if(function_exists('wp_pagenavi')) { wp_pagenavi('<div class="rounded pagination">', '</div>'); }  
	?>

<?php else : ?>

	<div class="single_post rounded">
        <h1>Not Found</h1>
        <p>Ahh shucks! You are looking for something that isn't here. Try searching again or double-check the reference you are looking for.</p>
    </div>

<?php endif; ?>


<?php #get_sidebar(); ?>
<?php get_footer(); ?>