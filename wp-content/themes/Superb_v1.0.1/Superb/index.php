<?php get_header(); ?>
	<?php include 'page-tagline.php' ?>
	<div id="content-wrapper">
		<div id="content" class="<?php echo uds_get_option('uds-blog-sidebar-position', 'uds_blog_options') == 'right' ? 'sidebar-right' : 'sidebar-left' ?>">
			<div id="main">
			<?php rewind_posts() ?>
			<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post() ?>
					<?php echo uds_post() ?>
				<?php endwhile; ?>
				<div class="post-pages">
					<?php if($next = get_next_posts_link(__("&laquo; Older entries", 'uds-textdomain'))): ?>
				    <div class="pages-prev uds-button">
				    	<?php echo $next?>
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
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria', 'uds-textdomain') ?></p>
			<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>
	</div>
<?php get_footer() ?>