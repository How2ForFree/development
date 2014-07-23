<?php
	//delete_option(UDS_PRICING_OPTION);
	$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));
	//d($pricing_tables);
	if(isset($_GET['uds_pricing_delete_nonce']) && wp_verify_nonce($_GET['uds_pricing_delete_nonce'], 'uds-pricing-delete-nonce')) {
		unset($pricing_tables[$_GET['uds_pricing_delete']]);
		update_option(UDS_PRICING_OPTION, serialize($pricing_tables));
	}
	
?>
<div class="wrap">
	<h2><?php _e('Pricing Tables', 'uds-textdomain') ?></h2>
	<?php if(!empty($pricing_tables)): ?>
		<div class="create-pricing-table">
			<a href="<?php echo admin_url("admin.php?page=uds_pricing_structure") ?>"><?php _e('Create new Pricing Table', 'uds-textdomain') ?></a>
		</div>
		<table class="uds-pricing-admin-table">
			<tr>
				<th><?php _e('Name', 'uds-textdomain') ?></th>
				<th class="shortcode"><?php _e('Shortcode', 'uds-textdomain') ?></th>
				<th><?php _e('Properties', 'uds-textdomain') ?></th>
				<th><?php _e('Products', 'uds-textdomain') ?></th>
				<th><?php _e('Edit Structure', 'uds-textdomain') ?></th>
				<th><?php _e('Edit Products', 'uds-textdomain') ?></th>
				<th><?php _e('Delete', 'uds-textdomain') ?></th>
			</tr>
			<?php foreach($pricing_tables as $name => $pricing_table): ?>
				<tr>
					<td><?php echo $name ?></td>
					<td>[uds-pricing-table name="<?php echo $name ?>"]</td>
					<td><?php echo count($pricing_table['properties']); ?></td>
					<td><?php echo count($pricing_table['products']); ?></td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_structure&uds_pricing_edit='.urlencode($name)) ?>" class="pricing-edit-structure"><?php _e('Edit', 'uds-textdomain') ?></a>
					</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_products&uds_pricing_edit='.urlencode($name)) ?>" class="pricing-edit-products"><?php _e('Edit', 'uds-textdomain') ?></a>
					</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_pricing_admin&uds_pricing_delete='.urlencode($name)).'&uds_pricing_delete_nonce='.wp_create_nonce('uds-pricing-delete-nonce') ?>" class="pricing-delete"><?php _e('Delete', 'uds-textdomain') ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php else: ?>
		<p class="updated uds-warn"><?php printf(__("There are no Pricing tables defined yet. Create your first one %shere%s.", 'uds-textdomain'), "<a href='" . admin_url('admin.php?page=uds_pricing_structure') . "'>", '</a>') ?></p>
	<?php endif; ?>
</div>