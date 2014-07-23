<?php
	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
	$ad = array();
	$ad['name'] = '';
	$ad['image_url'] = '';
	$ad['destination_url'] = '';
	$ad['format'] = '125';
	$ad['click_limit'] = '0';
	$ad['showing'] = 1;
	$ad['position'] = '0';
	$ad['priority'] = '0';
	$ad['display_from'] = date("Y-m-d H:i:s");
	$ad['display_to'] = date("Y-m-d H:i:s", time() + 30 * 24 * 3600);
	$ad['ignore_date'] = 0;
	$ad['new_window'] = 1;

	$messages = array();
	$can_go = true;
	if(!empty($_POST)){
		if(!wp_verify_nonce($_POST['nonce'], 'uds-ads-create')){
			$can_go = false;
			$messages[] = __('Security check failed', 'uds-textdomain');
		}
		
		if(empty($_POST['name'])){
			$can_go = false;
			$messages[] = __('Name cannot be empty', 'uds-textdomain');
		}
		
		if(empty($_POST['image_url'])){
			$can_go = false;
			$messages[] = __('Image cannot be empty', 'uds-textdomain');
		}
		
		if(empty($_POST['destination_url'])){
			$can_go = false;
			$messages[] = __('Destination URL cannot be empty', 'uds-textdomain');
		}
		
		$ad = array();
		$ad['id'] = $_POST['ad_id'];
		$ad['name'] = $_POST['name'];
		$ad['image_url'] = $_POST['image_url'];
		$ad['destination_url'] = $_POST['destination_url'];
		$ad['format'] = $_POST['format'];
		$ad['click_limit'] = $_POST['click_limit'];
		$ad['showing'] = $_POST['showing'] == 'on' ? 1 : 0;
		$ad['position'] = $_POST['position'];
		$ad['priority'] = $_POST['priority'];
		$ad['display_from'] = $_POST['display_from'];
		$ad['display_to'] = $_POST['display_to'];
		$ad['ignore_date'] = $_POST['ignore_date'] == 'on' ? 1 : 0;
		$ad['times_clicked'] = '0';
		$ad['new_window'] = $_POST['new_window'] == 'on' ? 1 : 0;
		
		if($can_go){
			$result = false;
			$id = (int)$_POST['ad_id'];
			if($id == 0){
				$result = create_ad($ad);
				if($result){
					$messages[] = __('Ad created successfully.', 'uds-textdomain');
				} else {
					$messages[] = __('Failed to create ad.', 'uds-textdomain');
				}
			} else {
				$result = update_ad($ad);
				if($result){
					$messages[] = __('Ad updated successfully.', 'uds-textdomain');
				} else {
					$messages[] = __('Failed to update ad.', 'uds-textdomain');
				}
			}
		}
	}
	
	$nonce = wp_create_nonce('uds-ads-create');
	
	if($id != 0){
		$ad = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix . UDS_ADS_TABLE_NAME ." WHERE id=$id");
	}
	
	$ad = array2object($ad);
