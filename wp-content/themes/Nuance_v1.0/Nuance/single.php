<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Blog single post page
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>

	<?php if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; } ?>
	
	<?php get_header(); ?>
	
	<?php 
		
		/* Get the custom fields values */
		$post_custom = get_post_custom($post->ID);
		
		/* Get the post/page */
		the_post();
	
	?>

	<?php if(isset($post_custom['jw_layout'][0]) && $post_custom['jw_layout'][0] == 'layout_sc'){ get_sidebar('blog'); } /* If sidebar + content layout get the left sidebar */ ?>
		
	<div id="content" class="<?php if($post_custom['jw_layout'][0] != 'layout_c'){ ?>two-third<?php } if($post_custom['jw_layout'][0] == 'layout_sc'){ ?> last<?php } ?>">
			
		<div class="post-entry">
			
			<?php if(isset($post_custom['jw_composer'][0]) && $post_custom['jw_composer'][0] == 'active'){ ?>
	
				<?php echo do_shortcode($post_custom['jw_composer_front'][0]); ?>
				
			<?php }else{ ?>
				
				<!-- Thumbnail -->
				<?php if($jw_blog_thumbnails == 'on'){ ?>
					
					<div class="<?php echo $image_animate_class; ?>">
						<?php
							if($post_custom['jw_layout'][0] == 'layout_c'){
								if(has_post_thumbnail()){ the_post_thumbnail('jw_blog_full', array('class' => 'wrapped')); } /* Show the "full size" post thumbail if there is one */ 
							}else{
								if(has_post_thumbnail()){ the_post_thumbnail('jw_blog', array('class' => 'wrapped')); } /* Show the "one third size" post thumbail if there is one */ 
							}
						?>
					</div>
				
				<?php } ?>
				
				<!-- Content -->
				<?php the_content();  ?>
				
			<?php } ?>
		
			<div class="post-date">
				<span class="post-date-top"><?php the_time('M'); ?></span>
				<span class="post-date-middle"><?php the_time('jS'); ?></span>
				<span class="post-date-bottom"><?php the_time('Y'); ?></span>
			</div>
		
		</div> <!-- .post-entry -->
		
		<?php wp_reset_query(); ?>
		
		<?php if($jw_blog_about_author == 'on'){ jw_about_author(); } ?>
		
		<?php comments_template(); ?>
		
	</div><!-- #content -->
		
	<?php if(!isset($post_custom['jw_layout'][0]) || $post_custom['jw_layout'][0] == 'layout_cs'){ get_sidebar('blog'); } /* If sidebar + content layout get the left sidebar */ ?>
	
	<?php get_footer(); ?>