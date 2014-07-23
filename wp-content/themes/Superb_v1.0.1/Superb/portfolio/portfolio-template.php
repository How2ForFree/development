<?php

	$temp = $wp_query;
	
	$base = get_permalink();
	$terms = get_terms('portfolio_category');
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$post_count = wp_count_posts('uds-portfolio');
	$total_pages = ceil((int)($post_count->publish) / 9);
	$active_tags = get_post_meta($post->ID, 'uds-portfolio-show-tags', true);
	
	$cat_id = '';
	
	if(!empty($active_tags)) {
		$query_vars = $active_tags;
	} else {
		$query_vars = isset($wp_query->query_vars['portfolio_category']) ? $wp_query->query_vars['portfolio_category'] : '';
	}

	foreach($terms as $term){
		//d($term->slug);
		if($term->slug == $query_vars){
			$cat_id = $term->term_id;
		}
	}
	//d($cat_id);
	//d($query_vars);
	$portfolio = new WP_Query(array(
		'post_type' => 'uds-portfolio',
		'portfolio_category' => $query_vars,
		'posts_per_page' => 9,
		'paged' => $paged
	));	

	//d($portfolio);
	//d($terms);
?>

<?php if(is_ajax()): ?>
	<?php $wp_query = $portfolio; ?>
	<div class="portfolio">
		<?php foreach($portfolio->posts as $key => $portfolio_item): ?>
			<?php 
				$type = get_post_meta($portfolio_item->ID, 'uds-portfolio-content-type');
				$type = isset($type[0]) ? $type[0] : '';
				$noLB = get_post_meta($portfolio_item->ID, 'uds-portfolio-no-lightbox');
				$noLB = isset($noLB[0]) && $noLB[0] == 'on' ? 'no-lightbox' : '';
				$last = $portfolio_type == 'gallery' && ($key + 1) % 3 == 0 ? 'last' : '';
				$last = $portfolio_type == '3-column' && ($key + 1) % 3 == 0 ? 'last' : $last;
				$last = $portfolio_type == '2-column' && ($key + 1) % 2 == 0 ? 'last' : $last;
				$last = $portfolio_type == '1-column' ? '' : $last;
			?>
			<div id="data-<?php echo $portfolio_item->ID ?>" class="portfolio-item-wrapper <?php echo $last ?>">
				<div class="portfolio-item <?php echo esc_attr(' '.$type.' '.$noLB) ?>">
					<a href="<?php echo get_permalink($portfolio_item->ID) ?>" type="ajax" class="image">
					<?php 
					$dir = get_template_directory_uri();
					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_item->ID), 'full');
					$thumb = urlencode($thumb[0]);
					echo "<img src='$dir/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' class='portfolio-item-image' />";
					?>
					</a>
					<h3 class="portfolio-heading"><a href="<?php echo get_permalink($portfolio_item->ID) ?>"><?php echo esc_html($portfolio_item->post_title) ?></a></h3>
					<div class="excerpt"><?php echo esc_html($portfolio_item->post_excerpt) ?></div>
					<div class="uds-button default">
						<a href="<?php echo get_permalink($portfolio_item->ID) ?>"><?php _e('Continue reading', 'uds-textdomain') ?></a>
					    <div class="uds-button-right"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
