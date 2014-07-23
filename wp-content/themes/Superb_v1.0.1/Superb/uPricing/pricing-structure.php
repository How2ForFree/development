<?php
global $uds_errors; 

if(!empty($_GET['uds_pricing_edit'])) {
	$pricing_table_name = $_GET['uds_pricing_edit'];
} else {
	$pricing_table_name = '';
}

$pricing_table_name = !empty($_POST['uds-pricing-table-name']) ? $_POST['uds-pricing-table-name'] : $pricing_table_name;

$editing = true;
if(empty($pricing_table_name)) {
	$editing = false;
}

$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));

$pricing_table = $pricing_tables[$pricing_table_name];

$edit = "";
if(!empty($pricing_table_name)) {
	$edit = "&uds_pricing_edit=$pricing_table_name";
}

?>
<div class="wrap">
	<?php if(!$editing): ?>
		<h2><?php _e('Create new Pricing Table structure', 'uds-textdomain') ?></h2>
	<?php else: ?>
		<h2><?php _e('Edit Pricing Table Structure', 'uds-textdomain') ?></h2>
	<?php endif; ?>
	<?php if(!empty($pricing_tables)): ?>
		<div class="uds-pricing-edit">
			<label for=""><?php _e('Edit', 'uds-textdomain') ?></label>
			<select class="uds-load-pricing-table">
				<?php foreach($pricing_tables as $name => $table): ?>
					<option <?php echo $pricing_table_name == $name ? 'selected="selected"' : '' ?>><?php echo $name ?></option>
				<?php endforeach; ?>
			</select>
			<input type="submit" name="" value="<?php esc_attr_e('Load', 'uds-textdomain') ?>" class="submit button-primary uds-change-table" />
		</div>
	<?php endif; ?>
	<?php if(!empty($uds_errors)): ?>
		<div class="updated uds-warn">
			<ul>
				<?php foreach($uds_errors as $error): ?>
					<li><?php echo $error->get_error_message() ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<div id="uds-pricing-structure" class="uds-pricing">
		<form action="<?php echo admin_url("admin.php?page=uds_pricing_structure$edit") ?>" method="post">
			<input type="hidden" name="uds_pricing_nonce" value="<?php echo wp_create_nonce('uds-pricing-nonce') ?>" />
			<input type="hidden" name="uds_pricing_name_original" value="<?php echo $pricing_table_name ?>" />
			<h3><?php _e('General Options', 'uds-textdomain') ?></h3>
			<?php if($editing): ?>
				<a href="<?php echo admin_url("admin.php?page=uds_pricing_products$edit") ?>" class="backlink"><?php _e('Add/Edit Products', 'uds-textdomain') ?></a>
			<?php endif; ?>
			<div id="uds-pricing-options">
				<?php uds_pricing_render_general_options($pricing_table) ?>
			</div>
			<h3><?php _e('Properties', 'uds-textdomain') ?></h3>
			<div id="uds-pricing-properties">
				<table>
					<tr>
						<th class="label"><?php _e('Label', 'uds-textdomain') ?></th>
						<th class="type"><?php _e('Type', 'uds-textdomain') ?></th>
						<th colspan="3" class="actions"><?php _e('Actions', 'uds-textdomain') ?></th>
					</tr>
					<?php if(!empty($pricing_table['properties'])): ?>
						<?php foreach($pricing_table['properties'] as $name => $type): ?>
						<tr>
							<td>
								<input type="text" name="labels[]" value="<?php echo $name ?>" />
							</td>
							<td>
								<select name="types[]">
									<option value="text" <?php if($type == 'text') echo "selected='selected'"?>><?php _e('Text', 'uds-textdomain') ?></option>
									<option value="checkbox" <?php if($type == 'checkbox') echo "selected='selected'"?>><?php _e('Checkbox', 'uds-textdomain') ?></option>
								</select>
							</td>
							<td>
								<div class="move"><?php _e('Move', 'uds-textdomain') ?></div>
							</td>
							<td>
								<div class="delete"><?php _e('Delete', 'uds-textdomain') ?></div>
							</td>
							<td>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					<tr>
						<td>
							<input type="text" name="labels[]" value="" />
						</td>
						<td>
							<select name="types[]">
								<option value="text"><?php _e('Text', 'uds-textdomain') ?></option>
								<option value="checkbox"><?php _e('Checkbox', 'uds-textdomain') ?></option>
							</select>
						</td>
						<td>
							<div class="move"><?php _e('Move', 'uds-textdomain') ?></div>
						</td>
						<td>
							<div class="delete"><?php _e('Delete', 'uds-textdomain') ?></div>
						</td>
						<td>
							<div class="add"><?php _e('Add', 'uds-textdomain') ?></div>
						</td>
					</tr>
				</table>
				<input type="submit" name="" class="submit button-primary" value="<?php esc_attr_e('Update', 'uds-textdomain')?>" />
				<div class="clear"></div>
			</div>
		</form>
	</div>
</div>