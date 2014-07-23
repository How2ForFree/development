<?php
	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	$ad = null;
	if($id != 0){
		$ad = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." WHERE id=$id");
	}
	
	if($ad != null):
?>
<div class="wrap">
	<h2><?php _e('View Ad', 'uds-textdomain') ?></h2>
	
	<table class="uds-ads-view">
	    <tr>
	    	<td><?php _e('Name', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->name ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Image', 'uds-textdomain') ?></td>
	    	<td><img id="image" src="<?php echo $ad->image_url ?>" alt="" />
	    	</td>
	    </tr>
	    <tr>
	    	<td><?php _e('Destination URL', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->destination_url ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Format', 'uds-textdomain') ?></td>
	    	<td><?php echo  $uds_ads_resolutions[$ad->format] ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Click limit', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->click_limit ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Showing', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->showing == '1' ? __("Yes", 'uds-textdomain') : __("No", 'uds-textdomain') ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Position', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->position + 1 ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Priority', 'uds-textdomain') ?></td>
	    	<td><?php echo  $ad->priority + 1 ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Display from', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->display_from ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Display to', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->display_to ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Ignore Date', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->ignore_date == '1' ? __("Yes", 'uds-textdomain') : __("No", 'uds-textdomain') ?></td>
	    </tr>
	    <tr>
	    	<td><?php _e('Open in new window', 'uds-textdomain') ?></td>
	    	<td><?php echo $ad->new_window == '1' ? __("Yes", 'uds-textdomain') : __("No", 'uds-textdomain') ?></td>
	    </tr>
	</table>
</div>
<?php endif; ?>