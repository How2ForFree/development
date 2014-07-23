<?php

class uds_contact_extension {
	
	var $plugin_name = "udsContact";
	var $plugin_dir = 'uds-contact';
	
	function uds_contact_extension()  {
		//print UDS_CONTACT_PATH.'tinymce/'.$this->plugin_dir.'/editor_plugin.js';;
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		
		// init process for contact control
		add_action('init', array (&$this, 'add_button') );
	}

	function add_button() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
			// add the contact for wp2.5 in a new way
			add_filter("mce_external_plugins", array (&$this, "add_tinymce_plugin" ), 6);
			add_filter('mce_buttons_4', array (&$this, 'register_button' ), 6);
		}
	}
	
	// used to insert contact in wordpress 2.5x editor
	function register_button($buttons) {
	
		array_push(
			$buttons,
			$this->plugin_name
		);

		return $buttons;
	}	
	
	
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_tinymce_plugin($plugin_array) {    
	
		$plugin_array[$this->plugin_name] =  UDS_CONTACT_URL.'tinymce/'.$this->plugin_dir.'/editor_plugin.js';

		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
		return ++$version;
	}
	
}

// Call it now
new uds_contact_extension();

?>