<?php

//Load WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

global $domain;

//Get the options
include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';

$mail_to = $jw_email;
$mail_subject = 'Message from '.get_bloginfo('name');

$sendmail = false;
$aErrors = array();

if(isSet($_REQUEST['cemail'])) {
	
	if(!isSet($_REQUEST['cname']) OR empty($_REQUEST['cname'])) {
		$aErrors[] = 'Please fill in your name';
	}
	if(!isSet($_REQUEST['cemail']) OR !preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_REQUEST['cemail'])) {
		$aErrors[] = 'Please fill in your mail';
	}
	if(!isSet($_REQUEST['ccomment']) OR empty($_REQUEST['ccomment'])) {
		$aErrors[] = 'Please fill in a message';
	}
	
	if(count($aErrors)===0) {
		$mailbody = "Message sent from IP: {$_SERVER['REMOTE_ADDR']}\n";
		$mailbody .= "Name: ".strip_tags($_REQUEST['cname'])."\n";
		$mailbody .= "Email: ".strip_tags($_REQUEST['cemail'])."\n\n";
		$mailbody .= "Message:\n";
		$mailbody .= strip_tags($_REQUEST['ccomment']);
		@mail($mail_to, $mail_subject, $mailbody);
		$sendmail = true;
	}	
}

if($sendmail === true) {
	?><p><?php _e('Your message is sent.', $domain); ?></p><?php
}else{
	?><p><?php _e('There was a problem. Try again later.', $domain); ?></p><?php
}

?>