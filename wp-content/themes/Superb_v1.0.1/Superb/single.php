<?php if(is_ajax()):?>
	<?php the_post(); the_content(); ?>
<?php else : ?>
<?php get_header() ?>
<?php include 'page-tagline.php' ?>
<?php rewind_posts() ?>
<div id="content-wrapper">
	<div id="content" class="<?php echo uds_get_option('uds-blog-sidebar-position', 'uds_blog_options') == 'right' ? 'sidebar-right' : 'sidebar-left' ?>">
		<div id="main">
			<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post() ?>
					<div id="post-<?php the_ID() ?>" <?php post_class('post') ?>>
				   		<p class="meta">
				   			<img src="<?php echo  get_template_directory_uri() . "/images/time.png" ?>" class="meta-img" alt="" />
				   			<?php printf(__('Posted on %s', 'uds-textdomain'), get_the_time('j') . ',' . get_the_time('M')) ?> |
				   			<img src="<?php echo  get_template_directory_uri() . "/images/author.png" ?>" class="meta-img" alt="" />
				   			<?php printf(__('Posted by %s', 'uds-textdomain'), get_the_author()); ?>
				   		</p>
				   		<div class="post-content">
						    <?php the_content() ?>
						    <div class="clear"></div>
						</div>
						<?php if(is_single()): ?>
						    <?php wp_link_pages(array(
						    	'before'			=> '<p class="center" id="post-pager">',
						    	'after'				=> '</p>',
						    	'link_before'		=> ' ',
						    	'link_after'		=> ' ',
						    	'next_or_number'	=> 'number',
						    	'nextpagelink'		=> __('Next page &raquo;', 'uds-textdomain'),
						    	'previouspagelink'	=> __('&laquo; Previous page', 'uds-textdomain'),
						    	'pagelink'			=> '%',
						    	'more_file'			=> '',
						    	'echo'				=> 1 )
						    ); 
						    ?>
						    <?php if(uds_get_option('uds-show-authorbox', 'uds_blog_options') == 'on'): ?>
						    <div id="authorbox">  					    	  
					    		<?php if (function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('user_email'), '80'); }?> 
					    		<div class="authorbox-meta"> 
					    			<h4><?php _e('About', 'uds-textdomain') ?> <a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('display_name'); ?></a></h4>  
					    			<p><?php the_author_meta('description'); ?></p>  
					    		</div>
					    		<div class="clear"></div>
						    </div>
						    <?php endif; ?>
						    <?php comments_template() ?>
						<?php endif; ?>
						<div class="clear"></div>
					</div>
				<?php endwhile; ?>
				<div class="post-pages">
				    <div class="pages-prev"><?php next_posts_link(__("&laquo; Older entries", 'uds-textdomain'))?></div>
				    <div class="pages-next"><?php previous_posts_link(__("Newer entries &raquo;", 'uds-textdomain'))?></div>
				    <div class="clear"></div>
				</div>
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria', 'uds-textdomain') ?></p>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<?php get_footer() ?>
<?php endif; ?>