<?php else: ?>
	<?php get_header(); the_post(); ?>
		<div class="heading-wrapper">
			  <div class="heading">
			  	<div id="heading-title">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<?php the_breadcrumbs() ?>
				</div>
			  	<form action="<?php bloginfo('url') ?>" method="get" class="searchbox">
			  		<fieldset>
			  			<div class="bg-search-left"></div>
			  			<input type="text" name="s" value="<?php esc_attr_e('type here to search', 'uds-textdomain') ?>" id="top-search" />
			  			<button type="submit"></button>
			  			<div class="bg-search-right"></div>
			  			<div class="clear"></div>
			  		</fieldset>
			  	</form>
			  	<div class="clear"></div>
			  </div>
		</div>
		<?php $custom = get_post_custom() ?>
		<?php if(!empty($custom['heading'][0])): ?>
			  <div class="content-heading">
			  	<?php echo esc_html($custom['heading'][0]) ?>
			  </div>
		<?php endif; ?>
		<div id="content-wrapper">
			<div id="content">
				<div class="page">
					<?php the_content() ?>
				</div>
				<?php $wp_query = $portfolio; ?>
				<div id="portfolio-terms-switcher">
					<?php if(!empty($terms) && empty($active_tags)): ?>
						<div class="terms">
							<div class="terms-tag <?php if($query_vars == '') echo 'current' ?>">
								<div class="terms-active-left"></div>
								<a href="<?php echo esc_url($base) ?>" class="terms-tag-main">All</a>
								<div class="terms-active-right"></div>
								<div class="clear"></div>
							</div>
							<?php foreach($terms as $term): ?>
								<div class="terms-tag <?php if($query_vars == $term->slug) echo 'current' ?>">
									<a href="<?php echo get_term_link($term) ?>" class="terms-tag-main"><?php echo esc_html($term->name) ?></a>
									<div class="clear"></div>
								</div>
							<?php endforeach; ?>
							<div class="clear"></div>
						</div>
					<?php endif; ?>
					<div class="layout-switcher">
						<a href="#" id="switcher-layout-gallery"><?php _e('Gallery', 'uds-textdomain') ?></a>
						<a href="#" id="switcher-layout-3-column"><?php _e('3 Column', 'uds-textdomain') ?></a>
						<a href="#" id="switcher-layout-2-column"><?php _e('2 Column', 'uds-textdomain') ?></a>
						<a href="#" id="switcher-layout-1-column"><?php _e('1 Column', 'uds-textdomain') ?></a>
					</div>			
					<div class="clear"></div>
				</div>
				<?php if(!empty($portfolio)): ?>
					<div class="portfolio layout-<?php echo esc_attr($portfolio_type) ?>">
						<?php foreach($portfolio->posts as $key => $portfolio_item): ?>
							<?php 
								$type = get_post_meta($portfolio_item->ID, 'uds-portfolio-content-type');
								$type = isset($type[0]) ? $type[0] : '';
								$noLB = get_post_meta($portfolio_item->ID, 'uds-portfolio-no-lightbox');
								$noLB = isset($noLB[0]) && $noLB[0] == 'on' ? 'no-lightbox' : '';
								$last = $portfolio_type == 'gallery' && ($key + 1) % 3 == 0 ? 'last' : '';
								$last = $portfolio_type == '3-column' && ($key + 1) % 3 == 0 ? 'last' : $last;
								$last = $portfolio_type == '2-column' && ($key + 1) % 2 == 0 ? 'last' : $last;
								$last = $portfolio_type == '1-column' ? '' : $last;
							?>
							<div id="data-<?php echo $portfolio_item->ID ?>" class="portfolio-item-wrapper <?php echo $last ?>">
								<div class="portfolio-item <?php echo ' '.$type.' '.$noLB ?>">
									<a href="<?php echo get_permalink($portfolio_item->ID) ?>" type="ajax" class="image">
										<?php 
											$dir = get_template_directory_uri();
											$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_item->ID), 'full');
											$thumb = urlencode($thumb[0]);
											echo "<img src='$dir/timthumb.php?src=$thumb&amp;w=450&amp;h=248&amp;zc=0' alt='' class='portfolio-item-image' />";
										?>
									</a>
									<h3 class="portfolio-heading"><a href="<?php echo get_permalink($portfolio_item->ID) ?>"><?php echo esc_html($portfolio_item->post_title) ?></a></h3>
									
									<div class="excerpt"><?php echo esc_html($portfolio_item->post_excerpt) ?></div>
									<div class="uds-button default">
										<a href="<?php echo get_permalink($portfolio_item->ID) ?>"><?php _e('Continue reading', 'uds-textdomain') ?></a>
									    <div class="uds-button-right"></div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="clear"></div>
					</div>
				<?php endif; ?>
				<div class="clear"></div>
				<div class="post-pages">
					<?php if($next = get_next_posts_link(__("&laquo; Older entries", 'uds-textdomain'))): ?>
					<div class="pages-prev uds-button">
						<?php echo $next ?>
						<div class="uds-button-right"></div>
					</div>
					<?php endif; ?>
					<?php if($prev = get_previous_posts_link(__("Newer entries &raquo;", 'uds-textdomain'))): ?>
					<div class="pages-next uds-button">
						<?php echo $prev ?>
						<div class="uds-button-right"></div>
					</div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<?php $wp_query = $temp ?>
			</div>
		</div>
	<?php get_footer() ?>
<?php endif; ?>