<?php

/* ------------------------------------------------------------------------------------------------------------

	Content template - Search form
	
------------------------------------------------------------------------------------------------------------ */

?>

<?php global $domain; ?>

<div class="search-container">
	
	<form class="search-form" method="get" action="<?php echo home_url(); ?>">
		
		<fieldset>
			<p>
				<input type="text" name="s" value="" />
			</p>
		</fieldset>
		
		<p><button class="submit" type="submit"><?php _e('Search', $domain); ?></button></p>
		
	</form>
	
</div> <!-- end search -->