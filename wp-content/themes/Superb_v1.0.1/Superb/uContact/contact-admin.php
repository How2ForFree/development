<?php
	//delete_option(UDS_CONTACT_OPTION);
	$forms = maybe_unserialize(get_option(UDS_CONTACT_OPTION, array()));
	
	if(isset($_GET['uds_contact_delete_nonce']) && wp_verify_nonce($_GET['uds_contact_delete_nonce'], 'uds-contact-delete-nonce')) {
		unset($forms[$_GET['uds_contact_delete']]);
		update_option(UDS_CONTACT_OPTION, serialize($forms));
	}
	
?>
<div class="wrap">
	<h2><?php _e('Add/Edit Contact Forms', 'uds-textdomain') ?></h2>
	<?php if(!empty($forms)): ?>
		<table class="uds-contact-admin-table">
			<tr>
				<th><?php _e('Contact form name', 'uds-textdomain') ?></th>
				<th><?php _e('Shortcode', 'uds-textdomain') ?></th>
				<th><?php _e('Edit', 'uds-textdomain') ?></th>
				<th><?php _e('Delete', 'uds-textdomain') ?></th>
			</tr>
			<?php foreach($forms as $name => $form): ?>
				<tr>
					<td><?php echo $name ?></td>
					<td>[uds-contact-form name="<?php echo $name ?>"]</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_contact_add&uds_contact_edit='.urlencode($name)) ?>" class="contact-edit"><?php _e('Edit', 'uds-textdomain') ?></a>
					</td>
					<td>
						<a href="<?php echo admin_url('admin.php?page=uds_contact_admin&uds_contact_delete='.urlencode($name)).'&uds_contact_delete_nonce='.wp_create_nonce('uds-contact-delete-nonce') ?>" class="contact-delete"><?php _e('Delete', 'uds-textdomain') ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php else: ?>
		<p class="updated uds-warn"><?php printf(__('There are no Contact forms defined yet. Create your first one %shere%s.', 'uds-textdomain'), "<a href=" . admin_url('admin.php?page=uds_contact_add') . ">", '</a>') ?> </p>
	<?php endif; ?>
</div>