<?php

/* ------------------------------------------------------------------------------------------------------------

	Page template - Search
	
------------------------------------------------------------------------------------------------------------ */

?>

	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>
	
	<?php if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; } ?>
	
	<?php get_header(); ?>
		
	<?php global $domain; ?>
		
	<?php if($jw_archive_search_layout == 'layout_sc'){ get_sidebar('blog'); } ?>
		
	<div id="content" class="two-third <?php if($jw_archive_search_layout == 'layout_sc'){ ?>last<?php } ?>">
	
		<?php $count = 0; ?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $count++; ?>
		
			<?php if($count > 1){ ?><div class="separator-solid"></div><?php } ?>
	
			<div class="post-entry">
				
				<!-- Title -->
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<!-- Info -->
				<?php jw_post_meta(); ?>
				
				<!-- Thumbnail -->
				<?php if($jw_blog_thumbnails == 'on'){ ?>
					
					<?php
						
							if(has_post_thumbnail()){ ?><a href="<?php the_permalink(); ?>" class="<?php echo $image_animate_class; ?>"><?php the_post_thumbnail('jw_blog', array('class' => 'wrapped')); ?></a><?php } /* Show the "one third size" post thumbail if there is one */ 
						
					?>
				
				<?php } ?>
				
				<!-- Excerpt -->
				<?php if($count == 1 && $jw_blog_first_full == 'on'){ 
					the_content(); 
				}else{ ?>
					<div class="post-excerpt"><?php echo get_the_excerpt(); ?></div>
				<?php } ?>
				
				<div class="post-date">
					<span class="post-date-top"><?php the_time('M'); ?></span>
					<span class="post-date-middle"><?php the_time('jS'); ?></span>
					<span class="post-date-bottom"><?php the_time('Y'); ?></span>
				</div>
				
				<div class="blog-post-separate">
					<a class="blog-post-readmore" href="<?php echo the_permalink(); ?>"><?php _e('Read More &rarr;', $domain); ?></a>
					<span class="blog-post-info"><span><?php _e('By', $domain); ?></span> <?php the_author_posts_link(); ?> <span><?php _e('With', $domain); ?></span> <a href="<?php comments_link(); ?>"><?php comments_number(__('no comments', $domain), __('one comment', $domain), __('% comments', $domain)); ?></a></span>
				</div>
				
			</div> <!-- .post-entry -->
		
		<?php endwhile; else: /* If no posts found */ ?>
			
			<p><?php _e('No posts found', $domain); ?></p>
		
		<?php endif; /* End if have posts */ ?>
		
	
	</div><!-- #content -->
		
	<?php if($jw_archive_search_layout == 'layout_cs'){ get_sidebar('blog'); } ?>
	
<?php get_footer(); ?>