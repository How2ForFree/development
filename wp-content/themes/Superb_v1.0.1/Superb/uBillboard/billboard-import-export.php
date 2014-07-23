<div class="wrap">
	<h2><?php _e('Import/Export uBillboards', 'uds-textdomain') ?></h2>
	<?php if(!empty($uds_billboard_errors)): ?>
		<div class="updated uds-warn">
			<p><?php echo implode('</p><p>', $uds_billboard_errors) ?></p>
		</div>
	<?php endif; ?>
	<div class="uds-billboard-export">
		<h3><?php _e('Export', 'uds-textdomain') ?></h3>
		<?php printf(__('Download your exported uBillboards %shere%s.', 'uds-textdomain'), '<a href="admin.php?page=uds_billboard_import_export&download_export=' . wp_create_nonce('uds-billboard-export') . '">', '</a>') ?>
	</div>
	<div class="uds-billboard-import">
		<h3><?php _e('Import', 'uds-textdomain') ?></h3>
		<form method="post" action="" enctype="multipart/form-data">
			<label for="uds-billboard-import-attachments">
				<?php _e('Import attachments', 'uds-textdomain') ?>: <input type="checkbox" name="import-attachments" id="uds-billboard-import-attachments" />
			</label><br />
			<input type="file" name="uds-billboard-import" value="<?php esc_attr_e('Upload Exported uBillboard', 'uds-textdomain') ?>" />
			<input type="submit" name="" value="<?php esc_attr_e('Import', 'uds-textdomain') ?>" />
		</form>
	</div>
	<p><em><?php _e('Note', 'uds-textdomain') ?>:</em> <?php _e('Importer will attempt to download all slide images that are not located on this host.', 'uds-textdomain') ?></p>
</div>