<?php

/* ------------------------------------------------------------------------------------------------------------

	Sidebar template - Portfolio
	
------------------------------------------------------------------------------------------------------------ */

?>
	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>
	
	<?php global $domain; /* The unique string used for translation */ ?>

	<?php 
		
		/* Reset to the default query */
		wp_reset_query();
		
		/* Get the custom fields values */
		$post_custom = get_post_custom(get_the_ID());
		
		/* Get special sidebar if it exists */
		if(isset($post_custom['jw_sidebar'][0])){ $sidebar_name = $post_custom['jw_sidebar'][0]; }else{ $sidebar_name = 'Portfolio Widgets'; }
		
		if(!isset($post_custom['jw_layout'])){ $post_custom['jw_layout'][0] = 'layout_cs'; }
		
	?>
	
	<div id="sidebar" class="one-third<?php if((isset($post_custom['jw_layout'][0]) && $post_custom['jw_layout'][0] == 'layout_cs') || (is_archive())){ ?> last<?php } /* If sidebar + content layout get the left sidebar */ ?>">
		
		<?php if($jw_portfolio_single_sidebar_description == 'on' && isset($post_custom['jw_portfolio_description']) && $post_custom['jw_portfolio_description'][0] != ''){ ?>
		
			<div><?php echo do_shortcode($post_custom['jw_portfolio_description'][0]); ?></div>
			
			<div class="separator"></div>
			
		<?php } ?>
		
		<?php if($jw_portfolio_single_sidebar_info == 'on'){ ?>
		
			<h6><?php _e('Project info', $domain); ?></h6>
			
			<!-- Author -->
			<?php if(isset($post_custom['jw_portfolio_author'][0])){ ?>
				<span class="block"><span class="portfolio-info-title"><?php _e('Author: ', $domain); ?></span> <span class="portfolio-info-value"><?php echo $post_custom['jw_portfolio_author'][0]; ?></span></span>
			<?php } ?>
			
			<!-- Client -->
			<?php if(isset($post_custom['jw_portfolio_client'][0])){ ?>
				<span class="block"><span class="portfolio-info-title"><?php _e('Client:', $domain); ?></span> <span class="portfolio-info-value"><?php echo $post_custom['jw_portfolio_client'][0]; ?></span></span>
			<?php } ?>
			
			<!-- Categories -->
			<?php 
			$portfolio_cats = get_the_terms(get_the_ID(), 'jw_portfolio_categories');
			if(!empty($portfolio_cats)){
			?>
				<span class="block"><span class="portfolio-info-title"><?php _e('What we did:', $domain); ?></span> 
					
					<span class="portfolio-info-value">
					<?php 
						foreach($portfolio_cats as $portfolio_cat){
							echo $portfolio_cat->name.', ';
						}
					
					?>
					</span>
				
				</span>
			
			<?php } ?>
			
			<!-- Date -->
			<span><span class="portfolio-info-title"><?php _e('Release Date:', $domain); ?></span> <span class="portfolio-info-value"><?php the_time('F j Y'); ?></span></span>
			
			<div class="separator"></div>
			
		<?php } ?>
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
			
			<!-- No widgets START -->
			<?php if($jw_portfolio_single_sidebar_description == 'off' && $jw_portfolio_single_sidebar_info == 'off'){ ?>
			
				<div class="widget">
					<h6 class="widget-title"><?php _e('No Widgets Added Yet', $domain); ?></h6>
					<p><em><?php _e('Please add them in the WordPress admin page under Appearance &rarr; Widgets. The widget section is', $domain); echo ' "'.$sidebar_name.'".'; ?></em></p>
				</div>
			
			<?php } ?>
			
			<!-- No widgets END -->
			
		<?php endif; ?>

	</div><!-- #column -->