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