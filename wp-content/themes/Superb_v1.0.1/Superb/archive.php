<?php 
	if(is_object($wp_query) && is_object($wp_query->get_queried_object())) {
		$object = $wp_query->get_queried_object();
		if($object->taxonomy == 'portfolio_category') {
			include 'portfolio/portfolio-template.php';
			exit();
		}
	}
?>
<?php get_header(); ?>
	<?php include 'page-tagline.php' ?>
	<div id="content-wrapper">
		<div id="content" class="<?php echo uds_get_option('uds-blog-sidebar-position', 'uds_blog_options') == 'right' ? 'sidebar-right' : 'sidebar-left' ?>">
			<div id="main">
			<?php rewind_posts() ?>
			<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post() ?>
					<?php
					echo uds_post(array(
						'count' => 4,
						'thumb' => false,
						'thumb_width' => 240,
						'thumb_height' => 160,
						'title' => true,
						'title_tag' => 'h3',
						'content' => 'excerpt',
						'date' => true,
						'comment_count' => false,
						'read_more' => false,
						'author' => false
					));
					?>
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