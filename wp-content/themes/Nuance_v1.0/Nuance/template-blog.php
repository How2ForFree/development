<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Template Name: Blog
	
	Custom page template - Blog
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>
	
	<?php if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; } ?>
	
	<?php get_header(); ?>
	
	<?php global $domain; ?>
	
	<?php 
		
		/* Get the custom fields values */
		$post_custom = get_post_custom($post->ID); 
	
	?>
	
	<?php
		
		/* Query posts from blog */
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'paged' 			=> $paged, 
			'post_type' 		=> 'post',
			'posts_per_page'	=> $jw_posts_per_page
		);
		$jw_query = new WP_Query($args);

		$count = 0;
		
	?>
		
	<?php if($post_custom['jw_layout'][0] == 'layout_sc'){ get_sidebar('blog'); } /* If sidebar + content layout get the left sidebar */ ?>
	
	<div id="content" class="<?php if($post_custom['jw_layout'][0] != 'layout_c'){ ?>two-third<?php } if($post_custom['jw_layout'][0] == 'layout_sc'){ ?> last<?php } ?>">
	
		<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; /* Loop the posts */ ?>
		
			<?php if($count > 1){ ?><div class="separator-solid"></div><?php } ?>
	
			<div class="post-entry">
				
				<!-- Title -->
				<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<!-- Info -->
				<?php jw_post_meta(); ?>
				
				<!-- Thumbnail -->
				<?php if($jw_blog_thumbnails == 'on'){ ?>
					
					<?php
						if($post_custom['jw_layout'][0] == 'layout_c'){
							if(has_post_thumbnail()){ ?><a href="<?php the_permalink(); ?>" class="<?php echo $image_animate_class; ?>"><?php the_post_thumbnail('jw_blog_full', array('class' => 'wrapped')); ?></a><?php } /* Show the "full size" post thumbail if there is one */ 
						}else{
							if(has_post_thumbnail()){ ?><a href="<?php the_permalink(); ?>" class="<?php echo $image_animate_class; ?>"><?php the_post_thumbnail('jw_blog', array('class' => 'wrapped')); ?></a><?php } /* Show the "one third size" post thumbail if there is one */ 
						}
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
		
		<?php wp_reset_query(); ?>
		
		<?php 
			
			/* Pagination */
			$num_pages = $jw_query->max_num_pages;
			jw_pagination($num_pages);
			
		?>
		
		<?php jw_pagination(); ?>
		
	</div><!-- #content -->
	
	<?php if($post_custom['jw_layout'][0] == 'layout_cs'){ get_sidebar('blog'); } /* If sidebar + content layout get the left sidebar */ ?>
	
	<?php get_footer(); ?>