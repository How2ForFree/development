<?php
	$uds_install_result = '';
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	if(!empty($action) && $action == 'install' && wp_verify_nonce($_POST['_wpnonce'], 'uds-install')) {
		$uds_install_result = uds_theme_install();
	}
?>
<div class="uds-wrap">
	<?php uds_admin_render_header() ?>
	<?php uds_admin_render_sidebar() ?>
	<div class="uds-admin-main">
		<h2><?php _e("Theme Installer", 'uds-textdomain') ?></h2>
		<?php
			global $uds_errors;
		?>
		<?php if(!empty($uds_errors)): ?>
			<div class="uds-errors">
				<?php foreach($uds_errors as $error): ?>
					<p class="error"><?php echo $error ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if(!empty($uds_install_result)): ?>
			<?php echo $uds_install_result ?><br />
			<a href="<?php echo admin_url("admin.php?page=uds_theme_admin_install") ?>"><?php _e("Return to install settings", 'uds-textdomain') ?></a>
		<?php else: ?>
			<form action="<?php echo admin_url("admin.php?page=uds_theme_admin_install&action=install") ?>" method="post" class="uds-install-form">
				<?php wp_nonce_field('uds-install') ?>
				<div class="uds-warn updated fade">
					<p><?php _e("Please read the accompanying documentation page carefully before using this feature!", 'uds-textdomain') ?></p>
				</div>
				<table id="uds-general-table">
					<tr class="odd">
						<td>
							<div class="-wrapper">
								<label><?php _e("Move original About page and Hello World post to Trash", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="delete" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
					<tr class="even">
						<td>
							<div class="-wrapper">
								<label><?php _e("Import all sample data", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="import" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
					<tr class="odd">
						<td>
							<div class="-wrapper">
								<label><?php _e("Set up permalinks", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="permalinks" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
					<tr class="even">
						<td>
							<div class="-wrapper">
								<label><?php _e("Set up Home and Blog Pages", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="setup_pages" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
					<tr class="odd">
						<td>
							<div class="-wrapper">
								<label><?php _e("Set up Widgets, uContact and uPricing", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="widgets" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
					<tr class="even">
						<td>
							<div class="-wrapper">
								<label><?php _e("Set up uBillboard", 'uds-textdomain') ?></label>
								<span class="switch">
									<input type="checkbox" name="ubillboard" checked="checked" />
								</span>
							</div>
						</td>
					</tr>
				</table>
				<input type="submit" value="<?php esc_attr_e("Update", 'uds-textdomain') ?>" class="submit" />
			
		<?php endif; ?>
	</div>
</div>
<?php uds_render_js_support() ?>