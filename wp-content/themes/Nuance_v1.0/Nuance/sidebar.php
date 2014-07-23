<?php

/* ------------------------------------------------------------------------------------------------------------

	Sidebar template - Pages
	
------------------------------------------------------------------------------------------------------------ */

?>

	<?php global $domain; /* The unique string used for translation */ ?>
	
	<?php 
	
		/* Reset to the default query */
		wp_reset_query();
	
		/* Get the custom fields values */
		$post_custom = get_post_custom($post->ID); 
		
		/* Get special sidebar if it exists */
		if(isset($post_custom['jw_sidebar'][0])){ $sidebar_name = $post_custom['jw_sidebar'][0]; }else{ $sidebar_name = 'Page Widgets'; }
		
		if(!isset($post_custom['jw_layout'])){ $post_custom['jw_layout'][0] = 'layout_cs'; }
		
	?>
	
	<div id="sidebar" class="one-third<?php if((isset($post_custom['jw_layout'][0]) && ($post_custom['jw_layout'][0] == 'layout_cs' || $post_custom['jw_layout'][0] == 'layout_p4')) || (is_archive()) || (is_search())){ ?> last<?php } /* If sidebar + content layout get the left sidebar */ ?>">
	
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
			
			<!-- No widgets START -->
			
			<div class="widget">
				<h6 class="widget-title"><?php _e('No Widgets Added Yet', $domain); ?></h6>
				<p><em><?php _e('Please add them in the WordPress admin page under Appearance &rarr; Widgets. The widget section is', $domain); echo ' "'.$sidebar_name.'".'; ?></em></p>
			</div>
			
			<!-- No widgets END -->
			
		<?php endif; ?>

	</div><!-- #column -->