?>
<div class="wrap">
	<?php if($id == 0): ?>
		<h2><?php _e('Create Ad', 'uds-textdomain') ?></h2>
	<?php else: ?>
		<h2><?php _e('Update Ad', 'uds-textdomain') ?></h2>
	<?php endif; ?>
	
	<div class="messages">
		<?php foreach($messages as $message): ?>
			<div><?php echo $message?></div>
		<?php endforeach; ?>
	</div>
	
	<form action="<?php admin_url("admin.php?page=uds_ads_create" . ($id == 0 ? '' : '&id='.$id)) ?>" method="POST">
		<input type="hidden" name="nonce" value="<?php echo $nonce ?>" />
		<input type="hidden" name="ad_id" value="<?php echo $id ?>" />
		<table class="uds-ads-create">
			<tr>
				<td><?php _e('Name', 'uds-textdomain') ?></td>
				<td><input type="text" name="name" value="<?php echo $ad->name ?>" /></td>
				<td class="desc"><i><?php _e('Ad name, does not have to be unique, will be displayed as image title', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Image', 'uds-textdomain') ?></td>
				<td>
					<a class="thickbox" title="<?php esc_attr_e('Add an Image', 'uds-textdomain') ?>" id="ads_image_insert" href="media-upload.php?type=image&TB_iframe=true&width=640&height=345">
					<?php if(!empty($ad->image_url)): ?>
						<img id="image" src="<?php echo $ad->image_url ?>" alt="" />
					<?php else: ?>
						<?php _e('Add Image', 'uds-textdomain') ?>
					<?php endif; ?>
					</a><br />
					<input type="text" name="image_url" id="ad_image"  value="<?php echo $ad->image_url ?>" />
				</td>
				<td class="desc"><i><?php _e('Ad Image (required)', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Destination URL', 'uds-textdomain') ?></td>
				<td><input type="text" name="destination_url"  value="<?php echo $ad->destination_url ?>" /></td>
				<td class="desc"><i><?php _e('URL that the Ad points to', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Format', 'uds-textdomain') ?></td>
				<td>
					<select name="format">
					<?php foreach($uds_ads_resolutions as $key => $value): ?>
						<option value="<?php echo $key ?>" <?php echo  $key == $ad->format ? "selected='selected'" : "" ?>><?php echo $value ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td class="desc"><i><?php _e('Ad image resolution', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Click limit', 'uds-textdomain') ?></td>
				<td>
					<input type="text" name="click_limit" value="<?php echo $ad->click_limit ?>" />
				</td>
				<td class="desc"><i><?php _e('Ad will automatically stop showing if click limit is reached.', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Showing', 'uds-textdomain') ?></td>
				<td>
					<input type="checkbox" name="showing" <?php echo $ad->showing == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i><?php _e('Unchecked will prevent Ad from showing.', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Position', 'uds-textdomain') ?></td>
				<td>
					<select name="position">
					<?php for($i = 0; $i < UDS_ADS_MAX_POSITION; $i++): ?>
						<option value="<?php echo $i ?>"<?php echo  $i == $ad->position ? "selected='selected'" : "" ?>><?php echo $i + 1 ?></option>
					<?php endfor; ?>
					</select>
				</td>
				<td class="desc"><i><?php _e('Shows Ad in widget with this number', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Priority', 'uds-textdomain') ?></td>
				<td>
					<select name="priority">
						<?php for($i = 0; $i < UDS_ADS_MAX_PRIORITY; $i++): ?>
							<option value="<?php echo $i ?>" <?php echo  $i == $ad->priority ? "selected='selected'" : "" ?>><?php echo $i + 1 ?></option>
						<?php endfor; ?>
					</select>
				</td>
				<td class="desc"><i><?php _e('This will be used to sort ads', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Display from', 'uds-textdomain') ?></td>
				<td>
					<input type="text" name="display_from" value="<?php echo $ad->display_from ?>" />
				</td>
				<td class="desc"><i><?php _e("Don't display the Ad before this date", 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Display to') ?></td>
				<td>
					<input type="text" name="display_to" value="<?php echo $ad->display_to ?>" />
				</td>
				<td class="desc"><i><?php _e('Stops showing the Ad after this date', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Ignore Date', 'uds-textdomain') ?></td>
				<td>
					<input type="checkbox" name="ignore_date" <?php echo $ad->ignore_date == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i><?php _e('Ignore previous two fields', 'uds-textdomain') ?></i></td>
			</tr>
			<tr>
				<td><?php _e('Open in new window', 'uds-textdomain') ?></td>
				<td>
					<input type="checkbox" name="new_window" <?php echo $ad->new_window == 1 ? "checked='checked'" : "" ?> />
				</td>
				<td class="desc"><i><?php _e('Adds target=&quot;_blank&quot;', 'uds-textdomain') ?></i></td>
			</tr>
		</table>
		<?php if($id == 0): ?>
		<input type="submit" value="<?php esc_attr_e('Create ad' , 'uds-textdomain') ?>" />
		<?php else: ?>
		<input type="submit" value="<?php esc_attr_e('Update ad', 'uds-textdomain') ?>" />
		<?php endif; ?>
	</form>
</div>
<script language='JavaScript' type='text/javascript'>
var send_to_editor = function(img){
	 tb_remove();
	 if(jQuery(jQuery(img)).is('a')){ // work around Link URL supplied
	 	var src = jQuery(jQuery(img)).find('img').attr('src');
	 } else {
	 	var src = jQuery(jQuery(img)).attr('src');
	 }
	 
	 //console.log(window.receiver);
	 jQuery('#ads_image_insert').html('<img src="'+src+'" alt="" />');
	 jQuery("#ad_image").val(src);
}
jQuery('.billboard-image,#uds-logo,#uds-favicon').click(function(){
	set_receiver(this);
});
</script>