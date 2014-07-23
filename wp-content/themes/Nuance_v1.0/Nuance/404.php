<?php

/* ------------------------------------------------------------------------------------------------------------

	Page template - 404
	
------------------------------------------------------------------------------------------------------------ */

?>

	<?php get_header(); ?>
	
	<?php global $domain; ?>
	
	<h3><?php _e('404 - Not Found', $domain); ?></h3>
	<p><?php _e('The content you were looking for could not be found.', $domain); ?></p>

	<?php get_footer(); ?>