<?php

global $uds_billboard_attributes;

$billboards = maybe_unserialize(get_option(UDS_BILLBOARD_OPTION));

if(!empty($_GET['uds-billboard-edit']) && !empty($billboards[$_GET['uds-billboard-edit']])) {
	$billboard = $billboards[$_GET['uds-billboard-edit']];
}

// safety check
if(! is_array($billboard)) {
	$billboard = array();
}

$name = array_search($billboard, $billboards);

$billboard['slides'][] = uds_billboard_default_billboard();

?>
<div class="wrap">
	<?php if(empty($_GET['uds-billboard-edit'])): ?>
		<h2><?php _e('Create new uBillboard', 'uds-textdomain') ?></h2>
	<?php else: ?>
		<h2><?php _e('Edit uBillboard', 'uds-textdomain') ?></h2>
	<?php endif; ?>
	<?php if(!uds_billboard_cache_is_writable()): ?>
		<div class="updated uds-warn"><strong><?php _e('Warning!', 'uds-textdomain') ?></strong> <?php printf(__('Directory %s cache is not writable!', 'uds-textdomain'), UDS_BILLBOARD_PATH) ?></div>
	<?php endif; ?>
	<form action="" method="post" class="uds-billboard-form">
		<input type="hidden" name="uds-billboard-nonce" value="<?php echo wp_create_nonce('uds-billboard') ?>" />
		<input type="hidden" name="original_name" value="<?php echo $name ?>" />
		<div class="uds-billboard-options">
			<div class="close"></div>
			<h3><?php _e('General Options', 'uds-textdomain') ?></h3>
			<input type="submit" value="<?php esc_attr_e('Update', 'uds-textdomain') ?>"  class="submit button-primary" />
			<div class="inside">
				<?php uds_billboard_admin_options($billboard, $name) ?>
				<div class="clear"></div>
			</div>
		</div>
		<table id="uds-billboard-table">
			<?php foreach($billboard['slides'] as $key => $item): ?>
			<tr>
				<td>
					<a href="#" class="billboard-move" title="<?php esc_attr_e('Reorder Billboard Items', 'uds-textdomain') ?>"><?php _e('Move', 'uds-textdomain') ?></a>
					<a href="#" class="billboard-delete" title=<?php esc_attr_e("Delete Item", 'uds-textdomain') ?>><?php _e('Delete', 'uds-textdomain') ?></a>
				</td>
				<td>
					<?php foreach($uds_billboard_attributes as $attrib => $options): ?>
						<?php uds_billboard_render_field($item, $attrib, $key) ?>
					<?php endforeach; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<input type="submit" value="<?php esc_attr_e('Update', 'uds-textdomain') ?>"  class="submit button-primary" />
	</form>
</div>
<?php uds_billboard_render_js_support() ?>