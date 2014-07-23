<?php
session_start();
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
die('Please do not load this page directly. Thanks!');
}

/* CHECK IF CONTACT FORM SHOULD BE DISPLAYD ON THIS PAGE/POST */
if(get_post_meta($post->ID, '_screen-showContact', true) == 'true') {
$contactTitle = get_post_meta($post->ID, '_screen-contact-title', true);
$showGender = get_post_meta($post->ID, '_screen-contact-showGender', true);
$showName = get_post_meta($post->ID, '_screen-contact-showName', true);
$contactNameRequired = get_post_meta($post->ID, '_screen-contact-nameRequired', true);
$showAddress = get_post_meta($post->ID, '_screen-contact-showAddress', true);
$contactAddressRequired = get_post_meta($post->ID, '_screen-contact-addressRequired', true);
$showPostalcode = get_post_meta($post->ID, '_screen-contact-showPostalcode', true);
$contactPostalcodeRequired = get_post_meta($post->ID, '_screen-contact-postalcodeRequired', true);
$showCity = get_post_meta($post->ID, '_screen-contact-showCity', true);
$contactCityRequired = get_post_meta($post->ID, '_screen-contact-cityRequired', true);
$showCountry = get_post_meta($post->ID, '_screen-contact-showCountry', true);
$contactCountryRequired = get_post_meta($post->ID, '_screen-contact-countryRequired', true);
$showTelephone = get_post_meta($post->ID, '_screen-contact-showTelephone', true);
$contactTelephoneRequired = get_post_meta($post->ID, '_screen-contact-telephoneRequired', true);
$showEmail = get_post_meta($post->ID, '_screen-contact-showEmail', true);
$contactEmailRequired = get_post_meta($post->ID, '_screen-contact-emailRequired', true);
$showMessage = get_post_meta($post->ID, '_screen-contact-showMessage', true);
$contactMessageRequired = get_post_meta($post->ID, '_screen-contact-messageRequired', true);
$contactCaptcha = get_post_meta($post->ID, '_screen-contact-captcha', true);

/* IF FORM HAS BEEN SUBMITTED */
if(isset($_POST['contact-sent'])) {
  if($contactCaptcha == 'false' || md5(strtoupper($_POST['captcha'])) == $_SESSION['captchatxt']) {
	$emailTo = get_post_meta($post->ID, '_screen-contact-emailto', true);
	$subject = trnslt('This message was sent from') . ' ' . get_bloginfo('name') . ' (' . get_bloginfo('url') . ')';
	$mailText = $subject . '
------------------------------------------------

';
	if(isset($_POST['contact-gender'])) {
	  $mailText .= trnslt('Gender') . ': ';
	  if($_POST['contact-gender'] == 'm') {
		$mailText .= trnslt('Male') . '
';
	  } else {
		$mailText .= trnslt('Female') . '
';
	  }
	}
	if(isset($_POST['contact-name'])) {
	  $mailText .= trnslt('Name') . ': ' . $_POST['contact-name'] . '
';
	}
	if(isset($_POST['contact-address'])) {
	  $mailText .= trnslt('Address') . ': ' . $_POST['contact-address'] . '
';
	}
	if(isset($_POST['contact-postalcode'])) {
	  $mailText .= trnslt('Postal code') . ': ' . $_POST['contact-postalcode'] . '
';
	}
	if(isset($_POST['contact-city'])) {
	  $mailText .= trnslt('City') . ': ' . $_POST['contact-city'] . '
';
	}
	if(isset($_POST['contact-country'])) {
	  $mailText .= trnslt('Country') . ': ' . $_POST['contact-country'] . '
';
	}
	if(isset($_POST['contact-telephone'])) {
	  $mailText .= trnslt('Telephone') . ': ' . $_POST['contact-telephone'] . '
';
	}
	if(isset($_POST['contact-email'])) {
	  $mailText .= trnslt('E-mail') . ': ' . $_POST['contact-email'] . '
';
	}
	if(isset($_POST['contact-message'])) {
	  $mailText .= trnslt('Message') . ':
' . $_POST['contact-message'];
	}
	$mailText .= '
  
------------------------------------------------
Powered by Theme Dutch (www.theme-dutch.com)';
  
	$message = '';
	$headers = 'From: ' . get_bloginfo('name') . '<' . get_bloginfo('admin_email') . '>' . "\r\n" .
	'Reply-To: ' . get_bloginfo('admin_email') . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	/* Send e-mail */
	if(mail($emailTo, $subject, $mailText, $headers)) {
	  $message = trnslt('Your information has been successfully sent.');
	} else {
	  $message = trnslt('Something went wrong whilst sending your information. Please try again at a later time.');
	}
  } else {
	$message = trnslt('Wrong CAPTCHA code entered.');
  }
}

/* Display form elements */
?>
<form method="post" action="" name="contactform" id="contactform">
  <?php
	if(trim($contactTitle) != '') {
  ?>
  <h2><?php echo $contactTitle; ?></h2>
  <?php
	}
	if(isset($message)) {
  ?>
  <div id="contact-message"><?php echo $message; ?></div>
  <?php
	}
  ?>
  <div id="contact-error"><?php echo trnslt('Please fill in all required (*) fields.'); ?></div>
  <?php
	if($showGender == 'true') {
	  $fSel = ($_POST['contact-gender'] == 'f') ? ' checked' : '';
	  $mSel = ($fSel == '') ? ' checked' : '';
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Gender'); ?>:</div>
	<div class="contact-field"><input type="radio" name="contact-gender" value="m"<?php echo $mSel; ?> /> <?php echo trnslt('Male'); ?><input type="radio" name="contact-gender" value="f"<?php echo $fSel; ?> /> <?php echo trnslt('Female'); ?></div>
  </div>
  <?php
	}
	if($showName == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Name'); ?><?php if($contactNameRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-name" value="<?php echo $_POST['contact-name']; ?>"<?php if($contactNameRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showAddress == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Address'); ?><?php if($contactAddressRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-address" value="<?php echo $_POST['contact-address']; ?>"<?php if($contactAddressRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showPostalcode == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Postal code'); ?><?php if($contactPostalcodeRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-postalcode" value="<?php echo $_POST['contact-postalcode']; ?>"<?php if($contactPostalcodeRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showCity == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('City'); ?><?php if($contactCityRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-city" value="<?php echo $_POST['contact-city']; ?>"<?php if($contactCityRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showCountry == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Country'); ?><?php if($contactCountryRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-country" value="<?php echo $_POST['contact-country']; ?>"<?php if($contactCountryRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showTelephone == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Telephone'); ?><?php if($contactTelephoneRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-telephone" value="<?php echo $_POST['contact-telephone']; ?>"<?php if($contactTelephoneRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showEmail == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('E-mail'); ?><?php if($contactEmailRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><input type="text" name="contact-email" value="<?php echo $_POST['contact-email']; ?>"<?php if($contactEmailRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
  </div>
  <?php
	}
	if($showMessage == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label"><?php echo trnslt('Message'); ?><?php if($contactMessageRequired == 'true') { ?> *<?php } ?></div>
	<div class="contact-field"><textarea name="contact-message" rows="" cols=""<?php if($contactMessageRequired == 'true') { ?> class="required-field"<?php } ?>><?php echo $_POST['contact-message']; ?></textarea></div>
  </div>
  <?php
	}
	if($contactCaptcha == 'true') {
  ?>
  <div class="contact-row">
	<div class="contact-label">&nbsp;</div>
	<div class="contact-field"><img src="<?php bloginfo('template_url'); ?>/lib/captcha/captcha.php" style="margin:0 0 5px 0; float:none;" /><br /><input type="text" name="captcha" value="" class="required-field" /></div>
  </div>
  <?php } ?>
  <div class="contact-row">
	<div class="contact-label"><input type="hidden" name="contact-sent" value="1" />&nbsp;</div>
	<div class="contact-field"><a href="javascript:void(0)" class="cp td-button" id="contact-submit"><span><?php echo trnslt('Submit'); ?></span></a></div>
  </div>
  <div class="floatfix"></div>
</form>
<?php
}
?>