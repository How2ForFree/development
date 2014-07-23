<div class="sidebar-wrapper">
	<div class="sidebar-top"></div>
	<div class="sidebar">
		<?php the_post();
			$sidebars = maybe_unserialize(get_option('uds-page-sidebars'));
			$current_sidebar = get_post_meta(get_the_ID(), 'uds-page-sidebar');
			$current_sidebar = isset($current_sidebar[0]) ? $current_sidebar[0] : '';
			$current_sidebar = sanitize_title_with_dashes($current_sidebar);
			if(is_active_sidebar($current_sidebar)) {
				dynamic_sidebar($current_sidebar);
			}
		?>
		<?php $sidebar = is_page() ? (is_front_page() ? 'home' : 'page') : (get_post_type() == 'uds-portfolio' ? 'portfolio' : 'blog') ?>
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)): ?>
			<!-- Static sidebar items -->
		<?php endif; ?>
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('common')): ?>
			<!-- Static sidebar items -->
		<?php endif; ?>
	</div>
	<div class="sidebar-bottom"></div>
</div>