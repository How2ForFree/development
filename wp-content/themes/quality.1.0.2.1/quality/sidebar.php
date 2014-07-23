<?php
/*	@Theme Name	:	Quality
* 	@file         :	sidebar.php
* 	@package      :	Quality
* 	@author       :	VibhorPurandare
* 	@license      :	license.txt
* 	@filesource   :	wp-content/themes/Quality/sidebar.php
*/	
?>
<div class="col-md-4 qua-sidebar">	
	<?php if ( is_active_sidebar( 'sidebar-primary' ) )
			{ dynamic_sidebar( 'sidebar-primary' );	}
			else  {  	
			$args=array(
					'before_title' => '<div class="qua_sidebar_widget_title"><h2>',
					'after_title' => '<div id="" class="qua-footer-separator"></div></h2></div>');  
				the_widget('WP_Widget_Archives','',$args); 	
				the_widget('WP_Widget_Categories','',$args);
			}
			?>	
</div>