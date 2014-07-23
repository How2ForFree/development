<?php
/**
 * Reviews Tab
 */
 
global $woocommerce, $post; 

if ( comments_open() ) : ?>
	<div class="panel entry-content" id="tab-reviews">
	
		<?php comments_template(); ?>
	
	<!-- </div>   fix a bug -->
<?php endif; ?>