<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Template Name: Portfolio
	
	Custom page template - Portfolio
	
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
		
		if($post_custom['jw_layout'][0] == 'layout_p1'){ 
			if(get_option('jw_portfolio_per_page_p1') !== FALSE){
				$portfolio_posts_to_query = get_option('jw_portfolio_per_page_p1');
			}else{
				$portfolio_posts_to_query = 6;
			}
		}else if($post_custom['jw_layout'][0] == 'layout_p2'){
			if(get_option('jw_portfolio_per_page_p2') !== FALSE){
				$portfolio_posts_to_query = get_option('jw_portfolio_per_page_p2');
			}else{
				$portfolio_posts_to_query = 6;
			}
		}else if($post_custom['jw_layout'][0] == 'layout_p3' || $post_custom['jw_layout'][0] == 'layout_p4'){
			if(get_option('jw_portfolio_per_page_p3') !== FALSE){
				$portfolio_posts_to_query = get_option('jw_portfolio_per_page_p3');
			}else{
				$portfolio_posts_to_query = 6;
			}
		}else{
			$portfolio_posts_to_query = 6;
		}
		
		// This will get an array of posts belonging to the terms you defined in the 'portfolio_terms_ids' variable
		if(isset($post_custom['jw_portfolio_categories'][0]) && $post_custom['jw_portfolio_categories'][0] != 'show_all'){
			$portfolio_categories_to_query = get_objects_in_term( explode( ",", $post_custom['jw_portfolio_categories'][0] ), 'jw_portfolio_categories');
			$portfolio_posts_to_query = -1;
		}else{
			$portfolio_categories_to_query = '';
		}
		
		/* 
			Query the portfolio posts (custom post type named jw_portfolio).
		*/
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'paged'				=> $paged,
			'post_type'			=> 'jw_portfolio',
			'posts_per_page'	=> $portfolio_posts_to_query,
			'post__in'			=> $portfolio_categories_to_query
		);
		$jw_query = new WP_Query($args); 
		
		$count = 0;
		
		the_post();

	?>
			
	<?php if(isset($post_custom['jw_portfolio_categories'][0]) && $post_custom['jw_portfolio_categories'][0] != '' && isset($post_custom['jw_portfolio_filter'][0]) && $post_custom['jw_portfolio_filter'][0] != 'no'){ ?>
		
		<div id="portfolio-filter" class="type-<?php echo $post_custom['jw_portfolio_filter_type'][0] ?>" style="text-align:center">
			
			<?php if($post_custom['jw_portfolio_filter_type'][0] == 'textual'){ ?>
			
					<ul class="col-clear">
						<?php
						?><li><a href="<?php bloginfo('template_url') ?>/functions/quicksand-load.php?type=<?php echo $post_custom['jw_layout'][0] ?>&cat_id=<?php echo $post_custom['jw_portfolio_categories'][0]; ?>&last=3"><?php _e('All', $domain); ?></a></li><?php
						$portfolio_categories = explode(",", $post_custom['jw_portfolio_categories'][0]);
						foreach($portfolio_categories as $p_cat){
							$p_cat_details = get_term_by('id', $p_cat, 'jw_portfolio_categories');
							?><li><a href="<?php bloginfo('template_url') ?>/functions/quicksand-load.php?type=<?php echo $post_custom['jw_layout'][0] ?>&cat_id=<?php echo $p_cat; ?>&last=3"><?php echo $p_cat_details->name; ?></a></li><?php
						}
						?>
						<li id="portfolio-filter-info">&larr; <em><?php _e('Filter by category', $domain); ?></em></li>
					</ul>			
			
			<?php }else{ ?>
			
				<?php
					echo do_shortcode('[button color="'.$post_custom['jw_portfolio_filter_button_color'][0].'" link="'.get_bloginfo('template_url').'/functions/quicksand-load.php?type='.$post_custom['jw_layout'][0].'&cat_id='.$post_custom['jw_portfolio_categories'][0].'&last=3"]'.__('All', $domain).'[/button]');
					$portfolio_categories = explode(",", $post_custom['jw_portfolio_categories'][0]);
					foreach($portfolio_categories as $p_cat){
						$p_cat_details = get_term_by('id', $p_cat, 'jw_portfolio_categories');
						echo do_shortcode('[button color="'.$post_custom['jw_portfolio_filter_button_color'][0].'" link="'.get_bloginfo('template_url').'/functions/quicksand-load.php?type='.$post_custom['jw_layout'][0].'&cat_id='.$p_cat.'&last=3"]'.$p_cat_details->name.'[/button]');
					}
				?>
			
			<?php } ?>
		</div>
		<?php if($post_custom['jw_portfolio_filter_type'][0] == 'buttons'){ ?>
			<div class="separator"></div>
		<?php } ?>
	
	<?php } ?>
			
	<?php $count = 0; ?>
	
	<?php if($post_custom['jw_layout'][0] == 'layout_p1'){ ?>
		
		<div class="portfolio-popup">
	
			<ul class="portfolio-listing col-clear">
				
				<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; /* Loop the posts */ ?>
				
					<?php $c_post_custom = get_post_custom($post->ID); ?>
					
					<li data-id="quicksand-id-<?php echo $post->ID; ?>" class="<?php echo $image_animate_class; ?>">
						<?php if(has_post_thumbnail()){ ?>
							<?php the_post_thumbnail('jw_portfolio_grid', array('class' => "grid-img")); ?>
						<?php } ?>
						<div class="portfolio-popup-info">
							
							<!-- Title -->
							<span class="portfolio-popup-info-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
							
							<!-- Description -->
							<span class="portfolio-popup-info-description"><?php echo jw_text_excerpt(get_the_excerpt(), 120); ?></span>
							
							<!-- Client -->
							<?php if(isset($c_post_custom['jw_portfolio_client'][0])){ ?>
								<span><strong><?php _e('Client', $domain); ?></strong> \\ <?php echo $c_post_custom['jw_portfolio_client'][0]; ?></span>
							<?php } ?>
							
							<!-- Categories -->
							<?php 
							$portfolio_cats = get_the_terms($post->ID, 'jw_portfolio_categories');
							if(!empty($portfolio_cats)){
							?>
								<span><strong><?php _e('What we did', $domain); ?></strong> \\ 
									
									<?php 
										foreach($portfolio_cats as $portfolio_cat){
											echo $portfolio_cat->name.', ';
										}
									
									?>
								
								</span>
							
							<?php } ?>
							
							<!-- Author -->
							<?php if(isset($c_post_custom['jw_portfolio_author'][0])){ ?>
								<span><strong><?php _e('Author', $domain); ?></strong> \\ <?php echo $c_post_custom['jw_portfolio_author'][0]; ?></span>
							<?php } ?>
							
							<!-- Date -->
							<span><strong><?php _e('Date', $domain); ?></strong> \\ <?php the_time('F j Y'); ?></span>
							
							<!-- Actions -->
							<span class="portfolio-popup-info-actions">
								<?php if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p1 == 'on'){ ?>
									<?php if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; } ?>
									<?php if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; } ?>
									<a href="<?php echo $real_link; ?>" class="portfolio-popup-info-zoom" rel="prettyPhoto[pp_gal_<?php echo $post->ID ?>]"><?php _e('zoom', $domain); ?></a>
									<?php
										if(isset($c_post_custom['jw_portfolio_images'][0])){
											$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
											$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.$post->ID.'"', $jw_portfolio_images);
											echo do_shortcode($jw_portfolio_images);
										}
									?>
								<?php } ?>
								<a href="<?php the_permalink(); ?>" class="portfolio-popup-info-more"><?php _e('more', $domain); ?></a>
							</span>
							
						</div><!-- .portfolio-popup-info -->
							
					</li> <!-- end portfolio item -->
				
				<?php endwhile; else: /* If no posts found */ ?>
					
					<p><?php _e('The portfolio is empty', $domain); ?></p>
				
				<?php endif; /* End if have posts */ ?>
				
			</ul>
			
		</div> <!-- .portfolio-popup -->
		
		<div class="separator noline"></div>
			
		<?php 
			
			/* Pagination */
			$num_pages = $jw_query->max_num_pages;
			jw_pagination($num_pages);
			
		?>
		
	<?php }elseif($post_custom['jw_layout'][0] == 'layout_p2' || $post_custom['jw_layout'][0] == 'layout_p3' || $post_custom['jw_layout'][0] == 'layout_p4'){ ?>
		
		<?php $real_count = 0; ?>
		
		<?php if($post_custom['jw_layout'][0] == 'layout_p3' || $post_custom['jw_layout'][0] == 'layout_p4'){ $max_count = 2; }else{ $max_count = 3; } ?>
		
		<?php if($post_custom['jw_layout'][0] == 'layout_p3'){ get_sidebar(); } ?>
		
		<div id="content" class="<?php if($post_custom['jw_layout'][0] == 'layout_p3' || $post_custom['jw_layout'][0] == 'layout_p4'){ ?>two-third<?php } if($post_custom['jw_layout'][0] == 'layout_p3'){ ?> last<?php } ?>">
		
			<ul class="portfolio-listing">
			
				<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; $real_count++; /* Loop the posts */ ?>
					
					<?php $c_post_custom = get_post_custom($post->ID); ?>
				
					<li class="one-third<?php if($count == $max_count){ ?> last<?php $count = 0; } if($real_count <= $max_count){ ?> no-margin-top<?php }  ?>" data-id="quicksand-id-<?php echo $post->ID; ?>">
						<?php if(has_post_thumbnail()){ ?>
							
							<?php if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p2 == 'on'){ ?>
								<?php if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; $lightbox_class = 'lightbox-video'; } ?>
								<?php if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; $lightbox_class = 'lightbox-image'; } ?>
								<a href="<?php echo $real_link; ?>" class="<?php echo $image_animate_class; ?> <?php echo $lightbox_class; ?>" rel="prettyPhoto[pp_gal_<?php echo $post->ID; ?>]"><?php the_post_thumbnail('jw_portfolio_listing', array('class' => 'wrapped')); ?></a>
								<?php
									if(isset($c_post_custom['jw_portfolio_images'][0])){
										$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
										$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.get_the_ID().'"', $jw_portfolio_images);
										echo do_shortcode($jw_portfolio_images);
									}
								?>
							<?php }else{ ?>
								<a href="<?php the_permalink(); ?>"  class="<?php echo $image_animate_class; ?> lightbox-none"><?php the_post_thumbnail('jw_portfolio_listing', array('class' => 'wrapped')); ?></a>
							<?php } ?>
							
						<?php } ?>
						<span class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
						<?php echo jw_text_excerpt(get_the_excerpt(), 90); ?>
					</li>
					
				<?php endwhile; else: /* If no posts found */ ?>
						
					<p><?php _e('The portfolio is empty', $domain); ?></p>
				
				<?php endif; /* End if have posts */ ?>
				
			</ul>
		
			<div class="separator"></div>
			
			<?php 
				
				/* Pagination */
				$num_pages = $jw_query->max_num_pages;
				jw_pagination($num_pages);
				
			?>
			
		</div><!-- .portfolio-listing -->
		
		<?php if($post_custom['jw_layout'][0] == 'layout_p4'){ get_sidebar(); } ?>
		
	<?php } ?>

	<?php get_footer(); ?>