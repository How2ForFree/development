<div id="main">	
	<?php if(is_front_page()): ?>
		<?php if(uds_get_option('uds-show-tagline', 'uds_home_page_options') == 'on'): ?>
			<div id="tagline-wrapper">
				<div id="tagline">
					<h2 class="tagline-text"><?php echo esc_html(uds_get_option('uds-tagline-text', 'uds_home_page_options')) ?></h2>
					<?php $link = uds_get_option('uds-tagline-button-link', 'uds_home_page_options'); ?>
					<?php $text = uds_get_option('uds-tagline-link-text', 'uds_home_page_options'); ?>
					<?php if(!empty($link) && !empty($text)): ?>
						<div class="right tour-button-bg">
							<a  class="right tour-button" href="<?php echo esc_url($link) ?>" id="tagline-link">
								<?php echo esc_html($text) ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID() ?>" <?php post_class('') ?>>
				<div class="post-content">
				    <?php the_content() ?>
				    <div class="clear"></div>
				</div>
			    <?php wp_link_pages(array(
			    	'before'			=> '<p class="center" id="post-pager">',
			    	'after'				=> '</p>',
			    	'link_before'		=> ' ',
			    	'link_after'		=> ' ',
			    	'next_or_number'	=> 'number',
			    	'nextpagelink'		=> __('Next page &raquo;'),
			    	'previouspagelink'	=> __('&laquo; Previous page'),
			    	'pagelink'			=> '%',
			    	'more_file'			=> '',
			    	'echo'				=> 1 )
			    ); 
			    ?>
				<div class="clear"></div>
			</div>
		<?php endwhile; ?>
		<?php if(!is_front_page()) comments_template(); ?>
	<?php else: ?>
		<p><?php _e('Sorry, no posts matched your criteria', 'uds-textdomain') ?></p>
	<?php endif; ?>
</div>