<?php if(!is_front_page()): ?>
	<?php 
		$tagline_type = get_post_meta($post->ID, 'uds-page-tagline-type');
		$tagline_type = isset($tagline_type[0]) ? $tagline_type[0] : '';
		
		$tagline = get_post_meta($post->ID, 'uds-page-tagline');
		$tagline = isset($tagline[0]) ? $tagline[0] : '';
	 ?>
	<?php if($tagline_type == 'default' || $tagline_type == ''): ?>
	<div class="heading-wrapper">
		<div class="heading">
			<div id="heading-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php if(is_search()): echo __("Search", 'uds-textdomain'); elseif(is_page()): the_title(); else: wp_title(''); endif; ?></a></h2>
				<?php the_breadcrumbs() ?>
			</div>
			<form action="<?php bloginfo('url') ?>" method="get" class="searchbox">
				<fieldset>
					<div class="bg-search-left"></div>
					<input type="text" name="s" value="Search" id="top-search" />
					<button type="submit"></button>
					<div class="bg-search-right"></div>
					<div class="clear"></div>
				</fieldset>
			</form>
			<div class="clear"></div>
		</div>
	</div>
	<?php elseif($tagline_type == 'custom'): ?>
	<div class="heading-wrapper">
	<div class="heading">
		<div class="heading-inner">
			<div id="heading-title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php if(is_search()): echo __("Search", 'uds-textdomain'); elseif(is_page()): the_title(); else: wp_title(''); endif; ?></a></h2>
				<?php the_breadcrumbs() ?>
			</div>
			<div class="custom-tagline"><?php echo esc_html($tagline) ?></div>
			<div class="clear"></div>
		</div>
	</div>
	</div>
	<?php endif;?>
<?php endif; ?>