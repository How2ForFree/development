<?php get_header() ?>
	<div class="heading-wrapper">
		<div class="heading">
			<div id="heading-title">
				<h2><a href="#" rel="bookmark"><?php _e('404 Not Found', 'uds-textdomain') ?></a></h2>
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
	<div id="content-wrapper">
		<div id="content" class="sidebar-right">
			<div id="main">
				<div class="post-content">
					<div class="box info"><?php _e("We don't seem to have the page you requested.", 'uds-textdomain') ?></div>
					<p></p>
					<h3><?php _e("Why?", 'uds-textdomain') ?></h3>
					<ol class="uds-list">
						<li><?php _e("You clicked a broken link", 'uds-textdomain') ?></li>
						<li><?php _e("You misspelled the UR", 'uds-textdomain') ?>L</li>
						<li><?php _e("The page was deleted", 'uds-textdomain') ?></li>
					</ol>
					<h3><?php _e("What now?", 'uds-textdomain') ?></h3>
					<p><?php _e("You can use search box in the upper right section to search through existing pages.", 'uds-textdomain') ?></p>
					<p></p>
					<p><?php _e("Or you can either pick a page from these.", 'uds-textdomain') ?></p>
					<ul>
						<?php
							wp_list_pages(array(
							    'depth'        => 0,
							    'show_date'    => true,
							    'date_format'  => get_option('date_format'),
							    'child_of'     => 0,
							    'exclude'      => '',
							    'title_li'     => '',
							    'echo'         => 1,
							    'authors'      => '',
							    'sort_column'  => 'menu_order, post_title',
							    'link_before'  => '',
							    'link_after'   => '',
							    'exclude_tree' => '' )
							);
						?>
					</ul>
				</div>
			</div>
			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>
	</div>
<?php get_footer() ?>