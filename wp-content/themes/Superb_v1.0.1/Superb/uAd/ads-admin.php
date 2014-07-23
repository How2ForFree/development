<?
	$table = $wpdb->prefix . UDS_ADS_TABLE_NAME;
	
	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
	if($id != 0 && wp_verify_nonce($_GET['nonce'], 'ads_delete')){
		delete_ad($id);
	}

	$ads = $wpdb->get_results("SELECT * FROM $table ORDER BY created DESC");
	$nonce = wp_create_nonce('ads_delete');
?>
<div class="wrap">
	<h2><?php _e('Ads Management', 'uds-textdomain') ?></h2>
<? if(!empty($ads)): ?>
	<table class="uds-ads">
		<tr>
			<th><?php _e('ID', 'uds-textdomain') ?></th>
			<th><?php _e('Name', 'uds-textdomain') ?></th>
			<th><?php _e('Showing', 'uds-textdomain') ?></th>
			<th><?php _e('Display From/To', 'uds-textdomain') ?></th>
			<th><?php _e('Click Limit', 'uds-textdomain') ?></th>
			<th><?php _e('Times Clicked', 'uds-textdomain') ?></th>
			<th><?php _e('Created', 'uds-textdomain') ?></th>
			<th><?php _e('Modified', 'uds-textdomain') ?></th>
			<th><?php _e('Actions', 'uds-textdomain') ?></th>
		</tr>
		<? foreach($ads as $ad): ?>
			<tr>
				<td><?=$ad->id?></td>
				<td><?=$ad->name?></td>
				<td><?=$ad->showing == 1 ? "Yes" : "No"?></td>
				<td>
					<? if($ad->ignore_date == 0): ?>
						<?=date('Y/m/d', strtotime($ad->display_from))?> - <?=date('Y/m/d', strtotime($ad->display_from))?>
					<? else: ?>
						-
					<? endif; ?>
				</td>
				<td><?=$ad->click_limit?></td>
				<td><?=$ad->times_clicked?></td>
				<td><?=date('d M Y H:i', strtotime($ad->created))?></td>
				<td><?=date('d M Y H:i', strtotime($ad->modified))?></td>
				<td>
					<a href="admin.php?page=uds_ads_view&id=<?=$ad->id?>"><img src="<?php echo get_template_directory_uri().'/uAd/images/view.png'?>" alt="View" /></a>
					<a href="admin.php?page=uds_ads_create&id=<?=$ad->id?>"><img src="<?php echo get_template_directory_uri().'/uAd/images/edit.png'?>" alt="Edit" /></a>
					<a href="admin.php?page=uds_ads&id=<?=$ad->id?>&nonce=<?=$nonce?>" onclick="return confirm('Really delete?')"><img src="<?php echo get_template_directory_uri().'/uAd/images/delete.png'?>" alt="Delete" /></a>
				</td>
			</tr>
		<? endforeach; ?>
	</table>
<? else: ?>
	<p><?php _e('There are no ads defined yet.', 'uds-textdomain') ?></p>
	<p><?php _e('You can create your first ad', 'uds-textdomain') ?> <a href="<? bloginfo('url') ?>/wp-admin/admin.php?page=uds_ads_create"><?php _e('here', 'uds-textdomain') ?></a>.</p>
<? endif; ?>
</div>