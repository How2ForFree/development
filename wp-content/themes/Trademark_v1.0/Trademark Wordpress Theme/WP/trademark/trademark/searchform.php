<form action="<?php echo home_url(); ?>" class="searchform" method="get">
	<div>
	   <label for="s" class="screen-reader-text">Search for:</label>
	   <input type="text" class="s" id="s" name="s" value="<?php echo __( "search...", "theme" )?>" onclick="this.value=''" />
	   <input type="submit" value="<?php echo __("Search"); ?>" class="searchsubmit" />
	</div>
</form>
