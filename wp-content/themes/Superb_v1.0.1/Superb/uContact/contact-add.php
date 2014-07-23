<?php

global $uds_contact_field_types;

if(!empty($_GET['uds_contact_edit'])) {
	$form_name = $_GET['uds_contact_edit'];
} else {
	$form_name = '';
}

$form_name = !empty($_POST['uds-contact-form-name']) ? $_POST['uds-contact-form-name'] : $form_name;

$editing = true;
if(empty($form_name)) {
	$editing = false;
}

if(wp_verify_nonce(isset($_POST['uds-contact-nonce']) ? $_POST['uds-contact-nonce'] : '', 'uds-contact-nonce')) {
	uds_contact_form_update($_POST);
} elseif(!empty($_POST)) {
	die(__("Secuity check failed", 'uds-textdomain'));
}

$forms = maybe_unserialize(get_option(UDS_CONTACT_OPTION, array()));

$form = $forms[$form_name];
//$form['fields'][3]['type'] = 'textarea';
?>
<div class="wrap">
	<?php if(empty($_GET['uds-contact-edit'])): ?>
		<h2><?php _e('Create new Contact Form', 'uds-textdomain') ?></h2>
	<?php else: ?>
		<h2><?php _e('Edit Contact Form', 'uds-textdomain') ?></h2>
	<?php endif; ?>
	<div id="uds-instructions">
		<p><?php _e('Drag Contact form field types from the left to the right to create contact form.', 'uds-textdomain') ?></p>
	</div>
	<div id="uds-contact-sample">
	</div>
	<div id="uds-contact-templates">
		<?php $i = 0;?>
		<?php foreach($uds_contact_field_types as $key => $field_type): ?>
			<div>
				<a href="javascript:void(0)" id="uds-contact-create-<?php echo $key ?>" class="uds-contact-create"><?php printf(__('Drag to create %s', 'uds-textdomain'), $field_type['name']) ?></a>
				<?php echo uds_contact_admin_render_field('_ID_', $key, $field_type) ?>
			</div>
			<?php $i++;?>
		<?php endforeach; ?>
	</div>
	<div id="uds-contact-descriptions">
		<h3><?php _e('Help', 'uds-textdomain') ?>:</h3>
		<p class="hint"><?php _e('Hover over page elements to display contextual help', 'uds-textdomain') ?></p>
		<div id="uds-contextual-help"></div>
		<?php foreach($uds_contact_field_types as $key => $field_type): ?>
			<div id="uds-contact-describe-<?php echo $key ?>">
				<?php echo $field_type['description'] ?>
			</div>
		<?php endforeach; ?>
	</div>
	<div id="uds-arrow"></div>
	<div id="uds-contact-form-assembly">
		<form method="post" action="<?php echo admin_url('admin.php?page=uds_contact_add') ?>">
			<input type="hidden" name="uds-contact-nonce" value="<?php echo wp_create_nonce('uds-contact-nonce') ?>" />
			<input type="hidden" name="uds-contact-form-name-original" value="<?php echo $form_name ?>" />
			<input type="hidden" name="uds-contact-id-counter" value="<?php echo count($form['fields']) ?>" class="uds-contact-id-counter" />
			<div class="uds-contact-from-general-options">
				<div>
					<label for="uds-form-name"><?php _e('Form name', 'uds-textdomain') ?>:</label>
					<input type="text" id="uds-form-name" name="uds-contact-form-name" value="<?php echo $form_name ?>" />
					<div class="clear"></div>
				</div>
				<div>
					<label for="uds-form-submit"><?php _e('Submit Button Text', 'uds-textdomain') ?>:</label>
					<input type="text" id="uds-form-submit" name="uds-contact-form-submit" value="<?php echo $form['submit'] ?>" />
					<div class="clear"></div>
				</div>
				<div>
					<label for="uds-form-submit"><?php _e('Send To Email Address', 'uds-textdomain') ?>:</label>
					<input type="text" id="uds-form-email" name="uds-contact-form-email" value="<?php echo $form['email'] ?>" />
					<div class="clear"></div>
				</div>
				<div>
					<label for="uds-use-recaptcha"><?php _e('Use Captcha', 'uds-textdomain') ?>:</label>
					<input type="checkbox" name="uds-contact-form-use-captcha" <?php echo $form['use-captcha'] == 'on' ? 'checked="checked"' : '' ?> />
					<div class="clear"></div>
				</div>
				<div class="uds-captcha">
					<div>
						<label for="uds-captcha-publickey"><?php _e('reCaptcha Public Key', 'uds-textdomain') ?>:</label>
						<input type="text" id="uds-captcha-publickey" name="uds-contact-form-captcha-publickey" value="<?php echo $form['captcha-publickey'] ?>" />
						<div class="clear"></div>
					</div>
					<div>
						<label for="uds-captcha-privatekey"><?php _e('reCaptcha Private Key', 'uds-textdomain') ?>:</label>
						<input type="text" id="uds-captcha-privatekey" name="uds-contact-form-captcha-privatekey" value="<?php echo $form['captcha-privatekey'] ?>" />
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div id="uds-contact-fields">
				<?php if(!empty($form['fields'])): ?>
					<?php foreach($form['fields'] as $key => $field): ?>
						<?php echo uds_contact_admin_render_field($key, $field['type'], $field) ?>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="uds-contact-fields-empty"><?php _e('Drop Fields Here', 'uds-textdomain') ?></p>
				<?php endif; ?>
			</div>
			<input type="submit" value="<?php echo $editing ? __('Update', 'uds-textdomain') : __('Create', 'uds-textdomain') ?>" class="submit button-primary" />
		</form>
	</div>
</div>