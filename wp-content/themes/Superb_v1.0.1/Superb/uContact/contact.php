<?php
// General Options
define('UDS_CONTACT_VERSION', '2.1.0');
define('UDS_CONTACT_USE_COMPRESSION', true);
if(uds_billboard_is_plugin()) {
	define('UDS_CONTACT_URL', plugin_dir_url(__FILE__));
	define('UDS_CONTACT_PATH', plugin_dir_path(__FILE__));
} else {
	define('UDS_CONTACT_URL', trailingslashit(get_template_directory_uri() . '/uContact'));
	define('UDS_CONTACT_PATH', trailingslashit(get_template_directory() . '/uContact'));
}

// User configurable options
define('UDS_CONTACT_OPTION', 'uds-contact');

include 'contact-widget.php';
include 'tinymce/uds-contact/extension.php';
register_widget('uContact');

add_option(UDS_CONTACT_OPTION, array());

$uds_contact_field_types = array(
	'text' => array(
		'name' => __('Text field', 'uds-textdomain'),
		'description' => __('<p>Regular textfield. Can be used for any data that is either 
			a singular value (like numbers) or short strings (few words or a sentence).
			</p><p>Validators include email and required.</p>', 'uds-textdomain'),
		'required' => false,
		'label' => '',
		'default' => '',
		'allowed-validators' => array(
			'nonempty',
			'email'
		),
		'validators' => array(
			
		),
		'messages' => array()
	),
	'textarea' => array(
		'name' => __('Text area', 'uds-textdomain'),
		'description' => __('<p>Regular textarea. Used for longer chunks of text (like a Message), 
			provides multiline input. Can be marked as &quot;required&quot;</p>', 'uds-textdomain'),
		'required' => false,
		'label' => '',
		'default' => '',
		'allowed-validators' => array(
			'nonempty'
		),
		'validators' => array(
			
		),
		'messages' => array()
	),
	'email' => array(
		'name' => __('&quot;Reply to&quot; Email', 'uds-textdomain'),
		'description' => __('<p>&quot;Reply To&quot; Email. If you use this field instead of
			the standard textfield with email validation, the email supplied here will be
			used in the &quot;Reply-to&quot; email header. So if you reply to the email 
			from this contact form, you will reply directly to the person who wrote you.</p>', 'uds-textdomain'),
		'required' => true,
		'label' => __('E-mail', 'uds-textdomain'),
		'default' => '',
		'allowed-validators' => array(
			'nonempty',
			'email'
		),
		'validators' => array(
			'nonempty',
			'email'
		),
		'messages' => array()
	),
	'captcha' => array(
		'name' => __('reCaptcha', 'uds-textdomain'),
		'description' => __('<p>Captcha field. Enable this option if you are getting a lot of spam
			from this contact form. We use reCaptcha, so you&quot;ll need to apply for an
			API key. Enable captcha on the right side and then drag this to the contact form
			to create the captcha field</p>', 'uds-textdomain'),
		'required' => true,
		'label' => __('Captcha', 'uds-textdomain'),
		'default' => '',
		'publickey' => '',
		'privatekey' => '',
		'theme' => 'white',
		'allowed-validators' => array(
			'captcha'
		),
		'validators' => array(
			'captcha'
		),
		'messages' => array()
	)
);

$uds_contact_validators = array(
	'nonempty' => array(
		'name' => __('Non-empty', 'uds-textdomain'),
		'description' => __('Can be used for textfields, textareas, etc.', 'uds-textdomain'),
		'error' => __('%FIELD% can not be empty', 'uds-textdomain')
	),
	'email' => array(
		'name' => __('Email', 'uds-textdomain'),
		'description' => __('Email validation, can be used for textfields', 'uds-textdomain'),
		'error' => __('%VALUE% is not a valid email address', 'uds-textdomain')
	),
	'captcha' => array(
		'name' => __('Captcha', 'uds-textdomain'),
		'description' => __('Captcha validator', 'uds-textdomain'),
		'error' => __('Captcha verification failed', 'uds-textdomain')
	)
);

function uds_contact_is_active()
{
	if(is_active_widget(false, false, 'ucontact')) {
		return true;
	}
	
	if(function_exists('uds_active_shortcodes')) {
		$active_shortcodes = uds_active_shortcodes();
		if( ! in_array('uds-contact-form', $active_shortcodes)) {
			return false;
		}
	}
	
	return true;
}

// initialize billboard
add_action('init', 'uds_contact_init');
function uds_contact_init()
{
	// Basic init
	if(!is_admin()) {
		include 'recaptchalib.php';		
	}
}

add_action('wp_print_styles', 'uds_contact_styles');
function uds_contact_styles()
{
	if(!uds_contact_is_active()) return;
	
	$dir = UDS_CONTACT_URL;
	wp_enqueue_style('uds-contact', $dir.'css/contact.css', false, false, 'screen');
}

add_action('wp_print_scripts', 'uds_contact_scripts');
function uds_contact_scripts()
{
	global $wp_version;
	if(!uds_contact_is_active()) return;
	
	$dir = UDS_CONTACT_URL;
	// We need to override jQuery on WP < 3.0 because the default there is jQuery 1.3 and we need 1.4
	if(version_compare($wp_version, '3.0.0', '<=')){
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
	}
	
	if(UDS_CONTACT_USE_COMPRESSION){
		wp_enqueue_script("uds-contact", $dir."js/contact.min.js", array('jquery'));
	} else {
		wp_enqueue_script("uds-contact", $dir."js/contact.js", array('jquery'));
	}
}

////////////////////////////////////////////////////////////////////////////////
//
//	Admin menus
//
////////////////////////////////////////////////////////////////////////////////

add_action('admin_menu', 'uds_contact_menu');
function uds_contact_menu()
{
	global $menu;
	$position = 104;
	if(!empty($menu[$position])) $position = null;
	
	$icon = UDS_CONTACT_URL . 'images/menu-icon.png';
	$contact = add_menu_page(__("uContact", 'uds-textdomain'), __("uContact", 'uds-textdomain'), 'manage_options', 'uds_contact_admin', 'uds_contact_admin', $icon, $position);
	$contact_add = add_submenu_page('uds_contact_admin', __("Add Contact Form", 'uds-textdomain'), __('Add Contact Form', 'uds-textdomain'), 'manage_options', 'uds_contact_add', 'uds_contact_add');
	
	add_action("admin_print_styles-$contact", 'uds_contact_enqueue_styles');
	add_action("admin_print_styles-$contact_add", 'uds_contact_enqueue_styles');
	
	add_action("admin_print_scripts-$contact", 'uds_contact_enqueue_scripts');
	add_action("admin_print_scripts-$contact_add", 'uds_contact_enqueue_scripts');
}

// Admin menu entry handling
function uds_contact_admin()
{
	include 'contact-admin.php';
}

// Admin menu entry handling
function uds_contact_add()
{
	include 'contact-add.php';
}

function uds_contact_enqueue_styles()
{
	$dir = UDS_CONTACT_URL;
	wp_enqueue_style('uds-contact', $dir.'css/contact-admin.css', false, false, 'screen');
}

function uds_contact_enqueue_scripts()
{
	$dir = UDS_CONTACT_URL;
	wp_enqueue_script("jquery-ui-sortable");
	wp_enqueue_script("jquery-ui-draggable");
	wp_enqueue_script("jquery-ui-droppable");
	wp_enqueue_script('uds-contact', $dir."js/contact-admin.js");
}
////////////////////////////////////////////////////////////////////////////////
//
//	Form update handling
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_form_update($struct)
{
 	global $uds_contact_field_types;
 	
 	if(!isset($struct['uds-contact-nonce'])) {
 		return;
 	}
 	
 	if(!wp_verify_nonce($struct['uds-contact-nonce'], 'uds-contact-nonce')) {
 		die(__('Security check failed', 'uds-textdomain'));
 	}
 	
 	$forms = maybe_unserialize(get_option(UDS_CONTACT_OPTION, array()));
	$form = array();
	$ids = $struct['uds-ids'];
	//d($_POST);
	if(!empty($ids)) {
		$types = $struct['uds-types'];
		if($struct['uds-contact-form-name-original'] != $struct['uds-contact-form-name']) {
			unset($forms[$struct['uds-contact-form-name-original']]);
		}
		
		$form['submit'] = $_POST['uds-contact-form-submit'];
		$form['email'] = $_POST['uds-contact-form-email'];
		$form['use-captcha'] = $_POST['uds-contact-form-use-captcha'];
		$form['captcha-publickey'] = $_POST['uds-contact-form-captcha-publickey'];
		$form['captcha-privatekey'] = $_POST['uds-contact-form-captcha-privatekey'];
		
		// field types are indexed equally as IDs, therefore we access them with the $idid
		foreach($ids as $idid => $id) {
			if(!isset($types[$idid])) continue;
			
			$type = $types[$idid];
			$fields = $uds_contact_field_types[$type];
			$fields['type'] = $type;
			if($type != 'captcha') {
				$fields['label'] = $struct['uds-field-labels'][$id];
				$fields['required'] = isset($struct['uds-field-required'][$id]) ? $struct['uds-field-required'][$id] : '';
			}
			
			// process validators
			foreach($fields['allowed-validators'] as $validator) {
				$status = isset($struct['uds-field-validator-'.$validator][$id]) ? $struct['uds-field-validator-'.$validator][$id] : null;
				if($status == 'on') {
					if(!in_array($validator, $fields['validators'])) {
						$fields['validators'][] = $validator;
					}
				} else {
					if(in_array($validator, $fields['validators'])) {
						unset($fields['validators'][$validator]);
					}
				}
			}
			
			$form['fields'][] = $fields;
		}
	}
	
	$forms[$struct['uds-contact-form-name']] = $form;
	
	//d($forms);
	
	update_option(UDS_CONTACT_OPTION, serialize($forms));
}

////////////////////////////////////////////////////////////////////////////////
//
//	Admin options rendering functions
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_admin_render_field($id = '_ID_', $field_type = 'text', $options = array())
{
	global $uds_contact_field_types, $uds_contact_validators;
	$defaults = $uds_contact_field_types[$field_type];
	
	$name = $defaults['name'];
	
	$label = $required = $validators = '';
	if($field_type != 'captcha') {
		$label_value = empty($options['label']) ? $defaults['label'] : $options['label'];
		$label = "
			<div class='options-label'>
				<label for='uds-field-label-$id'>Label:</label>
				<input type='text' name='uds-field-labels[$id]' id='uds-field-label-$id' value='$label_value' />
				<div class='clear'></div>
			</div>
		";
	
		$required_value = isset($options['required']) ? ( $options['required'] == 'on' ? 'checked="checked"' : '' ) : ($defaults['required'] == 'on' ? 'checked="checked"' : '');
		$required = "
			<div class='options-required'>
				<label for='uds-field-required-$id'>Required:</label>
				<input type='checkbox' name='uds-field-required[$id]' id='uds-field-required-$id' class='checkbox' $required_value />
				<div class='clear'></div>
			</div>
		";
		
		$validators_values = empty($defaults['allowed-validators']) ? array() : $defaults['allowed-validators'];

		if(!empty($validators_values)) {
			$validator_listing = '';
			foreach($validators_values as $validator) {
				$value = in_array($validator, empty($options['validators']) ? $defaults['validators'] : $options['validators']) ? 'checked="checked"' : '';
				$validator_label = $uds_contact_validators[$validator]['name'];
				$validator_listing .= "
					<div>
						<label for='uds-field-validator-$validator-$id'>$validator_label</label>
						<input type='checkbox' name='uds-field-validator-{$validator}[$id]' id='uds-field-validator-$validator-$id' class='checkbox' $value />
						<div class='clear'></div>
					</div>
				";
			}
			$validators = "
				<div class='options-validators'>
					<p>Validators:</p>
					<div class='validators-listing'>
						$validator_listing
					</div>
					<div class='clear'></div>
				</div>
			";
		}
	}
	
	$out = "
		<div class='uds-contact-field $field_type'>
			<h3>$name</h3>
			<div class='uds-actions'>
				<span class='uds-actions-move'>" . __('Move', 'uds-textdomain') . "</span>
				<span class='uds-actions-delete'>" . __('Delete', 'uds-textdomain') . "</span>
			</div>
			<input type='hidden' name='uds-ids[]' value='$id' />
			<input type='hidden' name='uds-types[]' value='$field_type' />
			$label
			$required
			$validators
		</div>
	";
	
	return $out;
}

////////////////////////////////////////////////////////////////////////////////
//
//	Frontend field rendering functions
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_render_field($key, $field, $form)
{
	$field_type = $field['type'];
	$required = empty($field['required']) ? '' : 'required';
	$messages = implode("\n", $field['messages']);
	$error = empty($messages) ? '' : 'error' ;
	$field['default'] = (isset($field['value']) && $form['success'] === false) ? $field['value'] : $field['default'];
	
	$rendered_field = call_user_func('uds_contact_render_'.$field['type'], $key, $field, $form);
	
	$out = "
		<div class='$key $required $field_type $error uds-contact-element'>
			<label for='$key'>{$field['label']}:</label>
			" . $rendered_field . "
			<div class='uds-contact-element-messages'>$messages</div>
			<div class='clear'></div>
		</div>
	";
	return $out;
}

function uds_contact_render_text($id, $field, $form)
{
	$out = "
		<input type='text' name='$id' id='$id' class='text $id' value='{$field['default']}' />
	";
	return $out;
}

function uds_contact_render_textarea($id, $field, $form)
{
	$out = "
		<textarea name='$id' id='$id' class='text $id' rows='' cols=''>{$field['default']}</textarea>
	";
	return $out;
}

function uds_contact_render_email($id, $field, $form)
{
	$out = "
		<input type='text' name='$id' id='$id' class='email $id' value='{$field['default']}' />
	";
	return $out;
}

function uds_contact_render_captcha($id, $field, $form)
{
	$publickey = $form['captcha-publickey'];
	$theme = $field['theme'];
	
	$out = '
		<script type="text/javascript">
			var RecaptchaOptions = {
				theme : "'.$theme.'"
			};
		</script>';
	$out .= recaptcha_get_html($publickey);
	$out .= "<div class='clear'></div>";
	return $out;
}

////////////////////////////////////////////////////////////////////////////////
//
//	Frontend API
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_form_process($name, $form)
{
	global $uds_contact_validators;
	$can_go = true;
	$email_message = "";
	$reply_to_email = '';
	
	foreach($form['fields'] as $key => $field) {
		// init messages field
		$form['fields'][$key]['messages'] = array();
		
		// captcha
		if($field['type'] == 'captcha' && $form['use-captcha'] == 'on') {
			$privatekey = $form['captcha-privatekey'];
			$response = recaptcha_check_answer(
				$privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]
			);
			
			if(!$response->is_valid) {
				$can_go = false;
				$form['fields'][$key]['messages'][] = "<p class='error'>" . __('Captcha verification failed', 'uds-textdomain') . "</p>";
			}
			
			continue;
		}
		
		// other fields
		$value = $_POST[$name . '-' . $key];
		if(!empty($field['required']) && empty($value)) {
			$can_go = false;
			$form['fields'][$key]['messages'][] = "<p class='error'>" . sprintf(__('Field %s is required', 'uds-textdomain'), "&quot;{$field['label']}&quot;") . "</p>";
		}
		
		// other validators
		if(is_array($field['validators'])) {
			foreach($field['validators'] as $validator) {
				if(false == call_user_func('uds_contact_validator_'.$validator, $value)) {
					$can_go = false;
					$error = str_replace('%FIELD%', '&quot;'.$field['label'].'&quot;', $uds_contact_validators[$validator]['error']);
					$error = str_replace('%VALUE%', '&quot;'.htmlspecialchars($value).'&quot;', $error);
					$form['fields'][$key]['messages'][] = "<p class='error'>$error</p>";
				}
			}
		}
		
		if($field['type'] == 'email' && is_email($value)) {
			$reply_to_email = $value;
		}
		
		$form['fields'][$key]['value'] = $value;
		$email_message .= $field['label'] . ': ' . $value . "\n\r";
	}
	
	$email_message .= "-------------------------------------------\n\r";
	$email_message .= __("Sent From", 'uds-textdomain') . ': ' . get_bloginfo('name') . " (" . get_bloginfo('url') . ")\n\r";
	$email_message .= __("Contact Form Name", 'uds-textdomain') . ": $name\n\r";
	
	$headers = '';
	if(!empty($reply_to_email)) {
		$headers .= __('From', 'uds-textdomain') . ': '.$reply_to_email.' <'.$reply_to_email.'>' . "\r\n\\";
	}
	
	if($can_go) {
		if(wp_mail($form['email'], $name, $email_message, $headers)) {
			$form['success'] = true;
			$form['messages'][] = '<p class="success">' . __('Successfuly sent', 'uds-textdomain') . '</p>';
		} else {
			$form['success'] = false;
			$form['messages'][] = '<p class="error">' . __('Failed to send email', 'uds-textdomain') . '</p>';
		}
	} else {
		$form['success'] = false;
		$form['messages'][] = '<p class="error">' . __('Form verification failed', 'uds-textdomain') . '</p>';
	}
	
	return $form;
}

function get_uds_contact_form($name)
{
	$forms = maybe_unserialize(get_option(UDS_CONTACT_OPTION, array()));

	if(!isset($forms[$name])) return "<div class='error'>" . sprintf(__('Contact form named: %s does not exist', 'uds-textdomain'), $name) . ".</div>";
	
	$form = $forms[$name];
	
	$name = uds_contact_form_name($name);
	
	// process incoming forms
	if(isset($_POST["uds-contact-form-nonce-$name"]) && wp_verify_nonce($_POST["uds-contact-form-nonce-$name"], "uds-contact-form-nonce-$name")) {
		$form = uds_contact_form_process($name, $form);
	}
	
	$fields = '';
	foreach($form['fields'] as $key => $field) {
		$fields .= uds_contact_render_field($name . '-' . $key, $field, $form);
	}
	
	empty($form['messages']) ? $messages = '' : $messages = implode("\n", $form['messages']);
	
	$out = "
		<div class='uds-contact-form $name'>
			<form method='post' action='".get_permalink()."'>
				<fieldset>
					<div class='messages'>$messages</div>
					<input type='hidden' name='uds-contact-form-nonce-$name' value='".wp_create_nonce("uds-contact-form-nonce-$name")."' />
					$fields
					<input type='submit' class='submit' value='{$form['submit']}' />
				</fieldset>
			</form>
		</div>
	";
	
	return $out;
}

add_shortcode('uds-contact-form', 'uds_contact_from_shortcode');
function uds_contact_from_shortcode($atts, $content = null)
{	
	extract(shortcode_atts(array(
		'name' => __('Contact', 'uds-textdomain')
	), $atts));
	return get_uds_contact_form($name);
}

////////////////////////////////////////////////////////////////////////////////
//
//	Helpers
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_form_name($name)
{
	return sanitize_title($name);
}

////////////////////////////////////////////////////////////////////////////////
//
//	Validators
//
////////////////////////////////////////////////////////////////////////////////

function uds_contact_validator_nonempty($arg)
{
	return !empty($arg);
}

function uds_contact_validator_email($arg)
{
	return is_email($arg);
}

function uds_contact_validator_captcha($arg)
{
	// captcha is validated in place, return true
	return true;
}

?>